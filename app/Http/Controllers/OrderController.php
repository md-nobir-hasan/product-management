<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use PDF;
use App\Http\Requests\StoreOrderRequests;
use App\Http\Requests\UpdateOrderRequests;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:Show Order']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->ccan('Show Order');
        $n['orders'] = Order::with(['product', 'Branch'])->orderBy('id', 'desc')->paginate(10);
        $n['count'] = DB::table("orders")->get();
        return view('backend.order.index', $n);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $n['products'] = Product::with(['Color', 'Size', 'Branch'])
            ->where('status', 'active')
            ->where('stock', '>', 0)
            ->latest()
            ->get();

        return view('backend.selling.index', $n);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequests $request)
    {
        $this->ccan('Create Order');

        $data = $request->validated();

        $order_number = 'ORD-' . rand(1, 999) . strtoupper(Str::random(10));
        $user_id = Auth()->user()->id;
        foreach ($data['product'] as $key => $product) {
            $qty = (int)$product['qty'];
            $db_product = DB::table('products')->find($product['id']);
            if (!($qty <= $db_product->stock)) {
                request()->session()->flash('error', "Insufficient stock (S.L $key)");
                return back();
            }

            if ($qty > 0) {
                for ($i = 1; $i < $qty + 1; $i++) {
                    DB::table('orders')->insert([
                        'order_number' => $order_number,
                        'product_id' => $db_product->id,
                        'qty' => 1,
                        'inventory_cost' => $db_product->inventory_cost,
                        'dollar_cost' => $db_product->dollar_cost,
                        'other_cost' => $db_product->other_cost,
                        'price' => $db_product->price,
                        'discount' => $db_product->discount,
                        'selling_price' => $db_product->final_price,
                        'order_discount' => 0,
                        'final_price' => $db_product->final_price,
                        'user_id' => $user_id,
                    ]);
                }
                DB::table('products')->where('id', $product['id'])->decrement('stock', $qty);
            }
        }
        return to_route('order.edit', [$order_number]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->ccan('Show Order');

        $order = Order::with(['divission', 'cart'])->find($id);
        // return $order;
        return view('backend.order.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->ccan('Edit Order');
        $id_check = (int)$id;
        if ($id_check > 0) {
            $n['new_orders'] = Order::with('product')->where('id', $id_check)->get();
        } else {
            $n['new_orders'] = Order::with('product')->where('order_number', $id)->get();
        }

        $n['branches'] = DB::table("branches")->get();
        $n['order_statuses'] = DB::table("order_statuses")
            ->where('status', 'active')
            ->select('id', 'title')
            ->get();

        // dd($n,$id,$id_check);
        // if (count($n['new_orders']) < 1) {
        //     return to_route('selling');
        // }
        return view('backend.order.edit', $n);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequests $request, $id)
    {
        $this->ccan('Edit Order');
        $data = $request->validated();

        foreach ($data['order'] as $key => $order) {
            $order_fetch = DB::table('orders')->where('id', $order['id'])->first();
            $order_update = DB::table('orders')->where('id', $order['id'])->update([
                'qty' => $order['qty'],
                'selling_price' => $order['selling_price'],
                'order_discount' => $order['order_discount'],
                'final_price' => $order['final_price'],
                'branch_id' => $order['branch_id'],
                'order_status' => $order['order_status'],
            ]);
            $product_stock_manage = Product::find($order_fetch->product_id);
            $product_stock_manage->update(['stock' => $product_stock_manage->stock + $order_fetch->qty - $order['qty']]);
        }

        request()->session()->flash('success', 'Successfully updated order');
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->ccan('Delete Order');

        $order = Order::find($id);
        if ($order) {
            $status = $order->delete();
            if ($status) {
                request()->session()->flash('success', 'Order Successfully deleted');
            } else {
                request()->session()->flash('error', 'Order can not deleted');
            }
            return redirect()->route('order.index');
        } else {
            request()->session()->flash('error', 'Order can not found');
            return redirect()->back();
        }
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $setting = DB::table('other_settings')->first();;
        if ($order) {
            $update = $order->update([
                'is_cancelled' => 1,
                'previous_branch_id' => $order->branch_id,
                'branch_id' => $setting->branch_id,
            ]);
            DB::table('products')->where('id', $order->product_id)->increment('stock', $order->qty);
            request()->session()->flash('success', 'Successfully Canceled');
            return back();
        }
        request()->session()->flash('error', 'Something Wrong');
        return back();
    }

    public function uncancel($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->update([
                'is_cancelled' => 0,
                'branch_id' => $order->previous_branch_id,
            ]);
            DB::table('products')->where('id', $order->product_id)->decrement('stock', $order->qty);
            request()->session()->flash('success', 'Successfully Uncanceled');
            return back();
        }
        request()->session()->flash('error', 'Something Wrong');
        return back();
    }

    public function orderTrack()
    {
        return view('frontend.pages.order-track');
    }

    public function OrderTrackOrder(Request $request)
    {
        // return $request->all();
        $order = Order::where('user_id', auth()->user()->id)->where('order_number', $request->order_number)->first();
        if ($order) {
            if ($order->status == "new") {
                request()->session()->flash('success', 'Your order has been placed. please wait.');
                return redirect()->route('home');
            } elseif ($order->status == "process") {
                request()->session()->flash('success', 'Your order is under processing please wait.');
                return redirect()->route('home');
            } elseif ($order->status == "delivered") {
                request()->session()->flash('success', 'Your order is successfully delivered.');
                return redirect()->route('home');
            } else {
                request()->session()->flash('error', 'Your order canceled. please try again');
                return redirect()->route('home');
            }
        } else {
            request()->session()->flash('error', 'Invalid order numer please try again');
            return back();
        }
    }

    // PDF generate
    public function pdf(Request $request)
    {
        $order = Order::getAllOrder($request->id);
        // return $order;
        $file_name = $order->order_number . '-' . $order->first_name . '.pdf';
        // return $file_name;
        $pdf = PDF::loadview('backend.order.pdf', compact('order'));
        return $pdf->download($file_name);
    }
    // Income chart
    public function incomeChart(Request $request)
    {
        $year = \Carbon\Carbon::now()->year;
        // dd($year);
        $items = Order::with(['cart_info'])->whereYear('created_at', $year)->where('status', 'delivered')->get()
            ->groupBy(function ($d) {
                return \Carbon\Carbon::parse($d->created_at)->format('m');
            });
        // dd($items);
        $result = [];
        foreach ($items as $month => $item_collections) {
            foreach ($item_collections as $item) {
                $amount = $item->cart_info->sum('amount');
                // dd($amount);
                $m = intval($month);
                // return $m;
                isset($result[$m]) ? $result[$m] += $amount : $result[$m] = $amount;
            }
        }
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthName = date('F', mktime(0, 0, 0, $i, 1));
            $data[$monthName] = (!empty($result[$i])) ? number_format((float)($result[$i]), 2, '.', '') : 0.0;
        }
        return $data;
    }
}

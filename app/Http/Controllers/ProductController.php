<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Size;
use App\Models\Color;
use App\Models\Duration;
use App\Models\Graphic;
use App\Models\hdd;
use App\Models\Installment;
use App\Models\ProcessorGeneration;
use App\Models\ProcessorModel;
use App\Models\ProductOffer;
use App\Models\Ram;
use App\Models\SpecialFeature;
use App\Models\ssd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['can:Show Product']);
    }

    public function index()
    {
        $n['products'] = Product::with(['Color', 'Size', 'Branch'])->latest()->get();
        $n['count'] = DB::table('products')->get();
        return view('backend.product.index', $n);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->ccan('Create Product');
        $n['branches'] = Branch::get();
        $n['sizes'] = Size::get();
        $n['colors'] = Color::get();

        // $n['brands'] = Brand::get();
        // $n['p_generations'] = ProcessorGeneration::get();
        // $n['durations'] = Duration::where('status', true)->get();
        // $n['p_models'] = ProcessorModel::get();
        // $n['d_sizes'] = Size::get();
        // $n['d_types'] = Color::get();
        // $n['rams'] = Ram::get();
        // $n['hdds'] = hdd::get();
        // $n['graphics'] = Graphic::get();
        // $n['special_features'] = SpecialFeature::get();
        // $n['product_offers'] = ProductOffer::get();
        // $n['categories'] = Category::where('is_parent', 1)->get();
        // return $category;
        return view('backend.product.create', $n);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $this->ccan('Create Product');
        $data = $request->validated();
        $status = Product::create($data);
        if ($status) {
            request()->session()->flash('success', 'Product Successfully added');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $product = Product::with(['Color', 'Size', 'Branch'])->find($id);
        // return $products;
        return view('backend.product.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->ccan('Edit Product');
        $n['product'] = Product::find($id);
        $n['branches'] = Branch::get();
        $n['sizes'] = Size::get();
        $n['colors'] = Color::get();
        return view('backend.product.edit', $n);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $this->ccan('Edit Product');
        $product = Product::findOrFail($id);
        $data = $request->validated();
        $status =$product->update($data);
        if ($status) {
            request()->session()->flash('success', 'Product Successfully updated');
        } else {
            request()->session()->flash('error', 'Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->ccan('Delete Product');
        $product = Product::findOrFail($id);
        $status = $product->delete();

        if ($status) {
            request()->session()->flash('success', 'Product successfully deleted');
        } else {
            request()->session()->flash('error', 'Error while deleting product');
        }
        return redirect()->route('product.index');
    }
}

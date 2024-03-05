<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number', 'product_id', 'qty',
        'inventory_cost', 'dollar_cost', 'other_cost', 'price', 'discount',
        'selling_price', 'order_discount', 'final_price', 'branch_id',
        'order_status', 'is_cancelled', 'payment_method', 'user_id',
        'shipping_id', 'payment_status', 'transaction_id', 'comment', 'previous_branch_id',
    ];


    public static function getAllOrder($id)
    {
        return Order::with('cart_info')->find($id);
    }

    public static function countActiveOrder()
    {
        $data = Order::count();
        if ($data) {
            return $data;
        }
        return 0;
    }


    public function shipping()
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class);
    }
    public function pending()
    {
        return count($this->where('status', 'Pending')->get());
    }
    public function delivered()
    {
        return count($this->where('status', 'Delivered')->get());
    }
    public function cancelled()
    {
        return count($this->where('status', 'Cancelled')->get());
    }
}

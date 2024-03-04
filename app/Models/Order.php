<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable=['user_id','order_number','sub_total','quantity','delivery_charge',
     'amount','installment_count','payable','name','l_name','country','post_code','address','address2','phone','email','payment_method',
     'payment_status','shipping_id','coupon', 'order_status_id','divission_id', 'status', 'transaction_id',
        'currency', 'city', 'inventory_cost'];


    public static function getAllOrder($id){
        return Order::with('cart_info')->find($id);
    }

    public static function countActiveOrder(){
        $data=Order::count();
        if($data){
            return $data;
        }
        return 0;
    }


    public function shipping(){
        return $this->belongsTo(Shipping::class,'shipping_id');
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function Branch(){
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

    public function pending(){
        return count($this->where('status','Pending')->get());
    }
    public function delivered(){
        return count($this->where('status','Delivered')->get());
    }
    public function cancelled(){
        return count($this->where('status','Cancelled')->get());
    }


}

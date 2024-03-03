<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        //main field
        'title', 'code', 'inventory_cost', 'dollar_cost', 'other_cost', 'price',
        'discount', 'final_price', 'size_id', 'color_id', 'branch_id', 'stock', 'photo', 'status',
    ];

    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function Color()
    {
        return $this->belongsTo(Color::class);
    }

    public function Size()
    {
        return $this->belongsTo(Size::class);
    }

    public static function activeProduct()
    {
        $data = Product::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
    public function img()
    {
        return explode(',', $this->photo);
    }

    public static function getAllProduct()
    {
        return Product::with(['cat_info', 'sub_cat_info'])->orderBy('id', 'desc')->paginate(10);
    }

    public static function getProductByCode($slug)
    {
        return Product::with(['cat_info', 'rel_prods', 'getReview'])->where('slug', $slug)->first();
    }
    // public function cat_info()
    // {
    //     return $this->hasOne('App\Models\Category', 'id', 'cat_id');
    // }
    // public function sub_cat_info()
    // {
    //     return $this->hasOne('App\Models\Category', 'id', 'child_cat_id');
    // }

    // public function rel_prods()
    // {
    //     return $this->hasMany('App\Models\Product', 'cat_id', 'cat_id')->where('status', 'active')->orderBy('id', 'DESC')->limit(8);
    // }
    // public function getReview()
    // {
    //     return $this->hasMany('App\Models\ProductReview', 'product_id', 'id')->with('user_info')->where('status', 'active')->orderBy('id', 'DESC');
    // }



    // public function carts()
    // {
    //     return $this->hasMany(Cart::class)->whereNotNull('order_id');
    // }

    // public function wishlists()
    // {
    //     return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    // }

    // public function brand()
    // {
    //     return $this->hasOne(Brand::class, 'id', 'brand_id');
    // }

    // public function ProcessorGeneration()
    // {
    //     return $this->belongsTo(ProcessorGeneration::class);
    // }

    // public function ProcessorModel()
    // {
    //     return $this->belongsTo(ProcessorModel::class);
    // }



    // public function Ram()
    // {
    //     return $this->belongsTo(Ram::class);
    // }

    // public function ssd()
    // {
    //     return $this->belongsTo(ssd::class);
    // }

    // public function hdd()
    // {
    //     return $this->belongsTo(hdd::class);
    // }

    // public function Graphic()
    // {
    //     return $this->belongsTo(Graphic::class);
    // }

    // public function SpecialFeature()
    // {
    //     return $this->belongsTo(SpecialFeature::class);
    // }
    // public function ProductOffer()
    // {
    //     return $this->belongsTo(ProductOffer::class);
    // }


    // public function installment(): BelongsTo
    // {
    //     return $this->belongsTo(Installment::class);
    // }

    // public function storage()
    // {
    //     $strage = '';
    //     if ($this->ssd) {
    //         $strage = $strage . $this->ssd->name . ' SSD';
    //     }
    //     if ($this->hdd) {
    //         $strage = $strage . ', ' . $this->hdd->name . ' HDD';
    //     }
    //     return $strage;
    // }

    // public function totalOrder()
    // {
    //     return count($this->carts);
    // }

    // public function statusWiseOrderCount($status)
    // {
    //     if (count($this->carts) > 0) {
    //         $count = 0;
    //         foreach ($this->carts as $cart) {
    //             if ($cart->order->status == $status) {
    //                 $count++;
    //             }
    //         }
    //         return $count;
    //     } else {
    //         return 0;
    //     }
    // }
}

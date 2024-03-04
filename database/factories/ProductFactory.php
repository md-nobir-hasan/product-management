<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Color;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon as SupportCarbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $inventory_cost = rand(500,999999);
        $dollar_cost = $inventory_cost*5/100;
        $other_cost = $inventory_cost*10/100;
        $price = $inventory_cost + (40*$inventory_cost/100);
        $discount = rand(1,20)*$inventory_cost/100;
        $final_price = $price - $discount;
        $status = ['active','inactive'];

        return [
            'title' => fake()->title(),
            'code' => fake()->unique()->uuid(),
            'inventory_cost' => $inventory_cost,
            'dollar_cost' => $dollar_cost,
            'other_cost' => $other_cost,
            'price' => $price,
            'discount' => $discount,
            'final_price' => $final_price,
            'price' => rand(12000,500000),
            'discount' => rand(0,60),
            'final_price' => rand(12000,400000),
            'branch_id' => rand(1,4),
            'size_id' => rand(1,5),
            'color_id' => rand(1,7),
            'stock' => rand(1,20),
            'photo' => "/storage/default/5005.jpg,/storage/default/5007.jpg",
            'status' => $status[rand(0,1)],
        ];
    }
}

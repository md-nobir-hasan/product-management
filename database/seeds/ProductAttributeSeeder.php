<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $processer_generation = [
            ['name' => 'Intel 5th gen'],
            ['name' => 'Intel 6th gen'],
            ['name' => 'Intel 7th gen'],
            ['name' => 'Intel 8th gen'],
            ['name' => 'Intel 9th gen'],
            ['name' => 'Intel 10th gen'],
            ['name' => 'Intel 11th gen'],
            ['name' => 'Intel 12th gen'],
            ['name' => 'Intel 13th gen'],
            ['name' => 'AMD Ryzen 3000 series'],
            ['name' => 'AMD Ryzen 4000 series'],
            ['name' => 'AMD Ryzen 5000 series'],
            ['name' => 'AMD Ryzen 6000 series'],
            ['name' => 'AMD Ryzen 7000 series'],
        ];
        DB::table('processor_generations')->insert($processer_generation);

        $processer_model = [
            ['name' => 'Intel core i3'],
            ['name' => 'Intel core i5'],
            ['name' => 'Intel core i7'],
            ['name' => 'Intel core i9'],
            ['name' => 'AMD Athlon'],
            ['name' => 'AMD Ryzen 3'],
            ['name' => 'AMD Ryzen 5'],
            ['name' => 'AMD Ryzen 7'],
            ['name' => 'AMD Ryzen 9'],
            ['name' => 'Apple M1'],
            ['name' => 'Apple M1 Pro'],
            ['name' => 'Apple M1 Pro Max'],
            ['name' => 'Apple M2'],
            ['name' => 'Apple M2 Pro'],
            ['name' => 'Apple M2 Pro Max'],
        ];
        DB::table('processor_models')->insert($processer_model);

        $size = [
            ['name'=>'SM','measurement' => 13],
            ['name'=>'M','measurement' => 13],
            ['name'=>'L','measurement' => 14],
            ['name'=>'XL','measurement' => 15],
            ['name'=>'XXL','measurement' => 16], //5
        ];
        DB::table('sizes')->insert($size);

        $color = [
            ['name' => 'red','code'=> '#ff0000'],
            ['name' => 'green','code'=> '#008000'],
            ['name' => 'yellow','code'=> '#ffff00'],
            ['name' => 'black','code'=> '#000000'],
            ['name' => 'pink','code'=> '#ffc0cb'],
            ['name' => 'violet','code'=> '#ee82ee'],
            ['name' => 'blue','code'=> '#0000ff'], //7
        ];
        DB::table('colors')->insert($color);

        $ram = [
            ['ram' => '4','type'=>'DDR5','bus_speed'=>5500,],
            ['ram' => '8','type'=>'DDR5','bus_speed'=>5500,],
            ['ram' => '16','type'=>'DDR5','bus_speed'=>5500,],
            ['ram' => '32','type'=>'DDR5','bus_speed'=>5500,],
            ['ram' => '64','type'=>'DDR5','bus_speed'=>5500,],
        ];
        DB::table('rams')->insert($ram);

        $hdd = [
            ['name' => '512 MB'],
            ['name' => '1 TB'],
        ];
        DB::table('hdds')->insert($hdd);

        $branch = [
            ['name' => 'Dhaka'],
            ['name' => 'Chuadanga'],
            ['name' => 'Rajshahi'],
            ['name' => 'Chattogram'],
        ];
        DB::table('branches')->insert($branch);

        $graphic = [
            ['name' => 'Integrated/Shared'],
            ['name' => 'Dedicated 2GB'],
            ['name' => 'Dedicated 4GB'],
            ['name' => 'Dedicated 6GB'],
            ['name' => 'Dedicated 8GB'],
        ];
        DB::table('graphics')->insert($graphic);

        $special_feature = [
            ['name' => 'Backlit Keyboard'],
            ['name' => 'Finger Print'],
            ['name' => '360 Degree'],
            ['name' => 'Touch Screen'],
            ['name' => 'Type-C Port'],
        ];
        DB::table('special_features')->insert($special_feature);

        $brand = [
            ['title' => 'Asus','slug'=>'asus'],
            ['title' => 'HP','slug'=>'hp'],
            ['title' => 'DELL','slug'=>'dell'],
            ['title' => 'Lenovo','slug'=>'lenevo'],
            ['title' => 'Acer','slug'=>'acer'],
            ['title' => 'Apple','slug'=>'aplle'],
            ['title' => 'Walton','slug'=>'walton'],
        ];
        DB::table('brands')->insert($brand);

        $from = Carbon::now();
        $product_offer = [
            ['title' => 'Bkash New Year Cashback Offer','des'=> 'Pay with Bkash and Enjoy 10% instant Cashback!','dis'=>10,'from'=> $from,'to'=> $from->addDays(7), 'type' => 'Online'],
        ];
        DB::table('product_offers')->insert($product_offer);

        $duration = [
            ['year' => 1, 'month' => 6,'status'=>true],
            ['year' => 2, 'month' => 6,'status'=>true],
            ['year' => 0, 'month' => 6,'status'=>true],
            ['year' => 0, 'month' => 3,'status'=>true],
            ['year' => 1, 'month' => 3,'status'=>true],
        ];
        DB::table('durations')->insert($duration);
    }
}

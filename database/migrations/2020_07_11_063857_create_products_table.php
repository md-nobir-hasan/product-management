<?php

use App\Models\Size;
use App\Models\Color;
use App\Models\Branch;
use App\Models\Graphic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            //  😯😲😲 (88 fields) .. 😯😲😲
            // main attributes => (22)
            $table->id();
            $table->string('title');
            $table->string('code');
            $table->float('inventory_cost',10,2);
            $table->float('dollar_cost', 10, 2)->default(0);
            $table->float('other_cost', 10, 2)->default(0);
            $table->float('price', 10, 2);
            $table->float('discount', 10, 2)->default(0);
            $table->float('final_price', 10, 2);
            $table->foreignIdFor(Branch::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Size::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Color::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('stock')->default(1);
            $table->string('returned')->nullable();
            $table->text('photo');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

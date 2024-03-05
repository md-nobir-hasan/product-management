<?php

use App\Models\Branch;
use App\Models\Divission;
use App\Models\OrderStatus;
use App\Models\Product;
use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('qty');
            $table->float('inventory_cost',10,2);
            $table->float('dollar_cost',10,2);
            $table->float('other_cost',10,2);
            $table->float('price',10,2);
            $table->float('discount',10,2);
            $table->float('selling_price',10,2);
            $table->float('order_discount',10,2)->default(0);
            $table->float('final_price',10,2)->default(0);
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('previous_branch_id')->nullable();
            $table->string('order_status')->default('New');
            $table->boolean('is_cancelled')->default(0);
            $table->enum('payment_method',['cod','online'])->default('cod');
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->string('transaction_id')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('orders');
    }
}

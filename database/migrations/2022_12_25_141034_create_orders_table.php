
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('goods_id');
            $table->string('cat_id')->nullable();
            $table->string('variant')->nullable();
            $table->string('sku');
            $table->integer('quantity');
            $table->string('billno')->nullable();
            $table->string('price')->nullable();
            $table->string('discount')->nullable();
            $table->string('description')->nullable();
            $table->string('supplier')->default('shein')->nullable();
            $table->string('order_id');
            $table->string('order_details_id');
            $table->text('raw_receipt')->nullable();
            $table->string('status')->default('pending');
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
};

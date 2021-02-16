<?php

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
            $table->increments('id');
            $table->string('products', 300);
            $table->double('order_value_total', 8, 2);
            $table->double('payment_value', 8, 2);
            $table->string('payment_method', 5)->default('money');
            $table->double('change_value', 8, 2);
            $table->string('customer_name', 20)->nullable();
            $table->string('status', 9)->default('preparing');
            $table->rememberToken();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersProductsTable extends Migration {

	public function up()
	{
		Schema::create('orders_products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('Order_id');
			$table->integer('product_id')->nullable();
			$table->integer('quantity');
			$table->double('price');
		});
	}

	public function down()
	{
		Schema::drop('orders_products');
	}
}
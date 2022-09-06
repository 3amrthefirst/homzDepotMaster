<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRefundsProductsTable extends Migration {

	public function up()
	{
		Schema::create('refunds_products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id');
		    $table->integer('supplier_id');
			$table->integer('refund_id');
			$table->integer('quantity');
			$table->double('price');


		});
	}

	public function down()
	{
		Schema::drop('refunds_products');
	}
}

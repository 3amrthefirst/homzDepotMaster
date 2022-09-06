<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddQuantitiesTable extends Migration {

	public function up()
	{
		Schema::create('addQuantities', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id');
			$table->integer('admin_id')->nullable();
			$table->integer('supplier_id')->nullable();
			$table->integer('quantity');
			$table->enum('status', array('pending', 'accepted', 'rejected'));
		});
	}

	public function down()
	{
		Schema::drop('addQuantities');
	}
}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePullQuantitiesTable extends Migration {

	public function up()
	{
		Schema::create('pullQuantities', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id');
			$table->integer('supplier_id')->nullable();
			$table->integer('admin_id')->nullable();
			$table->integer('quantity');
			$table->enum('status', array('pending', 'accepted', 'rejected'));
		});
	}

	public function down()
	{
		Schema::drop('pullQuantities');
	}
}
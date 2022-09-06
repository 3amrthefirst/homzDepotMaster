<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('customer_id')->nullable();
			$table->double('total_after_discount')->nullable();
			$table->integer('government_id');
			$table->string('address');
			$table->double('totalPrice');
			$table->integer('discount_code_id')->nullable();
			$table->integer('shipping');
			$table->enum('status', array('pending','storePending' ,'inProgress', 'ready','delivered', 'received','notRecevied' ,'canceled', 'rejected'))
			->default('pending');
			$table->string('code');
			$table->string('phone');
			$table->string('name');
			$table->string('phone2')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
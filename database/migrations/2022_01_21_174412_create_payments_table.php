<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('supplier_id');
			$table->integer('amount');
			$table->integer('refund')->nullable();
			$table->integer('websiteProfit');
			$table->integer('allAmount');
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}

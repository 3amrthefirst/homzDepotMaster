<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReasonsTable extends Migration {

	public function up()
	{
		Schema::create('reasons', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('message');
			$table->string('product_id')->nullable();
			$table->integer('add_quantity_id')->nullable();
			$table->integer('pull_quantity_id')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('reasons');
	}
}

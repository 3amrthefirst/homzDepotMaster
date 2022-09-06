<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComplaintsTable extends Migration {

	public function up()
	{
		Schema::create('complaints', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('customer_id');
			$table->string('message', 1000);
			$table->string('phone', 15);
			$table->enum('type', array('complaint', 'suggestion'));
		});
	}

	public function down()
	{
		Schema::drop('complaints');
	}
}
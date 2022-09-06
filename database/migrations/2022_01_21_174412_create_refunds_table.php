<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRefundsTable extends Migration {

	public function up()
	{
		Schema::create('refunds', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('order_id')->nullable();
            $table->date('date');
			$table->enum('type', array('refund', 'substitution'));
			$table->string('address');
			$table->string('customerName');

			$table->string('phone');
		});
	}

	public function down()
	{
		Schema::drop('refunds');
	}
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDiscountCodesTable extends Migration {

	public function up()
	{
		Schema::create('discountCodes', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('code');
			$table->boolean('is_active')->default(0);
			$table->double('value');
			$table->string('status')->enum('value','percent');
			$table->double('max_value')->nullable();
			$table->double('total_price')->nullable();
			$table->integer('maxUser')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('discountCodes');
	}
}
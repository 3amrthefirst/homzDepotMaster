<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	public function up()
	{
		Schema::create('customers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('fname', 255);
			$table->string('lname', 255);
            $table->string('phone', 255)->nullable();
			$table->string('email');
			$table->string('password');
			$table->string('address', 1000)->nullable();
			$table->integer('pin_code')->nullable();
				$table->string('provider_user_id')->nullable();
			$table->enum('provider', ['facebook', 'google'])->nullable();
		});
	}

	public function down()
	{
		Schema::drop('customers');
	}
}
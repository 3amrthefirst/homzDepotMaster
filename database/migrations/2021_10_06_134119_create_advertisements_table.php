<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertisementsTable extends Migration {

	public function up()
	{
		Schema::create('advertisements', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
            $table->string('link')->nullable();
            $table->boolean('type')->default(0) ;   // if 0 show in product if 1 show in policy
			$table->boolean('is_active')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('advertisements');
	}
}

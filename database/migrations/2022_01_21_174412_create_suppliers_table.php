<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuppliersTable extends Migration {

	public function up()
	{
		Schema::create('suppliers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('code', 50);
			$table->string('password', 255);
			$table->string('email');
			$table->string('phone', 255);
			$table->double('adminProfit')->nullable();
			$table->double('allProfit')->nullable();
			$table->double('availableProfit')->nullable();
			$table->double('withdraw')->nullable();
			$table->double('allRefundProfit')->nullable();
			$table->double('refundProfit')->nullable();
		});
		App\Models\Supplier::create([
            'name'=>'hamada',
            'phone'=>'01065845129',
            'email'=>'supplier@supplier.com',
            'password'=>bcrypt(123),
        ]);
	}

	public function down()
	{
		Schema::drop('suppliers');
	}
}

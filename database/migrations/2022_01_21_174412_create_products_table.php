<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->double('price');
			$table->string('code');
			$table->string('size')->nullable();
			$table->string('material')->nullable();
            $table->string('description')->nullable();
			$table->integer('supplier_id');
			$table->integer('category_id');
			$table->integer('subCategory_id')->nullable();
			$table->integer('original_quantity')->nullable();
			$table->integer('availableQuantity')->nullable();
			$table->integer('refundQuantity')->nullable();
			$table->integer('saledQuantity')->nullable();
			$table->enum('status', array('pending', 'accepted', 'rejected'));
			$table->boolean('is_active')->default(0);
			$table->enum('receivedTime', array('oneWeek', 'twoWeek', 'byOrder'));
			$table->string('colorName')->nullable();
			$table->double('discountValue')->nullable();
			$table->double('discountPercent')->nullable();
			$table->boolean('discountValueStatus')->default(0);
			$table->boolean('discountPercentStatus')->default(0);
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}

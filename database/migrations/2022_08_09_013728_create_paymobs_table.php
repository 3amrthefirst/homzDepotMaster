<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymobs', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->integer('order');
            $table->integer('amount_cent');
            $table->boolean('success');
            $table->boolean('error_occured');
            $table->boolean('is_refunded');
            $table->integer('customer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paymobs');
    }
}

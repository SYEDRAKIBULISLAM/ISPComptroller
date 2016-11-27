<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('consumer_id')->unsigned();
            $table->integer('bill_id')->unsigned();
            $table->integer('amount');
            $table->integer('due')->nullable();
            $table->integer('discount')->nullable();
            $table->date('date');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('consumer_id')->references('id')->on('consumers');
            $table->foreign('bill_id')->references('id')->on('bills');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payments');
    }
}

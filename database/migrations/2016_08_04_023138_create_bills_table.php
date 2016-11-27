<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('consumer_id')->unsigned();
            $table->integer('generate_bill_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('amount');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('consumer_id')->references('id')->on('consumers');
            $table->foreign('generate_bill_id')->references('id')->on('generate_bills');
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
        Schema::drop('bills');
    }
}

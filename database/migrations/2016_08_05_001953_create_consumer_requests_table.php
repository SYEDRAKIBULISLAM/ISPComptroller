<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConsumerRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumer_requests', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('consumer_id')->unsigned();
            $table->string('note');
            $table->date('date');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('consumer_id')->references('id')->on('consumers');
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
        Schema::drop('consumer_requests');
    }
}

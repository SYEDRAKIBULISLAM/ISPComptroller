<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConsumersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('occupation');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('present_address');
            $table->string('permanent_address');
            $table->string('img_name');
            $table->string('NID');
            $table->integer('package_id')->unsigned();
            $table->integer('amount');
            $table->string('IP');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('package_id')->references('id')->on('packages');
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
        Schema::drop('consumers');
    }
}

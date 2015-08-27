<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('mindbody_id')->unsigned()->unique();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();

            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->integer('postal_code')->unsigned()->nullable();

            $table->string('mobile_phone')->nullable();
            $table->string('home_phone')->nullable();

            $table->boolean('active')->default(1);
            $table->string('photo_url')->nullable();

            $table->integer('account_balance')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers');
    }
}

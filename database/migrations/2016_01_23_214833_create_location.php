<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80)->unique();
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 10)->unique();
            $table->string('name', 100);
            $table->string('address', 100);
            $table->string('address_number', 4);
            $table->double('address_lat', 10, 8);
            $table->double('address_long', 10, 8);
            $table->string('postal', 6);
            $table->string('city', 50);
            $table->date('placed_at');
            $table->date('planned_till');
            $table->date('removed_at')->nullable();
            $table->string('contact_name', 60);
            $table->string('phone', 15);
            $table->string('email', 120);
            $table->boolean('data_requested', 8);
            $table->boolean('active')->default(1);
            $table->text('note')->nullable();
            $table->timestamps();
            $table->integer('source_id')->unsigned()->nullable();
            $table->foreign('source_id')->references('id')->on('sources')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('locations');
        Schema::drop('sources');
    }
}

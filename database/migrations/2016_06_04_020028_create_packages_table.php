<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('code');
            $table->string('description');

            $table->enum('state', ['low', 'sold', 'rented', 'available']);

            $table->integer('box_id')->unsigned()->nullable(); // Temporary
            $table->foreign('box_id')->references('id')->on('boxes');

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
        Schema::drop('packages');
    }
}

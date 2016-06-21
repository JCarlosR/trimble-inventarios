<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devolutions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('output_detail_id')->unsigned()->nullable();
            $table->foreign('output_detail_id')->references('id')->on('output_details');

            $table->integer('output_package_id')->unsigned()->nullable();
            $table->foreign('output_package_id')->references('id')->on('output_packages');

            // The item/package, has been returned?
            // $table->boolean('returned')->default(false);

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
        Schema::drop('devolutions');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutputPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('output_packages', function (Blueprint $table) {
            $table->increments('id');

            // Output header
            $table->integer('output_id')->unsigned();
            $table->foreign('output_id')->references('id')->on('outputs');

            $table->integer('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages');

            $table->decimal('price', 9,2);
            $table->decimal('originalprice', 9,2);

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
        Schema::drop('output_packages');
    }
}

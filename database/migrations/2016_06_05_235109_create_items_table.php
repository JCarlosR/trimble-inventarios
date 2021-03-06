<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->string('series');

            $table->enum('state', ['low', 'sold', 'rented', 'available', 'packaging', 'annulled'])->default('available');

            $table->integer('package_id')->unsigned()->nullable();
            $table->foreign('package_id')->references('id')->on('packages');

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
        Schema::drop('items');
    }
}

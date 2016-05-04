<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->decimal('price', 6,3);
            $table->integer('serie');
            $table->integer('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->integer('model_id')->unsigned();
            $table->foreign('model_id')->references('id')->on('models');
            $table->string('numParte');
            $table->string('color');
            $table->integer('categorie_id')->unsigned();
            $table->foreign('categorie_id')->references('id')->on('subCategories');
            $table->integer('subCategorie_id')->unsigned();
            $table->foreign('subCategorie_id')->references('id')->on('subCategories');
            $table->string('comment');
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
        Schema::drop('products');
    }
}

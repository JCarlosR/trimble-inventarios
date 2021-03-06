<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('document');
            $table->string('address');
            $table->enum('type', ['Natural', 'Juridica']);
            $table->string('phone');
            $table->integer('enable')->unsigned();

            $table->integer('provider_type_id')->unsigned();
            $table->foreign('provider_type_id')->references('id')->on('provider_types');

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
        Schema::drop('providers');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outputs', function (Blueprint $table) {
            $table->increments('id');

            // Customer
            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');

            // Employee who registered the output
            $table->enum('reason', ['sale', 'rental']);

            $table->boolean('active')->default(true);

            // General data
            $table->enum('type', ['local', 'foreign']);
            $table->enum('currency', ['PEN', 'USD']);
            $table->string('comment');

            // Invoice data
            $table->string('invoice'); // number
            $table->date('invoice_date')->nullable();

            // Rental data
            $table->date('fechaAlquiler')->nullable();
            $table->date('fechaRetorno')->nullable();
            $table->string('destination')->nullable();

            // For rentals, this indicates the status of the devolution
            $table->boolean('completed')->default(false);

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
        Schema::drop('outputs');
    }
}

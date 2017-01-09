<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');

            // Customer
            $table->integer('provider_id')->unsigned()->nullable();
            $table->foreign('provider_id')->references('id')->on('providers');

            // Employee who registered the output
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->boolean('active')->default(true);

            // General data
            $table->enum('currency', ['PEN', 'USD']);
            $table->string('comment');
            $table->decimal('igv', 9,2);
            $table->decimal('total', 9,2);
            $table->decimal('shipping', 9,2);
            $table->integer('state')->unsigned();//1:pendiente; 0: completa

            // Invoice data
            $table->string('invoice'); // number
            $table->enum('type_doc', ['F', 'B']); // type
            $table->date('invoice_date')->nullable();
            
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
        Schema::drop('purchase_orders');
    }
}

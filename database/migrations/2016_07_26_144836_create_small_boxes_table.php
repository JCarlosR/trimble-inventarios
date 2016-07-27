<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmallBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('small_boxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('concept');
            $table->enum('type', ['input', 'output', 'assign']);
            $table->decimal('amount', 9,2);
            $table->string('voucher');
            $table->integer('enable')->unsigned();

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
        Schema::drop('small_boxes');
    }
}

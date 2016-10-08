<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetractionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detractions', function (Blueprint $table) {
            $table->increments('id');

            // Output associated
            $table->integer('output_id')->unsigned()->nullable();
            $table->foreign('output_id')->references('id')->on('outputs');

            $table->string('voucher'); // payment code
            $table->date('detraction_date');
            $table->float('value')->default(0);

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
        Schema::drop('detractions');
    }
}

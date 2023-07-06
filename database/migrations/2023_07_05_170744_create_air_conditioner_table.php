<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirConditionerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_conditioner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pop_id')->constrained('data_pop')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('kondisi');
            $table->string('merk');
            $table->string('kapasitas');
            $table->string('tekanan_freon');
            $table->string('mode_hidup');
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
        Schema::dropIfExists('air_conditioner');
    }
}

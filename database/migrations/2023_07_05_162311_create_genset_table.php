<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGensetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genset', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pop_id')->constrained('data_pop')->onDelete('cascade')->onUpdate('cascade');
            $table->string('merk');
            $table->integer('kapasitas');
            $table->string('sn');
            $table->string('merk_engine');
            $table->string('merk_gen');
            $table->integer('max_fuel');
            $table->string('bahan_bakar');
            $table->float('accu');
            $table->string('merk_accu');
            $table->string('tipe_batt_charger');
            $table->string('switch');
            $table->timestamp('tgl_instalasi');
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
        Schema::dropIfExists('genset');
    }
}

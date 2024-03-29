<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInverterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inverter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pop_id')->constrained('data_pop')->onDelete('cascade')->onUpdate('cascade');
            $table->string('sn');
            $table->string('kondisi');
            $table->string('merk');
            $table->string('tipe');
            $table->integer('kapasitas');
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
        Schema::dropIfExists('inverter');
    }
}

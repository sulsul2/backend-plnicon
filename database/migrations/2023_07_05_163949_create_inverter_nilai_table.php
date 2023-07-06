<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInverterNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inverter_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inverter_id')->constrained('inverter')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pm_id')->constrained('jadwal_pm')->onDelete('cascade')->onUpdate('cascade');
            $table->string('load');
            $table->string('input_ac');
            $table->string('input_dc');
            $table->string('output_dc');
            $table->string('mainfail');
            $table->string('hasil_uji');
            $table->string('temuan')->nullable();
            $table->string('rekomendasi')->nullable();
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
        Schema::dropIfExists('inverter_nilai');
    }
}

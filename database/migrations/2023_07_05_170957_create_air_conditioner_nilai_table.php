<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirConditionerNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_conditioner_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ac_id')->constrained('air_conditioner')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pm_id')->constrained('jadwal_pm')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('suhu_ac');
            $table->string('hasil_pengujian');
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
        Schema::dropIfExists('air_conditioner_nilai');
    }
}

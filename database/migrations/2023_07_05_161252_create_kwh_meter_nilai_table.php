<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKwhMeterNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kwh_meter_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kwh_id')->constrained('kwh_meter')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pm_id')->constrained('jadwal_pm')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->float('load_r')->nullable();
            $table->float('load_s')->nullable();
            $table->float('load_t')->nullable();
            $table->float('vrn')->nullable();
            $table->float('vsn')->nullable();
            $table->float('vtn')->nullable();
            $table->float('vng')->nullable();
            $table->float('vrs')->nullable();
            $table->float('vrt')->nullable();
            $table->float('vst')->nullable();
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
        Schema::dropIfExists('kwh_meter_nilai');
    }
}

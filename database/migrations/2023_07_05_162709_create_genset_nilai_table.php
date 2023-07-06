<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGensetNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genset_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genset_id')->constrained('genset')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pm_id')->constrained('jadwal_pm')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->integer('fuel');
            $table->float('hour_meter');
            $table->float('tegangan_accu');
            $table->float('tegangan_charger');
            $table->float('arus_charger');
            $table->string('fail_over_test');
            $table->float('temp_on');
            $table->float('uji_beban_volt');
            $table->float('uji_beban_arus');
            $table->float('uji_tanpa_beban_volt');
            $table->float('uji_tanpa_beban_arus');
            $table->string('indoor_clean');
            $table->string('outdoor_clean');
            $table->string('temuan')->nullable();
            $table->string('rekomendasi')->nullable();
            $table->string('kartu_gantung_url')->nullable();
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
        Schema::dropIfExists('genset_nilai');
    }
}

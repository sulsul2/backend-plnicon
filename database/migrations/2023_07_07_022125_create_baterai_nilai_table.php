<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBateraiNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baterai_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baterai_id')->constrained('baterai')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pm_id')->constrained('jadwal_pm')->onDelete('cascade')->onUpdate('cascade');
            $table->float('load');
            $table->float('group_vbank');
            $table->float('cell_v1');
            $table->float('cell_v2');
            $table->float('cell_v3');
            $table->float('cell_v4');
            $table->integer('time_discharge');
            $table->integer('stop_uji_baterai');
            $table->float('performance');
            $table->float('sisa_kapasitas');
            $table->float('kemampuan_backup_time');
            $table->integer('jumlah_baterai_rusak');
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
        Schema::dropIfExists('baterai_nilai');
    }
}

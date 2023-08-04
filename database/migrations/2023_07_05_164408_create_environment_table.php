<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvironmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pop_id')->constrained('data_pop')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pm_id')->constrained('jadwal_pm')->onDelete('cascade')->onUpdate('cascade');
            $table->string('exhaust');
            $table->string('kebersihan_exhaust');
            $table->string('lampu');
            $table->string('jumlah_lampu');
            $table->float('suhu_ruangan');
            $table->string('bangunan');
            $table->string('kebersihan_bangunan');
            $table->string('temuan')->nullable();
            $table->string('rekomendasi')->nullable();
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
        Schema::dropIfExists('environment');
    }
}

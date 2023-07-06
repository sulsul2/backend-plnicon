<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerangkatNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perangkat_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pm_id')->constrained('jadwal_pm')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('perangkat_id')->constrained('data_perangkat')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('perangkat_nilai');
    }
}

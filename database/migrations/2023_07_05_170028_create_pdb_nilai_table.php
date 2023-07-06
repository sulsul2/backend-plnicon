<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePdbNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdb_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pdb_id')->constrained('pdb')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pm_id')->constrained('jadwal_pm')->onDelete('cascade')->onUpdate('cascade');
            $table->string('arester_warna');
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
        Schema::dropIfExists('pdb_nilai');
    }
}

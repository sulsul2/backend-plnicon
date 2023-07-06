<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalPmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_pm', function (Blueprint $table) {
            $table->id();
            $table->string('pm_kode')->unique();
            $table->foreignId('pop_id')->constrained('data_pop')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status')->default('PLAN');
            $table->boolean('status_approval')->default(false);
            $table->timestamp('plan');
            $table->timestamp('realisasi');
            $table->string('jenis');
            $table->string('kategori');
            $table->string('detail_pm');
            $table->string('hostname');
            $table->string('fat_id');
            $table->string('wilayah');
            $table->string('area');
            $table->string('lokasi_osp')->nullable();
            $table->string('koordinat_awal')->nullable();
            $table->string('koordinat_akhir')->nullable();
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
        Schema::dropIfExists('jadwal_pm');
    }
}

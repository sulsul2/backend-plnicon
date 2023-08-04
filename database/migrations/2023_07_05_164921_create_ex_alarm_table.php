<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExAlarmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ex_alarm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pop_id')->constrained('data_pop')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pm_id')->constrained('jadwal_pm')->onDelete('cascade')->onUpdate('cascade');
            $table->string('ea');
            $table->string('suhu');
            $table->string('pintu');
            $table->integer('pln_off');
            $table->string('genset_run_fail');
            $table->string('smokenfire');
            $table->string('perangkat_ea');
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
        Schema::dropIfExists('ex_alarm');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjiBateraiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uji_baterai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baterai_id')->constrained('baterai')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pm_id')->constrained('jadwal_pm')->onDelete('cascade')->onUpdate('cascade');
            $table->string('jenis_uji');
            $table->string('interval')->nullable();
            $table->float('t0')->nullable();
            $table->float('t1')->nullable();
            $table->float('t2')->nullable();
            $table->float('t3')->nullable();
            $table->float('t4')->nullable();
            $table->float('t5')->nullable();
            $table->float('t6')->nullable();
            $table->float('t7')->nullable();
            $table->float('t8')->nullable();
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
        Schema::dropIfExists('uji_baterai');
    }
}

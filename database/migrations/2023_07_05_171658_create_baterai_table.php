<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBateraiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baterai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rect_id')->constrained('rect')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('bank_id');
            $table->string('nama');
            $table->string('merk');
            $table->string('tipe');
            $table->string('sn');
            $table->integer('kapasitas');
            $table->float('persentase');
            $table->float('vbatt');
            $table->timestamp('tgl_uji');
            $table->timestamp('tgl_instalasi')->nullable();
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
        Schema::dropIfExists('baterai');
    }
}

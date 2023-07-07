<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInverterFotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inverter_foto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inverter_nilai_id')->constrained('inverter_nilai')->onDelete('cascade')->onUpdate('cascade');
            $table->string('url');
            $table->string('deskripsi')->nullable();
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
        Schema::dropIfExists('inverter_foto');
    }
}

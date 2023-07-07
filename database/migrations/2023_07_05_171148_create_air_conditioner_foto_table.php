<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirConditionerFotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('air_conditioner_foto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ac_nilai_id')->constrained('air_conditioner_nilai')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('air_conditioner_foto');
    }
}

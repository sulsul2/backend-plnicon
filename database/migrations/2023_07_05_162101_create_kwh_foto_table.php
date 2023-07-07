<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKwhFotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kwh_foto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kwh_nilai_id')->constrained('kwh_meter_nilai')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('kwh_foto');
    }
}

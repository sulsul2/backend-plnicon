<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerangkatFotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perangkat_foto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rack_id')->constrained('data_rack')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('perangkat_nilai_id')->constrained('perangkat_nilai')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->string('url');
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
        Schema::dropIfExists('perangkat_foto');
    }
}

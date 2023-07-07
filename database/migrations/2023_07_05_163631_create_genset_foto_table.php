<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGensetFotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genset_foto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genset_nilai_id')->constrained('genset_nilai')->onDelete('cascade')->onUpdate('cascade')->nullable();
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
        Schema::dropIfExists('genset_foto');
    }
}

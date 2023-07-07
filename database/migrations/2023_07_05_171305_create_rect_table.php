<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rect', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pop_id')->constrained('data_pop')->onDelete('cascade')->onUpdate('cascade');
            $table->string('merk');
            $table->string('tipe');
            $table->integer('jumlah_phasa');
            $table->string('sn');
            $table->integer('slot_modul');
            $table->integer('modul_terpasang');
            $table->integer('modul_control');
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
        Schema::dropIfExists('rect');
    }
}

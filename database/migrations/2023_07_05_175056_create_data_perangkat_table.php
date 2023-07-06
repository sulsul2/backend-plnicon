<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPerangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_perangkat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rack_id')->constrained('data_rack')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->string('merk');
            $table->string('sumber_main');
            $table->string('sumber_backup');
            $table->string('terminasi');
            $table->string('jenis');
            $table->string('tipe');
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
        Schema::dropIfExists('data_perangkat');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('port', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perangkat_id')->constrained('data_perangkat')->onDelete('cascade')->onUpdate('cascade');
            $table->string('pelanggan_id');
            $table->string('port_switch');
            $table->string('odf')->nullable();
            $table->string('core')->nullable();
            $table->string('converter')->nullable();
            $table->string('port_converter')->nullable();
            $table->string('cwdm')->nullable();
            $table->string('port_cwdm')->nullable();
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
        Schema::dropIfExists('port');
    }
}

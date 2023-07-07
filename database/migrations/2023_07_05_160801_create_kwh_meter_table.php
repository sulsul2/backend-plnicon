<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKwhMeterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kwh_meter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pop_id')->constrained('data_pop')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah_phasa');
            $table->float('daya');
            $table->float('capmcbr')->nullable();
            $table->float('capmcbs')->nullable();
            $table->float('capmcbt')->nullable();
            $table->string('cos');
            $table->string('cos_type')->nullable();
            $table->string('arester');
            $table->string('arester_type')->nullable();
            $table->string('warna_kabelr')->nullable();
            $table->string('warna_kabels')->nullable();
            $table->string('warna_kabelt')->nullable();
            $table->string('warna_kabeln')->nullable();
            $table->string('warna_kabelg')->nullable();
            $table->float('luas_kabelr')->nullable();
            $table->float('luas_kabels')->nullable();
            $table->float('luas_kabelt')->nullable();
            $table->float('luas_kabeln')->nullable();
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
        Schema::dropIfExists('kwh_meter');
    }
}

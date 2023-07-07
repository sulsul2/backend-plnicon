<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcb', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pdb_id')->constrained('pdb')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama');
            $table->string('jumlah_phasa');
            $table->string('merk');
            $table->string('kapasitas');
            $table->string('a_terukur');
            $table->string('tipe');
            $table->string('peruntukan')->nullable();
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
        Schema::dropIfExists('mcb');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRectNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rect_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rect_id')->constrained('rect')->onDelete('cascade')->onUpdate('cascade');
            $table->float('loadr')->nullable();
            $table->float('loads')->nullable();
            $table->float('loadt')->nullable();
            $table->string('temuan')->nullable();
            $table->string('rekomendasi')->nullable();
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
        Schema::dropIfExists('rect_nilai');
    }
}

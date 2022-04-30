<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenugasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penugasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wawancara_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('soal')->nullable();
            $table->text('field_jawaban')->nullable();
            $table->string('file_jawaban')->nullable();
            $table->string('status_png')->nullable();
            $table->string('catatan')->nullable();
            $table->unique('wawancara_id');
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
        Schema::dropIfExists('penugasans');
    }
}

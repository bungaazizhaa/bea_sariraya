<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_periode');
            $table->unique('id_periode');
            $table->string('name');

            $table->date('tm_adm')->comment('TM = Tanggal Mulai');
            $table->date('ta_adm')->comment('TA = Tanggal Akhir');
            $table->date('tp_adm')->comment('TP = Tanggal Pengumuman');
            $table->enum('status_adm', ['Selesai'])->nullable()->comment('Null / Selesai');
            $table->dateTime('ts_adm')->nullable()->comment('TS = Tanggal Set Status');;

            $table->date('tm_wwn');
            $table->date('ta_wwn');
            $table->date('tp_wwn');
            $table->enum('status_wwn', ['Selesai'])->nullable();
            $table->dateTime('ts_wwn')->nullable();

            $table->date('tm_png');
            $table->date('ta_png');
            $table->date('tp_png');
            $table->enum('status_png', ['Selesai'])->nullable();
            $table->dateTime('ts_png')->nullable();

            $table->enum('status', ['aktif', 'nonaktif'])->default('nonaktif');
            $table->string('group_wa')->nullable();
            $table->text('teknis_wwn')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodes');
    }
}

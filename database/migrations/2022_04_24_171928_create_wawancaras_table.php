<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWawancarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wawancaras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('administrasi_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedInteger('periode_id');
            // $table->foreign('periode_id')->references('id_periode')->on('periodes')->onUpdate('cascade')->onDelete('cascade');
            $table->unique('administrasi_id');
            $table->dateTime('jadwal_wwn')->nullable(); //Seharusnya ga Nullable
            $table->enum('status_wwn', ['lolos', 'gagal'])->nullable(); //Seharusnya ga Nullable
            $table->string('catatan')->nullable(); //Seharusnya ga Nullable
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wawancaras');
    }
}

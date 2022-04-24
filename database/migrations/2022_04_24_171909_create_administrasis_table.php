<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrasis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('no_pendaftaran')->unique();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('periode_id')->constrained()->onUpdate('cascade');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('semester');
            $table->float('ipk', 3, 2); //nama,total digit,digit desimal
            $table->string('keahlian');
            $table->string('alamat');
            $table->string('file_cv');
            $table->string('file_esai');
            $table->string('file_portofolio')->nullable();
            $table->string('file_ktm');
            $table->string('file_transkrip');
            $table->string('no_wa');
            $table->string('instragram')->nullable();
            $table->string('facebook')->nullable();
            $table->enum('status_adm', ['lolos', 'gagal']);
            $table->string('catatan');
            // $table->unique(['user_id', 'periode_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrasis');
    }
}

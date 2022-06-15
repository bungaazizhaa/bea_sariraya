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
            // $table->foreignId('periode_id')->constrained()->onUpdate('cascade');
            $table->unsignedInteger('periode_id');
            $table->foreign('periode_id')->references('id_periode')->on('periodes')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tempat_lahir')->nullable(); //Seharusnya ga Nullable
            $table->date('tanggal_lahir')->nullable(); //Seharusnya ga Nullable
            $table->string('semester')->nullable(); //Seharusnya ga Nullable
            $table->float('ipk', 3, 2)->nullable(); //Seharusnya ga Nullable //nama,total digit,digit desimal
            $table->string('keahlian')->nullable(); //Seharusnya ga Nullable
            $table->string('alamat')->nullable(); //Seharusnya ga Nullable
            $table->string('file_cv')->nullable(); //Seharusnya ga Nullable
            $table->string('file_esai')->nullable(); //Seharusnya ga Nullable
            $table->string('file_portofolio')->nullable();
            $table->string('file_ktm')->nullable(); //Seharusnya ga Nullable
            $table->string('file_transkrip')->nullable(); //Seharusnya ga Nullable
            $table->string('no_wa')->nullable(); //Seharusnya ga Nullable
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->enum('status_adm', ['lolos', 'gagal'])->nullable(); //Seharusnya ga Nullable
            $table->string('catatan')->nullable();
            $table->unique(['user_id', 'periode_id']);
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

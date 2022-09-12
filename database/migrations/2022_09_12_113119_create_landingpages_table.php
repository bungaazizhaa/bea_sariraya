<?php

use App\Models\Landingpage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landingpages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('keterangan')->nullable();
            // $table->timestamps();
        });

        Landingpage::create([
            'name' => 'views',
            'keterangan' => 0,
        ]);

        Landingpage::create([
            'name' => 'kontak1',
            'keterangan' => 'WhatsApp: +81-70-1304-5868',
        ]);

        Landingpage::create([
            'name' => 'kontak2',
            'keterangan' => 'Email: info@sariraya.com',
        ]);

        Landingpage::create([
            'name' => 'pemberian',
            'keterangan' => 'Maret 2022 - September 2022',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landingpages');
    }
}

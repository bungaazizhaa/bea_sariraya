<?php

use App\Models\Other;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('others', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('views')->nullable();
            $table->string('keterangan')->nullable();
            // $table->timestamps();
        });

        Other::create([
            'name' => 'Landing Page',
            'views' => 0,
        ]);

        Other::create([
            'name' => 'kontak1',
            'views' => null,
            'keterangan' => 'WhatsApp: +81-70-1304-5868',
        ]);

        Other::create([
            'name' => 'kontak2',
            'views' => null,
            'keterangan' => 'Email: info@sariraya.com',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('others');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->dateTime('pergi');
            $table->dateTime('pulang')->nullable();
            $table->string('nama_pembeli')->nullable();
            $table->string('tujuan');
            $table->string('sopir');
            $table->string('kernet')->nullable();
            $table->string('mobil');
            $table->string('barang')->nullable();
            $table->string('input_by');
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
        Schema::dropIfExists('drivers');
    }
}

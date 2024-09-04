<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcsKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcs_keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kain_keluar_id')->constrained('kain_keluars')->onDelete('cascade');
            $table->foreignId('warna_keluar_id')->constrained('warna_keluars')->onDelete('cascade');
            $table->integer('old_id');
            $table->double('yard', 15, 2);
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
        Schema::dropIfExists('pcs_keluars');
    }
}

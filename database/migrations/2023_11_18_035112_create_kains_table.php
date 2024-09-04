<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kains', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kain');
            $table->string('kode_desain')->nullable();
            $table->string('surat_jalan')->nullable();
            $table->string('lot')->nullable();
            $table->string('harga')->nullable();
            $table->string('satuan')->nullable();
            $table->string('foto_kain')->nullable();
            $table->foreignId('supplier_id');
            $table->string('lokasi')->nullable();
            $table->date('tgl_masuk');
            $table->string('input_by');
            $table->dateTime('input_at');
            $table->string('update_by')->nullable();
            $table->dateTime('update_at')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('kains');
    }
}

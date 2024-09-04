<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packing_lists', function (Blueprint $table) {
            $table->id();
            $table->string('packingListNo');
            $table->string('nama_pengambil');
            $table->string('nama_security');
            $table->string('nama_koordinator');
            $table->string('jenis');
            $table->string('tujuan');
            $table->date('tanggal');
            $table->longText('barang')->nullable();
            $table->integer('total_pcs')->nullable();
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
        Schema::dropIfExists('packing_lists');
    }
}

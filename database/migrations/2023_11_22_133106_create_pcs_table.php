<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcs', function (Blueprint $table) {
            $table->id();
            $table->double('yard', 15, 2);
            $table->integer('status')->nullable();
            $table->string('packingListNo')->nullable();
            $table->foreignId('warna_id')->constrained('warnas')->onDelete('cascade');
            $table->dateTime('input_at');
            $table->string('input_by');
            $table->dateTime('update_at')->nullable();
            $table->string('update_by')->nullable();
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
        Schema::dropIfExists('pcs');
    }
}

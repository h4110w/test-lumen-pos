<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableStok extends Migration
{
    /**
     * Date: 07-03-2020
     * Description: Membuat migration stok
     * Developer: rizal
     * Status: Create
     */

    public function up()
    {
        Schema::create('stoks', function (Blueprint $table) {
            $table->uuid('id')->unique()->default(DB::Raw('uuid_generate_v4()'));
            $table->primary('id');
            $table->uuid('id_barang');
            $table->integer('total_barang');
            $table->string('jenis_stok');
            $table->timestamps();

            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('stoks');
    }
}

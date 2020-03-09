<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableBarang extends Migration
{
    /**
     * Date: 07-03-2020
     * Description: Membuat migration barang
     * Developer: rizal
     * Status: Create
     */

    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->uuid('id')->unique()->default(DB::Raw('uuid_generate_v4()'));
            $table->primary('id');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('gambar_barang');
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
        Schema::dropIfExists('barangs');
    }
}

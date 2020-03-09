<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablePembelianDetail extends Migration
{
    /**
     * Date: 07-03-2020
     * Description: Membuat migration tabel pembelian detail
     * Developer: rizal
     * Status: Create
     */

    public function up()
    {
        Schema::create('pembelian_detail', function (Blueprint $table) {
            $table->uuid('id')->unique()->default(DB::Raw('uuid_generate_v4()'));
            $table->primary('id');
            $table->uuid('id_pembelian');
            $table->uuid('id_barang');
            $table->integer('jumlah');
            $table->integer('harga');
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
        Schema::dropIfExists('pembelian_details');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanDetailTable extends Migration
{
    /**
     * Date: 09-03-2020
     * Description: Membuat migration tabel penjualan detail
     * Developer: rizal
     * Status: Create
     */

    public function up()
    {
        Schema::create('penjualan_detail', function (Blueprint $table) {
            $table->uuid('id')->unique()->default(DB::Raw('uuid_generate_v4()'));
            $table->primary('id');
            $table->uuid('id_penjualan');
            $table->uuid('id_barang');
            $table->integer('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualan_detail');
    }
}

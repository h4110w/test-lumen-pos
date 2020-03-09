<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablePembelian extends Migration
{
    /**
     * Date: 07-03-2020
     * Description: Membuat migration tabel pembelian
     * Developer: rizal
     * Status: Create
     */

    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->uuid('id')->unique()->default(DB::Raw('uuid_generate_v4()'));
            $table->primary('id');
            $table->string('no_nota');
            $table->date('tgl_nota');
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
        Schema::dropIfExists('pembelian');
    }
}

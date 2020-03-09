<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddViewTransaksi extends Migration
{
    /**
     * Date: 09-03-2020
     * Description: Membuat migration view transaksi
     * Developer: rizal
     * Status: Create
     */

    public function up()
    {
        $query = "
                create or replace view view_transaksi as
                    select
                        list.jumlah,
                        list.tanggal,
                        list.nama_barang[1] nama_barang
                    from
                        (
                            select
                                sum(penjualan_detail.jumlah) jumlah,
                                date(penjualan.created_at) tanggal,
                                array_agg(barangs.nama_barang) nama_barang
                            from penjualan_detail
                            join penjualan on penjualan_detail.id_penjualan = penjualan.id
                            join barangs on penjualan_detail.id_barang = barangs.id
                            group by
                                date(penjualan.created_at),
                                penjualan_detail.id_barang
                        ) as list
                ";
        DB::statement($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view view_transaksi");
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTriggerPenjualan extends Migration
{
    /**
     * Date: 09-03-2020
     * Description: Membuat migration trigger penjualan
     * Developer: rizal
     * Status: Create
     */

    public function up()
    {
        $query  ="
                create or replace function penjualan_insert() returns trigger as \$pj_insert\$
                    begin
                        if (TG_OP = 'INSERT') then
                            insert into barang_stok(id_barang, total_barang, jenis_stok)
                                select id_barang, jumlah, 'in' from inserted;
                        end if;
                        return null;
                    end;
                \$pj_insert\$ language plpgsql ";
        DB::statement($query);

        $query  = "
                create trigger penjualan_after_insert
                AFTER INSERT ON penjualan_detail
                REFERENCING NEW TABLE AS inserted
                FOR EACH STATEMENT EXECUTE PROCEDURE penjualan_insert() ";
        DB::statement($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS penjualan_after_insert ON penjualan_dt");
    }
}

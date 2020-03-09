<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTriggerPembelian extends Migration
{
    /**
     * Date: 09-03-2020
     * Description: Membuat migration trigger pembelian
     * Developer: rizal
     * Status: Create
     */

    public function up()
    {
        $query  ="
                create or replace function pembelian_insert() returns trigger as \$pb_insert\$
                    begin
                        if (TG_OP = 'INSERT') then
                            insert into barang_stok(id_barang, total_barang, jenis_stok)
                                select id_barang, jumlah, 'in' from inserted;
                        end if;
                        return null;
                    end;
                \$pb_insert\$ language plpgsql ";
        DB::statement($query);

        $query  = "
                create trigger pembelian_after_insert
                AFTER INSERT ON pembelian_detail
                REFERENCING NEW TABLE AS inserted
                FOR EACH STATEMENT EXECUTE PROCEDURE pembelian_insert() ";
        DB::statement($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TRIGGER IF EXISTS pembelian_after_insert ON pembelian_detail");
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Stok;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stok::create([
            'id_barang' => 'de767799-638b-4bff-abb6-99265ec9cfbc',
            'total_barang' => 10,
            'jenis_stok' => 'in'
        ]);
        Stok::create([
            'id_barang' => '6189ee7b-53d8-450d-850c-f8129ddf2370',
            'total_barang' => 20,
            'jenis_stok' => 'out'
        ]);
    }
}

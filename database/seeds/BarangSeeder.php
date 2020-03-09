<?php

use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::create([
            'kode_barang' => 'tes kode 1',
            'nama_barang' => 'nama barang 1',
            'gambar_barang' => 'gambar barang 1'
        ]);
        Barang::create([
            'kode_barang' => 'tes kode 2',
            'nama_barang' => 'nama barang 2',
            'gambar_barang' => 'gambar barang 2'
        ]);
        Barang::create([
            'kode_barang' => 'tes kode 3',
            'nama_barang' => 'nama barang 3',
            'gambar_barang' => 'gambar barang 3'
        ]);
    }
}

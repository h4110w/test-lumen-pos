<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PenjualanController extends Controller
{
    /**
     * Date: 07-03-2020
     * Description: Membuat method index di controller penjualan
     * Developer: rizal
     * Status: Create
     */

    public function index()
    {
        $data = DB::table('penjualan')->get();
        $data = [
            "message" => "Daftar Penjualan",
            "results" => $data
        ];

        return response()->json($data, 200);
    }

    /**
     * Date: 07-03-2020
     * Description: Mendapatkan data penjualan berdasarkan id penjualan
     * Developer: rizal
     * Status: Create
     */

    public function getOne($id)
    {
        $data = DB::table('penjualan_detail')
                    ->join('barang', 'penjualan_detail.id_barang', '=', 'barang.id')
                    ->select('barang.kode_barang', 'barang.nama_barang', 'barang.harga', 'penjualan_detail.jumlah')
                    ->where('penjualan_detail.id_penjualan', $id)
                    ->get();
        $result = ['code' => '99', 'data' => $data];
        return response()->json($result);
    }

    /**
     * Date: 07-03-2020
     * Description: Membuat method untuk transaksi penjualan
     * Developer: rizal
     * Status: Create
     */

    public function store(Request $request)
    {
        $id_barang = $request->input('id_barang');
        $jumlah = $request->input('jumlah');

         $data = ['rp_bayar' => $request->input('rp_bayar')];
        $id = DB::table('penjualan')->insertGetId($data);

        for ($i=0; $i<count($id_barang); $i++) {
            $item_barang[] = [
                'id_penjualan' => $id,
                'id_barang' => $id_barang[$i],
                'jumlah' => $jumlah[$i]
            ];
        }

        $hasil = DB::table('penjualan_detail')->insert($item_barang);

        return response()->json($hasil, 201);
    }
}

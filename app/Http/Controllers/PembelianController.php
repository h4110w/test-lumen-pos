<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PembelianController extends Controller
{
    /**
     * Date: 07-03-2020
     * Description: Membuat method index di controller pembelian
     * Developer: rizal
     * Status: Create
     */

    public function index()
    {
        $data = DB::table('pembelian')->get();
        $data = [
            "message" => "Daftar Pembelian",
            "results" => $data
        ];

        return response()->json($data, 200);
    }

    /**
     * Date: 07-03-2020
     * Description: Mendapatkan data pembelian berdasarkan id pemebelian
     * Developer: rizal
     * Status: Create
     */

    public function getOne($id)
    {
        $data = DB::table('pembelian_detail')
                    ->join('barang', 'pembelian_detail.id_barang', '=', 'barang.id')
                    ->select('barang.kode_barang', 'barang.nama_barang', 'pembelian_detail.jumlah', 'pembelian_detail.harga')
                    ->where('pembelian_detail.id_pembelian', $id)
                    ->get();

        $result = ['code' => '99', 'data' => $data];
        return response()->json($result);
    }

    /**
     * Date: 07-03-2020
     * Description: Membuat method untuk transaksi pembelian
     * Developer: rizal
     * Status: Create
     */

    public function store(Request $request)
    {
        $id_barang = $request->input('id_barang');
        $jumlah = $request->input('jumlah');
        $harga = $request->input('harga');

        $data = [
            'no_nota' => $request->input('no_nota'),
            'tgl_nota' => date('Y-m-d', strtotime($request->input('tgl_nota')))
        ];
        $id = DB::table('pembelian')->insertGetId($data);

        for ($i=0; $i<count($id_barang); $i++) {
            $item_barang[] = [
                'id_pembelian' => $id,
                'id_barang' => $id_barang[$i],
                'jumlah' => $jumlah[$i],
                'harga' => $harga[$i]
            ];
        }

        $hasil = DB::table('pembelian_detail')->insert($item_barang);

        return response()->json($hasil, 201);
    }
}

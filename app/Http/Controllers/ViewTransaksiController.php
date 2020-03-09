<?php
namespace App\Http\Controllers;

class ViewTransaksiController extends Controller
{
    /**
     * Date: 07-03-2020
     * Description: Membuat method middleware di view transaksi
     * Developer: rizal
     * Status: Create
     */

    public function __construct()
    {
        $this->middleware("login");
    }

    /**
     * Date: 07-03-2020
     * Description: Membuat method get untuk menampilkan view transaksi
     * Developer: rizal
     * Status: Create
     */

    public function getTransaksi()
    {
        $data = DB::table('view_transaksi')->get();
        $result = ['code' => '99', 'data' => $data];
        return response()->json($result);
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StokController extends Controller
{
    /**
     * Date: 07-03-2020
     * Description: Membuat controller barang
     * Developer: rizal
     * Status: Create
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $getStok = DB::table('stoks')->get();

        $out = [
            "message" => "Daftar Stok",
            "results" => $getStok
        ];
        return response()->json($out, 200);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'id_barang' => 'required',
                'total_barang' => 'required',
                'jenis_stok' => 'required',
            ]);
            $total_barang = $request->input('total_barang');
            $jenis_stok = $request->input('jenis_stok');

            $data = [
                // 'id'  => Uuid::uuid4(),
                'total_barang' => $total_barang,
                'jenis_stok' => $jenis_stok
            ];
            $insert = Stok::create($data);
            if ($insert) {
                $out  = [
                    "message" => "success_insert_data",
                    "results" => $data,
                    "code"  => 200
                ];
            } else {
                $out  = [
                    "message" => "failed_insert_data",
                    "results" => $data,
                    "code"   => 404,
                ];
            }
            return response()->json($out, $out['code']);
        }
    }

    public function update(Request $request)
    {
        if ($request->isMethod('patch')) {
            $this->validate($request, [
                'total_barang' => 'required',
                'jenis_stok' => 'required',
            ]);
            $id = $request->input('id');
            $total_barang = $request->input('total_barang');
            $jenis_stok = $request->input('jenis_stok');

            $barang = Stok::find($id);

            $data = [
                'total_barang' => $total_barang,
                'jenis_stok' => $jenis_stok,
            ];

            $update = $barang->update($data);

            if ($update) {
                $out  = [
                    "message" => "success_update_data",
                    "results" => $data,
                    "code"  => 200
                ];
            } else {
                $out  = [
                    "message" => "failed_update_data",
                    "results" => $data,
                    "code"   => 404,
                ];
            }

            return response()->json($out, $out['code']);
        }
    }

    public function destroy($id)
    {
        $barangs =  Stok::find($id);
        if (!$barangs) {
            $data = [
                "message" => "id nost found",
            ];
        } else {
            $barangs->delete();
            $data = [
                "message" => "success_deleted"
            ];
        }
        return response()->json($data, 200);
    }
}

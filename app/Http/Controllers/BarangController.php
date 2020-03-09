<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BarangController extends Controller
{
    /**
     * Date: 09-03-2020
     * Description: Membuat method untuk memfilter user yang login
     * Developer: rizal
     * Status: Create
     */

    public function __construct()
    {
        $this->middleware("login");
    }

    /**
     * Date: 07-03-2020
     * Description: Membuat method index di controller barang
     * Developer: rizal
     * Status: Create
     */

    public function index()
    {
        $data = DB::table('barangs')->get();
        $data = [
            "message" => "Daftar Barang",
            "results" => $data
        ];

        return response()->json($data, 200);
    }

    /**
     * Date: 07-03-2020
     * Description: Mendapatkan item barang berdasarkan id barang
     * Developer: rizal
     * Status: Create
     */

    public function getOne($id)
    {
        $data = DB::table('barangs')->where('id', $id)->get();

        return response()->json($data);
    }

    /**
     * Date: 07-03-2020
     * Description: Membuat method create barang
     * Developer: rizal
     * Status: Create
     */

    public function create(Request $request)
    {

        $file = $request->file('gambar_barang') ? $request->file('gambar_barang') : null;

        $input  = array('gambar_barang' => $file);
        $rules  = array('gambar_barang' => 'required');

        $destinationPath = 'assets/images/barang';
        $filename = $file->getClientOriginalName();
        $request->file('gambar_barang')->move($destinationPath, $filename);

        $data = [
            'kode_barang' => $request->input('kode_barang'),
            'nama_barang' => $request->input('nama_barang'),
            'gambar_barang' => $destinationPath . '/' . $filename
        ];

        DB::beginTransaction();
        try {
            DB::table('barangs')->insert($data);
            DB::commit();
            $return = response()->json([
                "success" => 99,
                "msgServer" => [
                    "message" => "Data telah ditambahkan."
                ]
            ], 200);
        } catch (Exception $e) {
            if (file_exists($destinationPath . '/' . $filename)) {
                unlink($destinationPath . '/' . $filename);
            }
            DB::rollback();
            $return = response()->json([
                "success" => false,
                "msgServer" => [
                    "error" => "gagal menambahkan.",
                    "error_description" => "Data gagal ditambahkan.",
                    "message" => "Data gagal ditambahkan."
                ]
            ], 200);
        }
        return $return;
    }

    /**
     * Date: 07-03-2020
     * Description: Membuat method update
     * Developer: rizal
     * Status: Create
     */

    public function update(Request $request)
    {
        $data = [
            'nama_barang' => $request->input('nama'),
            'nama_barang' => $request->input('harga')
        ];
        $update = DB::table('barangs')->where('id', $id)->update($data);

        return response()->json($update, 200);
    }

    /**
     * Date: 07-03-2020
     * Description: Membuat method delete
     * Developer: rizal
     * Status: Create
     */

    public function destroy($id)
    {
        DB::table('barangs')->where('id', '=', $id)->delete();
        return response('Data barang berhasil dihapus', 200);
    }
}

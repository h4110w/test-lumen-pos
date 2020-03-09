<?php
namespace App\Http\Controllers;

use DB;

class UserController extends Controller
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
     * Date: 08-03-2020
     * Description: Membuat method index untuk menampilkan daftar user
     * Developer: rizal
     * Status: Create
     */

    public function index()
    {
        return "Anda Berhasil masuk";
    }
}

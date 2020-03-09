<?php
namespace App\Http\Middleware;

use Closure;
use DB;

class LoginMiddleware
{
    /**
     * Date: 09-03-2020
     * Description: Membuat method login middleware
     * Developer: rizal
     * Status: Create
     */

    public function handle($request, Closure $next)
    {
        if ($request->input('token')) {
            $check = DB::table('users')->where('token', $request->input('token'))->first();
            // $check =  User::where('token', $request->input('token'))->first();

            if (!$check) {
                return response('Token Tidak Valid.', 401);
            } else {
                return $next($request);
            }
        } else {
            return response('Silahkan Masukkan Token.', 401);
        }

    }
}

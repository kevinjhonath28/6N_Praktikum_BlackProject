<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function login(Request $req)
    {
        if(Auth::attempt([
            'username' => $req->username,
            'password' => $req->password
        ])) {
            //disini jika username dan password sesuai
            $param['message'] = 'berhasil login';
            $param['data'] = Auth::user();
            $param['token'] = Auth::user()->token;

            return response()->json($param);
        } else {
            //jika username dan password tidak sesuai
            $param['message'] = 'username / password salah';
            return response()->json($param);
        }

    }

    public function register(Request $req)
    {

        $checkUsername = User::where('username', $req->username)->first();

        if($checkUsername != null){
            //jika ada tampilan pesan
            $param['message'] = 'username sudah ada';
            return response()->json($param);
        } else{
            //jika tidak ada simpan baru
            $simpan = new User;
            $simpan->username = $req->username;
            $simpan->password = bcrypt($req->password);
            $simpan->nama = $req->nama;
            $simpan->token = Str::random(20);
            $simpan->save();

            $param['message'] = 'berhasil daftar';
            $param['data'] = $simpan;
            $param['token'] = 'token123';
            return response()->json($param);
        }
    }
}

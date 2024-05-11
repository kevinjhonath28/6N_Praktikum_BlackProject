<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Routes;


class LoginController extends Controller
{
    public function login(request $req)
    {
        if  (Auth::attempt([
            'username' => $req->username,
            'password' => $req->password
        ])){
            return redirect('/beranda');
        } else {
            return back();
        }
    }
}   

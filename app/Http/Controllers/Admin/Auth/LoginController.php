<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('Email', 'MatKhau');
        //$credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            //Authentication passed...
            return redirect()->intended('Admin.index');

        }
        //return redirect('login');
        return view('Admin.login');
    }
}

<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\quantri;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function DangKy (Request $request){
        $user = new quantri;
        /*
        $matkhau = Hash::make($request->password, [
                            'memory' => 1024,
                            'time' => 2,
                            'threads' => 2,
                        ]);*/
        $matkhau = bcrypt($request->password);
        $tennv = $request->name;
        $user->MaNV = "NV006";
        $user->Email = $request->email;
        $user->TenNV = $request->name;
        $user->MatKhau = $matkhau;
        $user->save();
    }
}

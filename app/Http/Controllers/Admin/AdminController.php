<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\quantri;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function thongtinuser (Request $request){
        $kq = quantri::where('Email', $request->Email)->first();
        if (md5($request->MatKhau) == $kq->MatKhau){
        //if (Hash::check($request->MatKhau, $kq->MatKhau)) {
            $request->session()->put('admin.id', $kq->MaNV);
            $request->session()->put('admin.level', $kq->PhanQuyen);
            $request->session()->put('admin.hoten', $kq->TenNV);
            $request->session()->put('admin.email', $kq->Email);
            return redirect('quantri');
        }else{
            return view ('Admin.login')->with('thongbao', 'Tên đăng nhập hoặc mật khẩu không đúng');    
        }
    }
    
     public function thoatuser (){
        session_start();
        session_destroy();
            return redirect('quantri/login');           
    }
}

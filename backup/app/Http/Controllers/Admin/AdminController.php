<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\quantri;

class AdminController extends Controller
{
    public function thongtinuser (Request $request){
        $u = $request->Email;
        $p = $request->MatKhau;
        $p = md5($p);
        $kq = quantri::where('Email', $u)->where('MatKhau', $p)->first();
        if($kq){
            $request->session()->put('admin.id', $kq->MaNV);
            $request->session()->put('admin.user', $kq->TenDangNhap);
            $request->session()->put('admin.level', $kq->PhanQuyen);
            $request->session()->put('admin.hoten', $kq->TenNV);
            $request->session()->put('admin.email', $kq->Email);
            //return session()->get('admin.email');
            return redirect('quantri');
        }else{
            echo '<script type="text/javascript">'; 
            echo 'alert("Tên đăng nhập hoặc mật khẩu chưa đúng!")'; 
            echo '</script>';      
        }
    }
}

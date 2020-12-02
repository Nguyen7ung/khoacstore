<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\sanpham;
use App\Models\loaihang;
use App\Models\phanloaihang;

class trangchu extends Controller
{
     public function index()
    {
        $menu1 = loaihang::where('AnHien','=', 1)->get();
        $menu2 = phanloaihang::where('AnHien','=',1)->get();
        
        $sanphammoi = sanpham::where('AnHien','=', 1)
             ->orderBy('NgayCapNhat', 'DESC')
             ->take(8)
             ->get();
        return view('Store.trangchu')->with('sanphammoi',$sanphammoi);
        //return view('trangchu',compact('sanphammoi','menu1','menu2'));
    }
}

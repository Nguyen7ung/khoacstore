<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\loaihang;
use App\Models\phanloaihang;
use App\Models\sanpham;

class sanphamtrongloai extends Controller
{
    public function index($TenPL)
    {
        //$TenLH = loaihang::select('TenLH', 'TenLH_KhongDau')->where('TenLH_KhongDau','=', $TenLH)->first();
        $MaPL = phanloaihang::select('MaPL', 'TenPL')->where('TenPL_KhongDau','=', $TenPL)->first();
        $sanphamtrongloai = sanpham::where('MaPL','=', $MaPL->MaPL)->paginate(PAGE_SIZE);   
        return view('Store.sanphamtrongloai',['sp_trongloai' => $sanphamtrongloai, 'breadcrumb' => $MaPL->TenPL]);
    }
}

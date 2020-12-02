<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\LazyCollection;
use App\Models\loaihang;
use App\Models\phanloaihang;
use App\Models\sanpham;
use Illuminate\Support\Facades\DB;

class loaisanpham extends Controller
{
    public function index($TenLH)
    {
        $MaLH = loaihang::select('MaLH', 'TenLH', 'TenLH_KhongDau')->where('TenLH_KhongDau','=', $TenLH)->first();
        
        $loaisanpham = DB::table('sanpham')
        ->join('phanloaihang','phanloaihang.MaPL','=','sanpham.MaPL')
        ->where('phanloaihang.MaLH','=',$MaLH->MaLH)
        ->select('sanpham.*', 'phanloaihang.TenPL_KhongDau')->paginate(PAGE_SIZE);
        return view('Store.loaisanpham',['loaisanpham' => $loaisanpham, 'breadcrumb' => $MaLH]);
    }
}

<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

//use Illuminate\Support\Collection;
use App\Models\phanloaihang;
use Illuminate\Support\Arr;

class giohang2 extends Controller
{
    public $MaSP;
    public $SL;
    public $Size;
    public $MaMau;
    public $MauSac;
    public $MaDH;

    function __construct(Request $request) {
        
        if ($request->isMethod('get')) {
            $this->update();           
        }else{
            $this->MaSP = $request->MaSP;
            $this->SL = $request->SL; 
            $this->Size  = $request->Size; 
            $this->MaMau = $request->MaMau; 
            $this->MauSac = $request->MauSac; 
            $this->MaDH = $request->MaSP.$request->MaMau.$request->Size;  
            $this->add(); 
            exit();
        }
    }
    
    public function add (){
        if (session()->exists('donhang.'.$this->MaDH)) {
            //$this->update();
            return "update";
        }else{
            $thongtin_donhang = DB::table('sanpham')
                ->join('ctsanpham', function ($join) {
                    $join->on('ctsanpham.MaSP','=','sanpham.MaSP');              
                    })->where('ctsanpham.MaMau','=', $this->MaMau)
                ->where('sanpham.MaSP','=', $this->MaSP)
                ->select('ctsanpham.MaSP','ctsanpham.urlHinh1', 'sanpham.TenSP', 'sanpham.GiaBan')->get()->toArray();
                $thongtin_donhang[0]->SL = $this->SL;
                $thongtin_donhang[0]->Size = $this->Size;
                $thongtin_donhang[0]->MauSac = $this->MauSac;
                session()->push('donhang.'.$this->MaDH, $thongtin_donhang[0]);  
                $this->show();
        }
    }    
    
    public function update () {
        /*$thongtin_donhang = session()->get('donhang.'.$this->MaDH);
        $SL_Cu = session()->pull('donhang.'.$this->MaDH, 'SL'); 
        $SL_Moi = $SL_Cu[0]->SL + $this->SL;
        $thongtin_donhang[0]->SL = $SL_Moi;   
        session()->push('donhang.'.$this->MaDH, $thongtin_donhang[0]);
        $this->show();*/
    }
    
    public function delete ($MaDH){
        session()->forget('donhang.'.$MaDH);
        $this->show();
       // return back()->with('arr_donhang', $arr_donhang);
    }
    
    public function show (){
        $arr_donhang = session()->get('donhang');
        //return view('giohang')->with('arr_donhang', $arr_donhang);  
        print_r($arr_donhang);
    }
}

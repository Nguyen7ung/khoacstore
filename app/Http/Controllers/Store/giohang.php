<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Collection;
use App\Models\phanloaihang;
use Illuminate\Support\Arr;

class giohang extends Controller
{
    public function add (Request $request){
        $MaDH = $request->MaSP.$request->MaMau.$request->Size;
        $thongtin_donhang = DB::table('sanpham')
        ->join('ctsanpham', function ($join) {
            $join->on('ctsanpham.MaSP','=','sanpham.MaSP');              
            })->where('ctsanpham.MaMau','=', $request->MaMau)
        ->where('sanpham.MaSP','=', $request->MaSP)
        ->select('ctsanpham.MaSP','ctsanpham.urlHinh1', 'sanpham.TenSP', 'sanpham.GiaBan')->get()->toArray();
          
        $thongtin_donhang[0]->SL = $request->SL;
        $thongtin_donhang[0]->Size = $request->Size;
        $thongtin_donhang[0]->MauSac = $request->MauSac;
        
        if ($request->session()->exists('donhang.'.$MaDH)) {
            $this->update($MaDH, $thongtin_donhang[0], $request->SL);           
        }else{
            //$request->session()->put($MaDH, $thongtin_donhang);
            $request->session()->push('donhang.'.$MaDH, $thongtin_donhang[0]);
        }

        $arr_donhang = session()->get('donhang');
        return view('Store.giohang')->with('arr_donhang', $arr_donhang);        
        
        //foreach ($arr_donhang as $key => $value){
        //    echo $key. ': '. ($arr_donhang[$key][0]->TenSP) ."<br>";
        //}      
    }
    
    public function update ($MaDH, $thongtin_donhang, $SLMoi){
        //$SL_Cu = session()->pull($MaDH, 'SL'); // Nếu session là mảng 1 chiều
         $SL_Cu = session()->pull('donhang.'.$MaDH, 'SL'); // Nếu session là mảng 2 chiều
        //$SL_Moi = $SL_Cu->get('SL')+ $SLMoi; // Nếu là colection
        //$SL_Moi = $SL_Cu[0]['SL'] + $SLMoi; // Nếu là array
        $SL_Moi = $SL_Cu[0]->SL + $SLMoi; // Nếu là sdtClass object
        $thongtin_donhang->SL = $SL_Moi;   
        session()->push('donhang.'.$MaDH, $thongtin_donhang);
    }
    
    public function delete ($MaDH){
        session()->forget('donhang.'.$MaDH);
        $arr_donhang = session()->get('donhang');
        return view('Store.giohang')->with('arr_donhang', $arr_donhang);  
       // return back()->with('arr_donhang', $arr_donhang);
    }
}

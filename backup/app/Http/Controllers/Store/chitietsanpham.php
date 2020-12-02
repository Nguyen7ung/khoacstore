<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sanpham;
use App\Models\ctsanpham;
use Illuminate\Support\Facades\DB;

class chitietsanpham extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($MaSP)
    {  
        // Lấy mô tả sản phẩm
        $chitietsanpham = DB::table('sanpham')
        ->join('ctsanpham', function ($join) {
            $join->on('ctsanpham.MaSP', '=', 'sanpham.MaSP')
                    ->on('ctsanpham.MauSac','=','sanpham.MauSac');
        })
        ->where('sanpham.MaSP','=', $MaSP)->first();
        // Lấy danh sách hình ảnh
        $hinh_sp = $this->LayHinhAnh($MaSP, $chitietsanpham->MauSac);
    
        // Lấy danh sách màu sắc
        $arr_mau = DB::table('ctsanpham')->select('MaSP', 'MaMau', 'MauSac')
               ->where('MaSP', '=', $MaSP)
                ->get();
        
        // Lấy sản phẩm liên quan        
        $sp_lienquan = DB::table('sanpham')
        ->join('phanloaihang', 'phanloaihang.MaPL', '=', 'sanpham.MaPL')
        ->where([['phanloaihang.MaPL', '=', $chitietsanpham->MaPL], ['MaSP', '<>', $MaSP],['sanpham.AnHien', '=', 1]])
        ->select('TenPL_KhongDau', 'MaSP', 'urlHinh', 'TenSP', 'GiaBan')
        ->limit(4)
        ->get();
         
        return view ('Store.chitietsanpham',['chitiet_sp' => $chitietsanpham, 'DSHinh' => $hinh_sp, 'DSMau' => $arr_mau, "sp_lienquan" => $sp_lienquan]);
    }
    
    public function LayHinhAnh ($MaSP, $MauSac){
        $hinh_sp = DB::table('ctsanpham')->select('urlHinh1', 'urlHinh2', 'urlHinh3', 'urlHinh4')
               ->where([['MaSP', '=', $MaSP],['MauSac', '=', $MauSac]])
                ->get();
        $arr_hinh = json_decode($hinh_sp, TRUE);
        return $arr_hinh[0];
    }
    
     public function DoiHinhAnh (Request $request){
        $MaSP = $request->MaSP;
        $MauSac = $request->MauSac;
        $hinh_sp = DB::table('ctsanpham')->select('urlHinh1', 'urlHinh2', 'urlHinh3', 'urlHinh4')
               ->where([['MaSP', '=', $MaSP],['MauSac', '=', $MauSac]])
                ->get();
        $arr_hinh = json_decode($hinh_sp, true);
        $arr_hinh = array_values($arr_hinh[0]);
        return json_encode($arr_hinh);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\sanpham;
use App\Models\loaihang;
use App\Models\phanloaihang;
use App\Models\ctsanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\storesanpham;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;


class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loaihang = loaihang::all();
        return view('Admin.SanPham.sanpham_them', compact('loaihang'));            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storesanpham $request)
    {
        $validated = $request->validated();
        $img_path = $this->LayDuongDanHinh($validated['MaPL']);
        $img_path .= $validated['urlHinh'];
        $validated['urlHinh'] = $img_path;
        sanpham::create($validated);  
        $ctsanpham = new ctsanpham;
        $ctsanpham->MaSP =  $validated['MaSP'];
        $ctsanpham->urlHinh1 = $validated['urlHinh'];
        $ctsanpham->MauSac = $validated['MauSac'];
        $ctsanpham->save();
        $this->show($validated['MaPL']);
        return redirect()->route('sanpham.show',$validated['MaPL'])->with('ketqua','Thêm sản phẩm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function show($MaPL)          
    {
        $sanpham = sanpham::where('MaPL', $MaPL)->get();
        return view('Admin.SanPham.sanpham_ds', compact('sanpham'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function edit($MaSP)
    {
        $sanpham = sanpham::where('MaSP', $MaSP)->first();
        $phanloaihang = phanloaihang::all();
        return view('Admin.SanPham.sanpham_sua', compact('sanpham', 'phanloaihang'));   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function update(storesanpham $request, $MaSP)
    {
        $validated = $request->validated();
        $sanpham=sanpham::findOrFail($MaSP);
        unset($validated['MaSP']);
        if (strpos($validated['urlHinh'], '/') === FALSE){
            $img_path = $this->LayDuongDanHinh($validated['MaPL']);
            $img_path .= $validated['urlHinh'];
            $validated['urlHinh'] = $img_path;
        }
        $sanpham->update($validated);
        return redirect()->route('sanpham.show',$validated['MaPL'])->with('ketqua','Cập nhật sản phẩm thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function destroy($MaSP)
    {
        $sanpham=sanpham::findOrFail($MaSP);
        $sanpham->delete();
        return back();
    }
    
    public function LayMaPhanLoai(Request $request)
    {
        $MaPL = phanloaihang::where('MaLH', $request->MaLH)->get();
        foreach ($MaPL as $row){
             echo "<option value='".$row->MaPL."'>".$row->TenPL."</option>";
        }    
    }
    
    public function TaoMaSanPham (Request $request){  
        $MaSP = DB::table('sanpham')
                ->selectRaw('SUBSTRING(MaSP, 1, 2) as MaSanPham, SUBSTRING(MaSP, 3, 3) as SoSanPham')
                ->where('MaPL','=', $request->MaPL)
                ->orderby('SoSanPham', 'desc')
                ->limit(1)
                ->first(); 
        if($MaSP == null){
            echo "Null";
        }else{
            $DemMa= $MaSP->SoSanPham+1;       
            echo $MaSP->MaSanPham . str_pad($DemMa,3,"0",STR_PAD_LEFT);
        }
    }
    
    public function LayDuongDanHinh ($MaPL){
        $target_dir = "images/";
        $kq = DB::table('phanloaihang')
        ->join('loaihang', 'loaihang.MaLH', '=', 'phanloaihang.MaLH')
        ->where('phanloaihang.MaPL', '=', $MaPL)
        ->select('TenLH_KhongDau', 'TenPL_KhongDau')
        ->first();
        return $target_dir.$kq->TenLH_KhongDau.'/'.$kq->TenPL_KhongDau.'/';
    }
    
}// End Class

     
    

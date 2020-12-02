<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\loaihang;
use App\Models\phanloaihang;

class menu extends Controller
{
    public function menu1()
    {
        return $menu1 = loaihang::where('AnHien','=', 1)->get();
        //return view('menu')->with('menu1',$menu1);  
        
    }
    public function menu2()
    {
        return $menu2 = phanloaihang::where('AnHien','=',1)->get();
        //return view('menu')->with('menu2',2);              
    }
    
    public function show($MaLH)
    {
        $loaihang = loaihang::find($MaLH);
        return view('show', array('menu1' => $loaihang));
    }
}

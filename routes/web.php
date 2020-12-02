<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;


use App\Http\Middleware\checklogin;
use App\Models\sanpham;

use App\Http\Controllers\Store\trangchu;
use App\Http\Controllers\Store\sanphamtrongloai;
use App\Http\Controllers\Store\loaisanpham;
use App\Http\Controllers\Store\chitietsanpham;
use App\Http\Controllers\Store\giohang;
use App\Http\Controllers\Store\giohang2;

use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\SanPhamController;

//use Laravel\Fortify\Http\Controllers\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ------------------------------- Front-End -----------------------------------
// View
Route::get('/', [trangchu::class,'index']);
Route::get('/cat/{MaLH}',[loaisanpham::class,'index']);
Route::get('type/{TenPL}', [sanphamtrongloai::class, 'index']);
Route::get('/detail/{MaSP}', function ($MaSP){
    $ctsp = new chitietsanpham;
    return $ctsp->index($MaSP);
})->name('detail.show');
Route::post('/ajax', [chitietsanpham::class,'DoiHinhAnh'])->name('ajax.anh');


// Giỏ hàng
Route::post('/add-cart', [giohang::class,'add']);
Route::get('/update-cart/{MaDH}/{SL}',[giohang::class,'update']);
Route::get('/delete-cart/{MaDH}', [giohang::class,'delete']);
   
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// User dùng Jetstream
//Route::get('/register', [RegisteredUserController::class, 'create'])->middleware(['guest'])->name('register');
//Route::post('/register', [RegisteredUserController::class, 'store'])->middleware(['guest']);
    
// ------------------------------- Back-End ------------------------------------

Route::group(['prefix'=>'quantri', 'middleware'=> ['checklogin']],function (){  
    // Login    
    Route::get('/', function (){
        return view ('Admin.index');
    })->withoutMiddleware([checklogin::class]);
    Route::get('/login', function (){
        return view ('Admin.login');
    })->withoutMiddleware([checklogin::class]);
    Route::post('/login', [AdminController::class, 'thongtinuser'])->withoutMiddleware([checklogin::class]);
    //Route::post('/login', [LoginController::class, 'authenticate'])->withoutMiddleware([checklogin::class]);


    // Sản Phẩm
    Route::resource('/sanpham', SanPhamController::class);
    Route::post('/sanpham/mapl', [SanPhamController::class, 'LayMaPhanLoai'])->name('lay.maphanloai');
    Route::post('/sanpham/masp', [SanPhamController::class, 'TaoMaSanPham'])->name('tao.masanpham');
    Route::post('/sanpham/upload', [SanPhamController::class, 'LayDuongDanHinh']);
  
});
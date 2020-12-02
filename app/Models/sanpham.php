<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    public $timestamps = false;
    protected $primaryKey = 'MaSP';  
    public $incrementing = false; // Lưu ý: Phải có lệnh này
    protected $keyType = 'string';
   //protected $dates = ['NgayCapNhat'];
    protected $fillable = ['MaSP', 'TenSP', 'urlHinh', 'MauSac', 'MoTa', 'GiaBan', 'TinhTrang', 'NgayCapNhat', 'MaPL', 'MaNCC', 'ThuTu', 'AnHien'];

}

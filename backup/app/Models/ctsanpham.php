<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ctsanpham extends Model
{
    use HasFactory;
    protected $table = 'ctsanpham';
    //protected $primaryKey = 'MaSP'; 
    public $incrementing = false; // Lưu ý: Phải có lệnh này
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phanloaihang extends Model
{
    use HasFactory;
    protected $table = 'phanloaihang';
    protected $primaryKey = 'MaPL';
    public $incrementing = false; // Lưu ý: Phải có lệnh này
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loaihang extends Model
{
    use HasFactory;
    protected $table = 'loaihang';
    protected $primaryKey = 'MaLH';
    public $incrementing = false; // Lưu ý: Phải có lệnh này
}

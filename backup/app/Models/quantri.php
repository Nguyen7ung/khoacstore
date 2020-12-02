<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/*
class quantri extends Model
{
    use HasFactory;
    protected $table = 'quantri';
    protected $primaryKey = 'MaNV';
    public $incrementing = false; // Lưu ý: Phải có lệnh này

}
 */
class quantri extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'quantri';
    public $timestamps = false;
    protected $keyType = 'string';
    protected $primaryKey = 'MaNV';
    //public $incrementing = false; // Lưu ý: Phải có lệnh này
    
    protected $fillable = [
        'TenNV',
        'Email',
        'MatKhau',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'MatKhau',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //protected $casts = [
    //    'email_verified_at' => 'datetime',
    //];

}

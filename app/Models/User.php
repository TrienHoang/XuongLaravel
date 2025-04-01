<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Tên bảng

    protected $primaryKey = 'id'; // Khóa chính

    public $timestamps = true; // Sử dụng timestamps (created_at, updated_at)

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'address',
        'status',
        'avatar',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'string',
        'avatar' => 'integer',
        'role_id' => 'integer',
    ];

    // Quan hệ với bảng roles (Một user thuộc một role)
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function files()
    {
        // Một user có nhiều file
        return $this->hasMany(UploadFile::class);
    }

    public function avatar()
    {
        // Một user có một avatar (là một file đặc biệt)
        return $this->belongsTo(UploadFile::class, 'avatar');
    }
}

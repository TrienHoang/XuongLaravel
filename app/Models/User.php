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
    public function role() {
        return $this->belongsTo(Role::class);
    }


    public function hasPermission($permName) {
        return $this->role && $this->role->permissions->pluck('name')->contains($permName);
    }
    

    public function avatarFile()
    {
        return $this->belongsTo(UploadFile::class, 'avatar', 'id');
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    use HasFactory;

    protected $table = 'upload_files';

    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        // Một file thuộc về một user
        return $this->belongsTo(User::class);
    }

    public function avatarForUser()
    {
        // Một file có thể là avatar của một user
        return $this->hasOne(User::class, 'avatar');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AlbumProduct extends Pivot
{   
    use HasFactory;

    // Tên bảng (nếu không theo quy ước đặt tên của Laravel)
    protected $table = 'albums_product';

    // Các trường có thể gán giá trị hàng loạt
    protected $fillable = [
        'pro_id', 
        'upl_id',
        'type',
    ];

    // Kiểu dữ liệu tự động chuyển đổi
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Quan hệ với model Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'pro_id');
    }

    /**
     * Quan hệ với model UploadFile
     */
    public function uploadFile()
    {
        return $this->belongsTo(UploadFile::class, 'upl_id');
    }

    /**
     * Kiểm tra có phải là ảnh chính không
     */
    public function isMainImage(): bool
    {
        return $this->type === 'mainImage';
    }
}

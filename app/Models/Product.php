<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
        'quantity',
        'category_id',
        'brand_id',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function uploadFiles()
    {
        return $this->belongsToMany(UploadFile::class, 'albums_product', 'pro_id', 'upl_id')
                    ->using(AlbumProduct::class)
                    ->withPivot('type')
                    ->withTimestamps();
    }

    public function mainImage()
    {
        return $this->uploadFiles()
            ->wherePivot('type', 'mainImage')
            ->first();
    }

    public function otherImages()
    {
        return $this->uploadFiles()
            ->wherePivot('type', 'none')
            ->get();
    }
}

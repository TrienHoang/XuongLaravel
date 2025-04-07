<?php

namespace App\Repositories;

use App\Models\AlbumProduct;
use App\Models\Product;
use App\Models\UploadFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function all($paginate = 10)
    {
        return $this->model->with('category', 'brand')->orderByDesc('id')->paginate($paginate);
    }


    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function saveFile($file)
    {
        $path = $file->store('products', 'public'); // Lưu vào storage/public/products
        return UploadFile::create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(), // Lấy loại file (image/jpeg, image/png, ...)
            'user_id' => Auth::id(), // Lấy ID của user đang đăng nhập
        ]);
    }

    public function attachImageToProduct($productId, $uploadId, $type = 'none')
    {
        return AlbumProduct::create([
            'pro_id' => $productId,
            'upl_id' => $uploadId,
            'type' => $type,
        ]);
    }

    public function detachImageFromProduct($productId, $uploadId)
    {
        return AlbumProduct::where('pro_id', $productId)->where('upl_id', $uploadId)->delete();
    }

    public function deleteFile($uploadId)
    {
        $file = UploadFile::find($uploadId);
        if ($file) {
            Storage::disk('public')->delete($file->file_path); // Xóa file khỏi storage
            $file->delete(); // Xóa bản ghi trong DB
        }
    }

    public function update($product, array $data)
    {
        $product->update($data);
        return $product;
    }



    public function delete($product)
    {
        // Xóa tất cả liên kết ảnh trong bảng albums_product
        AlbumProduct::where('pro_id', $product->id)->delete();

        // Xóa sản phẩm
        $product->delete();
        return $product->delete();
    }

}

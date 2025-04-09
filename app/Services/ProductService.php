<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepo;

    public function __construct()
    {
        $this->productRepo = new ProductRepository();
    }

    public function getAllProducts()
    {
        return $this->productRepo->all(5);
    }

    public function getProduct($id)
    {
        return $this->productRepo->find($id);
    }

    public function createProduct($request)
    {

        $data = [
            'name' => $request['name'],
            'description' => $request['description'] ?? null,
            'price' => $request['price'],
            'discount' => $request['discount'] ?? 0.00,
            'quantity' => $request['quantity'] ?? 0,
            'category_id' => $request['category_id'],
            'brand_id' => $request['brand_id'] ?? null,
            'status' => $request['status'] ?? 'active',
        ];

        $product =  $this->productRepo->create($data);

        // Xử lý ảnh chính
        if ($request->hasFile('main_image')) {
            $mainImage = $this->productRepo->saveFile($request->file('main_image'));
            $this->productRepo->attachImageToProduct($product->id, $mainImage->id, 'mainImage');
        }

        // Xử lý ảnh phụ
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $subImage) {
                $uploadedSubImage = $this->productRepo->saveFile($subImage);
                $this->productRepo->attachImageToProduct($product->id, $uploadedSubImage->id, 'none');
            }
        }

        return $product;
    }

    public function updateProduct($product, $request)
    {

        $data = [
            'name' => $request['name'],
            'description' => $request['description'] ?? null,
            'price' => $request['price'],
            'discount' => $request['discount'] ?? 0.00,
            'quantity' => $request['quantity'] ?? 0,
            'category_id' => $request['category_id'],
            'brand_id' => $request['brand_id'] ?? null,
            'status' => $request['status'] ?? 'active',
        ];


        $this->productRepo->update($product, $data);

        // Xử lý ảnh chính
        if ($request->hasFile('main_image')) {

            // Lấy ảnh chính cũ (nếu có)
            $currentMainImage = $product->mainImage();

            // Xóa ảnh chính cũ nếu có
            if ($product->mainImage()) {

                $this->productRepo->detachImageFromProduct($product->id, $product->mainImage()->id);
                $this->productRepo->deleteFile($currentMainImage->id);
            }
            // Thêm ảnh chính mới
            $mainImage = $this->productRepo->saveFile($request->file('main_image'));
            $this->productRepo->attachImageToProduct($product->id, $mainImage->id, 'mainImage');
        }

        // Xử lý ảnh phụ mới
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $subImage) {
                $uploadedSubImage = $this->productRepo->saveFile($subImage);
                $this->productRepo->attachImageToProduct($product->id, $uploadedSubImage->id, 'none');
            }
        }

        // Xóa ảnh phụ được chọn
        if ($request->filled('delete_sub_images')) {
            foreach ($request->delete_sub_images as $uploadId) {
                $this->productRepo->detachImageFromProduct($product->id, $uploadId);
                $this->productRepo->deleteFile($uploadId);
            }
        }

        return $product->fresh(); // Lấy lại dữ liệu mới nhất
    }
    

    public function deleteProduct($product)
    {
        // Lấy tất cả ảnh liên quan đến sản phẩm
        $images = $product->uploadFiles;

        // Xóa từng file ảnh khỏi storage và database
        foreach ($images as $image) {
            $this->productRepo->deleteFile($image->id);
        }

        // Xóa sản phẩm và các liên kết ảnh
        $this->productRepo->delete($product);

        return true;
    }
}

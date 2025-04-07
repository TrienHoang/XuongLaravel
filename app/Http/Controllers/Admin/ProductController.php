<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Providers\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    // Hiển thị danh sách sản phẩm
    public function listProduct()
    {
        $products = $this->productService->getAllProducts();
        return view('admin.products.list', ['products' => $products]);
    }

    // Hiển thị form thêm sản phẩm
    public function addProduct()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.add', compact('categories', 'brands'));
    }

    // Xử lý thêm sản phẩm
    public function addPostProduct(ProductRequest $request)
    {
        $this->productService->createProduct($request);
        return redirect()->route('admin.products.listProduct')->with('success', 'Thêm sản phẩm thành công!');
    }

    // Xem chi tiết sản phẩm
    public function detailProduct($id)
    {
        $product = $this->productService->getProduct($id);
        return view('admin.products.detail', ['product' => $product]);
    }

    // Hiển thị form sửa sản phẩm
    public function updateProduct($id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::with('uploadFiles')->findOrFail($id);
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    // Xử lý cập nhật sản phẩm

    public function updatePatchProduct(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->productService->updateProduct($product, $request);
        return redirect()->route('admin.products.listProduct')->with('success', 'Cập nhật sản phẩm thành công!');
    }
    // Xóa sản phẩm
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $this->productService->deleteProduct($product);

        return redirect()->route('admin.products.listProduct')->with('success', 'Xóa sản phẩm thành công!');
    }
}

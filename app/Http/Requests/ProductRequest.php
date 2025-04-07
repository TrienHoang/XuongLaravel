<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'brand_id' => 'nullable|exists:brands,id',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Ảnh chính
            'sub_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Ảnh phụ
            'delete_sub_images' => 'nullable|array', // ID của ảnh phụ muốn xóa
            'delete_sub_images.*' => 'integer|exists:upload_files,id', // Validate ID ảnh phụ
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            // Tên sản phẩm
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự',
            
            // Mô tả
            'description.string' => 'Mô tả phải là chuỗi văn bản',
            
            // Giá
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là số',
            'price.min' => 'Giá sản phẩm không được nhỏ hơn 0',
            
            // Giảm giá
            'discount.numeric' => 'Giảm giá phải là số',
            'discount.min' => 'Giảm giá không được nhỏ hơn 0%',
            'discount.max' => 'Giảm giá không được vượt quá 100%',
            
            // Số lượng
            'quantity.required' => 'Vui lòng nhập số lượng',
            'quantity.integer' => 'Số lượng phải là số nguyên',
            'quantity.min' => 'Số lượng không được nhỏ hơn 0',
            
            // Danh mục
            'category_id.required' => 'Vui lòng chọn danh mục',
            'category_id.exists' => 'Danh mục không tồn tại',
            
            // Trạng thái
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            
            // Thương hiệu
            'brand_id.exists' => 'Thương hiệu không tồn tại',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'tên sản phẩm',
            'description' => 'mô tả',
            'price' => 'giá',
            'discount' => 'giảm giá',
            'quantity' => 'số lượng',
            'category_id' => 'danh mục',
            'brand_id' => 'thương hiệu',
            'status' => 'trạng thái',
        ];
    }
}
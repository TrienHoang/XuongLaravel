<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function listCategory() {
        $listCategory = Category::all();
        return view('admin.categories.list-category')->with([
            'listCategory' => $listCategory
        ]);
    }

    public function addCategory() {
        $categories = Category::all();
        return view('admin.categories.add-category', compact('categories'));
    }

    public function addPostCategory(Request $req) {
        $req->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'parent_id' => 'nullable|exists:categories,id',
        ], [
            'name.required' => 'Tên danh mục không được để trống.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'name.max' => 'Tên danh mục không được vượt quá 100 ký tự.',
            'parent_id.exists' => 'Danh mục cha không hợp lệ.',
        ]);

        $data = [
            'name' => $req->name,
            'parent_id' => $req->parent_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        Category::create($data);
        return redirect()->route('admin.categories.listCategory')->with([
            'message' => 'Thêm mới dữ liệu thành công'
        ]);
    }

    public function deleteCategory($id) {
        $category = Category::findOrFail($id); // Tìm danh mục theo ID
        $category->delete(); // Xóa danh mục

        return redirect()->route('admin.categories.listCategory')->with('message', 'Danh mục đã được xóa thành công!');
    }

    public function detailCategory($id){
        $category = Category::where('id', $id)->first();
        return view('admin.categories.detail-category')->with([
            'category' => $category
        ]);
    }

    public function updateCategory($id) {

        $category = Category::findOrFail($id); // Lấy danh mục cần chỉnh sửa
        $categories = Category::where('id', '!=', $id)->get(); // Lấy danh sách danh mục khác
    
        return view('admin.categories.update-category', compact('category', 'categories'));
    }

    public function updatePatchCategory($id, Request $req) {
        $req->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $id,
            'parent_id' => 'nullable|exists:categories,id',
        ], [
            'name.required' => 'Tên danh mục không được để trống.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'name.max' => 'Tên danh mục không được vượt quá 100 ký tự.',
            'parent_id.exists' => 'Danh mục cha không hợp lệ.',
        ]);
        
        $data = [
            'name' => $req->name,
            'parent_id' => $req->parent_id,
        ];
        Category::where('id', $id)->update($data);
        return redirect()->route('admin.categories.listCategory')->with([
            'message' => 'Sửa dữ liệu thành công'
        ]);
    }
}

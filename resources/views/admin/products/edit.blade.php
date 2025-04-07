@extends('admin.layouts.main')

@section('title')
    Thêm sản phẩm

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Chỉnh sửa sản phẩm</h5>
                                </div>
    
                                <form action="{{ route('admin.products.updatePatchProduct', $product->id) }}" method="POST" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    @method('PATCH')
    
                                    {{-- Name --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Tên sản phẩm:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="name" type="text" value="{{ old('name', $product->name) }}" placeholder="Product name">
                                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
    
                                    {{-- Description --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Mô tả:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="description" rows="4" placeholder="Mô tả sản phẩm...">{{ old('description', $product->description) }}</textarea>
                                            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
    
                                    {{-- Price --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Giá:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="price" type="number" value="{{ old('price', $product->price) }}" placeholder="Giá sản phẩm">
                                            @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
    
                                    {{-- Discount --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Giảm giá (%):</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="discount" type="number" min="0" max="100" value="{{ old('discount', $product->discount) }}" placeholder="Phần trăm giảm giá">
                                            @error('discount') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
    
                                    {{-- Quantity --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Số lượng:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="quantity" type="number" min="1" value="{{ old('quantity', $product->quantity) }}" placeholder="Số lượng sản phẩm">
                                            @error('quantity') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
    
                                    {{-- Category --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Danh mục:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="category_id">
                                                <option value="">-- Chọn danh mục --</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
    
                                    {{-- Brand --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Thương hiệu:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="brand_id">
                                                <option value="">-- Chọn thương hiệu --</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                        {{ $brand->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('brand_id') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
    
                                    {{-- Status --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Trạng thái:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status">
                                                <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                                                <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Ngừng bán</option>
                                            </select>
                                            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
    
                                    {{-- Main Image Current --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Ảnh chính hiện tại:</label>
                                        <div class="col-sm-9">
                                            @if ($product->mainImage())
                                                <img src="{{ asset('storage/' . $product->mainImage()->file_path) }}" 
                                                     alt="{{ $product->mainImage()->file_name }}" 
                                                     style="max-width: 200px;">
                                            @else
                                                <p>Chưa có ảnh chính</p>
                                            @endif
                                        </div>
                                    </div>
    
                                    {{-- Main Image Upload --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Thay ảnh chính:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" name="main_image">
                                            @error('main_image') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
    
                                    {{-- Sub Images Current --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Ảnh phụ hiện tại:</label>
                                        <div class="col-sm-9">
                                            @if ($product->otherImages()->count() > 0)
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($product->otherImages() as $image)
                                                        <div class="m-2">
                                                            <img src="{{ asset('storage/' . $image->file_path) }}" 
                                                                 alt="{{ $image->file_name }}" 
                                                                 style="max-width: 150px;">
                                                            <div>
                                                                <input type="checkbox" name="delete_sub_images[]" value="{{ $image->id }}">
                                                                <label>Xóa ảnh này</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <p>Chưa có ảnh phụ</p>
                                            @endif
                                        </div>
                                    </div>
    
                                    {{-- Sub Images Upload --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Thêm ảnh phụ:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" name="sub_images[]" multiple>
                                            @error('sub_images.*') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
    
                                    <button class="btn btn-success" type="submit">Cập nhật sản phẩm</button>
                                    <a href="{{ route('admin.products.listProduct') }}" class="btn btn-theme">Quay lại</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
@endsection
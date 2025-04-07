@extends('admin.layouts.main')

@section('title')
    Thêm sản phẩm

@endsection

@section('content')
<form action="{{ route('admin.products.addPostProduct') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Thêm sản phẩm</h5>
                                </div>

                                <div class="theme-form theme-form-2 mega-form">
                                    
                                    {{-- Name --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Tên sản phẩm:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="name" type="text" placeholder="Product name">
                                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Mô tả:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="description" rows="4" placeholder="Mô tả sản phẩm..."></textarea>
                                            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Price --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Giá:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="price" type="number"  placeholder="Giá sản phẩm">
                                            @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Discount --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Giảm giá (%):</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="discount" type="number" min="0" max="100" placeholder="Phần trăm giảm giá">
                                            @error('discount') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Quantity --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Số lượng:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="quantity" type="number" min="1" placeholder="Số lượng sản phẩm">
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
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
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
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                                <option value="active">Hoạt động</option>
                                                <option value="inactive">Ngừng bán</option>
                                            </select>
                                            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Image Upload  --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Ảnh sản phẩm:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" name="main_image">
                                            @error('main_image') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>


                                    {{-- Image Upload  --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Ảnh phụ sản phẩm:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" name="sub_images[]" multiple>
                                            @error('sub_images.*') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                </div>

                                <button class="btn btn-success" type="submit">Lưu sản phẩm</button>
                                <a href="{{ route('admin.products.listProduct') }}" class="btn btn-theme">Quay lại</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</form>

@endsection
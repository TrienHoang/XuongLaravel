@extends('admin.layouts.main')

@section('title')
    @parent
    Xem chi tiết danh mục
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h5>Chi tiết sản phẩm</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Ghi chú</th>
                            <td>{{ $product->description }}</td>
                        </tr>
                        <tr>
                            <th>Giá sản phẩm</th>
                            <td>{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <th>Số lượng sản phẩm</th>
                            <td>{{ $product->quantity }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái sản phẩm</th>
                            <td class="status-{{ $product->status == 'active' ? 'success' : 'danger' }}">
                                <span>{{ $product->status == 'active' ? 'Hoạt động' : 'Ngừng bán' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tên danh mục</th>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Hãng sản phẩm</th>
                            <td>{{ $product->brand->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Ảnh chính</th>
                            <td>
                                @if ($product->mainImage())
                                    <img src="{{ asset('storage/' . $product->mainImage()->file_path) }}" 
                                         alt="{{ $product->mainImage()->file_name }}" 
                                         style="max-width: 200px; height: auto;">
                                @else
                                    Chưa có ảnh chính
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Ảnh phụ</th>
                            <td>
                                @if ($product->otherImages()->count() > 0)
                                    <div class="d-flex flex-wrap">
                                        @foreach ($product->otherImages() as $image)
                                            <img src="{{ asset('storage/' . $image->file_path) }}" 
                                                 alt="{{ $image->file_name }}" 
                                                 style="max-width: 250px; height: 300px; margin: 5px;">
                                        @endforeach
                                    </div>
                                @else
                                    Chưa có ảnh phụ
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Ngày tạo sản phẩm</th>
                            <td>{{ $product->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Ngày cập nhật sản phẩm</th>
                            <td>{{ $product->updated_at }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('admin.products.listProduct') }}" class="btn btn-theme">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
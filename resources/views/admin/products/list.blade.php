@extends('admin.layouts.main')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
<div class="page-body-wrapper">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        @if (session('message'))
        <div class="alert alert-primary" role="alert">
            {{ session('message') }}
        </div>
        @php
        unset($_SESSION['message']);
        @endphp
    @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="title-header option-title d-sm-flex d-block">
                            <h5>Danh sách sản phẩm</h5>
                            <div class="right-options">
                                <ul>
                                    <li>
                                        <a class="btn btn-solid" href="{{ route('admin.products.addProduct') }}">Thêm sản phẩm</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table all-package theme-table table-product" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Danh mục</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Trạng thái</th>
                                            <th>Tùy chọn</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="table-image">
                                                    @if ($product->mainImage())
                                                    <div class="image-container">
                                                        <img src="{{ asset('storage/' . $product->mainImage()->file_path) }}" alt="{{ $product->mainImage()->file_name }}">
                                                    </div>
                                                @else
                                                    <p>Chưa có ảnh chính</p>
                                                @endif
                                                </div>
                                            </td>

                                            <td>{{ $product->name }}</td>

                                            <td>{{ $product->category->name ?? 'N/A' }}</td>

                                            <td>{{ $product->quantity }}</td>

                                            <td class="td-price">{{ number_format($product->price) }}đ</td>

                                            <td class="status-{{ $product->status == 'active' ? 'success' : 'danger' }}">
                                                <span>{{ $product->status == 'active' ? 'Hoạt động' : 'Ngừng bán' }}</span>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('admin.products.detailProduct', $product->id) }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.products.updateProduct', $product->id) }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $product->id }}">
                                                        <i class="ri-delete-bin-line text-danger"></i>
                                                    </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="deleteModalLabel{{ $product->id }}">Cảnh báo</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-danger">
                                                            Bạn có chắc chắn muốn xóa danh mục
                                                            <strong>{{ $product->name }}</strong> không?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Hủy</button>
                                                        <form
                                                            action="{{ route('admin.products.deleteProduct', ['id' => $product->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Xác nhận
                                                                xóa</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Không có sản phẩm nào</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                
                                <!-- Phân trang -->
                                @if ($products->hasPages())
                                <div class="mt-4">
                                    {{ $products->links('pagination::bootstrap-5') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid Ends-->
</div>

{{-- <!-- Modal xác nhận xóa -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa sản phẩm này?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".btn-delete").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                let form = this.closest("form");
                Swal.fire({
                    title: "Bạn có chắc muốn xóa?",
                    text: "Hành động này không thể hoàn tác!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Xóa",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

@endsection
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
                    <h5>Chi tiết danh mục</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <th>Tên danh mục</th>
                            <td>{{ $category->name }}</td>
                        </tr>
                        <tr>
                            <th>Danh mục cha</th>
                            <td>{{ $category->parent_id ?? 'Trống'  }}</td>
                        </tr>
                        <tr>
                            <th>Mô tả</th>
                            <td>{{ $category->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>{{ $category->updated_at }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('admin.categories.listCategory') }}" class="btn btn-theme">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

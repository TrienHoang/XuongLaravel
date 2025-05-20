@extends('admin.layouts.main')

@section('title', 'Danh sách vai trò')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-3">Danh sách vai trò</h2>
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên vai trò</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm d-inline-block">Sửa</a>
                            <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-warning btn-sm d-inline-block">Xem</a>
                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline-block">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-success"
                                    onclick="return confirm('Xác nhận xoá vai trò này?')">Xoá</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if($roles->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">Không có vai trò nào.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

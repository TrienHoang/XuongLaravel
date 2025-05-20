@extends('admin.layouts.main')

@section('title')
Chi tiết vai trò
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-header-2">
                        <h5>Chi tiết vai trò</h5>
                    </div>

                    <div class="theme-form theme-form-2 mega-form">

                        {{-- Tên Role --}}
                        <div class="mb-4 row">
                            <label class="form-label-title col-sm-3 mb-0">Tên vai trò:</label>
                            <div class="col-sm-9">
                                <p class="form-control-plaintext">{{ $role->name }}</p>
                            </div>
                        </div>

                        {{-- Mô tả --}}
                        <div class="mb-4 row">
                            <label class="form-label-title col-sm-3 mb-0">Mô tả:</label>
                            <div class="col-sm-9">
                                <p class="form-control-plaintext">{{ $role->description }}</p>
                            </div>
                        </div>

                        {{-- Danh sách quyền --}}
                        <div class="mb-4 row">
                            <label class="form-label-title col-sm-3 mb-0">Danh sách quyền:</label>
                            <div class="col-sm-9">
                                <ul class="list-group">
                                    @foreach ($role->permissions as $permission)
                                        <li class="list-group-item">
                                            {{ \App\Helpers\PermissionLabelHelper::label($permission->name) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <a href="{{ route('admin.roles.index') }}" class="btn btn-theme">Quay lại</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

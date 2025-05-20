@extends('admin.layouts.main')

@section('title')
Chỉnh sửa vai trò
@endsection

@section('content')
<form action="{{ route('admin.roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Chỉnh sửa vai trò</h5>
                                </div>

                                <div class="theme-form theme-form-2 mega-form">
                                    {{-- Role Name --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Tên vai trò:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="name" type="text" value="{{ old('name', $role->name) }}" placeholder="Tên vai trò">
                                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    
                                    {{-- Mô tả --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Mô tả:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="description" rows="3" placeholder="Mô tả vai trò...">{{$role->description}}</textarea>
                                            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Permissions --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Quyền:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    <div class="col-sm-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                                                {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                            <label class="form-check-label">{{ \App\Helpers\PermissionLabelHelper::label($permission->name) }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @error('permissions') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">  
                                    <button class="btn btn-success" type="submit">Cập nhật vai trò</button>
                                    <a href="{{ route('admin.roles.index') }}" class="btn btn-theme">Quay lại</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
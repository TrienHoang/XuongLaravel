
@extends('admin.layouts.main')

@section('title')
    Sửa người dùng
@endsection

@section('content')
<form action="{{ route('admin.users.updateUser', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Sử dụng PUT cho cập nhật -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Cập nhật người dùng</h5>
                                </div>

                                <div class="theme-form theme-form-2 mega-form">
                                    
                                    {{-- Name --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Tên người dùng:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="name" type="text" 
                                                   value="{{ old('name', $user->name) }}" 
                                                   placeholder="Tên người dùng">
                                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Email:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="email" type="email" 
                                                   value="{{ old('email', $user->email) }}" 
                                                   placeholder="Email người dùng">
                                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Password --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Mật khẩu mới:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="password" type="password" 
                                                   placeholder="Nhập mật khẩu mới (để trống nếu không đổi)">
                                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Phone Number --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Số điện thoại:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="phone_number" type="text" 
                                                   value="{{ old('phone_number', $user->phone_number) }}" 
                                                   placeholder="Số điện thoại">
                                            @error('phone_number') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Địa chỉ:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="address" rows="4" 
                                                      placeholder="Địa chỉ người dùng...">{{ old('address', $user->address) }}</textarea>
                                            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Trạng thái:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status">
                                                <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Hoạt động</option>
                                                <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Không hoạt động</option>
                                            </select>
                                            @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Role --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Vai trò:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="role_id">
                                                <option value="">-- Chọn vai trò --</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" 
                                                            {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role_id') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Avatar Upload --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Ảnh đại diện:</label>
                                        <div class="col-sm-9">
                                            @if ($user->avatar && $user->avatarFile)
                                                <img src="{{ Storage::url($user->avatarFile->file_path) }}" 
                                                     alt="Avatar" 
                                                     style="max-width: 100px; margin-bottom: 10px;">
                                            @endif
                                            <input class="form-control" type="file" name="avatar">
                                            <small class="text-muted">Để trống nếu không muốn thay đổi ảnh.</small>
                                            @error('avatar') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                </div>

                                <button class="btn btn-success" type="submit">Cập nhật người dùng</button>
                                <a href="{{ route('admin.users.listUser') }}" class="btn btn-theme">Quay lại</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</form>
@endsection
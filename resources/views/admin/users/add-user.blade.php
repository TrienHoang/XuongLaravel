@extends('admin.layouts.main')

@section('title')
    Thêm người dùng
@endsection

@section('content')
<form action="{{ route('admin.users.addPostUser') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Thêm người dùng</h5>
                                </div>

                                <div class="theme-form theme-form-2 mega-form">
                                    
                                    {{-- Name --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Tên người dùng:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="name" type="text" placeholder="Tên người dùng">
                                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Email:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="email" type="email" placeholder="Email người dùng">
                                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Password --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Mật khẩu:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="password" type="password" placeholder="Mật khẩu">
                                            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Phone Number --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Số điện thoại:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="phone_number" type="text" placeholder="Số điện thoại">
                                            @error('phone_number') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Địa chỉ:</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="address" rows="4" placeholder="Địa chỉ người dùng..."></textarea>
                                            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Trạng thái:</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="status">
                                                <option value="active">Hoạt động</option>
                                                <option value="inactive">Không hoạt động</option>
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
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role_id') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                    {{-- Avatar Upload --}}
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Ảnh đại diện:</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="file" name="avatar">
                                            @error('avatar') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>

                                </div>

                                <button class="btn btn-success" type="submit">Lưu người dùng</button>
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
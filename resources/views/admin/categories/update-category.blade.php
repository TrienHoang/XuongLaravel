@extends('admin.layouts.main')

@section('title')
    @parent
    Chỉnh sửa danh mục
@endsection

@section('content')
    <form action="{{ route('admin.categories.updatePatchCategory', $category->id) }}" method="post">
        @method('patch')
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Chỉnh sửa danh mục</h5>
                                    </div>

                                    <div class="theme-form theme-form-2 mega-form">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Tên danh mục: </label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="name" id="name" type="text"
                                                    placeholder="Tên danh mục" value="{{ old('name', $category->name) }}">
                                                @if ($errors->has('name'))
                                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Danh mục cha: </label>
                                            <div class="col-sm-9">
                                                <select name="parent_id" id="parent_id" class="form-control">
                                                    <option value="">Không có</option>
                                                    @foreach ($categories as $cat)
                                                        <option value="{{ $cat->id }}"
                                                            {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                                                            {{ $cat->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('parent_id'))
                                                    <div class="text-danger">{{ $errors->first('parent_id') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <button class="btn btn-success" type="submit">Cập nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.categories.listCategory') }}" class="btn btn-theme">Quay lại</a>
    </form>
@endsection

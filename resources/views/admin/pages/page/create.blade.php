@extends('admin.master')

@section('custom-css')
    <link rel="stylesheet" href="{{ asset('/css/CustomStyle.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Thêm trang mới</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>
        <form action="{{ url('/admin/pages/store') }}" class="form-group" method="POST" enctype="multipart/form-data" id="form-add-pages">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-8 float-left">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thành phần chính</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>

                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="form-group">
                            <label for="info">Thông tin</label>
                            <textarea name="info" class="form-control" id="info"></textarea>
                            <label id="info-error" class="text-danger error" for="info"></label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung trang</label>
                            <textarea name="content" id="ckeditor" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <!-- /.card-footer-->
                </div>
            </div>
            <!-- /.content -->

            <div class="col-4 float-right">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thành phần mở rộng</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="form-group">
                            <label for="name">Tên trang</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Tên trang">
                            <label id="name-error" class="text-danger error" for="name"></label>
                        </div>
                        <div class="form-group">
                            <label for="slug">Định danh</label>
                            <input type="text" name="slug" readonly class="form-control" id="slug" value="">
                        </div>
                        <div class="form-group">
                            <label for="menu_id">Menus</label>
                            <select name="menu_id" class="form-control" id="menu_id">
                                @if(!empty($menus))
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style="display: block;">
                        <input type="submit" class="btn btn-primary" value="Thêm">
                    </div>
                    <!-- /.card-footer-->
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom-js')
    <script type="text/javascript" src="{{ asset('/js/pages/menus/page.js') }}"></script>
@endsection

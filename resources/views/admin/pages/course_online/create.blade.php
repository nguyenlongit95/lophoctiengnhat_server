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
                        <h1 class="m-0 text-dark">Thêm khoá học mới</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>
        <form action="{{ url('/admin/course-online/store') }}" class="form-group" method="POST" enctype="multipart/form-data" id="form-add-course-online">
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
                            <label for="name">Tên khoá học</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Tên khoá học">
                            <label id="name-error" class="text-danger error" for="name"></label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung khoá học</label>
                            <textarea name="description" id="ckeditor" cols="30" rows="10"></textarea>
                            <label id="description-error" class="text-danger error" for="description"></label>
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
                            <label for="slug">Định danh</label>
                            <input type="text" name="link" readonly class="form-control" id="link" value="">
                        </div>
                        <div class="form-group">
                            <label for="page_id">Trang web</label>
                            <select name="page_id" class="form-control" id="page_id">
                                @if(!empty($pages))
                                    @foreach ($pages as $page)
                                        <option value="{{ $page->id }}">{{ $page->name }}</option>
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
    <script type="text/javascript" src="{{ asset('/js/pages/course/course_online.js') }}"></script>
@endsection

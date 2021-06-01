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
                        <h1 class="m-0 text-dark">Thêm đề thi mới</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>
        <form action="{{ url('/admin/question/store') }}" class="form-group" method="POST" enctype="multipart/form-data" id="form-add-question">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-8 float-left">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thành phần chính</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="form-group">
                            <label for="name">Tên đề thi</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Tên chuyên đề">
                            <label id="name-error" class="text-danger error" for="name"></label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung đề thi</label>
                            <textarea name="description" id="ckeditor" cols="30" rows="10"></textarea>
                            <label id="description-error" class="text-danger error" for="description"></label>
                        </div>
                        <div class="form-group">
                            <label for="type">Kiểu đề thi</label>
                            <select name="type" id="type" class="form-control">
                                <option value="0">Từ vựng</option>
                                <option value="1">Ngữ pháp</option>
                            </select>
                            <label id="type-error" class="text-danger error" for="type"></label>
                        </div>
                    </div>
                    <!-- /.card-footer-->
                    <div class="card-footer">
                        <p>+ Nội dung khóa học sẽ được cập nhật và hiển thị với mã HTML được hiển thị như một thẻ định danh. <span class="error">*</span></p>
                        <p>+ Thẻ định danh sẽ được render tự động từ tên của bài học và không được sửa để tránh trùng lặp và không khớp với bài học <span class="error">*</span></p>
                    </div>
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
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="form-group">
                            <label for="slug">Định danh</label>
                            <input type="text" name="slug" readonly class="form-control" id="slug" value="">
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
                        <div class="form-group">
                            <label for="name">Thông tin chuyên đề</label>
                            <textarea class="form-control" name="info" id="" cols="30" rows="10"></textarea>
                            <label id="info-error" class="text-danger error" for="info"></label>
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
    <script type="text/javascript" src="{{ asset('/js/pages/course/question.js') }}"></script>
@endsection

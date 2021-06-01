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
                        <h1 class="m-0 text-dark">Chỉnh sửa khoá học</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>
        <form action="{{ url('/admin/course-online/' . $courseOnline->id . '/update') }}" class="form-group" method="POST" enctype="multipart/form-data" id="form-add-course-online">
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
                            <input type="text" name="name" class="form-control" id="name" value="{{ $courseOnline->name }}">
                            <label id="name-error" class="text-danger error" for="name"></label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung khoá học</label>
                            <textarea name="description" id="ckeditor" cols="30" rows="10">{{ $courseOnline->description }}</textarea>
                            <label id="description-error" class="text-danger error" for="description"></label>
                        </div>
                    </div>
                    <!-- /.card-footer-->
                    <div class="card-footer">
                        <p>- Phần (nội dung khoá học) thì sẽ dùng để thêm nội dung của khoá học, có thể là văn bản, đường dẫn tới nhóm skype online v.v...</p>
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
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="form-group">
                            <label for="slug">Định danh</label>
                            <input type="text" name="link" readonly class="form-control" id="link" value="{{ $courseOnline->link }}">
                        </div>
                        <div class="form-group">
                            <label for="page_id">Trang web</label>
                            <select name="page_id" class="form-control" id="page_id">
                                @if(!empty($pages))
                                    @foreach ($pages as $page)
                                        <option @if($page->id === $courseOnline->page_id) selected @endif value="{{ $page->id }}">{{ $page->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style="display: block;">
                        <input type="submit" class="btn btn-primary" value="Sửa">
                    </div>
                    <!-- /.card-footer-->
                </div>
            </div>
        </form>

        <div class="col-md-12 float-left">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách các lớp của khoá học</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <table class="table table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <td></td>
                                <td>Tên lớp</td>
                                <td>Đường dẫn tĩnh</td>
                                <td>Trạng thái lớp</td>
                                <td>Thứ tự</td>
                                <td>Thao tác</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($courseOnlineSource))
                                @foreach($courseOnlineSource as $value)
                                <form action="{{ url('/admin/course-online/course-online-course/' . $value->id . '/update') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td><input type="text" name="class_name" class="form-control" value="{{ $value->class_name }}"></td>
                                    <td><input type="text" name="url_source_class" class="form-control" value="{{ $value->url_source_class }}"></td>
                                    <td>
                                        <select name="state" class="form-control" id="state">
                                            <option @if($value->state == 0) selected @endif value="0">Chưa diễn ra</option>
                                            <option @if($value->state == 1) selected @endif value="1">Đang diễn ra</option>
                                        </select>
                                    </td>
                                    <td><input type="number" name="sort" class="form-control" value="{{ $value->sort }}"></td>
                                    <td>
                                        <button type="submit" class="border-background-none"><i class="fa fa-pen"></i></button>|
                                        <a href=""><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                </form>
                                @endforeach
                            @else
                                <p class="text-danger text-center">Chưa có lớp học nào được mở.</p>
                            @endif

                            <form action="{{ url('admin/course-online/course-online-course/create/' . $courseOnline->id) }}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <tr>
                                <td></td>
                                <td><input type="text" name="class_name" class="form-control" placeholder="Tên lớp học"></td>
                                <td><input type="text" name="url_source_class" class="form-control" placeholder="Đường dẫn tĩnh"></td>
                                <td>
                                    <select name="state" class="form-control" id="state">
                                        <option value="0">Chưa diễn ra</option>
                                        <option value="1">Đang diễn ra</option>
                                    </select>
                                </td>
                                <td><input type="number" name="sort" class="form-control" placeholder="1"></td>
                                <td>
                                    <button class="border-background-none padding-top-10px"><i class="fa fa-plus-circle"></i></button>
                                </td>
                            </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="display: block;">
                    {!! $courseOnlineSource->render() !!}
                    <p>- Quản trị viên sẽ quản lý danh sách các đường dẫn tới lớp học tại bảng dữ liệu phía trên.</p>
                </div>
                <!-- /.card-footer-->
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script type="text/javascript" src="{{ asset('/js/pages/course/course_online.js') }}"></script>

    <style>
        .padding-top-10px {
            padding-top: 10px
        }
        .pagination {
            float: right;
        }
    </style>
@endsection

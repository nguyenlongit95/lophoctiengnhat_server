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
                        <h1 class="m-0 text-dark">Thêm chuyên đề mới</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>

        <div class="col-12 clear-both">
            <form action="{{ url('/admin/course-thematic/' . $course->id . '/update') }}" class="form-group" method="POST" enctype="multipart/form-data" id="form-add-course-level">
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
                                <label for="name">Tên chuyên đề</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $course->name }}">
                            </div>
                            <div class="form-group">
                                <label for="slug">Định danh</label>
                                <input type="text" name="slug" readonly class="form-control" id="slug" value="{{ $course->slug }}">
                            </div>
                            <div class="form-group">
                                <label for="page_id">Trang web</label>
                                <select name="page_id" class="form-control" id="page_id">
                                    @if(!empty($pages))
                                        @foreach ($pages as $page)
                                            <option @if($page->id === $course->page_id) selected @endif value="{{ $page->id }}">{{ $page->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nội dung chuyên đề</label>
                                <textarea name="description" id="ckeditor" cols="30" rows="10">{{ $course->description }}</textarea>
                            </div>
                        </div>
                        <!-- /.card-footer-->
                        <div class="card-footer">
                            <p>+ Nội dung chuyên đề sẽ được cập nhật và hiển thị với mã HTML được hiển thị như một thẻ định danh. <span class="error">*</span></p>
                            <p>+ Thẻ định danh sẽ được render tự động từ tên của bài học và không được sửa để tránh trùng lặp và không khớp với bài học <span class="error">*</span></p>
                            <p>+ Quản trị viên chỉ chọn 1 trong các tabs để thêm video. <span class="error">*</span></p>
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
                                <label for="name">Thông tin chuyên đề</label>
                                <textarea class="form-control" name="info" id="" cols="30" rows="10">{{ $course->info }}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer" style="display: block;">
                            <p>- Định dang là từ khoá để thao tác với dữ liệu nên không được phép thao tác ở ô nhập liệu.</p>
                            <p>- Ô lựa chọn trang web có nghĩa là nội dung bài học này thuộc trang web nào và chọn nó.</p>
                            <input type="submit" class="btn btn-primary" value="Sửa">
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>

                <div class="col-4 float-right">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Video bài học</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="group-tabs">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs text-center list-title-tabs" role="tablist">
                                        <li role="presentation">
                                            <a href="#youtube" class="active" aria-controls="youtube" role="tab" data-toggle="tab">Link video youtube</a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#driver" aria-controls="driver" role="tab" data-toggle="tab">Link video google driver</a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">Tải video lên</a>
                                        </li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <input type="hidden" name="video_link" value="{{ $course->video_link }}">
                                        <div role="tabpanel" class="tab-pane active" id="youtube">
                                            <input type="text" name="video_link_youtube" class="form-control col-8 float-left" id="video_link" value="@if($course->video_type == 0){{ $course->video_link }}@endif">
                                            <label id="video-link-error" class="text-danger error" for="video_link"></label>
                                            <div class="col-4 float-right">
                                                <video controls class="frame-show-video">
                                                    <source src="{{ $course->video_link }}">
                                                </video>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="driver">
                                            <input type="text" name="video_link_driver" class="form-control col-8 float-left" id="video_link" value="@if($course->video_type == 1){{ $course->video_link }}@endif">
                                            <label id="video-link-error" class="text-danger error" for="video_link"></label>
                                            <div class="col-4 float-right">
                                                <video controls class="frame-show-video">
                                                    <source src="{{ $course->video_link }}">
                                                </video>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="upload">
                                            <input type="file" name="video_link_upload" class="form-control col-8 float-left" id="video_link" value="@if($course->video_type == 2){{ $course->video_link }}@endif">
                                            <label id="video-link-error" class="text-danger error" for="video_link"></label>
                                            <div class="col-4 float-right">
                                                <video controls class="frame-show-video">
                                                    <source src="{{ asset('/source/videos/course_thematic/' . $course->video_link) }}">
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-12 clear-both">
            <div class="col-12 float-left clear-both">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tài nguyên bài học</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- // Phần mục từ sẽ lưu vào trường source các mục tiếp theo sẽ được parse vào 1 json và lưu vào trường info -->
                    <div class="card-body" style="display: block;">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <th>Tên bài học</th>
                                <th class="text-center">Định danh</th>
                                <th class="text-center">Thông tin</th>
                                <th>Nội Dung</th>
                                <th class="text-center wrap-nowrap-vertical-middel">Thao tác</th>
                            </thead>
                            <tbody>
                                @if (!empty($sources))
                                    @foreach($sources as $source)
                                    <form action="{{ url('/admin/course-thematic-source/' . $source->id . '/update') }}" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="course_thematic_id" value="{{ $course->id }}">
                                        <tr>
                                            <td><input type="text" onkeyup="renderSlugSource({{ $source->id }})" name="name" id="edit-name-thematic-source-{{ $source->id }}" class="form-control" value="{{ $source->name }}"></td>
                                            <td>
                                                <input type="text" name="slug" class="form-control" id="edit-slug-thematic-source-{{ $source->id }}" value="{{ $source->slug }}">
                                            </td>
                                            <td>
                                                <input type="text" onclick="_showModalEditInfo({{ $source->id }})" readonly data-toggle="modal" name="info" id="edit-info-{{ $source->id }}" class="form-control cursor-poiter" value="{{ $source->info }}" title="Kích vào đây để nhập nội dung!">
                                            </td>
                                            <td>
                                                <input type="text" onclick="_showModalEditDescription({{ $source->id }})" readonly data-toggle="modal" name="description" id="edit-description-{{ $source->id }}" class="form-control cursor-poiter" value="{{ $source->description }}" title="Kích vào đây để nhập nội dung!">
                                            </td>
                                            <td class="text-center wrap-nowrap-vertical-middel">
                                                <button type="submit" class="border-background-none"><i class="fas fa-edit" title="Chỉnh sửa nội dung cơ bản của bài học"></i></button>
                                                <a href="{{ url('/admin/course-thematic-source/render-view-word/' . $source->id . '/' . $course->id) }}"><i class="fas fa-file-word" title="Chỉnh sửa tài nguyên bài học"></i></a>
                                                <a href="{{ url('/admin/course-thematic-source/' . $source->id . '/delete') }}"><i class="fas fa-trash" title="Xoá nội dung"></i></a>
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach
                                @else
                                    <p class="text-danger">Không có tài nguyên bài học!</p>
                                @endif
                                <!-- Add new course thematic source -->
                                <form action="{{ url('/admin/course-thematic-source/store') }}" method="post" class="form-group" id="add-course-level-source-form" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="course_thematic_id" value="{{ $course->id }}">
                                    <tr>
                                        <td><input type="text" onkeyup="renderSlugSource(0)" name="name" id="add-name-thematic-source" class="form-control"></td>
                                        <td>
                                            <input type="text" name="slug" class="form-control" id="add-slug-thematic-source">
                                        </td>
                                        <td>
                                            <input type="text" onclick="_showModalAddThematicInfo()" readonly data-toggle="modal" name="info" id="add-thematic-info" class="form-control cursor-poiter" title="Kích vào đây để nhập nội dung!">
                                        </td>
                                        <td>
                                            <input type="text" onclick="_showModalAddThematicDescription()" readonly data-toggle="modal" name="description" id="add-thematic-description" class="form-control cursor-poiter" title="Kích vào đây để nhập nội dung!">
                                        </td>
                                        <td class="text-center text-vertical-middle">
                                            <button class="border-background-none" type="submit" title="Thêm mới nội dung">
                                                <i class="fas fa-plus-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" style="display: block;">
                        <p>+ Khu vực thêm, sửa xoá tài nguyên của bài học. <span class="text-danger">*</span></p>
                        <p>+ Tài nguyên của bài học ở đây thường là những file âm thanh của các từ ngữ, nội dung ý nghĩa của từ ngữ <span class="text-danger">*</span></p>
                    </div>
                    <!-- /.card-footer-->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
{{--    modal add new info--}}
    <div class="modal fade" id="info-modal-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm thông tin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea name="popup_thematic" class="form-control" id="add_popup_info" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-addOn-info" class="btn btn-primary">Cập nhật</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
{{--    modal add new description--}}
    <div class="modal fade" id="description-modal-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm nội dung</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea name="popup_thematic" class="form-control" id="add_popup_description" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-addOn-description" class="btn btn-primary">Cập nhật</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
{{--    modal edit info--}}
    <div class="modal fade" id="info-modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa thông tin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea name="popup_thematic" class="form-control" id="edit_popup_info_editor" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-editOn-info" class="btn btn-primary">Cập nhật</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    {{--    modal edit description--}}
    <div class="modal fade" id="description-modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa nội dung</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea name="popup_thematic" class="form-control" id="edit_popup_description_editor" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-editOn-description" class="btn btn-primary">Cập nhật</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script type="text/javascript" src="{{ asset('/js/pages/course/course_thematic.js') }}"></script>
    <script>
        /**
         * Function filter data add new thematic info
         *
         * @private
         */
        function _showModalAddThematicInfo () {
            $('#info-modal-add').modal('show');
            $('#btn-addOn-info').on('click', function () {
                $('#add-thematic-info').val($('#add_popup_info').val());
                $('#info-modal-add').modal('hide');
            });
        }

        /**
         * Function filter data add new thematic description
         *
         * @private
         */
        function _showModalAddThematicDescription () {
            $('#description-modal-add').modal('show');
            $('#btn-addOn-description').on('click', function () {
                $('#add-thematic-description').val($('#add_popup_description').val());
                $('#description-modal-add').modal('hide');
            });
        }

        /**
         * Function filter data edit quiz
         *
         * @param idInfo
         * @private
         */
        function _showModalEditInfo(idInfo) {
            $('#info-modal-edit').modal('show');
            $('#edit_popup_info_editor').val($('#edit-info-' + idInfo).val());
            $('#btn-editOn-info').on('click', function () {
                $('#edit-info-' + idInfo).val($('#edit_popup_info_editor').val());
                $('#info-modal-edit').modal('hide');
            });
        }

        /**
         * Function filter data edit description
         *
         * chưa làm j mới đổi tên
         * @param idDes
         * @private
         */
        function _showModalEditDescription(idDes) {
            $('#description-modal-edit').modal('show');
            $('#edit_popup_description_editor').val($('#edit-description-' + idDes).val());
            $('#btn-editOn-description').on('click', function () {
                $('#edit-description-' + idDes).val($('#edit_popup_description_editor').val());
                $('#description-modal-edit').modal('hide');
            });
        }
    </script>
@endsection

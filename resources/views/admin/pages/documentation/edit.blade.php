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
                        <h1 class="m-0 text-dark">Sửa tài liệu</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>

        <div class="col-12 clear-both">
            <form action="{{ url('/admin/documentation/' . $documentation->id . '/update') }}" class="form-group" method="POST" enctype="multipart/form-data" id="form-add-course-free">
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
                                <label for="name">Tên tài liệu</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $documentation->name }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nội dung tài liệu</label>
                                <textarea name="description" id="ckeditor" cols="30" rows="10">{{ $documentation->description }}</textarea>
                            </div>
                        </div>
                        <!-- /.card-footer-->
                        <div class="card-footer">
                            <p>+ Nội dung chuyên đề sẽ được cập nhật và hiển thị với mã HTML được hiển thị như một thẻ định danh. <span class="error">*</span></p>
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
                            </div>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="form-group">
                                <label for="slug">Định danh</label>
                                <input type="text" name="slug" readonly class="form-control" id="slug" value="{{ $documentation->slug }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Thông tin tài liệu</label>
                                <textarea class="form-control" name="info" id="info" cols="30" rows="10">{{ $documentation->info }}</textarea>
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
        </div>

        <div class="col-12 clear-both">
            <div class="col-12 float-right">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách tài nguyên</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <th>Tên tài nguyên</th>
                            <th>Định danh</th>
                            <th>Thông tin</th>
                            <th>Nội Dung</th>
                            <th>Tài nguyên</th>
                            <th>Mã giao dịch</th>
                            <th>Giá tiền (vnd)</th>
                            <th class="text-center wrap-nowrap-vertical-middel">Thao tác</th>
                            </thead>
                            <tbody>
                            @if(!empty($docResources))
                                @foreach($docResources as $docResource)
                                    <form action="{{ url('/admin/doc-resource/' . $docResource->id . '/update') }}" method="post" class="form-group" id="edit-doc-resource-form" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="doc_id" value="{{ $documentation->id }}">
                                        <tr>

                                            <td class="wrap-nowrap-vertical-middel text-center">
                                                <input type="text" onkeyup="renderSlugDocSource({{ $docResource->id }})" class="form-control" id="edit-name-doc-source-{{ $docResource->id }}" value="{{ $docResource->name }}" name="name">
                                            </td>
                                            <td class="wrap-nowrap-vertical-middel text-center">
                                                <input type="text" class="form-control" value="{{ $docResource->slug }}" id="edit-slug-doc-source" name="slug">
                                            </td>
                                            <td>
                                                <input type="text" onclick="_showModalEditInfo({{ $docResource->id }})" readonly data-toggle="modal" name="info" id="edit-info-{{ $docResource->id }}" class="form-control cursor-poiter" value="{{ $docResource->info }}" title="Kích vào đây để nhập nội dung!">
                                            </td>
                                            <td>
                                                <input type="text" onclick="_showModalEditDescription({{ $docResource->id }})" readonly data-toggle="modal" name="description" id="edit-description-{{ $docResource->id }}" class="form-control cursor-poiter" value="{{ $docResource->description }}" title="Kích vào đây để nhập nội dung!">
                                            </td>
                                            <td class="wrap-nowrap-vertical-middel text-center">
                                                <input type="file" class="hidden" value="{{ $docResource->url_source }}" id="url_source_{{ $docResource->id }}" name="url_source">
                                                <label class="cursor-poiter" for="url_source_{{ $docResource->id }}">Chọn file:
                                                <!-- Đường dẫn tới source pdf -->
                                                <span id="icon_play_vn_{{ $docResource->id }}">
                                                    <a class="width-120 height-30 margin-bottom-8" style="font-weight: normal">
                                                        {{ substr($docResource->url_source,22)  }}
                                                    </a>
                                                </span>
                                                </label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" readonly="readonly" name="code" value="{{ $docResource->code }}">
                                            </td>
                                            <td>
                                                <input type="number" name="price" class="form-control" value="{{ $docResource->price }}">
                                            </td>
                                            <td class="text-center text-vertical-middle">
                                                <button type="submit" class="border-background-none"><i class="fas fa-edit" title="Chỉnh sửa nội dung"></i></button>
                                                <a href="{{ url('/admin/doc-resource/' . $docResource->id . '/delete') }}"><i class="fas fa-trash" title="Xoá nội dung"></i></a>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                            @else
                                <p class="text-danger">Không có câu hỏi trắc nghiệm!</p>
                            @endif
                            <form action="{{ url('/admin/doc-resource/store') }}" method="post" class="form-group" id="add-doc-resource-form" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="doc_id" value="{{ $documentation->id }}">
                                <tr>
                                    <td class="wrap-nowrap-vertical-middel text-center">
                                        <input type="text" onkeyup="renderSlugDocSource(0)" class="form-control" placeholder="" id="add-name-doc-source" name="name">
                                    </td>
                                    <td class="wrap-nowrap-vertical-middel text-center">
                                        <input type="text" class="form-control" placeholder="" id="add-slug-doc-source" name="slug">
                                    </td>
                                    <td>
                                        <input type="text" onclick="_showModalAddDocResourceInfo()" readonly data-toggle="modal" name="info" id="add-doc-info" class="form-control cursor-poiter" title="Kích vào đây để nhập nội dung!">
                                    </td>
                                    <td>
                                        <input type="text" onclick="_showModalAddDocResourceDescription()" readonly data-toggle="modal" name="description" id="add-doc-description" class="form-control cursor-poiter" title="Kích vào đây để nhập nội dung!">
                                    </td>
                                    <td class="wrap-nowrap-vertical-middel text-center">
                                        <input type="file" class="hidden" id="url_source" name="url_source">
                                        <label class="cursor-poiter" for="url_source">Chọn file</label>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" readonly="readonly" name="code" value="">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="price" value="">
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
                        <p>+ Nội dung câu hỏi sẽ hiển thị trong popup khi bạn kích vào ô tương ứng của cột: (Câu hỏi) <span class="text-danger">*</span></p>
                        <p>+ Phần các đáp án sẽ hiển thị tương ứng với các đáp án: A, B, C, D tại trang người dùng<span class="text-danger">*</span></p>
                        <p>+ Cột đáp án đúng là đáp án chính xác của câu hỏi, trường này phải tương ứng với 4 cột đáp án phia trước <span class="text-danger">*</span></p>
                        <p>+ Mã giao dịch khi thêm mới hệ thống sẽ tự động sinh ra dựa trên tên tài nguyên và id của tài nguyên <span class="text-danger">*</span></p>
                    </div>
                    <!-- /.card-footer-->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
{{--    Modal thêm nội dung câu hỏi trắc nghiệm--}}
    <div class="modal fade" id="quiz-modal-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm nội dung câu hỏi trắc nghiệm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea name="popup_quiz" class="form-control" id="add_popup_quiz_editor" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-addOn-quiz" class="btn btn-primary">Cập nhật</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
{{--    Modal sửa Nội dung câu hỏi trắc nghiệm--}}
    <div class="modal fade" id="quiz-modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa Nội dung câu hỏi trắc nghiệm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea name="popup_quiz" class="form-control" id="edit_popup_quiz_editor" cols="30" rows="10"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-editOn-quiz" class="btn btn-primary">Cập nhật</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
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
                    <p>- Để có thể xuống dòng bạn hãy thêm thẻ <span class="text-danger"> "< br/ >" </span> vào phần xuống dòng</p>
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
                    <p>- Để có thể xuống dòng bạn hãy thêm thẻ <span class="text-danger"> "< br/ >" </span> vào phần xuống dòng</p>
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
                    <p>- Để có thể xuống dòng bạn hãy thêm thẻ <span class="text-danger"> "< br/ >" </span> vào phần xuống dòng</p>
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
                    <p>- Để có thể xuống dòng bạn hãy thêm thẻ <span class="text-danger"> "< br/ >" </span> vào phần xuống dòng</p>
                    <button type="button" id="btn-editOn-description" class="btn btn-primary">Cập nhật</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script type="text/javascript" src="{{ asset('/js/pages/course/documentation.js') }}"></script>
    <script>
        /**
         * Function filter data add new thematic info
         *
         * @private
         */
        function _showModalAddDocResourceInfo () {
            $('#info-modal-add').modal('show');
            $('#btn-addOn-info').on('click', function () {
                $('#add-doc-info').val($('#add_popup_info').val());
                $('#info-modal-add').modal('hide');
            });
        }

        /**
         * Function filter data add new thematic description
         *
         * @private
         */
        function _showModalAddDocResourceDescription () {
            $('#description-modal-add').modal('show');
            $('#btn-addOn-description').on('click', function () {
                $('#add-doc-description').val($('#add_popup_description').val());
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

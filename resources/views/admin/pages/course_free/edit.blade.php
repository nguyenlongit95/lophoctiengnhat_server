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
                        <h1 class="m-0 text-dark">Thêm khóa học mới</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>

        <div class="col-12 clear-both">
            <form action="{{ url('/admin/course-free/' . $course->id . '/update') }}" class="form-group" method="POST" enctype="multipart/form-data" id="form-add-course-free">
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
                                <label for="name">Tên khóa học</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $course->name }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nội dung khóa học</label>
                                <textarea name="description" id="ckeditor" cols="30" rows="10">{{ $course->description }}</textarea>
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
                                <label for="name">Thông tin khóa học</label>
                                <textarea class="form-control" name="info" id="info" cols="30" rows="10">{{ $course->info }}</textarea>
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
            <div class="col-7 float-left clear-both">
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
                                <th>Kiểu bài học</th>
                                <th class="text-center">Thông tin</th>
                                <th class="text-center">Nội Dung</th>
                                <th class="text-center wrap-nowrap-vertical-middel">Thao tác</th>
                            </thead>
                            <tbody>
                                @if (!empty($sources))
                                    @foreach($sources as $source)
                                    <form action="{{ url('/admin/course-free-source/' . $source->id . '/update') }}" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="course_free_id" value="{{ $course->id }}">
                                        <tr>
                                            <td><input type="text" name="type" id="edit-type-free-source" class="form-control" value="{{ $source->type }}"></td>
                                            <td>
                                                <input type="text" onclick="_showModalEditInfo({{ $source->id }})" readonly data-toggle="modal" name="info" id="edit-info-{{ $source->id }}" class="form-control cursor-poiter" value="{{ $source->info }}" title="Kích vào đây để nhập nội dung!">
                                            </td>
                                            <td>
                                                <input type="text" onclick="_showModalEditDescription({{ $source->id }})" readonly data-toggle="modal" name="description" id="edit-description-{{ $source->id }}" class="form-control cursor-poiter" value="{{ $source->description }}" title="Kích vào đây để nhập nội dung!">
                                            </td>
                                            <td class="text-center wrap-nowrap-vertical-middel">
                                                <button type="submit" class="border-background-none"><i class="fas fa-edit" title="Chỉnh sửa nội dung"></i></button>
                                                <a href="{{ url('/admin/course-free-source/' . $source->id . '/delete') }}"><i class="fas fa-trash" title="Xoá nội dung"></i></a>
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach
                                @else
                                    <p class="text-danger">Không có tài nguyên bài học!</p>
                                @endif
                                <!-- Add new course thematic source -->
                                <form action="{{ url('/admin/course-free-source/store') }}" method="post" class="form-group" id="add-course-level-source-form" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="course_free_id" value="{{ $course->id }}">
                                    <tr>
                                        <td><input type="text" name="type" id="add-type-free-source" class="form-control"></td>
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
            <div class="col-5 float-right">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Câu hỏi trắc nghiệm</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">

                        <table class="table table-bordered table-hover">
                            <thead>
                            <th>Câu hỏi</th>
                            <th>Đáp án 1</th>
                            <th>Đáp án 2</th>
                            <th>Đáp án 3</th>
                            <th>Đáp án 4</th>
                            <th>Đáp án đúng</th>
                            <th class="text-center wrap-nowrap-vertical-middel">Thao tác</th>
                            </thead>
                            <tbody>
                            @if(!empty($quizs))
                                @foreach($quizs as $quiz)
                                    <form action="{{ url('/admin/course-free-quiz/' . $quiz->id . '/update') }}" method="post" class="form-group" id="edit-course-free-quiz-form" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="course_free_id" value="{{ $course->id }}">
                                        <tr>
                                            <td>
                                                <input type="text" onclick="_showModalEditQuiz({{ $quiz->id }})" readonly data-toggle="modal" name="quiz" id="edit-quiz-{{ $quiz->id }}" class="form-control cursor-poiter" value="{{ $quiz->quiz }}" title="Kích vào đây để nhập câu hỏi!">
                                            </td>
                                            <td class="wrap-nowrap-vertical-middel text-center">
                                                <input type="text" class="form-control" value="{{ $quiz->answer1 }}" id="edit-quiz" name="answer1">
                                            </td>
                                            <td class="wrap-nowrap-vertical-middel text-center">
                                                <input type="text" class="form-control" value="{{ $quiz->answer2 }}" id="edit-answer-1" name="answer2">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="answer3" id="edit-answer-2" value="{{ $quiz->answer3 }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="answer4" id="edit-answer-3" value="{{ $quiz->answer4 }}">
                                            </td>
                                            <td>
                                                <select name="correct_answer" class="form-control width-70" id="edit-correct-answer">
                                                    <option @if($quiz->correct_answer === 1) selected @endif value="1">1</option>
                                                    <option @if($quiz->correct_answer === 2) selected @endif value="2">2</option>
                                                    <option @if($quiz->correct_answer === 3) selected @endif value="3">3</option>
                                                    <option @if($quiz->correct_answer === 4) selected @endif value="4">4</option>
                                                </select>
                                            </td>
                                            <td class="text-center text-vertical-middle">
                                                <button type="submit" class="border-background-none"><i class="fas fa-edit" title="Chỉnh sửa nội dung"></i></button>
                                                <a href="{{ url('/admin/course-free-quiz/' . $quiz->id . '/delete') }}"><i class="fas fa-trash" title="Xoá nội dung"></i></a>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                            @else
                                <p class="text-danger">Không có câu hỏi trắc nghiệm!</p>
                            @endif
                            <form action="{{ url('/admin/course-free-quiz/store') }}" method="post" class="form-group" id="add-course-free-quiz-form" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="course_free_id" value="{{ $course->id }}">
                                <tr>
                                    <td>
                                        <input type="text" onclick="_showModalAddQuiz(0)" readonly data-toggle="modal" name="quiz" id="add-quiz" class="form-control cursor-poiter" placeholder="" title="Kích vào đây để nhập câu hỏi!">
                                    </td>
                                    <td class="wrap-nowrap-vertical-middel text-center">
                                        <input type="text" class="form-control" placeholder="" id="add-answer1" name="answer1">
                                    </td>
                                    <td class="wrap-nowrap-vertical-middel text-center">
                                        <input type="text" class="form-control" placeholder="" id="add-answer-1" name="answer2">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="answer3" id="add-answer-2" placeholder="">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="answer4" id="add-answer-3" placeholder="">
                                    </td>
                                    <td>
                                        <select name="correct_answer" class="form-control width-70" id="add-correct-answer">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
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
                console.log('dddddddddddd');

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
                console.log('sssssssssss');
                $('#add-thematic-description').val($('#add_popup_description').val());
                $('#description-modal-add').modal('hide');
            });
        }

        /**
         * Function filter data edit quiz
         *
         * @param idQuiz
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
         * chưa làm j mới đổi tên
         * @param idQuiz
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

        /**
         * Function filter data add new quiz
         *
         * @private
         */
        function _showModalAddQuiz () {
            $('#quiz-modal-add').modal('show');
            $('#btn-addOn-quiz').on('click', function () {
                $('#add-quiz').val($('#add_popup_quiz_editor').val());
                $('#quiz-modal-add').modal('hide');
            });
        }

        /**
         * Function filter data edit quiz
         *
         * @param idQuiz
         * @private
         */
        function _showModalEditQuiz(idQuiz) {
            $('#quiz-modal-edit').modal('show');
            $('#edit_popup_quiz_editor').val($('#edit-quiz-' + idQuiz).val());
            $('#btn-editOn-quiz').on('click', function () {
                $('#edit-quiz-' + idQuiz).val($('#edit_popup_quiz_editor').val());
                $('#quiz-modal-edit').modal('hide');
            });
        }
    </script>
@endsection

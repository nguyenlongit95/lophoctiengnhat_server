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

        <div class="col-12 clear-both">
            <form action="{{ url('/admin/course-level/' . $course->id . '/update') }}" class="form-group" method="POST" enctype="multipart/form-data" id="form-add-course-level">
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
                                <label for="exampleInputEmail1">Nội dung khoá học</label>
                                <textarea name="description" id="ckeditor" cols="30" rows="10">{{ $course->description }}</textarea>
                            </div>
                        </div>
                        <!-- /.card-footer-->
                        <div class="card-footer">
                            <p>+ Nội dung khoá học sẽ được cập nhật và hiển thị với mã HTML được hiển thị như một thẻ định danh. <span class="error">*</span></p>
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
                                <label for="name">Thông tin khoá học</label>
                                <textarea class="form-control" name="info" id="" cols="30" rows="10">{{ $course->info }}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer" style="display: block;">
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
                        <div class="card-footer">
                            <p>- Quản trị viên chỉ được chọn 1 trong số các tabs trên để cập nhập videos</p>
                        </div>
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
                                <th>Mục từ</th>
                                <th class="text-center">Âm tiếng Việt</th>
                                <th class="text-center">Âm tiếng Nhật</th>
                                <th>Hán tự</th>
                                <th>Âm Hán</th>
                                <th>Ý nghĩa</th>
                                <th class="text-center wrap-nowrap-vertical-middel">Thao tác</th>
                            </thead>
                            <tbody>
                                @if (!empty($sources))
                                    @foreach($sources as $source)
                                    <form action="{{ url('/admin/course-level-source/' . $source->id . '/update') }}" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="course_level_id" value="{{ $course->id }}">
                                        <tr>
                                            <td><input type="text" name="source" class="form-control" value="{{ $source->source }}"></td>
                                            <td class="wrap-nowrap-vertical-middel text-center">
                                                <input type="file" class="hidden" value="{{ $source->sound_vn }}" id="sound_vn_{{ $source->id }}" name="sound_vn">
                                                <label class="cursor-poiter" for="sound_vn_{{ $source->id }}">Chọn file</label> |
                                                <!-- Đường dẫn tới source sound -->
                                                <span id="icon_play_vn_{{ $source->id }}">
                                                    <audio controls class="width-120 height-30 margin-bottom-8">
                                                        <source src="{{ asset($source->sound_vn) }}" type="audio/mpeg">
                                                    </audio>
                                                </span>
                                            </td>
                                            <td class="wrap-nowrap-vertical-middel text-center">
                                                <input type="file" class="hidden" value="{{ $source->sound_jp }}" id="sound_jp_{{ $source->id }}" name="sound_jp">
                                                <input type="hidden" id="path_sound_jp_{{ $source->id }}" value="{{ asset($source->sound_jp) }}">
                                                <label class="cursor-poiter" for="sound_jp_{{ $source->id }}">Chọn file</label> |
                                                <!-- Đường dẫn tới source sound -->
                                                <span id="icon_play_jp_{{ $source->id }}">
                                                     <audio controls class="width-120 height-30 margin-bottom-8">
                                                        <source src="{{ asset($source->sound_jp) }}" type="audio/mpeg">
                                                    </audio>
                                                </span>
                                            </td>
                                            <td><input type="text" name="drought" class="form-control" value="{{ $source->drought }}"></td>
                                            <td><input type="text" name="chinese" class="form-control" value="{{ $source->chinese }}"></td>
                                            <td><input type="text" name="meaning" class="form-control" value="{{ $source->meaning }}"></td>
                                            <td class="text-center wrap-nowrap-vertical-middel">
                                                <button type="submit" class="border-background-none"><i class="fas fa-edit" title="Chỉnh sửa nội dung"></i></button>
                                                <a href="{{ url('/admin/course-level-source/' . $source->id . '/delete') }}"><i class="fas fa-trash" title="Xoá nội dung"></i></a>
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach
                                @else
                                    <p class="text-danger">Không có tài nguyên bài học!</p>
                                @endif
                                <!-- Add new course level source -->
                                <form action="{{ url('/admin/course-level-source/store') }}" method="post" class="form-group" id="add-course-level-source-form" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="course_level_id" value="{{ $course->id }}">
                                    <tr>
                                        <td>
                                            <input type="text" name="source" id="form-add-source" class="form-control" placeholder="text">
                                        </td>
                                        <td class="wrap-nowrap-vertical-middel text-center">
                                            <input type="file" class="hidden" value="text" id="add-sound-vn" name="sound_vn">
                                            <label class="cursor-poiter" for="add-sound-vn">Chọn file</label>
                                        </td>
                                        <td class="wrap-nowrap-vertical-middel text-center">
                                            <input type="file" class="hidden" value="text" id="add-sound-jp" name="sound_jp">
                                            <label class="cursor-poiter" for="add-sound-jp">Chọn file</label>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="drought" id="add-drought" placeholder="text">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="chinese" id="add-chinese" placeholder="text">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="meaning" id="add-meaning" placeholder="text">
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
                                <form action="{{ url('/admin/course-level-quiz/' . $quiz->id . '/update') }}" method="post" class="form-group" id="edit-course-level-quiz-form" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="course_level_id" value="{{ $course->id }}">
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
                                                <option @if($quiz->correct_answer === 1) selected @endif value="1">A</option>
                                                <option @if($quiz->correct_answer === 2) selected @endif value="2">B</option>
                                                <option @if($quiz->correct_answer === 3) selected @endif value="3">C</option>
                                                <option @if($quiz->correct_answer === 4) selected @endif value="4">D</option>
                                            </select>
                                        </td>
                                        <td class="text-center text-vertical-middle">
                                            <button type="submit" class="border-background-none"><i class="fas fa-edit" title="Chỉnh sửa nội dung"></i></button>
                                            <a href="{{ url('/admin/course-level-quiz/' . $quiz->id . '/delete') }}"><i class="fas fa-trash" title="Xoá nội dung"></i></a>
                                        </td>
                                    </tr>
                                </form>
                                @endforeach
                            @else
                                <p class="text-danger">Không có câu hỏi trắc nghiệm!</p>
                            @endif
                            <form action="{{ url('/admin/course-level-quiz/store') }}" method="post" class="form-group" id="add-course-level-quiz-form" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="course_level_id" value="{{ $course->id }}">
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
                                            <option value="1">A</option>
                                            <option value="2">B</option>
                                            <option value="3">C</option>
                                            <option value="4">D</option>
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
@endsection

@section('custom-js')
    <script type="text/javascript" src="{{ asset('/js/pages/course/course_level.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/playAudio.js') }}"></script>
    <script>
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

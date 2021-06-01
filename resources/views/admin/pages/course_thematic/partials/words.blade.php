
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
                        <h1 class="m-0 text-dark">Danh sách các từ ngữ của bài học</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="col-12">
            @include('admin.layouts.errors')
        </div>
        <section class="content">
            <div class="col-md-12">
                <p class="text-danger" id="response-txt"></p>
                <table class="table table-bordered table-hover">
                    <thead class="">
                    <tr>
                        <th>Từ ngữ</th>
                        <th>Hán tự</th>
                        <th>Âm Hán</th>
                        <th>Ý nghĩa</th>
                        <th>Âm tiếng Việt</th>
                        <th>Âm tiếng Nhật</th>
                        <th style="width: 100px;">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($words))
                        @foreach($words as $word)
                            <form action="{{ url('/admin/course-thematic-source/word-edit/' . $word->id) }}" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <tr>
                                    <td>
                                        <input type="text" id="word-source-{{ $word->id }}" name="source" class="form-control" value="{{ $word->source }}">
                                    </td>
                                    <td>
                                        <input type="text" id="word-drought-{{ $word->id }}" name="drought" class="form-control" value="{{ $word->drought }}">
                                    </td>
                                    <td>
                                        <input type="text" id="word-chinese-{{ $word->id }}" name="chinese" class="form-control" value="{{ $word->chinese }}">
                                    </td>
                                    <td>
                                        <input type="text" id="word-meaning-{{ $word->id }}" name="meaning" class="form-control" value="{{ $word->meaning }}">
                                    </td>
                                    <td class="text-center">
                                        <input type="file" class="hidden" value="{{ $word->sound_vn }}" id="sound_vn_{{ $word->id }}" name="sound_vn">
                                        <label class="cursor-poiter" for="sound_vn_{{ $word->id }}">Chọn file</label>
                                        <!-- Đường dẫn tới source sound -->
                                        <span id="icon_play_vn_{{ $word->id }}">
                                            <audio controls class="width-120 height-30 margin-bottom-8">
                                                <source src="{{ asset($word->sound_vn) }}" type="audio/mpeg">
                                            </audio>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <input type="file" class="hidden" value="{{ $word->sound_jp }}" id="sound_jp_{{ $word->id }}" name="sound_jp">
                                        <label class="cursor-poiter" for="sound_jp_{{ $word->id }}">Chọn file</label>
                                        <!-- Đường dẫn tới source sound -->
                                        <span id="icon_play_jp_{{ $word->id }}">
                                             <audio controls class="width-120 height-30 margin-bottom-8">
                                                <source src="{{ asset($word->sound_jp) }}" type="audio/mpeg">
                                            </audio>
                                        </span>
                                    </td>
                                    <td>
                                        <button type="submit" class="border-background-none" title="Sửa nội dung từ vựng">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ url('/admin/course-thematic-source/word-delete/' . $word->id) }}" class="btn btn-"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </form>
                        @endforeach

                        <form action="{{ url('/admin/course-thematic-source/word-add/') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="course_thematic_sources_id" value="{{ $id }}">
                            <tr>
                                <td>
                                    <input type="text" id="word-source-add" name="source" class="form-control" value="">
                                </td>
                                <td>
                                    <input type="text" id="word-drought-add" name="drought" class="form-control" value="">
                                </td>
                                <td>
                                    <input type="text" id="word-chinese-add" name="chinese" class="form-control" value="">
                                </td>
                                <td>
                                    <input type="text" id="word-meaning-add" name="meaning" class="form-control" value="">
                                </td>
                                <td class="text-center">
                                    <input type="file" class="hidden" value="" id="sound_vn_add" name="sound_vn">
                                    <input type="hidden" id="path_sound_vn_add" value="">
                                    <label class="cursor-poiter" for="sound_vn_add">Chọn file</label>
                                </td>
                                <td class="text-center">
                                    <input type="file" class="hidden" value="" id="sound_jp_add" name="sound_jp">
                                    <input type="hidden" id="path_sound_jp_add" value="">
                                    <label class="cursor-poiter" for="sound_jp_add">Chọn file</label>
                                </td>
                                <td class="text-center">
                                    <button type="submit" class="border-background-none" title="Sửa nội dung từ vựng">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        </form>
                    @else
                        <p class="text-danger text-center">Chưa có tài nguyên bài học!</p>
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 float-right">
                <a href="{{ url('/admin/course-thematic/'. $courseId .'/edit') }}" class="btn btn-primary pull-right">Quay lại trang bài học</a>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('custom-js')

@endsection

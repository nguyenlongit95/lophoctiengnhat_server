@extends('frontend.master')
@section('content')

    <section class="about" id="about">
        <div id="main-content-section">
            <div class="container">
                <div class="w3ls-about-grids">
                    <div class="col-md-12 col-sm-12 about-top-text text-center">
                        <h3>{{ $course->name }}</h3>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 abt-btm-grid w3ls-ma">
                        <div id="lession-cotent" class="clearfix">
                            <!-- Description of course -->
                            <div id="description">
                                <div id="info-of-course" class="text-center font-size-13">
                                    {!! $course->info !!}
                                </div>
                                <br>
                                <!-- Video in course -->
                                <div class="text-center">
                                    {!! $course->description !!}
                                </div>
                                <div id="video-of-course-level" class="text-center">
                                    @if($course->video_type == 0)
                                    <!-- link youtube -->
                                        <video controls class="frame-show-video">
                                            <source src="{{ $course->video_link }}">
                                        </video>
                                    @elseif($course->video_type == 1)
                                    <!-- link google driver -->
                                        <video controls class="frame-show-video">
                                            <source src="{{ $course->video_link }}">
                                        </video>
                                    @else
                                    <!-- upload videos -->
                                        <video controls class="frame-show-video">
                                            <source src="{{ asset('/source/videos/course_level/' . $course->video_link) }}">
                                        </video>
                                    @endif
                                </div>
                                <!-- End video section -->
                            </div>
                            <!-- End description -->
                            <br>
                            <hr class="hr-class">
                            <br>
                            <!-- Course source -->
                            <div id="source-course" class="font-size-13">
                                <div class="group-tabs">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist" id="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#hiragana" aria-controls="hiragana" role="tab" data-toggle="tab">HỌC
                                                LÝ THUYẾT</a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#trac-nghiem" aria-controls="trac-nghiem" role="tab"
                                               data-toggle="tab">BÀI THI TRẮC NGHIỆM</a>
                                        </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="hiragana">
                                            <div class="row">
                                                @if (!empty($courseSource))
                                                    @foreach ($courseSource as $source)
                                                        <div class="col-md-4 w3_agile_gallery_grid">
                                                            <div class="agile_gallery_grid border-style-one">
                                                                <a title="{{ $source->source }}">
                                                                    <div class="agile_gallery_grid1 img-box-height-262">
                                                                        <div
                                                                            class="w3layouts_gallery_grid1_pos show-box">
                                                                            <h3>{{ $source->source }}</h3>
                                                                            <div class="left-box-source font-size-12">
                                                                                <p>Hán tự: {{ $source->drought }}</p>
                                                                                <p>Âm Hán: {{ $source->chinese }}</p>
                                                                                <p>Ý nghĩa: {{ $source->meaning }}</p>
                                                                            </div>
                                                                            <div class="right-box-source">
                                                                            <span class="play-sound"
                                                                                  id="play-sound-jp-{{ $source->id }}"
                                                                                  data-toggle="tooltip"
                                                                                  data-placement="top"
                                                                                  title="Click để nghe phiên âm tiếng Nhật"
                                                                                  onclick="playSoundJP( {{ $source->id }}, 'play' )">
                                                                                <i id="icon-play-sound-jp-{{ $source->id }}"
                                                                                   class="fa fa-play-circle"></i>
                                                                            </span>
                                                                                <br>
                                                                                <br>
                                                                                <span class="play-sound"
                                                                                      id="play-sound-vn-{{ $source->id }}"
                                                                                      data-toggle="tooltip"
                                                                                      data-placement="top"
                                                                                      title="Click để nghe phiên âm tiếng Việt"
                                                                                      onclick="playSoundVN( {{ $source->id }}, 'play')">
                                                                                <i id="icon-play-sound-vn-{{ $source->id }}"
                                                                                   class="fa fa-play-circle"></i>
                                                                            </span>
                                                                                <input type="hidden"
                                                                                       id="sound_jp_course_{{ $source->id }}"
                                                                                       value="{{ asset($source->sound_jp) }}">
                                                                                <input type="hidden"
                                                                                       id="sound_vn_course_{{ $source->id }}"
                                                                                       value="{{ asset($source->sound_vn) }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="trac-nghiem">
                                            <table class="table table-bordered table-hover">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th class="title-table-quiz">
                                                        <span class="">LUYỆN TẬP- CHỌN NGHĨA ĐÚNG (TIẾNG VIỆT)</span>
                                                        <span class="text-right float-right"><span id="number-of-answers-correct">0</span> / {{ count($courseLevelQuiz) }}</span>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(!empty($courseLevelQuiz))
                                                    <?php $i = 1; ?>
                                                    @foreach($courseLevelQuiz as $quiz)
                                                    <tr>
                                                        <td>
                                                            <div class="clearfix chanle cauhoi-wrap" id="cauhoi_{{ $quiz->id }}">
                                                                <h3>Câu hỏi số {{ $i }}: {{ $quiz->quiz }}</h3></br>
                                                                <input type="hidden" id="quiz-correct-answer-{{ $quiz->id }}" value="{{ $quiz->correct_answer }}">
                                                                <label class="customcheck col-md-3">
                                                                    <span id="answer-label-{{ $quiz->id }}-1">{{ $quiz->answer1 }}</span>
                                                                    <input type="radio" onclick="chooseYourAnswer( {{ $quiz->id }}, 1)" class="quiz_answer_{{ $quiz->id }}" id="quiz-answer-{{ $quiz->id }}-1" name="answer_{{ $quiz->id }}" value="1">
                                                                    <span class="checkmark test mark-{{ $quiz->id }}-1"></span>
                                                                </label>
                                                                <label class="customcheck col-md-3">
                                                                    <span id="answer-label-{{ $quiz->id }}-2">{{ $quiz->answer2 }}</span>
                                                                    <input type="radio" onclick="chooseYourAnswer( {{ $quiz->id }}, 2)" class="quiz_answer_{{ $quiz->id }}" id="quiz-answer-{{ $quiz->id }}-2" name="answer_{{ $quiz->id }}" value="2">
                                                                    <span class="checkmark test mark-{{ $quiz->id }}-2"></span>
                                                                </label>
                                                                <label class="customcheck col-md-3">
                                                                    <span id="answer-label-{{ $quiz->id }}-3">{{ $quiz->answer3 }}</span>
                                                                    <input type="radio" onclick="chooseYourAnswer( {{ $quiz->id }}, 3)" class="quiz_answer_{{ $quiz->id }}" id="quiz-answer-{{ $quiz->id }}-3" name="answer_{{ $quiz->id }}" value="3">
                                                                    <span class="checkmark test mark-{{ $quiz->id }}-3"></span>
                                                                </label>
                                                                <label class="customcheck col-md-3">
                                                                    <span id="answer-label-{{ $quiz->id }}-4">{{ $quiz->answer4 }}</span>
                                                                    <input type="radio" onclick="chooseYourAnswer( {{ $quiz->id }}, 4)" class="quiz_answer_{{ $quiz->id }}" id="quiz-answer-{{ $quiz->id }}-4" name="answer_{{ $quiz->id }}" value="4">
                                                                    <span class="checkmark test mark-{{ $quiz->id }}-4"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End source course -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.layouts.right_menu')
@endsection

@section('custom-js')
    <!-- JS quiz -->
    <script src="{{ asset('frontend/js/pages/course_levels/quiz.js') }}"></script>

    <!-- Local custom JS -->
    <script>
        $(document).ready(function () {
            /**
             *  Tooltip
             */
            $('[data-toggle="tooltip"]').tooltip();
        });
        var count = 3;

        /**
         * Function play sound of japanese
         *
         * @private
         */
        function playSoundJP(id, type) {
            let _sourceAudio = $('#sound_jp_course_' + id).val();
            let audio = new Audio(_sourceAudio);
            if (type === 'play') {
                audio.play();
                $('#icon-play-sound-jp-' + id).attr('class', 'fas fa-pause-circle playing-sound-' + id);
                $('#play-sound-jp-' + id).attr('onclick', 'playSoundJP(' + id + ', ' + '"pause"' + ')');
            }
            if (type === 'pause') {
                audio.pause();
                $('#icon-play-sound-jp-' + id).attr('class', 'fa fa-play-circle playing-sound-' + id);
                $('#play-sound-jp-' + id).attr('onclick', 'playSoundJP(' + id + ', ' + '"play"' + ')');
            }
            _countDown(3, id, 'jp');
        }

        /**
         * Function play sound of vietnamese
         *
         * @private
         */
        function playSoundVN(id, type) {
            let _sourceAudio = $('#sound_vn_course_' + id).val();
            let audio = new Audio(_sourceAudio);
            if (type === 'play') {
                audio.play();
                $('#icon-play-sound-vn-' + id).attr('class', 'fas fa-pause-circle playing-sound-' + id);
                $('#play-sound-vn-' + id).attr('onclick', 'playSoundVN(' + id + ', ' + '"pause"' + ')');
            }
            if (type === 'pause') {
                audio.pause();
                $('#icon-play-sound-vn-' + id).attr('class', 'fa fa-play-circle playing-sound-' + id);
                $('#play-sound-vn-' + id).attr('onclick', 'playSoundVN(' + id + ', ' + '"play"' + ')');
            }
            _countDown(3, id, 'vn');
        }

        /**
         * Function timer change icon sound
         *
         * @param count integer time countdown
         * @param id integer id of source
         * @param type string jp or vn
         */
        function _countDown(count, id, type) {
            if (count > 0) {
                count--;
                setTimeout("_countDown(" + count + ", " + id + ", '" + type + "')", 1000);
            } else {
                if (type === 'jp') {
                    $('#icon-play-sound-jp-' + id).attr('class', 'fa fa-play-circle playing-sound-' + id);
                    $('#play-sound-jp-' + id).attr('onclick', 'playSoundJP(' + id + ', ' + '"play"' + ')');
                }
                if (type === 'vn') {
                    $('#icon-play-sound-vn-' + id).attr('class', 'fa fa-play-circle playing-sound-' + id);
                    $('#play-sound-vn-' + id).attr('onclick', 'playSoundVN(' + id + ', ' + '"play"' + ')');
                }
            }
        }
    </script>

    <!-- Local style sheet -->
    <style>
        #tablist .active a {
            background: #2076b8;
            color: white;
        }

        .font-size-12 {
            font-size: 12px;
        }

        .float-right {
            float: right;
        }

        .w3layouts_gallery_grid1_pos {
            left: 10px !important;
            top: 10px !important;
            width: 95% !important;
            height: 222px;
        }

        .w3layouts_gallery_grid1_pos h3:after {
            left: 42% !important;
        }

        .left-box-source {
            width: 70%;
            float: left;
            text-align: left;
        }

        .right-box-source {
            width: 30%;
            float: right;
            text-align: right;
        }

        .play-sound {
            font-size: 28px;
            color: white;
        }

        .play-sound:hover {
            cursor: pointer;
        }

        #video-of-course-level .frame-show-video {
            width: 100%;
            max-height: 550px;
        }
    </style>
@endsection

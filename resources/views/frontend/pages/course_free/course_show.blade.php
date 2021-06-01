@extends('frontend.master')
@section('content')

    <section class="about font-medium" id="about">
        <div id="main-content-section">
            <!-- Content lession began -->
            <div id="lession-cotent" class="clearfix">
                <h1 id="arc-title">
                    <span class="dark-red">  {{ $courseFrees->name }} </span><span class="small-hide"></span>
                </h1>

                <div id="infoMsg" style="padding-right:28px; width:130px">
                    <span></span>
                    <a href="javascript:;" class="x-icon closeBox" rel="infoMsg" id="newMsgClose"></a>
                </div>

                <div id="vipLessonContent">
                    <p style="text-align: center;font-size: 15px;font-weight: Bold; color:#00BC51; padding-top: 5px; "> ↑↑↑ <span style="font-size: 16px; font-weight: Bold; color:#FF0000;background-color:#FFFF00;  width:300px;"> --- {{ $courseFrees->name }} --- </span>↑↑↑</p>
                    <p></p>
                    <table class="khung-full" style="width: 100%; font-size: 15px;" border="1">
                        <tbody>
                        <tr>
                            <td id="description-course" colspan="2">
                                {!! $courseFrees->description !!}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; padding: 5px;">Nội dung:</td>
                            <td>
                                <div class="box-word float-left">
                                    <div class="agile_gallery_grid">
                                        <!-- Tabs noi dung -->
                                        <div class="group-tabs">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                @if(!empty($courseFreeSource))
                                                    <?php $i = 1; ?>
                                                    @foreach($courseFreeSource as $course)
                                                    <li role="presentation" @if($i == 1) class="active" @endif><a href="#course_free_source_{{ $course->id }}" aria-controls="course_free_source_{{ $course->id }}" role="tab" data-toggle="tab">{{ $course->type }}</a></li>
                                                    <?php $i++; ?>
                                                    @endforeach
                                                @endif
                                            </ul>
                                            <!-- end tabs -->

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                @if(!empty($courseFreeSource))
                                                    <?php $j = 0; ?>
                                                    @foreach($courseFreeSource as $source)
                                                    <div role="tabpanel" @if($j == 0) class="tab-pane active" @else class="tab-pane" @endif id="course_free_source_{{ $source->id }}">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                {!! $source->info !!}

                                                            </div>
                                                            <div class="col-md-12 margin-top-15 margin-bottom-15">
                                                                {!! $source->description !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $j++; ?>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; padding: 5px;">
                                Trắc nghiệm <br/>
                                <span class="text-danger font-weight-bold text-number-of-answer-correct">
                                    <span id="number-of-answers-correct-course-free"> 0 </span> / 10
                                </span>
                            </td>
                            <td>
                                <div class="col-md-12 box-word float-left">
                                    <div class="agile_gallery_grid">
                                    @if(!empty($courseFreeQuiz))
                                        @foreach($courseFreeQuiz as $quiz)
                                        <div class="clearfix chanle cauhoi-wrap" id="cauhoi_{{ $quiz->id }}">
                                            <h3>Câu hỏi số 1: {{ $quiz->quiz }}</h3>
                                            </br>
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
                                        @endforeach
                                    @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End lession -->
        </div>
    </section>

    @include('frontend.layouts.right_menu')
@endsection

@section('custom-js')
    <script src="{{ asset('frontend/js/pages/course_free/quiz.js') }}"></script>
    <style>
        #arc-title {
            padding: 5px;
        }
        #description-course {
            color: #ff5560;
            font-weight: bold;
            width: 150px;
            text-align: center;
            padding-top: 5px;
        }
        .agile_gallery_grid {
            margin-top: 0px;
        }
        .nav-tabs {
            border-bottom: none;
            margin-bottom: 15px;
        }
        .nav-tabs .active a {
            background-color: #2076b8 !important;
            color: white !important;
        }
        .nav-tabs>li>a {
            border-radius: 0px !important;
        }
        .agile_gallery_grid {
            padding: 5px;
        }
        .nav-tabs>li>a {
            background: #0000000d;
            color: black;
        }
        .tab-content {
            padding-bottom: 15px;
        }

        /**
        * Custom css for label question
        */
        .customcheck {
            font-size: 14px;
        }
        .checkmark {
            height: 20px;
            width: 20px;
        }
        .customcheck .checkmark:after {
            left: 8px;
            top: 5px;
        }
        .wrong-answer::after {
            left: 4px !important;
            top: -3px !important;
        }
        .text-number-of-answer-correct {
            padding-left: 25px;
            font-weight: bold;
        }
    </style>
@endsection

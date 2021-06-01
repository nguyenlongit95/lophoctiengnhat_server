@extends('frontend.master')
@section('content')

    <section class="about font-medium" id="about">
        <div id="main-content-section">
            <!-- Content lession began -->
            <div id="lession-content" style="min-height: 420px;">
                <a id="restore" title="Chế độ bình thường" href="javascript:;" class="arc-control txt">
                    <span class="fa icon-resize-small"></span>
                </a>
                <div id="lession-cotent" class="clearfix">
                    <h1 id="arc-title"><span class="dark-red"></span><span class="small-hide"></span></h1>
                    <div id="infoMsg" style="padding-right:28px; width:130px">
                        <span></span>
                        <a href="javascript:;" class="x-icon closeBox" rel="infoMsg" id="newMsgClose"></a>
                    </div>
                    <div id="newsInner">
                        <table>
                            <tbody>
                            <tr>
                                <td><br></td>
                                @if(!empty($listPageQA))
                                    @foreach($listPageQA as $qa)
                                        <td>
                                            <p>
                                                <a class="right-link long" href="{{ url('/de-thi-online/' . $qa->slug) }}">
                                                <span class="right-link-inner" @if($qa->slug === $slug) style="background: #900;" @endif>
                                                    <span class="right-link-content">
                                                        <span class="fa icon-book"> </span>
                                                        <span class="right-txt">
                                                            <span class="right-big">{{ $qa->name }}</span>
                                                        <span class="right-small">
                                                        </span>
                                                    </span>
                                                </span>
                                                </a>
                                            </p>
                                            <p></p>
                                        </td>
                                    @endforeach
                                @endif
                            </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12 text-center" id="description-question">
                            <h4>{{ $getQuestion->name }}</h4>
                            {!! $getQuestion->description !!}
                         </div>
                        <div class="divider divider3"></div>
                        <div class="col-md-12 margin-top-15" id="box-quick-test">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                <tr>
                                    <th class="title-table-quiz">
                                        <span class="">LUYỆN TẬP- CHỌN NGHĨA ĐÚNG (TIẾNG VIỆT)</span>
                                        <span class="text-right float-right"><span id="number-of-answers-correct-question">0</span> / {{ count($detail) }}</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($detail))
                                    <?php $i = 1; ?>
                                    @foreach($detail as $quiz)
                                        <tr>
                                            <td>
                                                <div class="clearfix chanle cauhoi-wrap" id="cauhoi_{{ $quiz->id }}">
                                                    <h3>Câu hỏi số {{ $i }}: {{ $quiz->question }}</h3></br>
                                                    <input type="hidden" id="quiz-correct-answer-{{ $quiz->id }}" value="{{ $quiz->correct_answer }}">
                                                    <label class="customcheck col-md-3">
                                                        <span id="answer-label-{{ $quiz->id }}-1">{{ $quiz->answer1 }}</span>
                                                        <input type="radio" onclick="chooseYourAnswerQuestion({{ $quiz->id }}, 1)" class="quiz_answer_{{ $quiz->id }}" id="quiz-answer-{{ $quiz->id }}-1" name="answer_{{ $quiz->id }}" value="1">
                                                        <span class="checkmark test mark-{{ $quiz->id }}-1"></span>
                                                    </label>
                                                    <label class="customcheck col-md-3">
                                                        <span id="answer-label-{{ $quiz->id }}-2">{{ $quiz->answer2 }}</span>
                                                        <input type="radio" onclick="chooseYourAnswerQuestion({{ $quiz->id }}, 2)" class="quiz_answer_{{ $quiz->id }}" id="quiz-answer-{{ $quiz->id }}-2" name="answer_{{ $quiz->id }}" value="2">
                                                        <span class="checkmark test mark-{{ $quiz->id }}-2"></span>
                                                    </label>
                                                    <label class="customcheck col-md-3">
                                                        <span id="answer-label-{{ $quiz->id }}-3">{{ $quiz->answer3 }}</span>
                                                        <input type="radio" onclick="chooseYourAnswerQuestion({{ $quiz->id }}, 3)" class="quiz_answer_{{ $quiz->id }}" id="quiz-answer-{{ $quiz->id }}-3" name="answer_{{ $quiz->id }}" value="3">
                                                        <span class="checkmark test mark-{{ $quiz->id }}-3"></span>
                                                    </label>
                                                    <label class="customcheck col-md-3">
                                                        <span id="answer-label-{{ $quiz->id }}-4">{{ $quiz->answer4 }}</span>
                                                        <input type="radio" onclick="chooseYourAnswerQuestion({{ $quiz->id }}, 4)" class="quiz_answer_{{ $quiz->id }}" id="quiz-answer-{{ $quiz->id }}-4" name="answer_{{ $quiz->id }}" value="4">
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
                <!-- End lession -->
            </div>
    </section>

    @include('frontend.layouts.right_menu')
@endsection

@section('custom-js')
    <script src="{{ asset('frontend/js/pages/question/quiz.js') }}"></script>
    <style>
        #main-content-section {
            border: 1px solid #2076b8;
        }
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
        #description-question h4 {
            height: 30px;
            text-align: center;
            font-size: 18px;
            color: #aa4c4c;
            font-weight: Bold;
            margin-top: 10px;
        }
        #description-question p {
            font-size: 14px;
        }
        #box-quick-test {

        }
    </style>
@endsection

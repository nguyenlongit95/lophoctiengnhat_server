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
                    <div id="infoMsg" style=" padding-right:28px; width:130px">
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
                        <p></p>
                        <p></p>
                        <table style="width: 100%;" cellpadding="0">
                            <tbody>
                            <tr>
                                <td style="height: 30px; text-align: center; font-size: 18px; color: #aa4c4c; font-weight: Bold;">
                                    {{ $page->name }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12 text-center">
                            {!! $page->content !!}
                        </div>
                        <p></p>
                        <p></p>
                        <div class="divider divider3"></div>
                        <p></p>
                        <table style="width: 100%;" border="0">
                            <tbody>
                            <tr>
                                <td style="background-color: #fcbe91; font-size: 18px; color: #ff0000; width: 50%; height: 30px;">
                                    <strong> JLPT-文字・語彙 (Đề từ vựng)</strong><strong> </strong></td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- type == 0 => tu vung -->
                        @if(!empty($question))
                            @foreach($question as $value)
                                @if($value->type == 0)
                                <a class="right-link long btn-before-hover"
                                   href="{{ url('de-thi-online/' . $page->slug . '/' . $value->slug) }}"> <span
                                        class="right-link-inner"> <span class="right-link-content">
                                    <span class="fa fa-folder-open font-size-2-5rem"> </span>
                                    <span class="right-txt">
                                        <span class="right-big"></span>
                                        {{ $value->name }}
                                    </span>
                                </a>
                                @endif
                            @endforeach
                        @endif
                        <br>
                        <div class="divider divider3"></div>
                        <br>
                        <table style="width: 100%;">
                            <tbody>
                            <tr>
                                <td style="background-color: #fcbe91; font-size: 18px; color: #ff0000; width: 50%; height: 30px;">
                                    <strong> JLPT-文字・語彙 (Đề ngữ pháp)</strong><strong> </strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- type == 0 => tu vung -->
                        @if(!empty($question))
                            @foreach($question as $value)
                                @if($value->type == 1)
                                    <a class="right-link long btn-before-hover" href="{{ url('de-thi-online/' . $page->slug . '/' . $value->slug) }}">
                                        <span class="right-link-inner">
                                            <span class="right-link-content">
                                                <span class="fa fa-folder-open font-size-2-5rem"> </span>
                                                <span class="right-txt">
                                                    <span class="right-big"></span>
                                                    {{ $value->name }}
                                                </span>
                                            </span>
                                        </span>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                        <div class="divider divider3"></div>
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
    </style>
@endsection

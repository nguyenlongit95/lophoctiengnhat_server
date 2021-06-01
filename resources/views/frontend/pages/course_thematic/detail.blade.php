@extends('frontend.master')
@section('content')

    <section class="about font-medium" id="about">
        <div id="main-content-section">
            <div id="lession-cotent" class="clearfix">
                <h1 id="arc-title">
                    <span class="dark-red">  {{ $course->name }} </span><span class="small-hide"></span>
                </h1>

                <div id="infoMsg" style="padding-right:28px; width:130px">
                    <span></span>
                    <a href="javascript:;" class="x-icon closeBox" rel="infoMsg" id="newMsgClose"></a>
                </div>

                <div id="vipLessonContent">
                    <p style="text-align: center;font-size: 15px;font-weight: Bold; color:#00BC51;  "> ↑↑↑ <span style="font-size: 16px; font-weight: Bold; color:#FF0000;background-color:#FFFF00;  width:300px;"> --- {{ $course->name }} --- </span>↑↑↑</p>
                    <p></p>
                    <table class="khung-full" style="width: 100%; font-size: 15px;" border="1">
                        <tbody>
                        <tr>
                            <td style="color: #ff5560; font-weight: bold; width: 150px; text-align: center;" colspan="2">
                                {{ $source->description }}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Thông tin</td>
                            <td>
                                Click vào chữ để nghe phiên âm.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Nội dung:</td>
                            <td>
                                @if(!empty($words))
                                    @foreach($words as $word)
                                    <div class="box-word float-left">
                                        <div class="agile_gallery_grid">
                                            <div class="agile_gallery_grid1 img-box-height-165">
                                                <div class="w3layouts_gallery_grid1_pos show-box">
                                                    <input type="hidden" id="path-sound-word-{{ $word->id }}" value="{{ asset($word->sound_jp) }}">
                                                    <p data-toggle="tooltip" title="Click để nghe phiên âm" onclick="playWordSound({{ $word->id }})" id="word-{{ $word->id }}" class="font-size-35 txt-link-title color-white">{{ $word->source }}</p>
                                                    <p class="info-txt-link color-black">{{ $word->meaning }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.layouts.right_menu')
@endsection

@section('custom-js')
    <script>
        $(document).ready(function(){
            // Tooltip active
            $('[data-toggle="tooltip"]').tooltip();
        });

        /**
         * Function play sound using path
         *  Using audio element
         * @param idWord
         */
        function playWordSound(idWord) {
            let pathSound = $('#path-sound-word-' + idWord).val();
            let audio = new Audio(pathSound);
            audio.play();
        }
    </script>

    <style>
        a {
            text-decoration: none;
            color: #2267a7;
        }

        .clearfix {
            zoom: 1;
        }

        .clearfix:after {
            clear: both;
        }

        .clearfix:after, .clearfix:before {
            content: "";
            display: table;
        }

        #lession-cotent {
            margin: 10px;
            text-align: justify;
        }

        body, table {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            font-size: 12px;
            color: #444;
        }

        #lession-cotent h2:first-child, #lession-cotent p:first-child {
            margin-top: 0;
        }

        .khung-base, .khung-full, .khung-hoithoai, .khung-listhantu, .khungHanTu, .khungHanTu6C, .khungNote2C, .khungTuVung6C, .khunghantu_thugon, .td_ht1, .td_ht2 {
            border-width: 1px 1px 0 0;
            margin-bottom: 15px;
        }

        .khung-base, .khung-base td, .khung-full, .khung-full td, .khung-full th, .khung-hoithoai, .khung-hoithoai td, .khung-listhantu, .khung-listhantu td, .khung-ngang, .khung-ngang td, .khungHanTu, .khungHanTu td, .khungHanTu6C, .khungHanTu6C td, .khungNote2C, .khungNote2C td, .khungNote2C th, .khungTuVung6C, .khungTuVung6C td, .khunghantu_thugon, .khunghantu_thugon td, .td_ht1, .td_ht1 td, .td_ht2, .td_ht2 td, .td_ht2 th, khung2 th {
            border-color: #cbe1f2;
            border-style: solid;
        }

        .khung-base td, .khung-full td, .khung-full th, .khung-hoithoai td, .khung-listhantu td, .khungHanTu td, .khungHanTu6C td, .khungNote2C td, .khungNote2C th, .khungTuVung6C td, .khunghantu_thugon td, .td_ht1 td, .td_ht2 td, .td_ht2 th {
            border-width: 0 0 1px 1px;
            padding: 5px 10px;
            vertical-align: middle;
        }

        .khung-base, .khung-base td, .khung-full, .khung-full td, .khung-full th, .khung-hoithoai, .khung-hoithoai td, .khung-listhantu, .khung-listhantu td, .khung-ngang, .khung-ngang td, .khungHanTu, .khungHanTu td, .khungHanTu6C, .khungHanTu6C td, .khungNote2C, .khungNote2C td, .khungNote2C th, .khungTuVung6C, .khungTuVung6C td, .khunghantu_thugon, .khunghantu_thugon td, .td_ht1, .td_ht1 td, .td_ht2, .td_ht2 td, .td_ht2 th, khung2 th {
            border-color: #cbe1f2;
            border-style: solid;
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
        }

        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        /**
        * Local box word
        */
        .box-word {
            width: 150px;
            border: 2px solid floralwhite;
        }
        .w3layouts_gallery_grid1_pos {
            left: 18px !important;
        }
        .agile_gallery_grid {
            height: 170px !important;
            margin-top: 0 !important;
            background: #cbe1f2;
        }
        .w3layouts_gallery_grid1_pos a:hover {
            color: white;
        }
    </style>
@endsection

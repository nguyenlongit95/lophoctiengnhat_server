@extends('frontend.master')
@section('content')

    <section class="about font-medium" id="about">
        <div id="main-content-section">
            <div id="lession-cotent" class="clearfix">
                <h1 id="arc-title">
                    <span class="dark-red">  {{ $course->name }} - Bài 00</span><span class="small-hide"></span>
                </h1>

                <div id="infoMsg" style="padding-right:28px; width:130px">
                    <span></span>
                    <a href="javascript:;" class="x-icon closeBox" rel="infoMsg" id="newMsgClose"></a>
                </div>

                <div id="vipLessonContent">
                    <p style="text-align: center;font-size: 15px;font-weight: Bold; color:#00BC51;  "> ↑↑↑ HIỂN THỊ <span style="font-size: 16px; font-weight: Bold; color:#FF0000;background-color:#FFFF00;  width:300px;"> --- Bài 00 --- </span>↑↑↑</p>
                    <p></p>
                    <table class="khung-full" style="width: 100%; font-size: 15px;" border="0">
                        <tbody>
                        <tr>
                            <td style="color: #ff5560; font-weight: bold; width: 150px; text-align: center;" colspan="2">
                                THÔNG TIN KHÓA HỌC
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px; padding: inherit">Học phí khóa:</td>
                            <td>
                                <span style="background-color: #ffff00; color: #ff0000;"><strong>Free <br></strong></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Giới thiệu:</td>
                            <td>
                                {!! $course->description !!}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p>&nbsp;</p>
                    <table style="width: 100%; text-align: center;" border="0" cellspacing="0">
                        <tbody>
                        <tr>
                            <td><strong><span style="font-size: medium; color: #ff0000;">DANH SÁCH CÁC BÀI HỌC TRONG KHÓA</span></strong>
                            </td>
                        </tr>
                        @if(!empty($sources))
                            @foreach($sources as $source)
                            <tr>
                                <td><a class="button button3 mo-tai-cho" href="{{ url('hoc-theo-chuyen-de/' . $course->slug . '/' . $source->slug) }}"><span class="fa icon-book"></span>{{ $source->name }} - {{ $source->info }}</a></td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <p></p>
                    <p></p>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.layouts.right_menu')
@endsection

@section('custom-js')
    <style>
        .button {
            height: 28px;
            line-height: 28px;
            display: inline-block;
            padding: 0 10px;
            background: #2076b8;
            color: #fff;
        }

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
    </style>
@endsection

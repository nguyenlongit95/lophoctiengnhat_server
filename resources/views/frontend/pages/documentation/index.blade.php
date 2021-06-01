@extends('frontend.master')
@section('content')

    <section class="about font-medium" id="about">
        <div id="main-content-section">
            <div id="lession-cotent" class="clearfix">
                <h1 id="arc-title">
                    <span class="dark-red">  Tài liệu tiếng Nhật</span><span class="small-hide"></span>
                </h1>

                <div id="infoMsg" style="padding-right:28px; width:130px">
                    <span></span>
                    <a href="javascript:;" class="x-icon closeBox" rel="infoMsg" id="newMsgClose"></a>
                </div>

                <div id="vipLessonContent">
                    <p style="text-align: center;font-size: 15px;font-weight: Bold; color:#00BC51;  "> ↑↑↑ <span style="font-size: 16px; font-weight: Bold; color:#FF0000;background-color:#FFFF00;  width:300px;"> --- Danh sách tải tài liệu tiếng Nhật --- </span>↑↑↑</p>
                    <p></p>
                    <table class="khung-full" style="width: 100%; font-size: 15px;" border="0">
                        <tbody>
                        <tr>
                            <td style="color: #ff5560; font-weight: bold; width: 150px; text-align: center;" colspan="2">
                                {!! $documentations->info !!}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px"> Thông tin</td>
                            <td>
                                {!! $documentations->description !!}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100px;">Tài liệu</td>
                            <td>
                                <div class="row">
                                    @if(!empty($documentations->docResource))
                                        @foreach($documentations->docResource as $doc)
                                        <div class="col-md-4">
                                            <p>
                                                <a class="right-link long" @if(\Illuminate\Support\Facades\Auth::check()) onclick="checkPurchase({{ $doc->id }})" @else onclick="alert('Bạn hãy đăng nhập để tải tài liệu!')" @endif>
                                                <span class="right-link-inner">
                                                    <span class="right-link-content">
                                                        <span class="fa fa-file-archive font-size-30"> </span>
                                                        <span class="right-txt">
                                                            <span class="right-big">{{ $doc->name }}</span>
                                                        <span class="right-small">
                                                        </span>
                                                    </span>
                                                    <a class="absolute-right" @if(\Illuminate\Support\Facades\Auth::check()) onclick="checkPurchase({{ $doc->id }})" @else onclick="alert('Bạn hãy đăng nhập để tải tài liệu!')" @endif>
                                                        <span class="fa fa-file-download font-size-30"></span>
                                                    </a>
                                                </span>
                                                </a>
                                            </p>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p>&nbsp;</p>
                    <table style="width: 100%; text-align: center;" border="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td><a class="button button3 mo-tai-cho" href="{{ url('/tai-lieu/font-tieng-nhat') }}">Font's tiếng Nhật</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.layouts.right_menu')

    <div id="modal_purchase_doc_resource" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('/purchase') }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" value="" id="id_doc">
                <input type="hidden" name="type_doc" value="doc_resource">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Mua tài liệu</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="container">
                            <div class="col-md-2" id="title_infor_doc">
                                <p>Tên tài liệu:</p>
                                <p>File tài liệu:</p>
                                <p>Thông tin cơ bản:</p>
                                <p>Thông tin chi tiết:</p>
                                <p>Mã tài liệu:</p>
                                <p>Thành tiền:</p>
                            </div>
                            <div class="col-md-8" id="infor_doc">
                                <p id="name_doc"></p>
                                <p id="url_source_doc"></p>
                                <p id="info_doc"></p>
                                <p id="description_doc"></p>
                                <p id="code_doc"></p>
                                <p id="price_doc"></p>
                            </div>
                        </div>
                        <br><br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Mua tài liệu</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
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

        .font-size-30 {
            font-size: 30px;
        }
        .right-link-content {
            height: 50px !important;
        }
        .right-link-inner:hover {
            cursor: pointer;
        }
        #title_infor_doc p {
            text-align: left !important;
        }
        #infor_doc p {
            text-align: left !important;
        }
    </style>

    <script>
        function checkPurchase(idDoc) {
            // ajax call api check purchase
            $.ajax({
                url: "{{ url('/check-purchase') }}",
                method: 'get',
                data: {
                    idDoc: idDoc,
                    type_doc: 'doc_resource',
                },
                success: function (response) {
                    if (response.code !== 200) {
                        return null;
                    }
                    if (response.data.purchase_status === "not_purchase") {
                        $('#modal_purchase_doc_resource').modal('show');
                        // replace data to information of doc
                        $('#name_doc').text(response.data.resource.name);
                        $('#url_source_doc').text(response.data.resource.url_source);
                        $('#info_doc').text(response.data.resource.info);
                        $('#description_doc').text(response.data.resource.description);
                        $('#code_doc').text(response.data.resource.code);
                        $('#price_doc').text(response.data.resource.price);
                        $('#id_doc').val(response.data.resource.id);
                    }
                    if (response.data.purchase_status === "purchased") {
                        window.location = response.data.link_download;
                    }
                },
                error: function (err) {
                    console.log(err);
                    return null;
                }
            });
        }
    </script>
@endsection

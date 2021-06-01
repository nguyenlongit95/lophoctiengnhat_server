@extends('frontend.master')
@section('content')

    <section class="about font-medium" id="about">
        <div id="main-content-section">
            <!-- Content lession began -->
            <div id="lession-cotent" class="clearfix">
                <h1 id="arc-title"><span class="dark-red">Giới thiệu chương trình học Tiếng Nhật Free mỗi ngày</span><span class="small-hide"></span></h1>
                <br>
                <div id="newsInner">
                    <p class="font-16"><span style="font-size: large; color: #ff0000;"><strong>CHƯƠNG TRÌNH HỌC MỖI NGÀY</strong></span></p>
                    <p class="font-16"><strong><span style="color: #0000ff;">* Cách thức tham gia:</span></strong></p>
                    <p class="font-16">Học viên sẽ tham gia các lớp học free này bằng cánh click vào link trực tiếp tại menu của website.</p>
                    <p class="font-16">Bài học của ngày hôm đó sẽ hoàn toàn miễn phí cho học viên.</p>
                    <p class="font-16">Chức năng xem lại bài học của các ngày học trước trong tuần hoặc tuần trước chỉ dành cho các thành viên VIP.</p>
                    <p class="font-16">Trong một số trường hợp Sever bị quá tải, hệ thống tự động chuyển sang ưu tiên cho các học viên VIP sử dụng mà không cần báo trước.</p>
                    <p class="font-16"><strong><span style="color: #0000ff;">* Các khóa học hiện tại:</span></strong></p>
                    <table class="khung-full table-bordered table-hover" id="table-list-course-free">
                        <tbody>
                        @if(!empty($courseFrees))
                            @foreach($courseFrees as $courseFree)
                            <tr>
                                <td class="width-50-per">
                                    <p>
                                        <a class="button button3" href="{{ url('/hoc-free-moi-ngay/' . $courseFree->slug) }}">
                                            <span class="fa fa-folder-open"></span>&nbsp;&nbsp;&nbsp;{{ $courseFree->name }}
                                        </a>
                                    </p>
                                </td>
                                <td class="width-50-per">
                                    <span style="font-size: medium;"><strong>{{ $courseFree->info }}</strong></span>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <br>
                    <p><span style="font-size: 16px;"><strong><span style="color: #ff0000;">Chú ý: </span></strong></span></p>
                    <p><span style="font-size: 16px;"><strong><span style="color: #ff0000;">Không save lại, không in ra... <span style="background-color: #ffff00;">hãy để thời gian đó học thuộc</span> nó luôn nhé các bạn. </span></strong></span>
                    </p>
                    <p><span style="font-size: 16px;"><strong><span style="color: #ff0000;">Các bài được mở mỗi ngày và sẽ quay lại sau 1 khoảng thời gian để các bạn ôn.</span></strong></span>
                    </p>
                </div>
            </div>
            <!-- End lession -->
        </div>
    </section>

    @include('frontend.layouts.right_menu')
@endsection

@section('custom-js')

@endsection

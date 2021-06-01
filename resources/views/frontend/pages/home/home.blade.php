@extends('frontend.master')
@section('content')
<!--about-section-starts-here -->
<section class="about" id="about">
    <div class="container">
        <div class="w3ls-about-grids">
            <div class="col-md-12 col-sm-12 about-top-text text-center">
                <h3>CHƯƠNG TRÌNH HỌC MIỄN PHÍ MỖI NGÀY & LỚP GIÁO VIÊN</h3>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6 col-sm-6 abt-btm-grid w3ls-ma">
                <a href="{{ url('hoc-free-moi-ngay/' . $courseFreeFirst->slug) }}">
                    <img src="{{ asset('frontend/images/home/home_img_top.png') }}" class="img-responsive" alt="images"/>
                </a>
            </div>
            <div class="col-md-6 col-sm-6 abt-btm-grid w3ls-ma">
                <a href="{{ url('hoc-online-voi-gv/lop-n5-voi-giao-vien') }}">
                    <img src="{{ asset('frontend/images/home/home_img_left.png') }}" class="img-responsive" alt="images"/>
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
<!--//about-section-end-here -->
<!--services-section-starts-here -->
<section class="services jarallax" id="services">
    <div class="container">
        <h3>CHƯƠNG TRÌNH HỌC THEO CẤP ĐỘ</h3>
        <div class="service-grids">
            <div class="col-md-6 col-sm-6 wthree-left-grid">
                <?php $i = 0; ?>
                @if(!empty($courseLevels))
                    @foreach($courseLevels as $courseLevel)
                        @if($i < 3)
                        <div class="col-sm-8 col-xs-8 w3l-lt-text">
                            <h4 class="text-right color-white cursor-poiter"><a class="txt-default" href="{{ url('/hoc-theo-cap-do/' . $courseLevel->slug) }}">{{ $courseLevel->name }}</a></h4>
                            <div class="line-lt"></div>
                        </div>
                        <div class="col-sm-4 col-xs-4 service-icon text-center">
                            <i class="fa {{ $courseLevel->fa_icon }}" aria-hidden="true"></i>
                        </div>
                        <div class="clearfix"></div>
                        <?php $i++; ?>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="col-md-6 col-sm-6 wthree-right-grid">
                <?php $j = 1; ?>
                @if(!empty($courseLevels))
                    @foreach($courseLevels as $courseLevel)
                        @if($j > 3 && $j < 7)
                        <div class="col-sm-8 col-xs-8 w3l-lt-text">
                            <h4 class="text-right color-white cursor-poiter"><a class="txt-default" href="{{ url('/hoc-theo-cap-do/' . $courseLevel->slug) }}">{{ $courseLevel->name }}</a></h4>
                            <div class="line-lt"></div>
                        </div>
                        <div class="col-sm-4 col-xs-4 service-icon text-center">
                            <i class="fa {{ $courseLevel->fa_icon }}"></i>
                        </div>
                        <div class="clearfix"></div>
                        @endif
                        <?php $j++; ?>
                    @endforeach
                @endif
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>

<!--//services-section-starts-here -->
<!-- gallery -->
<div class="gallery" id="gallery">
    <div class="container">
        <h3>CHƯƠNG TRÌNH HỌC THEO CHUYÊN ĐỀ</h3>
        <div class="w3ls_gallery_grids">
            <div class="col-md-4 w3_agile_gallery_grid">
                <?php $indexCourseThematicCol1 = 0; ?>
                @if(!empty($courseThematics))
                    @foreach($courseThematics as $courseThematic)
                        @if($indexCourseThematicCol1 < 3)
                        <div class="agile_gallery_grid border-style-one">
                            <a title="{{ $courseThematic->info }}" href="{{ url('hoc-theo-chuyen-de/' .  $courseThematic->slug) }}">
                                <div class="agile_gallery_grid1 img-box-height-262">
                                    <div class="w3layouts_gallery_grid1_pos show-box">
                                        <h3>{{ substr($courseThematic->name, 0, 30) }}</h3>
                                        <p>{{ substr($courseThematic->info, 0, 60) }} ...</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endif
                        <?php $indexCourseThematicCol1++; ?>
                    @endforeach
                @endif
            </div>
            <div class="col-md-4 w3_agile_gallery_grid">
                <?php $indexCourseThematicCol2 = 0; ?>
                @if(!empty($courseThematics))
                    @foreach($courseThematics as $courseThematic)
                        @if($indexCourseThematicCol2 >= 3 && $indexCourseThematicCol2 < 6)
                            <div class="agile_gallery_grid border-style-one">
                                <a title="{{ $courseThematic->info }}" href="{{ url('hoc-theo-chuyen-de/' .  $courseThematic->slug) }}">
                                    <div class="agile_gallery_grid1 img-box-height-262">
                                        <div class="w3layouts_gallery_grid1_pos show-box">
                                            <h3>{{ substr($courseThematic->name, 0, 30) }}</h3>
                                            <p>{{ substr($courseThematic->info, 0, 60) }} ...</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        <?php $indexCourseThematicCol2++; ?>
                    @endforeach
                @endif
            </div>
            <div class="col-md-4 w3_agile_gallery_grid">
                <?php $indexCourseThematicCol3 = 0; ?>
                @if(!empty($courseThematics))
                    @foreach($courseThematics as $courseThematic)
                        @if($indexCourseThematicCol3 >= 6 && $indexCourseThematicCol3 < 9)
                            <div class="agile_gallery_grid border-style-one">
                                <a title="{{ $courseThematic->info }}" href="{{ url('hoc-theo-chuyen-de/' .  $courseThematic->slug) }}">
                                    <div class="agile_gallery_grid1 img-box-height-262">
                                        <div class="w3layouts_gallery_grid1_pos show-box">
                                            <h3>{{ substr($courseThematic->name, 0, 30) }}</h3>
                                            <p>{{ substr($courseThematic->info, 0, 60) }} ...</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        <?php $indexCourseThematicCol3++; ?>
                    @endforeach
                @endif
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- //gallery -->

<!--events-section-starts-here -->
<section class="events" id="events">
    <div class="container">
        <h3>Học Free mỗi ngày</h3>
        <div class="agile-event-grids text-center">
            <div class="event-top-grid">
                <div class="col-md-6 col-sm-6 top-left">
                    <div class="w3ls-date">
                        <h5>16</h5>
                        <h6>Jun</h6>
                    </div>
                    <div class="w3ls-text">
                        <h3><a href="{{ url('hoc-free-moi-ngay/' . $newCourseFree->slug) }}">{{ $newCourseFree->name }}</a></h3>
                        <a href="{{ url('hoc-free-moi-ngay/' . $newCourseFree->slug) }}" class="btn btn-info" role="button">Đọc thêm</a>
                        <p>{{ $newCourseFree->info }}</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="event-btm-grid">
                <div class="col-md-4 col-sm-6 w3l-event">
                    <div class="btm1-w3ls">
                        <div class="w3l-date">
                            <h5>{{ $courseFrees[0]->date_create }}</h5>
                        </div>
                        <div class="w3ls-text">
                            <h3><a href="{{ url('hoc-free-moi-ngay/' . $courseFrees[0]->slug) }}">{{ $courseFrees[0]->name }}</a></h3>
                            <a href="{{ url('hoc-free-moi-ngay/' . $courseFrees[0]->slug) }}" class="btn btn-info" role="button">Đọc thêm</a>
                            <p>{{ substr($courseFrees[0]->info, 0, 255) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 agile-w3">
                    <div class="btm2-w3ls">
                        <div class="w3l-date">
                            <h5>{{ $courseFrees[1]->date_create }}</h5>
                        </div>
                        <div class="w3ls-text">
                            <h3><a href="{{ url('hoc-free-moi-ngay/' . $courseFrees[1]->slug) }}">{{ $courseFrees[1]->name }}</a></h3>
                            <a href="{{ url('hoc-free-moi-ngay/' . $courseFrees[1]->slug) }}" class="btn btn-info" role="button">Đọc thêm</a>
                            <p>{{ substr($courseFrees[1]->info, 0, 255) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 w3ls-event">
                    <div class="btm3-w3ls">
                        <div class="w3l-date">
                            <h5>{{ $courseFrees[2]->date_create }}</h5>
                        </div>
                        <div class="w3ls-text">
                            <h3><a href="{{ url('hoc-free-moi-ngay/' . $courseFrees[2]->slug) }}">{{ $courseFrees[2]->name }}</a></h3>
                            <a href="{{ url('hoc-free-moi-ngay/' . $courseFrees[2]->slug) }}" class="btn btn-info" role="button">Đọc thêm</a>
                            <p>{{ substr($courseFrees[2]->info, 0, 255) }}</p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>
<!--//events-section-end-here -->

<!--newsletter-section-starts-here -->
<section class="newsletter">
    <div class="container">
        <div class="agile-contact-grids">
            <div class="col-sm-6 information">
                <h6> Thông tin liên hệ</h6>
                <ul class="agile-inf">
                    @if(!empty($widgets))
                        @foreach($widgets as $widget)
                            <li><i class="fa {{ $widget['fa_icon'] }}" aria-hidden="true"></i>{{ $widget['value'] }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div class="col-sm-6 agile-contact">
                <h6>Form liên hệ</h6>
                <div class="contact-form">
                    <form action="{{ url('send-contact') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" placeholder="Enter Name" name="name" required="required">
                        <input type="email" placeholder="Enter Email" name="email" required="required">
                        <input type="tel" placeholder="Enter Phone Number" name="phone" required="required">
                        <textarea name="content" placeholder="Enter Message" required="required"></textarea>
                        <input type="submit" class="btn-show-hover" value="Gửi">
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
</section>
<!--newsletter-section-end-here -->
@endsection

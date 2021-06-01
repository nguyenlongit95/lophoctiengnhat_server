@extends('frontend.master')
@section('content')

    <section class="about font-medium" id="about">
        <div id="main-content-section">

            <div id="lession-cotent" class="clearfix">
                    <div class="col-md-12 col-sm-12 about-top-text text-center">
                        <h3>{!! $page->name !!}</h3>
                        <div class="layer">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 abt-btm-grid w3ls-ma">
                        <div id="content-course" class="clearfix">
                            <!-- description of lession -->
                            <div class="row">
                                <div class="col-md-6 float-left" id="description">
                                    {!! $page->content !!}
                                </div>
                                <div class="col-md-6 float-right" id="list-course">
                                    <!-- course source begin -->
                                    <div class="row">
                                        @if(!empty($courseLevel))
                                            @foreach($courseLevel as $value)
                                                <!-- section box course -->
                                                <div class="col-md-6 float-left">
                                                    <div class="agile_gallery_grid border-style-one">
                                                        <a title="{{ $value->info }}" href="{{ url('hoc-theo-cap-do/' . $page->slug. '/' . $value->slug) }}">
                                                            <div class="agile_gallery_grid1 img-box-height-262">
                                                                <div class="w3layouts_gallery_grid1_pos show-box">
                                                                    <a href="{{ url('hoc-theo-cap-do/' . $page->slug. '/' . $value->slug) }}" class="font-size-13 txt-link-title">{{ $value->name }}</a>
                                                                    <p class="info-txt-link">{{ substr($value->info, 0, 60) }} ...</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- end section box course -->
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
        </div>
    </section>

    @include('frontend.layouts.right_menu')
@endsection

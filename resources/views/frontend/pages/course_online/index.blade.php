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
                    <div id="lession-cotent" class="clearfix">
                        {!! $page->content !!}
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frontend.layouts.right_menu')
@endsection

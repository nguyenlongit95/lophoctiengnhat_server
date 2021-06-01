<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Website học tiếng nhật</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Enlightenment Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!--// Meta tag Keywords -->
    <!-- css files -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('frontend/plugins/fontawesome/css/all.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('frontend/css/simpleLightbox.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('css/frontend/CustomStyle.css') }}" rel="stylesheet" type="text/css" media="all">
    <!-- //css files -->
    <!-- js -->
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-2.1.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap-3.1.1.min.js') }}"></script>
    <!-- //js -->

    <!-- online-fonts -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <!--// online-fonts -->
</head>
<body>

<!--header-banner-section-starts-here -->
<section class="header-banner">
    @include('frontend.layouts.menu')
    @if(isset($slider))
        @include('frontend.layouts.sliders')
    @endif
</section>
<!--//header-banner-section-end-here -->

<!-- Begin contents -->
@yield('content')
<!-- End contents -->

<!--contacts-section-end-here -->
@include('frontend.layouts.footer')

@include('frontend.partials.modalPayGate')
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="{{ asset('frontend/js/move-top.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/easing.js') }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    });
</script>
<!-- start-smoth-scrolling -->
<!-- Slide-To-Top JavaScript (No-Need-To-Change) -->
<script type="text/javascript">
    $(document).ready(function() {
        var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 100,
            easingType: 'linear'
        };
    });
</script>
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 0;"> </span></a>
<!-- //Slide-To-Top JavaScript -->
<!-- jarallax scrolling -->
<script src="{{ asset('frontend/js/jarallax.js') }}"></script>
<script src="{{ asset('frontend/js/SmoothScroll.min.js') }}"></script>
<script type="text/javascript">
    /* init Jarallax */
    $('.jarallax').jarallax({
        speed: 0.5,
        imgWidth: 1366,
        imgHeight: 768
    })
</script>
<!-- //jarallax scrolling -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" type="text/javascript"></script>
<!-- smooth scrolling -->
<script type="text/javascript">
    $(document).ready(function() {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */
        $().UItoTop({ easingType: 'easeOutQuart' });
    });

    /**
     * Function show modal pay gate and form charge
     */
    function showModalPayGates() {
        $('#paygateModal').modal('show');
    }
</script>
<!-- //smooth scrolling -->
@yield('custom-js')
</body>
</html>

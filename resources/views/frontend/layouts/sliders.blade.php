<div class="slideshow">
    <ul class="slideshow__container">
        <li class="slideshow__item"> <img src="{{ asset('frontend/images/ban1.jpg') }}" class="slideshow__image" alt="images"/></li>
        <li class="slideshow__item"><img src="{{ asset('frontend/images/ban2.jpg') }}" class="slideshow__image" alt="images"/></li>
        <li class="slideshow__item"><img src="{{ asset('frontend/images/ban3.jpg') }}" class="slideshow__image" alt="images"/></li>
    </ul>
    <div class="slideshow__back">
        <div class="slideshow__slidein">
            <div class="overlay"></div>
            <img src="{{ asset('frontend/images/ban1.jpg') }}" class="slideshow__image" alt="images"/>
            <h2 class="slideTitle">PREVIOUS SLIDE </h2>
        </div>
        <div class="slideshow__block"><img src="{{ asset('frontend/images/close.png') }}" class="close" alt="images"/></div>
        <div class="slideshow__prev">
            <svg width="32px" height="32px" viewBox="1 -1 32 32" version="1.1">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                    <g id="prevBtn" sketch:type="MSArtboardGroup" stroke="#1B2023" stroke-width="2">
                        <g id="Btn" sketch:type="MSLayerGroup" transform="translate(16.000000, 16.000000) scale(-1, 1) translate(-16.000000, -16.000000) ">
                            <path d="M16,1 L25.6,16.5428571 L16,31" class="line" stroke-linecap="round" sketch:type="MSShapeGroup"></path>
                            <circle class="circle" sketch:type="MSShapeGroup" cx="15" cy="15" r="15"></circle>
                        </g>
                    </g>
                </g>
            </svg>
        </div>
    </div>
    <div class="slideshow__forward">
        <div class="slideshow__slidein">
            <div class="overlay"></div>
            <img src="{{ asset('frontend/images/ban3.jpg') }}" class="slideshow__image" alt="images"/>
            <h2 class="slideTitle">NEXT SLIDE</h2>
        </div>
        <div class="slideshow__block"><img src="{{ asset('frontend/images/close.png') }}" class="close" alt="images"/></div>
        <div class="slideshow__next">
            <svg width="32px" height="32px" viewBox="-1 -1 32 32" version="1.1" >
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                    <g class="Btn" sketch:type="MSLayerGroup" stroke="#1B2023" stroke-width="2">
                        <path class="line" d="M16,1 L25.6,16.5428571 L16,31" class="line" stroke-linecap="round" sketch:type="MSShapeGroup">
                        </path>
                        <circle class="circle" sketch:type="MSShapeGroup" cx="15" cy="15" r="15"></circle>
                    </g>
                </g>
            </svg>
        </div>
    </div>
</div>

<div class="slider-text">
    <h3>{{ $slogan[0]->value }}</h3>
    <p>{{ $slogan[1]->value }}</p>
</div>

<div class="slider-bottom">
    <div class="agile-grids">
        <div class="col-sm-4 col-xs-4 left-grid">
            <div class="col-xs-3 w3l-lt w3ls-mk">
                <h4>{{ \Carbon\Carbon::now()->format('d') }}</h4>
                <span>{{ \Carbon\Carbon::now()->format('M') }}</span>
            </div>
            <div class="col-xs-9 w3l-lt w3ls-mku">
                <h5><a href="{{ url('hoc-online-voi-gv/lop-n5-voi-giao-vien') }}" data-toggle="modal" data-target="#myModal">Lớp Học Online</a></h5>
                <p>Trường trình học online với giáo viên mỗi ngày...</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-sm-4 col-xs-4 left-grid">
            <div class="col-xs-3 w3l-lt w3ls-mk">
                <h4>{{ \Carbon\Carbon::now()->subDay()->format('d') }}</h4>
                <span>{{ \Carbon\Carbon::now()->subMonth()->format('M') }}</span>
            </div>
            <div class="col-xs-9 w3l-lt w3ls-mku">
                <h5><a href="{{ url('hoc-theo-chuyen-de/co-ban-va-han-tu-500') }}" data-toggle="modal" data-target="#myModal"> Học theo chuyên đề</a></h5>
                <p>Học theo chuyên đề cụ thể và phù hợp...</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-sm-4 col-xs-4 left-grid">
            <div class="col-xs-3 w3l-lt w3ls-mk">
                <h4>{{ \Carbon\Carbon::now()->addDay()->format('d') }}</h4>
                <span>{{ \Carbon\Carbon::now()->addMonth()->format('M') }}</span>
            </div>
            <div class="col-xs-9 w3l-lt w3ls-mku">
                <h5><a href="{{ url('hoc-free-moi-ngay/30-phut-n3-moi-ngay') }}" data-toggle="modal" data-target="#myModal">Học Free mỗi ngày</a></h5>
                <p>Học Free mỗi ngày với giáo trình xịn...</p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<script src="{{ asset('frontend/js/TweenMax.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var imgWidth = $(".slideshow__image").width(),
            $slider = $(".slideshow__container"),
            $nextButton = $(".slideshow__next"),
            $prevButton = $(".slideshow__prev"),
            closeBlock = $(".slideshow__block"),
            slideInBlock = (".slideshow__slidein"),
            slideNext = $('.slideshow__forward').find('.slideshow__slidein'),
            slideBack = $('.slideshow__back').find('.slideshow__slidein'),
            clickCount = 0,
            clickCountImg = 1;

        $nextButton.click(function() {
            var circle = $(this).find('.circle'),
                line = $(this).find('.line'),
                block = $(this).parent().find('.slideshow__block'),
                slideIn = $(this).parent().find('.slideshow__slidein'),
                tl = new TimelineMax({
                    onComplete: tlComplete
                }),
                tl2 = new TimelineMax();

            tl.set(circle, {
                x: 15,
                y: 15,
                scale: 0
            })
                .set(slideIn, {
                    right: -350,
                    opacity: 1
                }, 0)
                .set(block, {
                    right: 270,
                    opacity: 0
                }, 0)
                .set($nextButton, {
                    zIndex: 1
                }, 0)
                .to(circle, 0.5, {
                    scale: 1,
                    transformOrigin: "50%, 50%",
                    opacity: 1
                }, 0)
                .to(circle, 0.3, {
                    opacity: 0
                })
                .to(line, 0.3, {
                    scale: 0,
                    transformOrigin: "50%, 50%"
                }, 0)
                .set(circle, {
                    scale: 0,
                    opacity: 0
                });

            function tlComplete() {
                tl2.to(slideIn, 0.5, {
                    right: 0
                })
                    .to(block, 0.5, {
                        right: 350,
                        opacity: 1
                    }, 0)
            };

            function getLineback() {
                TweenMax.to(line, 0.3, {
                    scale: 1,
                    opacity: 1,
                    delay: 0.5
                });
            };

            closeBlock.click(function() {
                tl2.reverse();
            });

            closeBlock.click(getLineback);

            $prevButton.click(function() {
                tl2.reverse();
            });

            $prevButton.click(getLineback);

        });

        $prevButton.click(function() {
            var circle = $(this).find('.circle'),
                line = $(this).find('.line'),
                block = $(this).parent().find('.slideshow__block'),
                slideIn = $(this).parent().find('.slideshow__slidein'),
                tl = new TimelineMax({
                    onComplete: tlComplete
                }),
                tl2 = new TimelineMax();

            tl.set(circle, {
                x: 15,
                y: 15,
                scale: 0
            })
                .set(slideIn, {
                    left: -350,
                    opacity: 1
                }, 0)
                .set(block, {
                    left: 270,
                    opacity: 0
                }, 0)
                .set($prevButton, {
                    zIndex: 1
                }, 0)
                .to(circle, 0.5, {
                    scale: 1,
                    transformOrigin: "50%, 50%",
                    opacity: 1
                }, 0)
                .to(circle, 0.3, {
                    opacity: 0
                })
                .to(line, 0.3, {
                    scale: 0,
                    transformOrigin: "50%, 50%"
                }, 0)
                .set(circle, {
                    scale: 0,
                    opacity: 0
                });

            function tlComplete() {
                tl2.to(slideIn, 0.3, {
                    left: 0
                })
                    .to(block, 0.3, {
                        left: 350,
                        opacity: 1
                    }, 0);
            };

            function getLineback() {
                TweenMax.to(line, 0.3, {
                    scale: 1,
                    opacity: 1,
                    delay: 0.5
                });
            };

            closeBlock.click(function() {
                tl2.reverse();
            })

            closeBlock.click(getLineback);

            $nextButton.click(function() {
                tl2.reverse();
            });

            $nextButton.click(getLineback);

        });

        slideNext.click(function() {
            clickCount++;
            clickCountImg++;

            var clickCountImgPrev = clickCountImg - 2;
            var firstImage = $('.slideshow__container li img:eq(0)'),
                imagePrev = $('.slideshow__container li img:eq(' + clickCountImgPrev + ')'),
                image = $('.slideshow__container li img:eq(' + clickCountImg + ')');

            if (clickCount > 3) {
                clickCount = 0;
            }
            if (clickCountImg > 3) {
                clickCountImg = 0;
                firstImage.clone().appendTo(slideNext);
            }

            TweenMax.to($slider, 0.5, {
                x: -clickCount * imgWidth
            })

            slideNext.children("img").remove();
            slideBack.children("img").remove();
            image.clone().appendTo(slideNext);
            imagePrev.clone().appendTo(slideBack);
            console.log(image);

            if (clickCountImg == 0) {
                firstImage.clone().appendTo(slideNext);
            }

        });

        slideBack.click(function() {
            clickCount--;
            clickCountImg--;

            var clickCountImgPrev = clickCountImg - 2,
                firstImage = $('.slideshow__container li img:eq(0)'),
                imagePrev = $('.slideshow__container li img:eq(' + clickCountImgPrev + ')'),
                image = $('.slideshow__container li img:eq(' + clickCountImg + ')');

            if (clickCount < 0) {
                clickCount = 3;
            }

            if (clickCountImg < 0) {
                clickCountImg = 3;
            }

            TweenMax.to($slider, 0.5, {
                x: -clickCount * imgWidth
            });

            slideNext.children("img").remove();
            slideBack.children("img").remove();

            imagePrev.clone().appendTo(slideBack);
            image.clone().appendTo(slideNext);

        });
    });
</script>

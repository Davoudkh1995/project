@extends('front.master.index')
@section('content')
<!--welcome-->
<div class="welcome">
    I think most <span>programmers</span> spend the first 5 years of their career mastering <span class="hue">complexity</span>,
    and the rest of their lives learning simplicity. - Buzz Andersen
</div>
<!--//welcome-->

<!-- nivo slider starts -->
<div class="slider-wrapper theme-default">
    <div class="row">
        <div class="span12">
            <div id="nslider" class="nivoSlider">
                <!-- add your images here -->
                <img src="/front/img/large/index_slider1.jpg" alt="" title="#nivocaption1" />
                <img src="/front/img/large/index_slider2.jpg" alt="" title="#nivocaption2" />
                <img src="/front/img/large/index_slider3.jpg" alt="" title="#nivocaption3" />
            </div>
            <!-- add your captions here -->
            <div id="nivocaption1" class="nivo-html-caption">We're Minx Studios</div>
            <div id="nivocaption2" class="nivo-html-caption">A Design Agency</div>
            <div id="nivocaption3" class="nivo-html-caption">We Love To Create!</div>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('.nivoSlider').nivoSlider({
                        effect: 'fade',
                        animSpeed: 500,
                        pauseTime: 3000,
                        directionNav: true,
                        controlNav: false,
                        pauseOnHover: true
                    });
                });
            </script>
        </div>
    </div>
</div>
<!-- slider ends -->
<div class="clear"></div>

<!--info boxes-->
<div class="row">
    <div class="span3">
        <div class="intro_sections">
            <a href="#">
                <div class="intro-icon-disc cont-large intro-icon rotate"><i class="icon-wrench intro-icon-large"></i></div>
                <h5><small>DESIGN</small>
                    <br><span>built for &amp; by nerds</span></h5>
                <p>Like you, we love building awesome products on the web. We love it so much, we decided to help people just like us do it easier, better, and faster.
                    Bootstrap is built for you.</p>
            </a>
        </div>
        <div class="pad15"></div>
    </div>

    <div class="span3">
        <div class="intro_sections">
            <a href="#">
                <div class="intro-icon-disc cont-large intro-icon rotate"><i class="icon-columns intro-icon-large"></i></div>
                <h5><small>CODE</small>
                    <br><span>12-column grid</span></h5>
                <p class="intro-sections">Designed to help people of all skill levels - designer or developer, huge nerd or early beginner.
                    Use it as a complete kit or use to start something more complex.</p>
            </a>
        </div>
        <div class="pad15"></div>
    </div>

    <div class="span3">
        <div class="intro_sections">
            <a href="#">
                <div class="intro-icon-disc cont-large intro-icon rotate"><i class="icon-resize-small intro-icon-large"></i></div>
                <h5><small>CREATE</small>
                    <br><span>responsive</span></h5>
                <p>With Bootstrap, we've gone fully responsive. Our components are scaled according to a range of resolutions and devices to provide a consistent
                    experience.</p>
            </a>
        </div>
        <div class="pad15"></div>
    </div>

    <div class="span3">
        <div class="intro_sections">
            <a href="#">
                <div class="intro-icon-disc cont-large intro-icon rotate"><i class="icon-book  intro-icon-large"></i></div>
                <h5><small>SUPPORT</small>
                    <br><span>growing library</span></h5>
                <p>Despite being only 7kb (gzipped), Bootstrap is one of the most complete front-end toolkits out there with dozens of fully functional components
                    ready to be put to use.</p>
            </a>
        </div>
    </div>

    <!--hero unit-->
    <div class="span12 pad15">
        <div class="hero-unit">
            <h2>Take a browse around our site and if you have any questions, feel free to <a href="#"><span>contact us</span></a>
                <a href="#" class="btn btn-inverse btn-large hero-button">get a free quote today!</a></h2>
        </div>
        <img src="/front/img/shadow3.png" class="hero-shadow" alt="" />

        <div class="pad45 hidden-phone"></div>
    </div>

    <!--//info boxes-->
    <!--slider-->
    <div class="span12">
        <div class="row">
            <div class="span4 pad10">
                <h3 class="title-divider span4"><strong>Recent</strong>  Work<span></span></h3>
                <p>Lorem ipsum dolor sit amet, rebum putant recusabo in ius, pri simul tempor ne, his ei summo virtute efficiantur.</p>
                <p>Nam ea labitur pericula. Meis tamquam pro te, cibo mutat necessitatibus id vim. An his tamquam postulant, pri id mazim nostrud diceret
                    sapientem eloquentiam sea cu, sea ut exerci delicata. Corrumpit vituperata.</p>

                <a href="#" class="btn btn-primary btn-medium">view portfolio</a>
            </div>

            <div class="span8 pad15 col_full2">

                <div id="slider_home">
                    <div class="slider-item">
                        <div class="slider-image ">
                            <a href="/front/img/large/s1.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s1.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">catalogue</a></h3>
                            <p>An his tamquam postulant, pri id mazim nostrud diceret.</p>
                            <p><a href="#"><span class="read_more">Read More &rarr;</span></a></p>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s2.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s2.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">loupe</a></h3>
                            <p>An his tamquam postulant, pri id mazim nostrud diceret.</p>
                            <p><a href="#"><span class="read_more">Read More &rarr;</span></a></p>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image" >
                            <a href="/front/img/large/s3.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s3.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">retro rocket</a></h3>
                            <p>An his tamquam postulant, pri id mazim nostrud diceret.</p>
                            <p><a href="#"><span class="read_more">Read More &rarr;</span></a></p>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s4.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s4.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">infographics</a></h3>
                            <p>An his tamquam postulant, pri id mazim nostrud diceret.</p>
                            <p><a href="#"><span class="read_more">Read More &rarr;</span></a></p>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s5.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s5.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">mock up</a></h3>
                            <p>An his tamquam postulant, pri id mazim nostrud diceret.</p>
                            <p><a href="#"><span class="read_more">Read More &rarr;</span></a></p>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s6.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s6.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">retro badges</a></h3>
                            <p>An his tamquam postulant, pri id mazim nostrud diceret.</p>
                            <p><a href="#"><span class="read_more">Read More &rarr;</span></a></p>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s7.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s7.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">details</a></h3>
                            <p>An his tamquam postulant, pri id mazim nostrud diceret.</p>
                            <p><a href="#"><span class="read_more">Read More &rarr;</span></a></p>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s8.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s8.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">vintage form</a></h3>
                            <p>An his tamquam postulant, pri id mazim nostrud diceret.</p>
                            <p><a href="#"><span class="read_more">Read More &rarr;</span></a></p>
                        </div>
                    </div>
                </div>
                <div id="sl-prev" class="widget-scroll-prev"><i class="icon-caret-left grey"></i></div>
                <div id="sl-next" class="widget-scroll-next"><i class="icon-caret-right  grey"></i></div>
                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        var portfolioCarousel = $("#slider_home");
                        portfolioCarousel.carouFredSel({
                            width : "100%",
                            height : "auto",
                            circular : false,
                            responsive : true,
                            infinite : false,
                            auto : false,
                            items : {
                                width : 231,
                                visible: {
                                    min: 1,
                                    max: 3
                                }
                            },
                            mousewheel: true,
                            swipe: {
                                onMouse: true,
                                onTouch: true
                            },
                            prev : {
                                button : "#sl-prev",
                                key : "left"
                            },
                            next : {
                                button : "#sl-next",
                                key : "right"
                            },
                            onCreate : function () {
                                $(window).on('resize', function(){
                                    portfolioCarousel.parent().add(portfolioCarousel).css('height', portfolioCarousel.children().first().outerHeight() + 'px');
                                }).trigger('resize');
                            }
                        });
                    });
                </script>
            </div>
        </div>
        <div class="pad25"></div>
    </div>
</div>
    @endsection

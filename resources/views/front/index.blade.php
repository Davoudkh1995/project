@extends('front.master.index')
@section('content')
    <!--welcome-->
    <div class="welcome text-right">
        یه جمله زیبایی در جهان وجود داره که میگه : بیشتر <span class="hue">برنامه نویسان</span> در پنج سال اول سخت تلاش میکنن و دوران حرفه ای شدنشون خیلی <span class="hue">پیچیده</span> است ولی مابقی عمرشون رو به سادگی یاد میگیرن<span> &#1748; </span>
    </div>
    <!--//welcome-->

    <!-- nivo slider starts -->
    <div class="slider-wrapper theme-default">
        <div class="row">
            <div class="span12">
                <div id="nslider" class="nivoSlider">
                    <!-- add your images here -->
                    @foreach($sliders as $key=>$slider)
                        <img src="{{$slider->picture}}" alt="{{$slider->title}}" title="#title_{{$key}}" />
                        @endforeach
                </div>
                <!-- add your captions here -->
                @foreach($sliders as $key=>$slider)
                    <div id="title_{{$key}}" class="nivo-html-caption">{{$slider->title}}</div>
                @endforeach
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.nivoSlider').nivoSlider({
                            effect: 'random',
                            animSpeed: 1000,
                            pauseTime: 3000,
                            directionNav: true,
                            controlNav: true,
                            pauseOnHover: false,
                            manualAdvance: false
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
                    <h5><small> طراحی و دیزاین</small>
                        <br><span>بر اساس نیاز شما</span></h5>
                    <p>نرم افزار ها و سایت های مورد نیاز شما با بروزترین امکانات تعبیه و طراحی میشوند <span> &#1748; </span></p>
                </a>
            </div>
            <div class="pad15"></div>
        </div>

        <div class="span3">
            <div class="intro_sections">
                <a href="#">
                    <div class="intro-icon-disc cont-large intro-icon rotate"><i class="icon-columns intro-icon-large"></i></div>
                    <h5><small>تکنولوژی</small>
                        <br><span>بروزترین ها</span></h5>
                    <p class="intro-sections">استفاده از جدیدترین تکنولوژی ها براساس نوع و ساختار پروژه شما</p>
                </a>
            </div>
            <div class="pad15"></div>
        </div>

        <div class="span3">
            <div class="intro_sections">
                <a href="#">
                    <div class="intro-icon-disc cont-large intro-icon rotate"><i class="icon-resize-small intro-icon-large"></i></div>
                    <h5><small>حمایت</small>
                        <br><span>حقوق مشتری</span></h5>
                    <p>برای انجام پروژه با شما قراردادی بسته میشه که از سلامت روند کاری اطمینان حاصل کنید</p>
                </a>
            </div>
            <div class="pad15"></div>
        </div>

        <div class="span3">
            <div class="intro_sections">
                <a href="#">
                    <div class="intro-icon-disc cont-large intro-icon rotate"><i class="icon-book  intro-icon-large"></i></div>
                    <h5><small>پشتیبانی</small>
                        <br><span>18 ساعته</span></h5>
                    <p>در زمانی که پشتیبانی سایت و نرم افزار شما در اختیار تیم رونیکا باشه تا 18 ساعت در روز پاسخگوی شما هستیم</p>
                </a>
            </div>
        </div>

        <!--hero unit-->
        <div class="span12 pad15">
            <div class="hero-unit">
                <h2>
                    <a href="/contact_us" class="btn btn-inverse btn-large hero-button">تماس با ما !</a>
                     در صورتی که نیاز به مشاوره داشتید میتونید دکمه تماس با ما رو لمس کنید یا از طریق چت آنلاین اقدام کنید .
                </h2>
            </div>
            <img src="/front/img/shadow3.png" class="hero-shadow" alt="طراحی سایت و نرم افزار گروه رونیکا" />

            <div class="pad45 hidden-phone"></div>
        </div>

        <!--//info boxes-->
        <!--slider-->
        <div class="span12">
            <div class="row">
                <div class="span4 pad10">
                    <h3 class="title-divider span4"><strong>آخرین</strong>  پروژه ها<span></span></h3>
                    <p class="text-right">به سایت خودتون خوش اومدید ما در این قسمت نمونه کارهای خودمون رو معرفی میکنیم</p>
                    <p class="text-right">تعدادی از نمونه کارها در باکس سمت راست قابل مشاهده است برای دیدن همه نمونه کارها دکمه مورد نظر را لمس کنید<span> &#1748; </span></p>

                    <a href="#" class="btn btn-primary btn-medium">نمایش نمونه کار</a>
                </div>

                <div class="span8 pad15 col_full2">

                    <div id="slider_home">

                        @foreach($portfolios as $portfolio)
                            <div class="slider-item">
                                <div class="slider-image ">
                                    <a href="{{$portfolio->picture['main']}}" data-rel="prettyPhoto"><img src="{{$portfolio->picture['main']}}" class="height153" alt="{{$portfolio->title}}"/></a>
                                </div>
                                <div class="slider-title">
                                    <h3 class="text-right"><a href="/portfolio/{{$portfolio->slug}}">{{$portfolio->title}}</a></h3>
                                    <p class="text-right">{!! Illuminate\Support\Str::limit($portfolio->title,50) !!}</p>
                                    <p><a href="/portfolio/{{$portfolio->slug}}"><span class="read_more">مطالعه بیشتر &rarr;</span></a></p>
                                </div>
                            </div>
                        @endforeach
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

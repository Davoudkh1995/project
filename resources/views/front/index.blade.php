@extends('front.master.index')
@section('content')
    <!--welcome-->
    <div class="welcome @if(app()->getLocale() == "fa") text-right @endif">
        {{__('messages.firstPhrase')}}<span> &#1748; </span>
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
                <a href="javascript:void(0)">
                    <div class="intro-icon-disc cont-large intro-icon rotate"><i class="icon-wrench intro-icon-large"></i></div>
                    <h5><small>{{__('messages.property.index.design.title')}}</small>
                        <br><span>{{__('messages.property.index.design.subTitle')}}</span></h5>
                    <p>{{__('messages.property.index.design.description')}}<span> &#1748; </span></p>
                </a>
            </div>
            <div class="pad15"></div>
        </div>

        <div class="span3">
            <div class="intro_sections">
                <a href="javascript:void(0)">
                    <div class="intro-icon-disc cont-large intro-icon rotate"><i class="icon-columns intro-icon-large"></i></div>
                    <h5><small>{{__('messages.property.index.technology.title')}}</small>
                        <br><span>{{__('messages.property.index.technology.subTitle')}}</span></h5>
                    <p class="intro-sections">{{__('messages.property.index.technology.description')}}</p>
                </a>
            </div>
            <div class="pad15"></div>
        </div>

        <div class="span3">
            <div class="intro_sections">
                <a href="javascript:void(0)">
                    <div class="intro-icon-disc cont-large intro-icon rotate"><i class="icon-resize-small intro-icon-large"></i></div>
                    <h5><small>{{__('messages.property.index.protection.title')}}</small>
                        <br><span>{{__('messages.property.index.protection.subTitle')}}</span></h5>
                    <p>{{__('messages.property.index.protection.description')}}</p>
                </a>
            </div>
            <div class="pad15"></div>
        </div>

        <div class="span3">
            <div class="intro_sections">
                <a href="javascript:void(0)">
                    <div class="intro-icon-disc cont-large intro-icon rotate"><i class="icon-book  intro-icon-large"></i></div>
                    <h5><small>{{__('messages.property.index.support.title')}}</small>
                        <br><span>{{__('messages.property.index.support.subTitle')}}</span></h5>
                    <p>{{__('messages.property.index.support.description')}}</p>
                </a>
            </div>
        </div>

        <!--hero unit-->
        <div class="span12 pad15">
            <div class="hero-unit">
                <h2>
                    <a href="/{{app()->getLocale()}}/contact_us" class="btn btn-inverse btn-large hero-button mr4">{{__('messages.contact_us.button')}}</a>
                    {{__('messages.contact_us.content')}}
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
                    <h3 class="title-divider span4"><strong>{{__('messages.latestPortfolios.title')}}</strong><span></span></h3>
                    <p class="@if(app()->getLocale() == "fa") text-right @endif">{{__('messages.latestPortfolios.content')}}</p>
                    <a href="/{{app()->getLocale()}}/portfolio" class="btn btn-primary btn-medium">{{__('messages.latestPortfolios.button')}}</a>
                </div>

                <div class="span8 pad15 col_full2">

                    <div id="slider_home">

                        @foreach($portfolios as $portfolio)
                            <div class="slider-item">
                                <div class="slider-image ">
                                    <a href="/{{$portfolio->picture['main']}}" data-rel="prettyPhoto"><img src="{{$portfolio->picture['main']}}" class="height153" alt="{{$portfolio->title}}"/></a>
                                </div>
                                <div class="slider-title">
                                    <h3 class="@if(app()->getLocale() == "fa") text-right @endif"><a href="/{{app()->getLocale()}}/portfolio/{{$portfolio->slug}}">{{$portfolio->title}}</a></h3>
                                    <p class="@if(app()->getLocale() == "fa") text-right @endif">{!! Illuminate\Support\Str::limit($portfolio->title,50) !!}</p>
                                    <p><a href="/{{app()->getLocale()}}/portfolio/{{$portfolio->slug}}"><span class="read_more">{{__('messages.details')}} &rarr;</span></a></p>
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

@extends('front.master.index')
@section('content')
    <div class="breadcrumbs"><a href="/">{{__('messages.home')}}</a> <i class="@if(app()->getLocale() == "fa") icon-double-angle-left @else icon-double-angle-right @endif"></i>{{__('messages.portfolios.detail.title')}}</div>
    <div class="inner_content">
        <h1 class="title">{{__('messages.portfolios.detail.title')}}</h1>
        <h2>{{$portfolio->title}}</h2>

        <div class="pad30"></div>
        <div class="row">
            <div class="span4">

                <h5><span>{{__('messages.portfolios.detail.description')}}</span></h5>
                <p class="lead @if(app()->getLocale() == "fa") text-right @endif">{!! $portfolio->content !!}</p>

                <h6 class=" @if(app()->getLocale() == "fa") text-right @endif"><span>{{__('messages.portfolios.detail.tags')}} : </span></h6>
                <ul class="icons  @if(app()->getLocale() == "fa") rtl @endif">
                    @foreach($portfolio->tags as $tag)
                        <li><i class=" @if(app()->getLocale() == "fa") icon-arrow-left @else icon-arrow-right @endif black"></i>{{$tag}}</li>
                        @endforeach
{{--                    <li><i class="icon-globe black"></i> طراحی وب</li>--}}
{{--                    <li><i class=" icon-pencil black"></i> گرافیک دیزاین</li>--}}
{{--                    <li><i class=" icon-laptop black"></i> هاستینگ وب</li>--}}
                </ul>

                <div class="pad25"></div>

            </div>

            <div class="span8 pad15">
                <!-- slider starts -->
                <div id="nslider" class="nivoSlider">
                    <!-- add your images here -->
                    <img src="{{json_decode($portfolio->picture)->main}}" alt="" title="#nivocaption0" />
                    @foreach($portfolioImages as $key=>$image)
                        <img src="{{$image->picture}}" alt="" title="#nivocaption{{$key+1}}" />
                        @endforeach
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.nivoSlider').nivoSlider({
                            effect: 'random',
                            animSpeed: 500,
                            pauseTime: 5000,
                            directionNav: true,
                            controlNav: true,
                            pauseOnHover: false,
                            manualAdvance: true
                        });
                    });
                </script>
                <div class="pad45"></div>
            </div>

            <div class="span12 pad45">

                <div class="col_full">
                    <h3 class="title-divider span12"><strong>{{__('messages.portfolios.detail.related_portfolios')}}</strong><span></span></h3>
                    <div id="slider_related">

                        @foreach($relatedPortfolios as $relatedPortfolio)
                            <div class="slider-item">
                                <div class="slider-image">
                                    <div class="hover_img">
                                        <img src="{{json_decode($relatedPortfolio->picture)->others[0]}}" alt="{{$relatedPortfolio->title}}"/>
                                        <span class="portfolio_zoom"><a href="{{json_decode($relatedPortfolio->picture)->others[0]}}" data-rel="prettyPhoto[portfolio1]"></a></span>
                                        <span class="portfolio_link"><a href="/portfolio/{{$relatedPortfolio->slug}}">{{$relatedPortfolio->title}}</a></span>
                                    </div>
                                </div>
                            </div>

                            @endforeach

                        {{--<div class="slider-item">
                            <div class="slider-image">
                                <div class="hover_img">
                                    <img src="/front/img/small/s1.jpg" alt=""/>
                                    <span class="portfolio_zoom"><a href="/front/img/large/s1.jpg" data-rel="prettyPhoto[portfolio1]"></a></span>
                                    <span class="portfolio_link"><a href="single_portfolio.html">View item</a></span>
                                </div>
                            </div>
                        </div>

                        <div class="slider-item">
                            <div class="slider-image">
                                <div class="hover_img">
                                    <img src="/front/img/small/s2.jpg" alt="" />
                                    <span class="portfolio_zoom"><a href="/front/img/large/s2.jpg" data-rel="prettyPhoto[portfolio1]"></a></span>
                                    <span class="portfolio_link"><a href="single_portfolio.html">View item</a></span>
                                </div>
                            </div>
                        </div>

                        <div class="slider-item">
                            <div class="slider-image">
                                <div class="hover_img">
                                    <img src="/front/img/small/s3.jpg" alt="" />
                                    <span class="portfolio_zoom"><a href="/front/img/large/s3.jpg" data-rel="prettyPhoto[portfolio1]"></a></span>
                                    <span class="portfolio_link"><a href="single_portfolio.html">View item</a></span>
                                </div>
                            </div>
                        </div>

                        <div class="slider-item">
                            <div class="slider-image">
                                <div class="hover_img">
                                    <img src="/front/img/small/s4.jpg" alt="" />
                                    <span class="portfolio_zoom"><a href="/front/img/large/s4.jpg" data-rel="prettyPhoto[portfolio1]"></a></span>
                                    <span class="portfolio_link"><a href="single_portfolio.html">View item</a></span>
                                </div>
                            </div>
                        </div>

                        <div class="slider-item">
                            <div class="slider-image">
                                <div class="hover_img">
                                    <img src="/front/img/small/s5.jpg" alt="" />
                                    <span class="portfolio_zoom"><a href="/front/img/large/s5.jpg" data-rel="prettyPhoto[portfolio1]"></a></span>
                                    <span class="portfolio_link"><a href="single_portfolio.html">View item</a></span>
                                </div>
                            </div>
                        </div>

                        <div class="slider-item">
                            <div class="slider-image">
                                <div class="hover_img">
                                    <img src="/front/img/small/s6.jpg" alt="" />
                                    <span class="portfolio_zoom"><a href="/front/img/large/s6.jpg" data-rel="prettyPhoto[portfolio1]"></a></span>
                                    <span class="portfolio_link"><a href="single_portfolio.html">View item</a></span>
                                </div>
                            </div>
                        </div>

                        <div class="slider-item">
                            <div class="slider-image">
                                <div class="hover_img">
                                    <img src="/front/img/small/s7.jpg" alt="" />
                                    <span class="portfolio_zoom"><a href="/front/img/large/s7.jpg" data-rel="prettyPhoto[portfolio1]"></a></span>
                                    <span class="portfolio_link"><a href="single_portfolio.html">View item</a></span>
                                </div>
                            </div>
                        </div>

                        <div class="slider-item">
                            <div class="slider-image">
                                <div class="hover_img">
                                    <img src="/front/img/small/s8.jpg" alt="" />
                                    <span class="portfolio_zoom"><a href="/front/img/large/s8.jpg" data-rel="prettyPhoto[portfolio1]"></a></span>
                                    <span class="portfolio_link"><a href="single_portfolio.html">View item</a></span>
                                </div>
                            </div>
                        </div>--}}

                    </div>
                    <div id="sl-prev3" class="widget-scroll-prev3"><i class=" icon-caret-left grey"></i></div>
                    <div id="sl-next3" class="widget-scroll-next3"><i class=" icon-caret-right grey"></i></div>
                    <script type="text/javascript">
                        jQuery(document).ready(function($) {
                            var portfolioCarousel = $("#slider_related");
                            portfolioCarousel.carouFredSel({
                                width : "100%",
                                height : "auto",
                                circular : false,
                                responsive : true,
                                infinite : false,
                                auto : false,
                                items : {
                                    width : 230,
                                    visible: {
                                        min: 1,
                                        max:5                                        }
                                },
                                mousewheel: true,
                                swipe: { onMouse: true, onTouch: true },
                                prev : {
                                    button : "#sl-prev3",
                                    key : "left"
                                },
                                next : {
                                    button : "#sl-next3",
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
        </div>
    </div>
     <!--//page-->
    @endsection

@extends('front.master.index')
{{--@section('title') @if(app()->getLocale() == "fa") {{'مقالات رونیکا'}} @else {{"Ronica's Articles"}} @endif @endsection--}}
{{--@section('description') {{$article->seo->description}} @endsection--}}
{{--@section('keywords') {{$article->seo->keywords}} @endsection--}}
{{--@section('canonical') {{$article->seo->canonical}} @endsection--}}
@section('content')
    <div class="breadcrumbs"><a href="/{{app()->getLocale()}}">{{__('messages.home')}}</a> <i class="@if(app()->getLocale() == "fa") icon-double-angle-left @else icon-double-angle-right @endif"></i>{{__('messages.portfolio')}}</div>

    <div class="inner_content rtl">
        <h1 class="title">{{__('messages.portfolios.archive.title')}}</h1>
        <h1>{{__('messages.portfolios.archive.subTitle')}}</h1>

        <div class="pad30"></div>
        <div id="options">
            <ul id="filters" class="option-set" data-option-key="filter">
                <li><a href="#filter" data-option-value="*" class=" selected">@if(app()->getLocale() == "fa")  همه @else All @endif</a></li>
                @foreach($categories as $category)
                    <li><a href="#filter" data-option-value=".category{{$category->id}}">{{$category->title}}</a></li>
                    @endforeach
{{--                <li><a href="#filter" data-option-value=".category01">Category 01</a></li>--}}
{{--                <li><a href="#filter" data-option-value=".category02">Category 02</a></li>--}}
{{--                <li><a href="#filter" data-option-value=".category03">Category 03</a></li>--}}
            </ul>
            <div class="clear"></div>
        </div>
        <!-- portfolio_block -->
        <div class="row">
            <div class="projects">
                @foreach($categories as $category)
                    @if(count($category->portfolios))
                    @foreach($category->portfolios as $portfolio)
                        <div class="span3 element category{{$category->id}}" data-category="category{{$category->id}}" @if(app()->getLocale() == "fa") dir="rtl" @endif>
                            <div class="hover_img">
                                <img src="{{json_decode($portfolio->picture)->others[0]}}" alt="{{$portfolio->title}}" class="height250 width100"/>
                                <span class="portfolio_zoom"><a href="{{json_decode($portfolio->picture)->others[0]}}" data-rel="prettyPhoto[portfolio1]"></a></span>
                                <span class="portfolio_link"><a href="{{'/'.app()->getLocale()}}/portfolio/{{$portfolio->slug}}">مشاهده</a></span>
                            </div>
                            <div class="item_description">
                                <a href="{{'/'.app()->getLocale()}}/portfolio/{{$portfolio->slug}}" class="@if(app()->getLocale() == "fa") text-right @endif"><span>{{$portfolio->title}}</span></a><br/>
                                {!! \Illuminate\Support\Str::limit($portfolio->content,50) !!}
                            </div>
                        </div>
                        @endforeach
                    @endif
                    @endforeach
                <div class="clear"></div>
            </div>
            <!-- //portfolio_block -->
        </div>
    </div>
    <!--//page-->
    <script type="text/javascript">
        $(window).load(function(){
            $('.projects').isotope({
            });
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $('div.element').hide();
        });
        var i = 0;//initialize
        var int=0;
        $(window).bind("load", function() {
            var int = setInterval("doThis(i)",100);
            // fade in speed in milliseconds
        });
        function doThis() {
            var imgs = $('div.element').length;
            if (i >= imgs) {
                clearInterval(int);
            }
            $('div.element:hidden').eq(0).fadeIn(100);
            i++;//add 1 to the count
        }
    </script>
@endsection

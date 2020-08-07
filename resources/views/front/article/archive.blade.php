@extends('front.master.index')
@section('content')
    <div class="breadcrumbs"><a href="/">خانه</a> <i class="icon-double-angle-right"></i> مقالات رونیکا</div>

    <div class="inner_content">
        <h2 class="title">مقالات رونیکا - بروز و و مناسب برای مشتاقان وب</h2>
        <h3>در این بخش شما مقالات رو مشاهده میکنید امیدواریم با مطالعه مقالات به اطلاعاتتون افزوده بشه.</h3>
        <div class="pad30"></div>
        <div class="row">
            <div class="span9">
                @foreach($articles as $article)
                <div class="post">
                    <div class="row">
                        <div class="span9">
                            <div class="date-post">
{{--                                <span class="day hue">{{$article->date}}</span>--}}
                                <span class="month">{{$article->date}}</span>
                            </div>

                            <a href="{{json_decode($article->picture)->main}}" data-rel="prettyPhoto">
                                <img src="{{json_decode($article->picture)->main}}" alt="{{$article->title}}"></a>

                            <h2 class="title-divider span9 post_link pad15"><a href="/article/{{$article->slug}}"><strong>{{$article->title}}</strong></a><span></span></h2>

                            <div class="clear"></div>


                            <div class="post-meta">
                                <ul>
                                    <li>نوشته شده توسط {{$article->user}} <span class="muted">/</span></li>
                                    <li><i class="icon-calendar normal muted"></i> {{$article->date}} /</li>
                                    <li><i class="icon-bullhorn normal muted"></i>
                                        {{$article->tags}}
{{--                                        <a href="">web</a>, <a href="">art</a>--}}
                                        /</li>
                                    <li><i class="icon-comment-alt muted"></i><a href="">16 comments</a></li>
                                </ul>
                            </div>
                            <!--end meta-->

                            <p class="text-right">{!! \Illuminate\Support\Str::limit($article->content,300) !!}</p>

                            <p><a href="/article/{{$article->tags}}" class="more-link">مطالعه بیشتر &rarr;</a></p>
                        </div>
                    </div>
                </div>
                @endforeach
                    {{ $articles->links("pagination::default") }}
            </div>
            <!--sidebar-->
            <div class="span3 rtl">
                <!--search-->
                <form action="/art_search/" method="post" id="searchItem">
                    @csrf
                <div class="input-append">
                    <input class="span2" type="text" placeholder="جستجو" name="slug">
                    <span class="add-on">
				<a onclick="searchItem()"><i class="icon-search"></i></a>
				</span>
                </div>
                </form>
                <script>
                    function searchItem() {
                       $('#searchItem').submit();
                    }
                </script>

                <div class="pad15 "></div>
                <h6 class="title-divider span3"><strong>فضای</strong>  مجازی<span></span></h6>
                <p>شما میتوانید مقالات را در فضای مجازی منتشر کنید.</p>
                <p>
                    <a href="#" class="zocial icon twitter"></a>
                    <a href="#" class="zocial icon facebook"></a>
                    <a href="#" class="zocial icon rss"></a>
                    <a href="#" class="zocial icon dribbble"></a>
                    <a href="#" class="zocial icon pinterest"></a>
                    <a href="#" class="zocial icon linkedin"></a>
                </p>

                <div class="pad15"></div>

                <h6 class="title-divider span3"><strong>دسته بندی</strong> مقالات<span></span></h6>
                <div class="clear"></div>
                <ul class="icons ">
                    @foreach($categories as $category)
                        <li><i class=" icon-caret-left"></i><a class="categ" href="/category_archive/{{$category->slug}}">{{$category->title}}</a></li>
                        @endforeach
                </ul>

                <div class="pad30"></div>
                <h6 class="title-divider span3"><strong>Video</strong>  Widget<span></span></h6>
                <div class="clear"></div>
                <!--video-->
                <div class="vendor">
                    <iframe src="http://player.vimeo.com/video/33136052?title=0&amp;byline=0&amp;portrait=0"></iframe>
                </div>

                <div class="pad30"></div>
                <div class="tabbable tabs-top">
                    <ul id="myTab" class="nav nav-tabs">
{{--                        <li><a href="#tab3" data-toggle="tab">برچسب</a></li>--}}
                        <li class="active"><a href="#tab1" data-toggle="tab">اخیر</a></li>
                        <li><a href="#tab2" data-toggle="tab">معروف</a></li>
                        <li><a href="#tab3" data-toggle="tab">برچسب</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">

                        <div class="tab-pane fade in active" id="tab1">
                            <ul class="media-list">
                                @foreach($latestArticles as $latestArticle)
                                    <li class="media">
                                        <img class=" pull-left" src="{{json_decode($latestArticle->picture)->others[1]}}" alt="{{$latestArticle->title}}" width="40" height="40"/>
                                        <div class="media-body">
                                            <small>{{$latestArticle->date}}</small><br>
                                            <a href="/article/{{$latestArticle->slug}}">{{$latestArticle->title}}</a></div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>

                        <div class="tab-pane fade" id="tab2">
                            <ul class="media-list">
                                @foreach($popularArticles as $popularArticle)
                                    <li class="media">
                                        <img class=" pull-left" src="{{json_decode($popularArticle->picture)->others[1]}}" alt="{{$popularArticle->title}}" width="60" height="60"/>
                                        <div class="media-body">
                                            <small>{{$popularArticle->date}}</small><br>
                                            <a href="/article/{{$popularArticle->slug}}">{{$popularArticle->title}}</a></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-pane fade" id="tab3">
                            <p>
                                @if(isset($tags))
                                    @foreach($tags as $tag)
                                        <a href="#" class="btn btn-small btn-inverse marg-bottom5">{{$tag}}</a>
                                        @endforeach
                                    @endif
                                {{--<a href="#" class="btn btn-small btn-inverse marg-bottom5">design</a>
                                <a href="#" class="btn btn-small btn-inverse marg-bottom5">art</a>
                                <a href="#" class="btn btn-small btn-inverse marg-bottom5">web</a>
                                <a href="#" class="btn btn-small btn-inverse  marg-bottom5">photoshop</a>
                                <a href="#" class="btn btn-small btn-inverse marg-bottom5">news</a>
                                <a href="#" class="btn btn-small btn-inverse marg-bottom5">themes</a></p>--}}
                        </div>

                    </div>
                    <div class="pad45"></div>
                </div>
            </div>
        </div>
    </div>
    @endsection

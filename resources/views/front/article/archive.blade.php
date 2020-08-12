@extends('front.master.index')
@section('content')
    <div class="breadcrumbs"><a href="/">{{__('messages.home')}}</a> <i
                class="@if(app()->getLocale() == "fa") icon-double-angle-left @else icon-double-angle-right @endif"></i>{{__('messages.article_page.archive.title')}}
    </div>

    <div class="inner_content">
        <h2 class="title">{{__('messages.article_page.archive.subTitle')}}</h2>
        <h3>{{__('messages.article_page.archive.description')}}</h3>
        <div class="pad30"></div>
        <div class="row">
            <div class="span9">
                @foreach($articles as $article)
                    <div class="post">
                        <div class="row">
                            <div class="span9">
                                <div class="date-post">
                                    {{--                                <span class="day hue">{{$article->date}}</span>--}}
                                    <span class="month">@if(app()->getLocale() == "fa") {{$article->date}} @else {{substr($article->created_at,0,9)}} @endif</span>
                                </div>

                                <a href="{{json_decode($article->picture)->main}}" data-rel="prettyPhoto">
                                    <img src="{{json_decode($article->picture)->main}}" alt="{{$article->title}}"></a>

                                <h2 class="title-divider span9 post_link pad15"><a
                                            href="/article/{{$article->slug}}"><strong>{{$article->title}}</strong></a><span></span>
                                </h2>

                                <div class="clear"></div>


                                <div class="post-meta">
                                    <ul>
                                        <li>({{__('messages.article_page.archive.authorText')}} {{$article->user}})
                                            <span class="muted">*/*</span></li>
                                        <li><i class="icon-calendar normal muted"></i> @if(app()->getLocale() == "fa")
                                                ({{$article->date}}
                                                ) @else {{'('.substr($article->created_at,0,9).')'}} @endif */*
                                        </li>
                                        <li><i class="icon-bullhorn normal muted"></i>
                                            ({{$article->tags}})
                                            {{--                                        <a href="">web</a>, <a href="">art</a>--}}
                                            */*
                                        </li>
                                        <li><i class="icon-comment-alt muted"></i><a
                                                    href="javascript:void(0)">{{$article->message_count}} comments</a>
                                        </li>
                                    </ul>
                                </div>
                                <!--end meta-->

                                <p class="text-right">{!! \Illuminate\Support\Str::limit($article->content,300) !!}</p>

                                <p><a href="/article/{{$article->tags}}"
                                      class="more-link">{{__('messages.more')}} &rarr;</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $articles->links("pagination::default") }}
            </div>
            <!--sidebar-->
            <div class="span3 @if(app()->getLocale() == "fa") rtl @else ltr @endif">
                <!--search-->
                <form action="/art_search/" method="post" id="searchItem">
                    @csrf
                    <div class="input-append">
                        @if(app()->getLocale() == "fa")
                            <input class="span2" type="text" placeholder="{{__('messages.search')}}" name="slug">
                            <span class="add-on"><a onclick="searchItem()" class="pointer"><i class="icon-search"></i></a></span>
                        @else
                                    <input class="span2" type="text" placeholder="{{__('messages.search').'...'}}"
                                           name="slug">
                                    <span class="add-on"><a onclick="searchItem()" class="pointer"><i class="icon-search"></i></a></span>
                            @endif


                    </div>
                </form>
                <script>
                    function searchItem() {
                        $('#searchItem').submit();
                    }
                </script>

                <div class="pad15 "></div>
                <h6 class="title-divider span3">
                    <strong>{{__('messages.article_page.archive.socialmedia.title')}}</strong><span></span></h6>
                <p>{{__('messages.article_page.archive.socialmedia.text')}}</p>
                <p>
                    <a href="#" class="zocial icon twitter"></a>
                    <a href="#" class="zocial icon facebook"></a>
                    <a href="#" class="zocial icon rss"></a>
                    <a href="#" class="zocial icon dribbble"></a>
                    <a href="#" class="zocial icon pinterest"></a>
                    <a href="#" class="zocial icon linkedin"></a>
                </p>

                <div class="pad15"></div>

                <h6 class="title-divider span3"><strong>{{__('messages.article_page.archive.articles')}}</strong>
                    <span></span></h6>
                <div class="clear"></div>
                <ul class="icons ">
                    @foreach($categories as $category)
                        <li><i class=" icon-caret-left"></i><a class="categ"
                                                               href="/category_archive/{{$category->slug}}">{{$category->title}}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="pad30"></div>
                <h6 class="title-divider span3"><strong>{{__('messages.article_page.archive.video_widget')}}</strong> <span></span></h6>
                <div class="clear"></div>
                <!--video-->
                <div class="vendor">
                    <iframe src="http://player.vimeo.com/video/33136052?title=0&amp;byline=0&amp;portrait=0"></iframe>
                </div>

                <div class="pad30"></div>
                <div class="tabbable tabs-top">
                    <ul id="myTab" class="nav nav-tabs">
                        {{--                        <li><a href="#tab3" data-toggle="tab">برچسب</a></li>--}}
                        <li class="active"><a href="#tab1" data-toggle="tab">{{__('messages.article_page.archive.latest')}}</a></li>
                        <li><a href="#tab2" data-toggle="tab">{{__('messages.article_page.archive.popular')}}</a></li>
                        <li><a href="#tab3" data-toggle="tab">{{__('messages.article_page.archive.tags')}}</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">

                        <div class="tab-pane fade in active" id="tab1">
                            <ul class="media-list">
                                @foreach($latestArticles as $latestArticle)
                                    <li class="media">
                                        <img class=" pull-left"
                                             src="{{json_decode($latestArticle->picture)->others[1]}}"
                                             alt="{{$latestArticle->title}}" width="40" height="40"/>
                                        <div class="media-body">
                                            <small>@if(app()->getLocale() == "fa") {{$latestArticle->date}} @else {{substr($latestArticle->created_at,0,9)}} @endif</small>
                                            <br>
                                            <a href="/article/{{$latestArticle->slug}}">{{$latestArticle->title}}</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>

                        <div class="tab-pane fade" id="tab2">
                            <ul class="media-list">
                                @foreach($popularArticles as $popularArticle)
                                    <li class="media">
                                        <img class=" pull-left"
                                             src="{{json_decode($popularArticle->picture)->others[1]}}"
                                             alt="{{$popularArticle->title}}" width="60" height="60"/>
                                        <div class="media-body">
                                            <small>@if(app()->getLocale() == "fa") {{$popularArticle->date}} @else {{substr($popularArticle->created_at,0,9)}} @endif</small>
                                            <br>
                                            <a href="/article/{{$popularArticle->slug}}">{{$popularArticle->title}}</a>
                                        </div>
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

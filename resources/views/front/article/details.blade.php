@extends('front.master.index')
@section('content')
    <div class="breadcrumbs"><a href="/{{app()->getLocale()}}">{{__('messages.home')}}</a> <i class="@if(app()->getLocale() == "fa") icon-double-angle-left @else icon-double-angle-right @endif"></i>{{__('messages.article_page.detail.title')}}</div>

    <div class="inner_content">
        <h1 class="title">{{__('messages.article_page.detail.title')}}</h1>
        <h1>{{$article->title}}</h1>
        <div class="pad30"></div>
        <div class="row">
            <div class="span9 @if(app()->getLocale() == "fa") fRight @else fLeft @endif">
                <div class="post">

                    <div class="row">
                        <div class="span9">
                            <div class="date-post">
                                @if(app()->getLocale() == "fa") {{$article->date}} @else {{substr($article->created_at,0,9)}} @endif<span class="month"></span>
                            </div>

                            <a href="{{json_decode($article->picture)->main}}" data-rel="prettyPhoto">
                                <img src="{{json_decode($article->picture)->main}}" alt="{{$article->title}}"></a>

                            <h2 class="title-divider span9 post_link pad15">
                                <a href="javascript:void(0)"><strong>{{$article->title}}</strong></a><span></span></h2>
                            <div class="clear"></div>

                            <div class="post-meta">
                                <ul>
                                    <li>({{__('messages.article_page.detail.authorText')}} {{$article->user}}) <span class="muted">*/*</span></li>
                                    <li><i class="icon-calendar normal muted"></i> @if(app()->getLocale() == "fa") ({{$article->date}}) @else {{'('.substr($article->created_at,0,9).')'}} @endif  */*</li>
                                    <li><i class="icon-bullhorn normal muted"></i>
                                        ({{$article->tags}})
                                        {{--                                        <a href="">web</a>, <a href="">art</a>--}}
                                        */*</li>
                                    <li><i class="icon-comment-alt muted"></i><a href="javascript:void(0)">{{$article->message_count}} comments</a></li>
                                </ul>
                            </div><!--end meta-->

                            <p>{!! $article->content !!}</p>

                            {{--<blockquote>"What has happened?" said the curate, standing up beside me. "Heaven knows!" said I.
                                A bat flickered by and vanished.  A distant tumult of shouting began and ceased.  I looked again at the Martian, and saw he was now moving eastward
                                along the riverbank.</blockquote>

                            <p>Every moment I expected the fire of some hidden battery to spring upon him; but the evening calm was unbroken. The figure of the Martian grew smaller as
                                he receded, and presently the mist and the gathering night had swallowed him up. By a common impulse we clambered higher. Towards Sunbury was a dark appearance,
                                as though a conical hill had suddenly come into being there, hiding our view of the farther country; and then, remoter across the river, over Walton, we saw another
                                such summit. These hill-like forms grew lower and broader even as we stared.</p>

                            <h5><a href="">Available To Download From ThemeForest</a> &raquo;</h5>

                            <p class="pad15"><a href="#" class="btn btn-inverse">preview</a> <a href="#" class="btn btn-inverse">download</a></p>--}}
                        </div>
                    </div>
                </div>
                <!--end post-->

                <!--author box-->
                <div class="well">
                    <img src="/front/img/small/author.jpg" class="pull-right drop2 pad_author" alt="" />
                    <h5>About The Author</h5>
                    <p>Every moment I expected the fire of some hidden battery to spring upon him; but the evening calm was unbroken. The figure of the Martian grew smaller as
                        he receded, and presently the mist and the gathering.</p>

                    <p>
                        <a href="#" data-rel="tooltip" data-placement="top" title="Twitter">Twitter</a> <i class="icon-star-empty grey "></i>
                        <a href="#" data-rel="tooltip" data-placement="top" title="Facebook">Facebook</a> <i class="icon-star-empty grey"></i>
                        <a href="#" data-rel="tooltip" data-placement="top" title="Rss">Rss</a> <i class="icon-star-empty grey "></i>
                        <a href="#" data-rel="tooltip" data-placement="top" title="Dribbble">Dribbble</a> <i class="icon-star-empty grey "></i>
                        <a href="#" data-rel="tooltip" data-placement="top" title="Pinterest">Pinterest</a> <i class="icon-star-empty grey"></i>
                        <a href="#" data-rel="tooltip" data-placement="top" title="Linkedin">Linkedin</a>
                    </p>
                </div>

                <div class="pad5"></div>
                <!--prev/next-->
                <hr>
                &larr; @if($beforeBool)<a href="/{{app()->getLocale()}}/beforeArticle/{{$beforeSlug}}" class="pointer">{{__('messages.article_page.detail.beforeArticle')}}</a> @else <a disabled="" class="pointer" >{{__('messages.article_page.detail.beforeArticle')}}</a> @endif :: @if($afterBool) <a href="/{{app()->getLocale()}}/afterArticle/{{$afterSlug}}" class="pointer">{{__('messages.article_page.detail.afterArticle')}} </a> @else <a disabled="" class="pointer">{{__('messages.article_page.detail.afterArticle')}} </a>@endif &rarr;
                <hr>
                <div class="pad5"></div>

                <!-- Comments -->
                <h6><span>{{count($messages)}} {{__('messages.article_page.detail.comment')}}</span></h6>
                <!--Comment 1-->
                @if(count($messages))
                    @foreach($messages as $message)
                <div class="media">
                    <a class=" @if(app()->getLocale() == "fa") pull-right @endif " href="javascript:void(0)">
                        <img src="/front/img/image/customer1.png" alt="" class="avatar img-circle" width="40" height="40"/></a>
                    <div class="media-body @if(app()->getLocale() == "fa") rtl @endif ">
                        <p class="media-heading">
                            <a href="javascript:void(0)">{{$message->customer}}</a> &raquo; {{$message->date}}</p>
                       {{$message->content}}
                        <!--Comment 2-->
                        @if(isset($message->admin))
                            <div class="media">
                            <a class=" @if(app()->getLocale() == "fa") pull-right @endif " href="javascript:void(0)">
                                <img src="/front/img/image/user.png" alt="" class="avatar img-circle" width="50" height="40"/></a>
                            <div class="media-body">
                                <p class="media-heading">
                                    <a href="javascript:void(0)">{{__('messages.article_page.detail.contact.admin')}}( {{$message->admin}} )</a></p>
                                <p>
                                    {{$message->answer}}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                    <hr/>
                <!-- //Comments -->
                    @endforeach
                @endif

                <div class="pad25"></div>

                <div class="pad25"></div>
                <div class="span7 @if(app()->getLocale() == "en") fLeft @endif ">
                    <div class="row">
                        <!-- Comment form -->
                        <h3>{{__('messages.article_page.detail.contact.title')}}</h3>
                        <div class="contact_form well">
                            <form action="/{{app()->getLocale()}}/message" method="post">
                                @csrf
                                <input type="hidden" name="comment" value="{{password_hash(1,PASSWORD_BCRYPT)}}">
                                <input type="hidden" name="article_id" value="{{$article->id}}">
                                <p class="form_info">{{__('messages.article_page.detail.contact.name')}} <span class="required">*</span></p>
                                <input class="span5" type="text" name="name" value="" />
                                <p class="form_info">{{__('messages.article_page.detail.contact.email')}} <span class="required">*</span></p>
                                <input class="span5" type="text" name="email" value=""  />

                                <p class="form_info">{{__('messages.article_page.detail.contact.message')}}</p>
                                <textarea name="content" id="message" class="span6" ></textarea>
                                <div class="clear"></div>

                                <input type="submit" class="btn btn-large btn-inverse btn-form" value="{{__('messages.article_page.detail.contact.send')}}" />
                                <input type="reset"  class="btn btn-large btn-inverse btn-form" value="{{__('messages.article_page.detail.contact.clear')}}" />
                                <div class="clear"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                            @if(session('error'))
                    var error = "{{session('error')}}";
                    Swal.fire({
                        icon: 'error',
                        title: "{{__('messages.article_page.detail.errorAlert')}}",
                        text: "{{__('messages.article_page.detail.error')}}",
                    });
                            @elseif(session('message'))
                    var message = "{{session('message')}}";
                    Swal.fire({
                        icon: 'success',
                        title: "{{__('messages.article_page.detail.successAlert')}}",
                        text: "{{__('messages.article_page.detail.success')}}",
                    });
                    @endif
                </script>
            </div>
            <!--sidebar-->
            <div class="span3  @if(app()->getLocale() == "fa") rtl @endif">
                <!--search-->
                <form action="/{{app()->getLocale()}}/art_search/" method="post" id="searchItem">
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
                    <strong>{{__('messages.article_page.detail.socialmedia.title')}}</strong><span></span></h6>
                <p>{{__('messages.article_page.detail.socialmedia.text')}}</p>
                <p>
                    <a href="http://twitter.com/share?url={{Request::url()}}&text=Simple Share Buttons&hashtags=simplesharebuttons" class="zocial icon twitter"></a>
                    <a href="http://www.facebook.com/sharer.php?u={{Request::url()}}" class="zocial icon facebook"></a>
                    <a href="#" class="zocial icon rss"></a>
                    <a href="#" class="zocial icon dribbble"></a>
                    <a href="#" class="zocial icon pinterest"></a>
                    <a href="http://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}" target="_blank" class="zocial icon linkedin"></a>
                </p>

                <div class="pad15"></div>

                <h6 class="title-divider span3"><strong>{{__('messages.article_page.archive.articles')}}</strong>
                    <span></span></h6>
                <div class="clear"></div>
                <ul class="icons ">
                    @foreach($categories as $category)
                        <li><i class=" icon-caret-left"></i><a class="categ" href="/{{app()->getLocale()}}/category_archive/{{$category->slug}}">{{$category->title}}</a></li>
                    @endforeach
                </ul>

                <div class="pad30"></div>
                <h6 class="title-divider span3"><strong>{{__('messages.article_page.detail.video_widget')}}</strong> <span></span></h6>
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
                                            <a href="/{{app()->getLocale()}}/article/{{$latestArticle->slug}}">{{$latestArticle->title}}</a>
                                        </div>
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
                                            <small>@if(app()->getLocale() == "fa") ({{$popularArticle->date}}) @else {{'('.substr($popularArticle->created_at,0,9).')'}} @endif</small><br>
                                            <a href="/{{app()->getLocale()}}/article/{{$popularArticle->slug}}">{{$popularArticle->title}}</a></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-pane fade" id="tab3">
                            <p>
                                @if(isset($tags))
                                    @foreach($tags as $tag)
                                        <a href="javascript:void(0)" class="btn btn-small btn-inverse marg-bottom5">{{$tag}}</a>
                            @endforeach
                            @endif
                        </div>

                    </div>
                    <div class="pad45"></div>
                </div>
            </div>
        </div>
    </div>

    @endsection

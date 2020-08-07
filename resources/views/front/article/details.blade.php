@extends('front.master.index')
@section('content')
    <div class="breadcrumbs"><a href="/">خانه</a> <i class="icon-double-angle-left"></i> {{$article->title}}</div>

    <div class="inner_content">
        <h1 class="title">مقالات رونیکا</h1>
        <h1>{{$article->title}}</h1>
        <div class="pad30"></div>
        <div class="row">
            <div class="span9 fRight">
                <div class="post">

                    <div class="row">
                        <div class="span9">
                            <div class="date-post">
                                <span class="day hue">{{$article->date}}</span><span class="month"></span>
                            </div>

                            <a href="{{json_decode($article->picture)->main}}" data-rel="prettyPhoto">
                                <img src="{{json_decode($article->picture)->main}}" alt="{{$article->title}}"></a>

                            <h2 class="title-divider span9 post_link pad15">
                                <a href="javascript:void(0)"><strong>{{$article->title}}</strong></a><span></span></h2>
                            <div class="clear"></div>

                            <div class="post-meta">
                                <ul>
                                    <li> نوشته شده توسط {{$article->user}} <span class="muted">/</span></li>
                                    <li><i class="icon-calendar normal muted"></i> {{$article->date}} /</li>
                                    <li><i class="icon-bullhorn normal muted"></i> <a href="">{{$article->tags}}</a> /</li>
                                    <li><i class="icon-comment-alt muted"></i><a href="">16 comments</a></li>
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
                &larr; <a href="#"> مقاله قبلی</a> :: <a href="#">مقاله بعدی </a> &rarr;
                <hr>
                <div class="pad5"></div>

                <!-- Comments -->
                <h6><span>3 comments</span></h6>
                <!--Comment 1-->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img src="/front/img/avatar1.jpg" alt="" class="avatar img-circle"/></a>
                    <div class="media-body">
                        <p class="media-heading">
                            <a href="#">Lauren Williams</a> &raquo; 27 March 2013 &raquo; <a href="#">Reply</a></p>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
                        Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
                        Donec lacinia congue felis in faucibus.
                        <!--Comment 2-->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img src="/front/img/my_avatar.jpg" alt="" class="avatar img-circle"/></a>
                            <div class="media-body">
                                <p class="media-heading">
                                    <a href="#">Admin</a> &raquo; 27 March 2013 &raquo; <a href="#">Reply</a></p>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio,
                                vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue
                                felis in faucibus.
                            </div>
                        </div>
                    </div>
                    <!--Comment 3-->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img src="/front/img/avatar2.jpg" alt="" class="avatar img-circle"/></a>
                        <div class="media-body">
                            <p class="media-heading">
                                <a href="#">Lauren Williams</a> &raquo; 23 March 2013 &raquo; <a href="#">Reply</a></p>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at,
                            tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        </div>
                    </div>
                </div>
                <!-- //Comments -->
                <div class="pad25"></div>

                <div class="pad25"></div>
                <div class="span7">
                    <div class="row">
                        <!-- Comment form -->
                        <h3>میخواهید پیامی بگذارید؟!</h3>
                        <div class="contact_form well">
                            <form action="{{route('message.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="comment" value="{{password_hash(1,PASSWORD_BCRYPT)}}">
                                <input type="hidden" name="article_id" value="{{$article->id}}">
                                <p class="form_info">نام <span class="required">*</span></p>
                                <input class="span5" type="text" name="name" value="" />
                                <p class="form_info">رایانامه <span class="required">*</span></p>
                                <input class="span5" type="text" name="email" value=""  />

                                <p class="form_info">متن پیام</p>
                                <textarea name="content" id="message" class="span6" ></textarea>
                                <div class="clear"></div>

                                <input type="submit" class="btn btn-large btn-inverse btn-form" value="ارسال پیام" />
                                <input type="reset"  class="btn btn-large btn-inverse btn-form" value="حذف محتوا" />
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
                        title: 'ناموفق',
                        text: error,
                    });
                            @elseif(session('message'))
                    var message = "{{session('message')}}";
                    Swal.fire({
                        icon: 'success',
                        title: 'موفقیت',
                        text: message,
                    });
                    @endif
                </script>
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
                    <a href="http://twitter.com/share?url={{Request::url()}}&text=Simple Share Buttons&hashtags=simplesharebuttons" class="zocial icon twitter"></a>
                    <a href="http://www.facebook.com/sharer.php?u={{Request::url()}}" class="zocial icon facebook"></a>
                    <a href="#" class="zocial icon rss"></a>
                    <a href="#" class="zocial icon dribbble"></a>
                    <a href="#" class="zocial icon pinterest"></a>
                    <a href="http://www.linkedin.com/shareArticle?mini=true&url={{Request::url()}}" target="_blank" class="zocial icon linkedin"></a>
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
                        </div>

                    </div>
                    <div class="pad45"></div>
                </div>
            </div>
        </div>
    </div>

    @endsection

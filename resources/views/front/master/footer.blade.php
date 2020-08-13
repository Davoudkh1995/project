<!--footer-->
<div id="footer">
    <div class="container">
        <div class="row">
            <!--column 1-->
            <div class="span3">
                <h6>{{__('messages.footer.rapid_info.title')}}</h6>
                <ul>
                    <li>
                        @if(app()->getLocale() == "fa")
                        <p class=" text-right"><span class="dropcap2">{{__('messages.footer.rapid_info.subTitle')}}</span>
                            {{__('messages.footer.rapid_info.description')}}
                        </p>
                        <address class="text-right">
                            {!! $contact->address !!}
                        </address>
                            @else
                            <p><span class="dropcap2">{{__('messages.footer.rapid_info.subTitle')}}</span>
                                {{__('messages.footer.rapid_info.description')}}
                            </p>
                            <address>
                                {!! $contact->address !!}
                            </address>
                        @endif
                        <p><i class="icon-envelope hue"></i>
                            <a href="mailto:{{$contact->address}}">{{$contact->email}}</a><br/>
                            <i class="icon-phone hue"></i>
                            <a href="mailto:{{$contact->mobile}}">{{$contact->mobile}}</a>
                        </p>

                    </li>
                </ul>
            </div>
            <!--column 2-->
            <div class="span3">
                <h6>{{__('messages.footer.articles.title')}} </h6>
                <ul class="media-list">
                    @foreach($articles as $article)
                        <li class="media">
                            <img class="drop @if(app()->getLocale() == "fa") pull-right @else pull-left @endif" src="{{$article->picture['others'][1]}}"
                                 alt="{{$article->title}}" height="42" width="42">
                            <div class="media-body  @if(app()->getLocale() == "fa") text-right @endif">
                                <a href="/{{app()->getLocale()}}/article/{{$article->slug}}" dir="rtl">{{\Illuminate\Support\Str::limit($article->title,100)}}</a>
                                <br/>@if(app()->getLocale() == "fa"){{$article->date}} @else {{substr($article->created_at,0,9)}} @endif<i class="icon-time hue"></i></div>
                        </li>
                    @endforeach


                    {{--<li class="media">
                        <img class="drop pull-left" src="/front/img/small/pop_post1.jpg" alt="" height="42" width="42">
                        <div class="media-body">
                            <a href="#">Aliquam convallis erat a enim dictum putant recusabo in ius</a>
                            <br/><i class="icon-time hue"></i> March 12th 2013</div>
                    </li>

                    <li class="media">
                        <img class="drop pull-left" src="/front/img/small/pop_post2.jpg" alt="" height="42" width="42">
                        <div class="media-body">
                            <a href="#">Aliquam convallis erat a enim dictum putant recusabo in ius</a>
                            <br/><i class="icon-time hue"></i> Feb 14th 2013
                        </div>
                    </li>

                    <li class="media">
                        <img class="drop pull-left" src="/front/img/small/pop_post3.jpg" alt="" height="42" width="42">
                        <div class="media-body">
                            <a href="#">Aliquam convallis erat a enim dictum putant recusabo in ius
                            </a>
                            <br/><i class="icon-time hue"></i> Jan 23rd 2013</div>
                    </li>--}}
                </ul>
            </div>
            <!--column 3-->
            <div class="span3">
                <h6>{{__('messages.footer.important_article.title')}}</h6>
                <img src="{{$latestBlog->picture['others'][1]}}" alt="{{$latestBlog->title}}"/>
                <h5><a href="/{{app()->getLocale()}}/portfolio/{{$latestBlog->slug}}">{{\Illuminate\Support\Str::limit($article->title,150)}}</a></h5>
                <p class="@if(app()->getLocale() == "fa") text-right @endif">
                    {!! \Illuminate\Support\Str::limit($article->title,150) !!}
                </p>
                <p>
                    <a href="/{{app()->getLocale()}}/article/{{$latestBlog->slug}}" class="more-link">{{__('messages.footer.important_article.button')}} &rarr;</a>
                </p>
            </div>
            <!--column 4-->
            <div class="span3">
                <!--flickr-->
                <h6>{{__('messages.footer.socialmedia.title')}} </h6>
                <div class="flickrs">
                    <div class="FlickrImages">
                        <ul>
                        </ul>
                        <div class="clear">
                        </div>
                    </div>
                </div>

                <h5>{{__('messages.footer.socialmedia.subTitle')}} </h5>
                <div class="follow_us">
                    <a href="#" class="zocial twitter"></a>
                    <a href="#" class="zocial facebook"></a>
                    <a href="#" class="zocial linkedin"></a>
                    <a href="#" class="zocial googleplus"></a>
                    <a href="#" class="zocial vimeo"></a>
                </div>
                <div class="copyright @if(app()->getLocale() == "fa") text-right @endif">
                    &copy;
                    <script type="text/javascript">
                        var d = new Date();
                        document.write(d.getFullYear())
                    </script>
                    - {{__('messages.footer.socialmedia.privacy')}}<br/>
                    {{__('messages.footer.socialmedia.policy')}} <a href="http://spiralpixel.com">{{__('messages.footer.socialmedia.author')}}</a> {{__('messages.footer.socialmedia.endStatement')}}
                </div>
            </div>
        </div>
    </div>
</div>
<!--//footer-->
<!-- up to top -->
<a href="#">
    <i class="go-top hidden-phone hidden-tablet icon-double-angle-up"></i></a>
<!--//end-->

<script src="/front/js/jquery.touchSwipe.min.js"></script>
<script src="/front/js/jquery.mousewheel.min.js"></script>
<script src="/front/js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="/front/js/jquery.easing.1.3.js"></script>
<script src="/front/js/bootstrap.min.js"></script>
<script src="/front/js/superfish.js"></script>
<script type="text/javascript" src="/front/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="/front/js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="/front/js/sorting.js"></script>
<script type="text/javascript" src="/front/js/scripts.js"></script>

</body>
</html>

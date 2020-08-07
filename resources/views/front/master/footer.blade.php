<!--footer-->
<div id="footer">
    <div class="container">
        <div class="row">
            <!--column 1-->
            <div class="span3">
                <h6>اطلاعات سریع</h6>
                <ul>
                    <li>
                        <p class="text-right"><span class="dropcap2">رونیکا</span>
                            این سایت به عنوان معرفی کننده گروه برنامه نویسی رونیکا است. این گروه مفتخر به انجام چندین
                            پروژه در حوزه سایت و نرم افزارهای تحت وب میباشد. بهترینها رو برای شما اجرا میکنیم به ما
                            اطمینان کنید</p>
                        <address class="text-right">
                            {!! $contact->address !!}
                        </address>

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
                <h6>مهمترین مقالات</h6>
                <ul class="media-list">
                    @foreach($articles as $article)
                        <li class="media">
                            <img class="drop pull-right" src="{{$article->picture['others'][1]}}"
                                 alt="{{$article->title}}" height="42" width="42">
                            <div class="media-body text-right">
                                <a href="/article/{{$article->slug}}" dir="rtl">{{\Illuminate\Support\Str::limit($article->title,100)}}</a>
                                <br/>{{$article->date}}<i class="icon-time hue"></i></div>
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
                <h6>آخرین مقاله</h6>
                <img src="{{$latestBlog->picture['others'][1]}}" alt="{{$latestBlog->title}}"/>
                <h5><a href="/portfolio/{{$latestBlog->slug}}">{{\Illuminate\Support\Str::limit($article->title,150)}}</a></h5>
                <p class="text-right">
                    {!! \Illuminate\Support\Str::limit($article->title,150) !!}
                </p>
                <p>
                    <a href="/article/{{$latestBlog->slug}}" class="more-link">ادامه مطلب &rarr;</a>
                </p>
            </div>
            <!--column 4-->
            <div class="span3">
                <!--flickr-->
                <h6>فضای مجازی</h6>
                <div class="flickrs">
                    <div class="FlickrImages">
                        <ul>
                        </ul>
                        <div class="clear">
                        </div>
                    </div>
                </div>

                <h5>ممنون که سایت خودتونو مشاهده کردید</h5>
                <div class="follow_us">
                    <a href="#" class="zocial twitter"></a>
                    <a href="#" class="zocial facebook"></a>
                    <a href="#" class="zocial linkedin"></a>
                    <a href="#" class="zocial googleplus"></a>
                    <a href="#" class="zocial vimeo"></a>
                </div>
                <div class="copyright text-right">
                    &copy;
                    <script type="text/javascript">
                        var d = new Date();
                        document.write(d.getFullYear())
                    </script>
                    - حقوق کپی رایت<br/>
                    این سایت تماماّ متعلق به <a href="http://spiralpixel.com">گروه برنامه نویسی رونیکا</a> است
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

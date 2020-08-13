<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{__('messages.siteTitle')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{__('messages.siteDescription')}}">
    <meta name="author" content="Davoud Khoshkar">

{{--    <link href='http://fonts.googleapis.com/css?family=Arvo:400|Open+Sans:400,700,300' rel='stylesheet' type='text/css'>--}}
<!--[if IE]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">-->
    {{--<!--    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css">-->--}}
    {{--    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet" type="text/css">--}}
    {{--    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css">--}}
    {{--    <![endif]-->--}}
    <link rel="preload" href="/front/font/aviny-700.woff" as="font" type="font/woff" crossorigin>
    <link href="/front/css/bootstrap.css" rel="stylesheet">
    <link href="/front/css/font-awesome.min.css" rel="stylesheet">
    @if(app()->getLocale() == 'fa')
        <link href="/front/css/theme.css" rel="stylesheet">
    @endif
    @if(app()->getLocale() == 'en')
        <link href="/front/css/themeEn.css" rel="stylesheet">
    @endif


    <link href="/front/css/prettyPhoto.css" rel="stylesheet" type="text/css"/>
    <link href="/front/css/zocial.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/admin/assets/sweetalert2/sweetalert2.css">
    <script type="text/javascript" src="/admin/assets/sweetalert2/sweetalert2.js"></script>

    {{--    <link href="/front/css/bootstrap_rtl/css/bootstrap-rtl.css" rel="stylesheet" type="text/css"/>--}}

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE 7]>
    <link rel="stylesheet" href="/front/css/font-awesome-ie7.min.css">
    <![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@700&display=swap" rel="stylesheet">
</head>
<body>
<!--header-->
<div class="header">
    <!--logo-->
    <div class="container">
        <div class="logo">
            @if(Request::is('/'))
                <div style="display: inline-block;float: left;margin-right: 20px;" class="btn-group">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class=" fa">fa</button>
                        <button type="button" class=" en">en</button>
                    </div>
                </div>
            @endif
            <a href="/"><img src="/front/img/logo.png" alt="رونیکا"/></a>

        </div>


    <!--menu-->
        <nav id="main_menu">
            <div class="menu_wrap">
                <ul class="nav sf-menu">
                    @if(app()->getLocale() == "fa")
                        <li class=" @if(Request::is('contact_us')) active @endif"><a href="/contact_us"><i
                                        class="icon-phone-sign darkgrey"></i><br>{{__('messages.contact')}}</a></li>
                        <li class=" @if(Request::is('about_us')) active @endif"><a href="/about_us"><i
                                        class="icon-user darkgrey"></i><br>{{__('messages.about')}}</a></li>
                        <li class=" @if(Request::is('article*') or Request::is('art_search') or Request::is('category_archive*') or Request::is('beforeArticle*') or Request::is('afterArticle*')) active @endif">
                            <a href="/article"><i class="icon-book darkgrey"></i><br>{{__('messages.articles')}}</a>
                        </li>
                        <li class=" @if(Request::is('portfolio*')) active @endif"><a href="/portfolio"><i
                                        class="icon-suitcase darkgrey"></i><br>{{__('messages.portfolio')}}</a></li>
                        <li class=" @if(Request::is('/')) active @endif"><a href="/"><i class="icon-home  darkgrey"></i><br>{{__('messages.home')}}
                            </a></li>
                    @endif

                    @if(app()->getLocale() == "en")
                        <li class=" @if(Request::is('/')) active @endif"><a href="/"><i class="icon-home  darkgrey"></i><br>{{__('messages.home')}}
                            </a></li>
                        <li class=" @if(Request::is('portfolio*')) active @endif"><a href="/portfolio"><i
                                        class="icon-suitcase darkgrey"></i><br>{{__('messages.portfolio')}}</a></li>
                        <li class=" @if(Request::is('article*') or Request::is('art_search') or Request::is('category_archive*') or Request::is('beforeArticle*') or Request::is('afterArticle*')) active @endif">
                            <a href="/article"><i class="icon-book darkgrey"></i><br>{{__('messages.articles')}}</a>
                        </li>
                        <li class=" @if(Request::is('about_us')) active @endif"><a href="/about_us"><i
                                        class="icon-user darkgrey"></i><br>{{__('messages.about')}}</a></li>
                        <li class=" @if(Request::is('contact_us')) active @endif"><a href="/contact_us"><i
                                        class="icon-phone-sign darkgrey"></i><br>{{__('messages.contact')}}</a></li>
                    @endif

                    {{--<li class="sub-menu"><a href="javascript:{}"> <i class="icon-book darkgrey"></i><br>Pages</a>
                        <ul>
                            <li><a href="team.html"><span>--</span>The Team</a></li>
                            <li><a href="about.html"><span>--</span>About</a></li>
                            <li><a href="services.html"><span>--</span>Services</a></li>
                            <li><a href="testimonials.html"><span>--</span>Testimonials</a></li>
                            <li><a href="process.html"><span>--</span>Process</a></li>
                            <li><a href="full.html"><span>--</span>Full Width</a></li>
                            <li><a href="left_sidebar.html"><span>--</span>Left Sidebar</a></li>
                            <li><a href="right_sidebar.html"><span>--</span>Right Sidebar</a></li>
                        </ul>
                    </li>--}}
                    {{--<li class="sub-menu"><a href="javascript:{}"><i class="icon-briefcase darkgrey"></i><br>Work</a>
                        <ul>
                            <li><a href="portfolio_2columns.html"><span>--</span>2 Columns</a></li>
                            <li><a href="portfolio_3columns.html"><span>--</span>3 Columns</a></li>
                            <li><a href="portfolio_4columns.html"><span>--</span>4 Columns</a></li>
                            <li><a href="gallery.html"><span>--</span>Paginated Gallery</a></li>
                            <li><a href="video_gallery.html"><span>--</span>Video Gallery</a></li>
                            <li><a href="portfolio_masonry.html"><span>--</span>Masonry</a></li>
                            <li><a href="portfolio_drop.html"><span>--</span>Drop Shapes</a></li>
                            <li><a href="portfolio_circle.html"><span>--</span>Circle Shapes</a></li>
                            <li><a href="single_portfolio.html"><span>--</span>Single Slider</a></li>
                            <li><a href="single_video.html"><span>--</span>Single Video</a></li>
                            <li><a href="single_image.html"><span>--</span>Single Image</a></li>
                        </ul>
                    </li>--}}
                    {{--<li class="sub-menu"><a href="javascript:{}"><i class="icon-cogs darkgrey"></i><br>Style</a>
                        <ul>
                            <li><a href="scaffolding.html"><span>--</span>Scaffolding</a></li>
                            <li><a href="typography.html"><span>--</span>Typography</a></li>
                            <li><a href="shortcodes.html"><span>--</span>Shortcodes</a></li>
                            <li><a href="icons.html"><span>--</span>Icons</a></li>
                            <li><a href="javascript:{}"><span>--</span>Colours</a>
                                <ul>
                                    <li><a href="../orange/index.html"><span>--</span>Orange</a></li>
                                    <li><a href="../green/index.html"><span>--</span>Green</a></li>
                                    <li><a href="../red/index.html"><span>--</span>Red</a></li>
                                    <li><a href="../pink/index.html"><span>--</span>Pink</a></li>
                                    <li><a href="../blue/index.html"><span>--</span>Blue</a></li>
                                    <li><a href="../lime/index.html"><span>--</span>Lime</a></li>
                                </ul>
                            <li><a href="script_examples.html"><span>--</span>JS Examples</a></li>
                        </ul>
                    </li>--}}
                    {{--<li class="sub-menu"><a href="javascript:{}"><i class="icon-heart darkgrey"></i><br>Extras</a>
                        <ul>
                            <li><a href="dribbble_stream.html"><span>--</span>Dribbble Stream</a></li>
                            <li><a href="index2.html"><span>--</span>Index Style 2</a></li>
                            <li><a href="pricing_table.html"><span>--</span>Pricing Table</a></li>
                            <li><a href="404.html"><span>--</span>404 Page</a></li>
                        </ul>
                    </li>--}}
                    {{--<li class="sub-menu"><a href="javascript:{}"><i class="icon-bullhorn darkgrey"></i><br>Blog</a>
                        <ul>
                            <li><a href="blog.html"><span>--</span>Blog</a></li>
                            <li><a href="blog_post.html"><span>--</span>Blog Post</a></li>
                            <li><a href="blog_two.html"><span>--</span>Blog Variation</a></li>
                            <li><a href="blog_post2.html"><span>--</span>Post Variation</a></li>
                        </ul>
                    </li>--}}
                    {{--                    <li class="last"><a href="contact.html"><i class="icon-pencil darkgrey"></i><br>Contact</a></li>--}}
                </ul>
            </div>
        </nav>
    </div>
</div>
<!--//header-->

@extends('front.master.index')
@section('content')
    <div class="breadcrumbs"><a href="/">{{__('messages.home')}}</a> <i
                class="@if(app()->getLocale() == "fa") icon-double-angle-left @else icon-double-angle-right @endif grey"></i>{{__('messages.about_us.title')}}
    </div>

    <div class="inner_content">
        <h1 class="title">{{__('messages.about_us.title')}}</h1>

        <h1>{{__('messages.about_us.subTitle')}}<span> &#1748; </span></h1>

        <div class="pad30"></div>
        <div class="row">
            <div class="span4 @if(app()->getLocale() == "fa") text-right @endif">
                <!--skill bars-->
                <h4 class="title-divider span4"><strong>{{__('messages.about_us.skills.title')}}</strong><span></span>
                </h4>
                <p class="@if(app()->getLocale() == "fa") text-right @endif">{{__('messages.about_us.skills.text')}}<span> &#1748; </span></p>
                <span class="@if(app()->getLocale() == "fa") text-right @endif ">{{__('messages.about_us.skills.design')}}</span>
                <div class="progress progress-striped progress-inverse">
                    <div class="bar @if(app()->getLocale() == "fa") f-right @endif " style="width: 98%;float: right;">
                    </div>
                </div>

                <span>{{__('messages.about_us.skills.responsive')}}</span>
                <div class="progress progress-striped progress-inverse">
                    <div class="bar f-right" style="width: 98%;float: right;"></div>
                </div>

                <span>{{__('messages.about_us.skills.content')}}</span>
                <div class="progress progress-striped progress-inverse">
                    <div class="bar @if(app()->getLocale() == "fa") f-right @endif " style="width: 98%;float: right;"></div>
                </div>
            </div>
            <div class="span4">
                <h4 class="title-divider span4"><strong>{{__('messages.about_us.mission.title')}}</strong><span></span>
                </h4>
                <p class="@if(app()->getLocale() == "fa") text-right @endif">{{__('messages.about_us.mission.text1')}}
                    <span> &#1748; </span></p>

                <ul class="icons @if(app()->getLocale() == "fa") text-right rtl @endif">
                    <li><i class="icon-ok hue"></i>{{__('messages.about_us.mission.prop1')}}</li>
                    <li><i class="icon-ok hue"></i>{{__('messages.about_us.mission.prop2')}}</li>
                    <li><i class="icon-ok hue"></i>{{__('messages.about_us.mission.prop3')}}</li>
                    <li><i class="icon-ok hue"></i>{{__('messages.about_us.mission.prop4')}}</li>
                </ul>
                <div class="pad15"></div>
            </div>
            <div class="span4">
                <h4 class="title-divider span4"><strong>{{__('messages.about_us.method')}}</strong><span></span></h4>
                <p class="lead">
                    {!! $about->content !!}
                </p>
                <div class="pad15"></div>
            </div>
        </div>

        {{--<div class="row pad15">
            <div class="span12">
                <h2 class="title-divider span12">Studio <strong>Tour</strong><span></span></h2></div>
            <div class="span12 pad15">
                <!--video-->
                <div class="vendor">
                    <iframe src="http://player.vimeo.com/video/44169481?title=0&amp;byline=0&amp;portrait=0"></iframe>
                </div>
                <!--//video-->
            </div>
        </div>--}}
    </div>

    {{--<div class="pad45"></div>
    <div class="row">
        <div class="span4">
            <h4 class="title-divider span4">طراحی <strong>رونیکا</strong><span></span></h4>
            <p>
                Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti.
                Vivamus purus arcu, commodo cursus egestas et, dictum lobortis dui. Curabitur at mi eu mi sollicit. Mauris viverra,
                tortor eget interdum lacinia, lacus mi tempor purus, eu commodo enim dui ac nisl.
            </p>
        </div>
        <!--carousel-->
        <div class="span8 pad25"><div class="col_full">
                <div id="slider_about">

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s1.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s1.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">catalogue</a></h3>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s2.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s2.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">loupe</a></h3>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s3.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s3.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">retro rocket</a></h3>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s4.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s4.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">infographics</a></h3>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s5.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s5.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">mock up</a></h3>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s6.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s6.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">retro badges</a></h3>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s7.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s7.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">details</a></h3>
                        </div>
                    </div>

                    <div class="slider-item">
                        <div class="slider-image">
                            <a href="/front/img/large/s8.jpg" data-rel="prettyPhoto"><img src="/front/img/small/s8.jpg" alt="" /></a>
                        </div>
                        <div class="slider-title">
                            <h3><a href="#">vintage form</a></h3>
                        </div>
                    </div>

                </div>
                <div id="sl-prev2" class="widget-scroll-prev2"><i class="icon-caret-left grey"></i></div>
                <div id="sl-next2" class="widget-scroll-next2"><i class="icon-caret-right grey"></i></div>
                <script type="text/javascript">
                    jQuery(document).ready(function($) {
                        var portfolioCarousel = $("#slider_about");
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
                                    max:4
                                }
                            },
                            mousewheel: true,
                            swipe: {
                                onMouse: true,
                                onTouch: true
                            },
                            prev : {
                                button : "#sl-prev2",
                                key : "left"
                            },
                            next : {
                                button : "#sl-next2",
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
                <script src="/front/js/jquery.touchSwipe.min.js"></script>
                <script src="/front/js/jquery.mousewheel.min.js"></script>
            </div></div>

        <div class="span12">
            <h4 class="title-divider span12">Tabs <strong>Example</strong><span></span></h4>
            <div class="tabbable tabs-left">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Tab1</a></li>
                    <li><a href="#tab2" data-toggle="tab">Tab2</a></li>
                    <li><a href="#tab3" data-toggle="tab">Tab3</a></li>
                    <li><a href="#tab4" data-toggle="tab">Tab4</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <!--tab 1-->
                    <div class="tab-pane fade in active" id="tab1">
                        <img src="/front/img/small/e11.jpg" class=" pull-left" alt="Image" title="Image" />
                        <h6><span>Made for everyone</span> and packed with features</h6>
                        <p>Sleek, intuitive, and powerful front-end framework for faster and easier web development.</p>
                        <p>By nerds, for nerds. Built at Twitter by @mdo and @fat, Bootstrap utilizes LESS CSS, is compiled via Node, and is managed through GitHub
                            to help nerds do awesome stuff on the web. Bootstrap was made to not only look and behave great in the latest desktop browsers (as well as IE7!),
                            but in tablet and smartphone browsers via responsive CSS as well. A 12-column responsive grid, dozens of components, JavaScript plugins, typography,
                            form controls, and even a web-based Customizer to make Bootstrap your own.</p>
                    </div>
                    <!--tab 2-->
                    <div class="tab-pane fade" id="tab2">
                        <h6><span>249 icons</span> in a single collection</h6><p>All icons are vectors,
                            which mean they're gorgeous on high-resolution retina displays. Scalable vector graphics means every icon looks awesome at any size.
                        </p>

                        <div class="row">
                            <div class="span2">
                                <ul class="icons">
                                    <li class="iconstab"><i class="icon-ok"></i> Ok</li>
                                    <li class="iconstab"><i class="icon-star"></i> Star</li>
                                    <li class="iconstab"><i class="icon-star-empty"></i> Star empty</li>
                                    <li class="iconstab"><i class=" icon-heart-empty"></i> Heart empty</li>
                                    <li class="iconstab"><i class=" icon-asterisk"></i> Asterisk</li>
                                    <li class="iconstab"><i class=" icon-music"></i> Music</li>
                                </ul>
                            </div>
                            <div class="span2">
                                <ul class="icons">
                                    <li><i class="icon-cogs"></i> Cogs</li>
                                    <li><i class="icon-beer"></i> Beer</li>
                                    <li><i class="icon-coffee"></i> Coffee</li>
                                    <li><i class="icon-food"></i> Food</li>
                                    <li><i class=" icon-circle-blank"></i> Circle blank</li>
                                    <li><i class=" icon-trophy"></i> Trophy</li>
                                </ul>
                            </div>

                            <div class="span2">
                                <ul class="icons">
                                    <li><i class=" icon-desktop"></i> Desktop</li>
                                    <li><i class="icon-tag"></i> Tag</li>
                                    <li><i class="icon-bullhorn"></i> Bullhorn</li>
                                    <li><i class=" icon-lightbulb"></i> Lightbulb</li>
                                    <li><i class=" icon-bell-alt"></i> Bell</li>
                                    <li><i class=" icon-plus-sign"></i> Plus sign</li>
                                </ul>
                            </div>

                            <div class="span2">
                                <ul class="icons">
                                    <li><i class=" icon-camera"></i> Camera</li>
                                    <li><i class="icon-bookmark"></i> Bookmark</li>
                                    <li><i class="icon-book"></i> Book</li>
                                    <li><i class=" icon-envelope"></i> Envelope</li>
                                    <li><i class="  icon-exclamation-sign"></i> Exclamation</li>
                                    <li><i class=" icon-pushpin"></i> Pushpin</li>
                                </ul>
                            </div>

                            <div class="span2">
                                <ul class="icons">
                                    <li><i class=" icon-eye-open"></i> Eye open</li>
                                    <li><i class="icon-facetime-video"></i> Facetime video</li>
                                    <li><i class="icon-leaf"></i> Leaf</li>
                                    <li><i class=" icon-flag"></i> Flag</li>
                                    <li><i class=" icon-pencil"></i> Pencil</li>
                                    <li><i class=" icon-plus"></i> Icon plus</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--tab 3-->
                    <div class="tab-pane fade" id="tab3">
                        <h6><span>Handy</span> Tables</h6>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Job</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>Designer</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jacob</td>
                                <td>Thorn</td>
                                <td>Artist</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Larry</td>
                                <td>Bird</td>
                                <td>Tea Boy</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--tab 4-->
                    <div class="tab-pane fade" id="tab4">
                        <h6><span>Alert</span> Boxes</h6>
                        <div class="row">
                            <div class="span6">
                                <div class="alert">
                                    <a class="close" data-dismiss="alert">&times;</a>
                                    <strong>Warning!</strong> Best check yo self, you're not looking too good.
                                </div>

                                <div class="alert alert-error">
                                    <a class="close" data-dismiss="alert">&times;</a>
                                    <strong>Oh snap!</strong> Change a few things up and try submitting again.
                                </div>
                            </div>

                            <div class="span3">
                            </div>
                            <div class="span2">
                                <div class="alert alert-success">
                                    <a class="close" data-dismiss="alert">&times;</a>
                                    <strong>Well done!</strong> You read this important alert message.
                                </div>
                            </div>

                            <div class="span2">
                                <div class="alert alert-info">
                                    <a class="close" data-dismiss="alert">&times;</a>
                                    <strong>Heads up!</strong> Alert needs your attention, but it's not important.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
@endsection

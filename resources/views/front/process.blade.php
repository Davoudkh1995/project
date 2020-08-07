@extends('front.master.index')
@section('content')
    <div class="breadcrumbs"><a href="#">Home</a> <i class="icon-double-angle-right grey"></i> Process</div>

    <div class="inner_content">
        <h1 class="title">Design Process</h1>
        <h1>It's art if it can't be explained. It's <span>fashion</span> if no one asks for an <span>explanation.</span>
            It's <span class="hue">design</span> if it doesn't need explanation. - Wouter Stokkel</h1>

        <div class="pad30"></div>
        <img src="/front/img/large/process.jpg" alt="" />
        <div class="row">
            <div class="span3 pad25">

                <div class="clear"></div>
                <img src="/front/img/large/screen1.jpg" alt="" />

                <h3 class="grey"><i class="icon-quote-right icon-3x pull-left hue"></i>
                    Ecilisis venenatis risus, suspendisse ac nec et. Nulla sed mauris, congue duis proin nonummy elementum phasellus. Mauris sed nulla sed,
                    egestas feugiat a dictum libero, nunc sapien.</h3>

                <p><a href="testimonials.html"><span class="read_more">Read More &rarr;</span></a></p>
            </div>

            <!-- Accordion -->
            <div class="span9 pad25">

                <div class="clear"></div>
                <div id="accordion" class="accordion">
                    <!--1-->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">
                                Information Gathering</a>
                        </div>

                        <div class="accordion-body collapse" id="collapseOne">
                            <div class="accordion-inner">
                                <img src="/front/img/large/screen3.jpg" alt="" class="pad5" />
                                <p class="pad15">
                                    Rebum sanctus gubergren ei mea, usu repudiare adolescens rationibus at, eum ea dicant malorum deseruisse. Quot pertinax sensibus id per,
                                    usu vide dolorem ea. Invidunt incorrupte mei ea, duo ei viderer mentitum explicari. Sed dolorum mediocritatem ex. Ceteros fabellas verterem
                                    ut has, ne facilis.</p>

                                <h1><span>CREATE  <i class="icon-arrow-right hue"></i> DESIGN <i class="icon-arrow-right hue"></i>  CODE</span></h1>

                                <p>Ex sit diam veniam veritus. Nec ex quis homero. Porro audiam recusabo ut sed, qui ornatus menandri ea, brute aperiam insolens his in.
                                    Vel te augue ponderum singulis, ei justo doctus sed.</p>
                            </div>
                        </div>
                    </div>

                    <!--2-->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">
                                Design</a>
                        </div>

                        <div class="accordion-body collapse in" id="collapseTwo">
                            <div class="accordion-inner ">
                                <div class="pad15"></div>
                                <p><img src="/front/img/small/e9.jpg" class="pull-right drop2" alt="" />
                                    Lorem ipsum dolor sit amet, vix invidunt neglegentur no, in pri evertitur consequuntur. Minim evertitur scripserit ad qui,
                                    no diam error meliore quo. No mei ferri adhuc scribentur, an eius vitae ubique eos.</p>

                                <h6><span>Certain things to consider are:</span></h6>
                                <ul class="icons">
                                    <li><i class="icon-star hue"></i><span>Purpose</span>
                                        <br/>Porro audiam recusabo ut sed, qui ornatus menandri ea, brute aperiam insolens his in?</li>
                                    <li><i class="icon-star hue pad15"></i><span>Goals</span>
                                        <br/>Vel te augue ponderum singulis, ei justo doctus sed?</li>
                                    <li><i class="icon-star hue pad15"></i><span>Target Audience</span>
                                        <br/>Quot pertinax sensibus id per, usu vide dolorem ea. Invidunt incorrupte mei ea, duo ei viderer mentitum explicari.</li>
                                </ul>
                                <br/>

                                <p>Mea ne essent prompta lucilius. Eos omnis noster mollis in, cum at semper laboramus adversarium, at dolore ponderum per.
                                    Est dicat tractatos id nobis fuisset definitionem in, ancillae noluisse usu at.</p>
                            </div>
                        </div>
                    </div>
                    <!--3-->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">
                                Testing and Delivery</a>
                        </div>

                        <div class="accordion-body collapse" id="collapseThree">
                            <div class="accordion-inner">
                                <p class="pad5">An mea vidit definiebas. No sea quaestio abhorreant, ne sit offendit urbanitas interpretaris. Habeo atqui docendi
                                    quo ne, clita labore laoreet eam no. Eam ipsum vocibus cu.</p>

                                <ul class="media-list">
                                    <li class="media">
                                        <img class=" pull-left" src="/front/img/small/pop_post1.jpg" alt="" />
                                        <div class="media-body">
                                            Ex sit diam veniam veritus. Nec ex quis homero. Porro audiam recusabo ut sed, qui ornatus menandri ea, brute aperiam insolens his in.
                                            Vel te augue ponderum singulis, ei justo doctus sed.</div>
                                    </li>

                                    <li class="media">
                                        <img class="pull-left" src="/front/img/small/pop_post2.jpg" alt="" />
                                        <div class="media-body">
                                            Ex sit diam veniam veritus. Nec ex quis homero. Porro audiam recusabo ut sed, qui ornatus menandri ea, brute aperiam insolens his in.
                                            Vel te augue ponderum singulis, ei justo doctus sed.</div>
                                    </li>

                                    <li class="media">
                                        <img class=" pull-left" src="/front/img/small/pop_post3.jpg" alt="" />
                                        <div class="media-body">
                                            Ex sit diam veniam veritus. Nec ex quis homero. Porro audiam recusabo ut sed, qui ornatus menandri ea, brute aperiam insolens his in.
                                            Vel te augue ponderum singulis, ei justo doctus sed.</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!--4-->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a href="#collapseFour" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle">
                                Maintenance</a>
                        </div>

                        <div class="accordion-body collapse" id="collapseFour">
                            <div class="accordion-inner">
                                <p class="pad5">Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti.
                                    Vivamus purus arcu, commodo cursus egestas et, dictum lobortis dui. Curabitur at mi eu mi sollicitudin faucibus at at libero.</p>

                                <ul class="icons">
                                    <li><i class="icon-star hue"></i><span>Hosting</span>
                                        <br/>Porro audiam recusabo ut sed, q<a href="">ui ornatus menandri ea</a> brute aperiam insolens his in?</li>

                                    <li><i class="icon-star hue pad15"></i><span>Pricing</span>
                                        <br/>Vel te augue ponderum singulis, ei justo doctus sed offendit urbanitas interpretaris.

                                        <ul>
                                            <li class="pad5">&bull; &pound;50.00 per page</li>
                                            <li>&bull; &pound;80.00 - &pound;120.00 per portfolio</li>
                                            <li>&bull; &pound;750.00 - e-commerce</li></ul></li>
                                    <li><i class="icon-star hue pad15"></i><span>Updates</span>
                                        <br/>Quot pertinax sensibus id per, usu vide dolorem ea. Invidunt incorrupte mei ea, duo ei viderer mentitum explicari.</li>
                                </ul>
                                <br/>

                                <table class="table table-condensed">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

@extends('front.master.index')
@section('content')
    <div class="breadcrumbs"><a href="#">خانه</a> <i class="icon-double-angle-left grey marginL10"></i>ارتباط با من</div>

    <div class="inner_content">
        <h1 class="title">ارتباط با ما</h1>

        {{--<h1>It's art if it can't be explained. It's <span>fashion</span> if no one asks for an <span>explanation.</span>
            It's <span class="hue">design</span> if it doesn't need explanation. - Wouter Stokkel</h1>--}}

        <div class="row">
            <div class="span12 pad25">
                <!--//GOOGLE MAP -ADD YOUR EMBED INFO HERE-->
                <div id="map">
                    <iframe  height="310" src="https://maps.google.co.uk/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Mornington+Crescent,+Camden+High+Street,+London&amp;aq=1&amp;oq=mornington+crescent&amp;sll=53.11546,-3.939972&amp;sspn=0.458287,1.234589&amp;ie=UTF8&amp;hq=Mornington+Crescent,+Camden+High+Street,+London&amp;t=m&amp;ll=51.535021,-0.13919&amp;spn=0.013881,0.032015&amp;output=embed"></iframe>
                </div>
                <img src="/front/img/shadow3.png" class="map-shadow" alt="" />
            </div>

            <div class="span4 pad15 text-right">
                <h3 class="title-divider span4">مشخصات<strong>مورد نظر</strong><span></span></h3>
                <p class="text-right">آیا نیاز به یک وبسایت کارآمد دارید؟<br>آیا سوالی در مورد مباحث فنی وب دارید؟<br>به من ایمیل بزنید یا از طریق فرم ارتباط با من پیام خودتونو ارسال کنید، من نهایتاً تا 24 ساعت آینده به شما جواب میدم  </p>

                <address class="text-right">
                    {!! $data->address !!}
                </address>

                <address class="text-right">
                    <span class="black">رایانامه</span><br>
                    <a href="mailto:{{$data->email}}">{{$data->email}}</a><br>
                    <span class="black">شماره تماس</span><br>
                    <a href="tel:{{$data->mobile}}">{{$data->mobile}}</a><br>
                </address>

                <a href="#" class="zocial icon twitter"></a>

                <a href="#" class="zocial icon facebook"></a>

                <a href="#" class="zocial icon googleplus"></a>

                <a href="#" class="zocial icon linkedin"></a>

                <a href="#" class="zocial icon dribbble"></a>
            </div>

            <div class="span8 pad15">
                <div class="contact_form well">
                    <div id="note"></div>
                    <div id="fields">
                        <form action="{{route('message.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="contact" value="{{password_hash(1,PASSWORD_BCRYPT)}}">
                            <p class="form_info"><span class="required">*</span>نام و نام خانوادگی </p>
                            <input class="span5" type="text" name="name" value="" />
                            <p class="form_info"><span class="required">*</span>رایانامه </p>
                            <input class="span5" type="text" name="email" value=""  />
                            <p class="form_info">موضوع</p>
                            <input class="span5" type="text" name="subject" value="" /><br>
                            <p class="form_info">پیام</p>
                            <textarea name="content" id="message" class="span7" ></textarea>
                            <div class="clear"></div>

                            <input type="submit"  class="btn btn-large btn-inverse btn-form" value="ارسال" />
                            <input type="reset"  class="btn btn-large btn-inverse btn-form" value="حذف محتوا" />
                            <div class="clear"></div>
                        </form>
                    </div>
                </div>
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
    @endsection

@extends('auth.layout.master.index')

@section('content')
    <div class="row align-items-center h-100-vh">
        <div class="col-lg-6 d-none d-lg-block p-t-b-25">
            <img class="img-fluid" src="/admin/assets/media/login_page_image/104.jpg" alt="...">
        </div>
        <div class="col-lg-4 offset-lg-1 p-t-b-25">
            {{--<div class="d-flex align-items-center m-b-20">
                <img src="/admin/assets/media/image/dark-logo.png" class="m-l-15" width="40" alt="">
                <h3 class="m-0">پنل مدیریت رونیکا</h3>
            </div>--}}
            <p></p>
            <form action="{{ route('login') }}" method="post" autocomplete="off">
                @csrf
                <div class="form-group mb-4">
                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="ایمیل یا نام کاربری" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="رمز عبور" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <button class="btn btn-primary btn-lg btn-block btn-uppercase mb-4" type="submit">ورود</button>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">به خاطر سپاری</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link auth-link text-black" href="{{ route('password.request') }}">
                            فراموشی رمز عبور
                        </a>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <a href="" class="btn btn-outline-facebook btn-block">
                            <i class="fa fa-facebook-square m-l-5"></i> با فیسبوک
                        </a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="" class="btn btn-outline-google btn-block">
                            <i class="fa fa-google m-l-5"></i> با گوگل
                        </a>
                    </div>
                </div>
                {{--<div class="text-center">
                    حسابی ندارید؟ <a href="{{route('register')}}" class="text-primary">ایجاد</a>
                </div>--}}
            </form>
        </div>
    </div>
@endsection

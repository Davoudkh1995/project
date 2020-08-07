@extends('auth.layout.master.index')

@section('content')
    <div class="row align-items-center h-100-vh">
        <div class="col-lg-6 d-none d-lg-block p-t-b-25">
            <img class="img-fluid" src="/admin/assets/media/svg/register.svg" alt="...">
        </div>
        <div class="col-lg-4 offset-lg-1 p-t-25 p-b-10">
            <h3>ثبت نام</h3>
            <p>ایجاد حساب کاربری جدید</p>
            <form action="" method="post" autocomplete="off">
                @csrf
                <div class="form-group mb-4">
                    <input id="name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="نام کاربری" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group mb-4">
                    <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="ایمیل" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="گذرواژه" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password" placeholder="تکرار گذرواژه">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch" checked>
                        <label class="custom-control-label" for="customSwitch">با قوانین و مقررات موافقم.</label>
                    </div>
                </div>
                <button class="btn btn-primary btn-lg btn-block btn-uppercase mb-4">ایجاد حساب</button>
                <p class="text-left">
                    <a href="{{route('login')}}" class="text-underline">حساب کاربری دارید؟</a>
                </p>
            </form>
        </div>
    </div>
@endsection

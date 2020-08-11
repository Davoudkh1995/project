@extends('admin.error.index')
@section('content')
    <div class="container">
        <img src="/admin/assets/media/error/403.png" alt="گروه رونیکا">

            <h1 class="text-center">شما دسترسی لازم برای ورود به این صفحه را ندارید.</h1>
        <div class="row mt-5">
            <a href="/home" class="btn btn-outline-danger m-auto"> بازگشت به پنل مدیریت</a>
        </div>
    </div>
@endsection

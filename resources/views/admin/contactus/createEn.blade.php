@extends('admin.master.index')
@section('style')
    <!-- begin::tagsinput -->
        <link rel="stylesheet" href="/admin/assets/vendors/tagsinput/bootstrap-tagsinput.css" type="text/css">
    <!-- end::tagsinput -->
    <script src="/admin/assets/ckeditor/ckeditor.js"></script>
@endsection
@section('script')
    <!-- begin::input mask -->
        <script src="/admin/assets/vendors/tagsinput/bootstrap-tagsinput.js"></script>
        <script src="/admin/assets/js/examples/tagsinput.js"></script>
{{--    <!-- end::input mask -->--}}
@endsection
@section('header')
    <div>
        <h3>تماس با ما</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">فهرست</li>
                <li class="breadcrumb-item">تماس با ما</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <h5 style="color: #ffffff;background-color: #f50000;font-size: 12px;border-bottom:1px solid #000;margin-bottom: 0;border-radius: 4px 4px 0 0;padding:10px 10px;">
                    اطلاعات وارد شده ناقص بوده</h5>
                <div style="background-color: #3f51b5;border-top:1px solid #000;padding: 10px;border-radius:0 0 4px 4px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color: #ffffff;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">تماس با ما</h5>
        <div class="card-body">
            <form action="/{{app()->getLocale()}}/admin/updateContactEn" method="post" class="needs-validation"
                  novalidate="" enctype="multipart/form-data"
                  autocomplete="off">
                @csrf
                <div class="form-row mb-4">
                        <div class="col-md-6 phones">
                            <label for="">تلفن</label>
                            <input type="text" class="form-control tagsinput" name="tel" value="@if(isset($contactus)) {{$contactus->tel}} @endif">
                        </div>
                        <div class="col-md-6 emails">
                            <label for="">پست الکترونیکی</label>
                            <input type="text" class="form-control tagsinput" name="email" value="@if(isset($contactus)) {{$contactus->email}} @endif">
                        </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="">فکس</label>
                        <input type="text" class="form-control" id="" required="" name="fax"
                               value="@if(isset($contactus)) {{$contactus->fax}} @endif">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">کدپستی</label>
                        <input type="text" class="form-control" id="" required="" name="postal_code"
                               value="@if(isset($contactus)) {{$contactus->postal_code}} @endif">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">تلفن همراه</label>
                        <input type="text" class="form-control" id="" required="" name="mobile"
                               value="@if(isset($contactus)) {{$contactus->mobile}} @endif">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">اسکریپت گوگل مپ</label>
                        <textarea name="google_map" class="form-control" id="" cols="30"
                                  rows="5">@if(isset($contactus)) {{$contactus->google_map}} @endif</textarea>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-12">
                        <label class="control-label ">آدرس شرکت</label>
                        <textarea rows="5" id="body" cols="5" class="form-control"
                                  name="address"
                                  placeholder="آدرس خود را در این قسمت وارد کنید...">@if(isset($contactus)) {!! $contactus->address !!} @endif</textarea>
                    </div>
                    <script>
                        var editor = CKEDITOR.replace('address', {
                            filebrowserBrowseUrl: '/admin/assets/ckeditor/ckfinder/ckfinder.html',
                            filebrowserUploadUrl: '/admin/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                        });
                        CKFinder.setupCKEditor(editor);
                    </script>
                </div>
                <button class="btn btn-primary" type="submit">ذخیره درخواست</button>
            </form>
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


    <div class="card">
        <div class="card-header">
            فیلد سئو
        </div>
        <div class="card-body">
            <form action="{{route('save_seo_contactEn')}}" method="post">
                @csrf
                @method('patch')
                <input type="hidden" name="object" value="{{$contactus->id}}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">عنوان صفحه</label>
                            <input type="text" name="title" class="form-control"
                                   value="@if(isset($seo)) {{$seo->title}} @endif">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">کنونیکال</label>
                            <input type="text" name="canonical"
                                   class="form-control" value="@if(isset($seo)) {{$seo->canonical}} @endif">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">آدرس URL</label>
                            <input type="text" name="seo_url"
                                   class="form-control" value="@if(isset($seo)) {{$seo->seo_url}} @endif">

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">کلمات کلیدی</label>
                            <input type="text" name="keywords"
                                   class="form-control tagsinput" value="@if(isset($seo)) {{$seo->keywords}} @endif">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label for="">متاتوضیحات</label>
                        <textarea name="description"
                                  class="form-control"> @if(isset($seo)) {{$seo->description}} @endif</textarea>
                    </div>
                    <div class="col-md-2">
                        <label for="">index
                            <input type="checkbox" name="index" class="form-control"
                                   @if(isset($seo)) @if($seo->index == 1) checked @endif @endif>
                        </label>
                    </div>
                    <div class="col-md-2">
                        <label for="">follow
                            <input type="checkbox" name="follow" class="form-control"
                                   @if(isset($seo)) @if($seo->follow == 1) checked @endif @endif>
                        </label>
                    </div>
                </div>
                <div class="row mt-3 mr-0">
                    <button class="btn btn-success">اعمال</button>
                </div>
            </form>
        </div>
    </div>
@endsection

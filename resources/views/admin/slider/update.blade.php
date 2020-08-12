@extends('admin.master.index')
@section('style')
    <!-- begin::select2 -->
    <link rel="stylesheet" href="/admin/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
    <!-- begin::dropzone -->
    <link rel="stylesheet" href="/admin/assets/vendors/dropzone/dropzone.css" type="text/css">
    <!-- begin::dropzone -->
@endsection
@section('script')
    <!-- begin::select2 -->
    <script src="/admin/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/admin/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
    <!-- begin::dropzone -->
    <script src="/admin/assets/vendors/dropzone/dropzone.js"></script>
    <script src="/admin/assets/js/examples/dropzone.js"></script>
    <!-- end::dropzone -->

@endsection
@section('header')
    <div>
        <h3>ویرایش اسلایدر</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">فهرست</li>
                <li class="breadcrumb-item"><a href="{{route('slider.index')}}">اسلایدر</a></li>
                <li class="breadcrumb-item">ویرایش</li>
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
    <form action="{{route('slider.update',$slider->id)}}" method="post" enctype="multipart/form-data" id="submitForm">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">

                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-5">
                                <label class="custom-file-label mr-3" for="customFile" id="picture">انتخاب تصویر</label>
                                <input type="file" class="form-control custom-file-input" id="customFile" name="picture"
                                       onchange="showName(this,'picture')">
                            </div>
                            <div class="form-group col-sm-7 text-left">
                                <a href="{{$slider->picture}}"><img src="{{$slider->picture}}" alt="" width="100" height="50"></a>
                            </div>
                            <script>
                                function showName(tagName, labelName) {
                                    var tag = $(tagName);
                                    var i = tag.prev('#' + labelName).clone();
                                    var file = tag[0].files[0].name;
                                    tag.prev('#' + labelName).text(file);
                                }
                            </script>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="">عنوان</label>
                                <input type="text" class="form-control" id="title"
                                       name="title" value="{{$slider->title}}">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="">لینک</label>
                                <input type="text" class="form-control" id="link"
                                       name="link" value="{{$slider->link}}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label for="validationCustom03">زبان</label>
                                    <select class="form-control js-example-basic-single" dir="rtl" name="lang">
                                        <option @if($slider->lang == "fa") selected @endif value="fa">فارسی</option>
                                        <option @if($slider->lang == "en") selected @endif value="en">انگلیسی</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="">توضیحات</label>
                                <textarea class="form-control" id="description" rows="3" name="description">
                                    {{$slider->description}}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"></div>
                        <div class="m-auto" style="display: table;">
                            <a onclick="submitForm()" type="submit" class="btn btn-success text-white float-right ">ذخیره اطلاعات
                            </a>
                        </div>
                        <div style="display: table;margin: 30px auto">
                            <div class="custom-control custom-switch custom-checkbox-dark">
                                <input type="checkbox" class="custom-control-input display-block" id="customSwitch6_"
                                       name="status" @if($slider->status == 1) checked @endif>
                                <label class="custom-control-label display-block" for="customSwitch6_">وضعیت
                                    نمایش</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <select class="js-example-basic-single" dir="rtl" name="slider_type" id="slider_type"
                                    onchange="typeSlider()">
                                <option value="0">انتخاب نوع اسلایدر</option>
                                <option value="1" @if($slider->slider_type == 1) selected @endif>تصویری</option>
                                <option value="2" @if($slider->slider_type == 2) selected @endif>متنی و تصویری</option>
                            </select>
                        </div>
{{--                        {{dd($priorities)}}--}}
                        <div class="form-group">
                            <select class="form-control js-example-basic-single" dir="rtl" name="priority" id="priority">
                                <option value="0" selected>انتخاب کنید</option>
                                <option value="{{$slider->priority}}"selected disabled>@if($slider->priority == 0) بدون جایگاه @else {{$slider->priority}} @endif</option>
                                @foreach($priorities as $priority)
                                    <option value="{{$priority}}">{{$priority}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
    <script>
        window.onload = function () {
            typeSlider();
        };

        function submitForm() {
            $('#submitForm').submit();
        }

        function typeSlider() {
            var selected = $('#slider_type option:selected');
            var value = selected.val();
            var btnLink = $('#btnLink');
            var btnTitle = $('#btnTitle');
            var description = $('#description');
            if (value == 1) {
                btnLink.prop("disabled", true);
                btnTitle.prop("disabled", true);
                description.prop("disabled", true);
            } else {
                btnLink.prop("disabled", false);
                btnTitle.prop("disabled", false);
                description.prop("disabled", false);
            }
        }
    </script>
@endsection

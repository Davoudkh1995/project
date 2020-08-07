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
        <h3>افزودن اسلایدر</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">فهرست</li>
                <li class="breadcrumb-item"><a href="{{route('slider.index')}}">اسلایدر</a></li>
                <li class="breadcrumb-item">افزودن</li>
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
    <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data" id="submitForm">
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
                        <div class="form-group col-sm-6">
                            <label for="">عنوان</label>
                            <input type="text" class="form-control" id="title"
                                   name="title" value="{{old('title')}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">لینک</label>
                            <input type="text" class="form-control" id="link"
                                   name="link" value="{{old('link')}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">توضیحات</label>
                            <textarea class="form-control" id="description" rows="3" name="description"
                                      >{{old('description')}}</textarea>
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
                                   name="status" checked>
                            <label class="custom-control-label display-block" for="customSwitch6_" >وضعیت
                                نمایش</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <select class="js-example-basic-single" dir="rtl" name="slider_type" id="slider_type"
                                onchange="typeSlider()">
                            <option>انتخاب نوع اسلایدر</option>
                            <option value="1">تصویری</option>
                            <option value="2">متنی و تصویری</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" dir="rtl" name="priority" id="priority">
                            <option value="0" selected>انتخاب کنید</option>
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

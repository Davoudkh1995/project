@extends('admin.master.index')
@section('style')
    <!-- begin::tagsinput -->
    <link rel="stylesheet" href="/admin/assets/vendors/tagsinput/bootstrap-tagsinput.css" type="text/css">
    <!-- end::tagsinput -->
    <!-- begin::select2 -->
    <link rel="stylesheet" href="/admin/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
    <script src="/admin/assets/ckeditor/ckeditor.js"></script>
@endsection
@section('script')
    <!-- begin::input mask -->
    <script src="/admin/assets/vendors/tagsinput/bootstrap-tagsinput.js"></script>
    <script src="/admin/assets/js/examples/tagsinput.js"></script>
    <!-- end::input mask -->
    <!-- begin::select2 -->
    <script src="/admin/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/admin/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
@endsection
@section('header')
    <div>
        <h3>افزودن خدمات</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">فهرست</li>
                <li class="breadcrumb-item"><a href="{{route('service.index')}}">خدمات</a></li>
                <li class="breadcrumb-item">افزودن</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">افزودن</h5>
        <div class="card-body">
            <form action="{{route('service.store')}}" method="post" class="needs-validation" novalidate=""
                  enctype="multipart/form-data"
                  autocomplete="off">
                @csrf
                <div class="form-row">
                    <div class="file-inputs col-10 mb-4">
                        <div class="form-group col-sm-6 item-count-1">
                            <label class="custom-file-label mr-3" for="customFile" id="picture_1">تصویر اصلی</label>
                            <input type="file" class="form-control custom-file-input" id="customFile" name="picture[]"
                                   onchange="showName(this,'picture_1')">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a class="btn btn-secondary btn-floating addBlock">
                            <i class="ti-plus"></i>
                        </a>
                        <a class="btn btn-danger btn-floating removeBlock">
                            <i class="ti-minus"></i>
                        </a>
                    </div>
                    <script>
                        function showName(tagName, labelName) {
                            var tag = $(tagName);
                            var i = tag.prev('#' + labelName).clone();
                            var file = tag[0].files[0].name;
                            tag.prev('#' + labelName).text(file);
                        }

                        var counter = 2;
                        $('.addBlock').click(function () {
                            if (counter < 8) {
                                var item = "<div class=\"form-group col-sm-6 item-count-" + counter + "\">\n" +
                                    "<label class=\"custom-file-label mr-3\" for=\"customFile\" id=\"picture_" + counter + "\">دیگر تصاویر</label>\n" +
                                    "<input type=\"file\" class=\"form-control custom-file-input\" id=\"customFile\" name=\"picture[]\"\n" +
                                    "onchange=\"showName(this,'picture_" + counter + "')\">\n" +
                                    "</div>";
                                $('.file-inputs').append(item);
                                counter++;
                            } else if (counter >= 8) {
                                counter = 8;
                            }
                        });
                        $('.removeBlock').click(function () {
                            if (counter > 2) {
                                $('.item-count-' + (counter - 1)).remove();
                                counter -= 1;
                            }
                        });

                    </script>
                </div>

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">عنوان خدمات</label>
                        <input type="text" class="form-control" id="validationCustom01" required="" name="title">
                        <div class="valid-feedback">
                            صحیح است!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">/{{\Illuminate\Support\Facades\App::make('url')->to('/service')}}</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="نامک" required=""
                               name="slug">
                        <div class="valid-feedback">
                            صحیح است!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="validationCustom03">دسته بندی</label>
                            <select class="form-control js-example-basic-single" dir="rtl" name="categoryID_FK">
                                <option selected value="0">انتخاب دسته</option>
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">برچسب</label>
                        <input type="text" id="validationCustom03" class="form-control tagsinput" placeholder=""
                               value="" name="tags">
                        <div class="valid-feedback">
                            صحیح است!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">اولویت</label>
                        <select class="form-control js-example-basic-single" dir="rtl" name="priority" id="priority">
                            <option value="0" selected>انتخاب کنید</option>
                            @foreach($priorities as $priority)
                                <option value="{{$priority}}">{{$priority}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-12">
                        <label class="control-label ">محتوای صفحه</label>
                        <textarea rows="5" id="body" cols="5" class="form-control"
                                  name="content"
                                  placeholder="محتوای صفحه خود را در این قسمت وارد کنید..."></textarea>
                    </div>
                    <script>
                        var editor = CKEDITOR.replace('content', {
                            filebrowserBrowseUrl: '/admin/assets/ckeditor/ckfinder/ckfinder.html',
                            filebrowserUploadUrl: '/admin/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                        });
                        CKFinder.setupCKEditor(editor);
                    </script>
                </div>
                <div class="form-row form-group">
                    <div class="custom-control custom-checkbox custom-checkbox-success">
                        <input type="checkbox" class="custom-control-input" id="customCheck" checked name="status">
                        <label class="custom-control-label" for="customCheck">این سرویس نمایش داده شود؟</label>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">ذخیره</button>
            </form>
        </div>
    </div>
    <script>
                @if (session('error'))
        var message = "{{session('error')}}";
        alert(message);
        @endif
    </script>
@endsection

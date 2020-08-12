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
        <h3>ویرایش نمونه کار</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">فهرست</li>
                <li class="breadcrumb-item"><a href="{{route('portfolio.index')}}">نمونه کار</a></li>
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
    <div class="card">
        <h5 class="card-header">ویرایش</h5>
        <div class="card-body">
            <form action="{{route('portfolio.update',$portfolio->id)}}" method="post" class="needs-validation" novalidate=""
                  enctype="multipart/form-data"
                  autocomplete="off" id="formUpdate">
                @csrf
                @method('patch')
                @foreach($otherImages as $key=>$image)
                    <input type="hidden" name="text_{{$image->symbol}}" id="text_{{$image->symbol}}" value="{{$image->symbol}}">
                    @endforeach
                <div class="form-row">
                    <div class="row form-group col-md-12">
                        <div class="col-md-4">
                            <label class="custom-file-label mr-3" for="customFile" id="mainPicture">تصویر اصلی</label>
                            <input type="file" class="form-control custom-file-input" id="customFile" name="mainPicture"
                                   onchange="showName(this,'mainPicture')">
                        </div>
                        <div class="col-md-3 text-left">
                          <a href="{{$portfolio->picture['main']}}"><img src="{{$portfolio->picture['main']}}" alt="" width="100" height="50"></a>
                        </div>
                    </div>
                    @foreach($otherImages as $key=>$image)
                        <div class="row form-group col-md-12 {{$image->symbol}}" data-browse="fdasd">
                            <div class="col-md-8">
                                <label class="custom-file-label mr-3" for="customFile" id="{{$image->symbol}}">تصویر {{$key+2}}</label>
                                <input type="file" class="form-control custom-file-input" id="customFile" name="{{$image->symbol}}"
                                       onchange="showName(this,'{{$image->symbol}}')">
                            </div>
                            <div class="col-md-2 text-right">
                                <a href="{{$image->picture}}"><img src="{{$image->picture}}" alt="" width="100" height="50"></a>
                            </div>
                            <div class="col-md-2">
                                <a class="btn btn-danger btn-floating" onclick="removeOtherImage(this,'{{$image->symbol}}')">
                                    <i class="ti-minus"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                </div>
                <hr/>

                <div class="form-row">
                    @if(count($otherImages) != 7)
                    <div class="file-inputs col-10 mb-4">
                        <div class="form-group col-sm-6 item-count-1" data-id="1">
                                <label class="custom-file-label mr-3" for="customFile" id="picture_1">دیگر تصاویر</label>
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
                    @endif
                    <script>
                        function removeOtherImage(tag,symbol){
                            var symbolTag = $('.'+symbol);
                            var textSymbolTag = $('#text_'+symbol);
                            $(symbolTag).remove();
                            $(textSymbolTag).remove();
                        }
                        function showName(tagName, labelName) {
                            var tag = $(tagName);
                            var i = tag.prev('#' + labelName).clone();
                            var file = tag[0].files[0].name;
                            tag.prev('#' + labelName).text(file);
                        }
                        var count = "{{count($otherImages)}}";
                        // var counter = 2+parseInt(count);
                        var counter = +count+2;
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
                            console.log(counter,count)
                        });
                        $('.removeBlock').click(function () {

                            if (counter > 2) {
                                $('.item-count-' + (counter - 1)).remove();
                                if (counter <= +count+2){
                                    counter = +count+2;
                                } else{
                                    counter -= 1;
                                }

                            }
                            console.log(counter,count);
                        });

                    </script>
                </div>

                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">عنوان نمونه کار</label>
                        <input type="text" class="form-control" id="validationCustom01" required="" name="title" value="{{$portfolio->title}}">
                        <div class="valid-feedback">
                            صحیح است!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">/{{\Illuminate\Support\Facades\App::make('url')->to('/portfolio')}}</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="نامک" required=""
                               name="slug" value="{{$portfolio->slug}}">
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
                                    <option value="{{$item->id}}" @if($portfolio->categoryID_FK == $item->id) selected @endif>{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="validationCustom03">زبان</label>
                            <select class="form-control js-example-basic-single" dir="rtl" name="lang">
                                <option @if($portfolio->lang == "fa") selected @endif value="fa">فارسی</option>
                                <option @if($portfolio->lang == "en") selected @endif value="en">انگلیسی</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">برچسب</label>
                        <input type="text" id="validationCustom03" class="form-control tagsinput"
                               value="{{$portfolio->tags}}" name="tags" >
                        <div class="valid-feedback">
                            صحیح است!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">اولویت</label>
                        <select class="form-control js-example-basic-single" dir="rtl" name="priority" id="priority">
                            <option value="0">انتخاب کنید</option>
                            <option disabled selected>@if($portfolio->priority == 0) فاقد اولویت @else {{$portfolio->priority}} @endif</option>

                            @foreach($priorities as $priority)
                                <option value="{{$priority}}" @if($portfolio->priority == $priority) selected @endif>{{$priority}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-12">
                        <label class="control-label ">محتوای صفحه</label>
                        <textarea rows="5" id="body" cols="5" class="form-control"
                                  name="content"
                                  placeholder="محتوای صفحه خود را در این قسمت وارد کنید...">{{$portfolio->content}}</textarea>
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
                        <input type="checkbox" class="custom-control-input" id="customCheck" @if($portfolio->status == 1) checked @endif name="status">
                        <label class="custom-control-label" for="customCheck">این سرویس نمایش داده شود؟</label>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">ذخیره</button>
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
@endsection

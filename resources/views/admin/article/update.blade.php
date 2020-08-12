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
        <h3>ویرایش اخبار و مقالات</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">فهرست</li>
                <li class="breadcrumb-item"><a href="{{route('article.index')}}">اخبار و مقالات</a></li>
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
            <form action="{{route('article.update',$article->id)}}" method="post" class="needs-validation" novalidate="" enctype="multipart/form-data"
                  autocomplete="off">
                @csrf
                @method('patch')
                <div class="form-row mb-4">
                    <div class="form-group col-sm-5">
                        <label class="custom-file-label mr-3" for="customFile" id="picture">انتخاب تصویر</label>
                        <input type="file" class="form-control custom-file-input" id="customFile" name="picture"
                               onchange="showName(this,'picture')">
                    </div>
                    <div class="form-group col-sm-7 text-left">
                        <a href="{{$article->picture['main']}}" target="_blank">
                            <img src="{{$article->picture['main']}}" alt="{{$article->title}}" width="150" height="100">
                        </a>
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
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">عنوان اخبار و مقالات</label>
                        <input type="text" class="form-control" id="validationCustom01" required="" name="title" value="{{$article->title}}">
                        <div class="valid-feedback">
                            صحیح است!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">/{{\Illuminate\Support\Facades\App::make('url')->to('/blog')}}</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="نامک" required=""
                               name="slug" value="{{$article->slug}}">
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
                                    <option value="{{$item->id}}" @if($article->categoryID_FK = $item->id) selected @endif>{{$item->title}}</option>
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
                                <option @if($article->lang == "fa") selected @endif value="fa">فارسی</option>
                                <option @if($article->lang == "en") selected @endif value="en">انگلیسی</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">برچسب</label>
                        <input type="text" id="validationCustom03" class="form-control tagsinput" placeholder=""
                               value="{{$article->tags}}" name="tags">
                        <div class="valid-feedback">
                            صحیح است!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom03">اولویت</label>
                        <select class="form-control js-example-basic-single" dir="rtl" name="priority" id="priority">
                            <option value="0" selected>انتخاب کنید</option>
                            <option value="{{$article->priority}}" disabled="disabled" selected>@if(!is_null($article->priority) or $article->priority != "" or $article->priority != 0){{$article->priority}} @else فاقد اولویت @endif</option>
                            @foreach($priorities as $priority)
                                <option value="{{$priority}}" @if($article->priority == $priority) @endif>{{$priority}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row mb-3">
                    <div class="col-md-12">
                        <label class="control-label ">محتوای صفحه</label>
                        <textarea rows="5" id="body" cols="5" class="form-control"
                                  name="content"
                                  placeholder="محتوای صفحه خود را در این قسمت وارد کنید...">{!! $article->content !!}</textarea>
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
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="status" @if($article->status == 1) checked @endif>
                        <label class="custom-control-label" for="customCheck">این خبر یا مقاله نمایش داده شود؟</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-checkbox-success mt-0 mr-5">
                        <input type="checkbox" class="custom-control-input" id="customCheck1"  @if($article->popular == 1) checked @endif name="popular" >
                        <label class="custom-control-label" for="customCheck1">مقاله معروف؟</label>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">ذخیره درخواست</button>
            </form>
        </div>
    </div>
    @if(count($messages))
    <div class="card">
        <h5 class="card-header">پیام کاربران</h5>
        <div class="card-body">
            @foreach($messages as $message)
            <div class="row" id="parent_{{$message->id}}">
                <div class="col-md-2">
                    {{$message->customerName}}
                </div>
                <div class="col-md-4 bg-danger" style="border-radius: 4px">
                    {{$message->content}}
                </div>
                <div class="col-md-4">
                    <textarea name="answer" id="textarea_{{$message->id}}" data-answer="{{$message->id}}" class="form-control"></textarea>
                </div>
                <div class="col-md-2 text-white">
                    <a onclick="submitAnswer(this,'{{$message->id}}')" class="btn btn-success">ارسال پاسخ</a>
                </div>
                <hr/>
            </div>
                @endforeach
        </div>
    </div>
    @endif
    <script>
        function submitAnswer(tag,id) {
            var button = $(tag);
            var parent = $('#parent_'+id);
            var message = parent.find('#textarea_'+id).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post( "/saveAnswer",{data:{"_token": "{{ csrf_token() }}", message: message, message_id: id}},function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'موفقیت!',
                    text: 'پاسخ به کامنت کاربر ارسال شد',
                });
                parent.remove();
            });
        }
    </script>
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
        //  Form Validation
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
            forms.submit();
        }, false);
        $(document).ready(function () {
            $('.parents').select2();
        });
    </script>
@endsection

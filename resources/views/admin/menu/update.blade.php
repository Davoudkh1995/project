@extends('admin.master.index')
@section('style')
    <!-- begin::select2 -->
    <link rel="stylesheet" href="/admin/assets/vendors/select2/css/select2.min.css" type="text/css">
    <script src="/admin/assets/ckeditor/ckeditor.js"></script>
    <!-- end::select2 -->
@endsection
@section('script')
    <!-- begin::select2 -->
    <script src="/admin/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/admin/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
@endsection
@section('header')
    <div>
        <h3>ویرایش منو</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">فهرست</li>
                <li class="breadcrumb-item"><a href="{{route('menu.index')}}">منو</a></li>
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
    @php
        if (isset($menu->page->content)){
            $content = $menu->page->content;
        }else{
            $content = null;
        }

    @endphp
    <div class="card">
        <h5 class="card-header">
            <p class="float-left m-0">ویرایش</p>
            <p><a id="show-page" class="float-right btn btn-outline-success m-0">ایجاد صفحه</a></p>
        </h5>
        <div class="card-body">
            <form action="{{route('menu.update',$menu->id)}}" method="post" class="needs-validation" novalidate=""
                  autocomplete="off">
                @csrf
                @method('patch')
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">عنوان منو</label>
                        <input type="text" class="form-control" id="validationCustom01" required="" name="title"
                               value="{{$menu->title}}">
                        <div class="valid-feedback">
                            صحیح است!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">/{{\Illuminate\Support\Facades\App::make('url')->to('/site')}}</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="نامک" required=""
                               name="slug" value="{{$menu->slug}}">
                        <div class="valid-feedback">
                            صحیح است!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="validationCustom03">زیردسته</label>
                            <select class="form-control js-example-basic-single" dir="rtl" name="parent_id">
                                <option selected value="0">سردسته</option>
                                @foreach($menus as $m)
                                    @if($menu->id != $m->id)
                                    <option value="{{$m->id}}"
                                            @if($menu->parent_id == $m->id) selected @endif>{{$m->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="custom-control custom-checkbox custom-checkbox-success">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="status"
                               @if($menu->status == 1) checked @endif>
                        <label class="custom-control-label" for="customCheck">این منو نمایش داده شود؟</label>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">ذخیره درخواست</button>
            </form>
        </div>
    </div>
    @php
        if (session('showPageCreator') == "on" or $content){
            $display = "block";
            $btn_text = 'ویرایش صفحه';
        }else{
            $display = "none";
            $btn_text = 'ساختن صفحه';
        }
    @endphp
    <div class="card" id="page-creator" style="display: {{$display}};">
        <div class="card-body">
            <form action="/admin/page_creator" method="post">
                @csrf
                <input type="hidden" name="menu_id" value="{{$menu->id}}">
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-success mt-2 float-right">{{$btn_text}}</button>
                    </div>
                    <div class="col-md-12">
                        <label class="control-label ">محتوای صفحه</label>
                        <textarea rows="5" id="body" cols="5" class="form-control"
                                  name="content"
                                  placeholder="محتوای صفحه خود را در این قسمت وارد کنید...">@if(isset($menu->page)){{$menu->page->content}}@endif</textarea>
                    </div>
                </div>
                <script>
                    var editor = CKEDITOR.replace('content', {
                        filebrowserBrowseUrl: '/admin/assets/ckeditor/ckfinder/ckfinder.html',
                        filebrowserUploadUrl: '/admin/assets/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                    });
                    CKFinder.setupCKEditor(editor);
                </script>
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
        $('#show-page').click(function () {
            $('#page-creator').fadeToggle()
        });

    </script>
@endsection

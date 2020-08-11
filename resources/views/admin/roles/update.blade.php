@extends('admin.master.index')
@section('style')
    <!-- begin::select2 -->
    <link rel="stylesheet" href="/admin/assets/vendors/select2/css/select2.min.css" type="text/css">
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
        <h3>ویرایش اطلاعات مشاغل</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">سطوح دسترسی</li>
                <li class="breadcrumb-item"><a href="{{route('role.index')}}">مشاغل</a></li>
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
        <h5 class="card-header">افزودن</h5>
        <div class="card-body">
            <form action="{{route('role.update',$role->id)}}" method="post" class="needs-validation" novalidate=""
                  autocomplete="off">
                @csrf
                @method('patch')
                <div class="mb-4">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="validationCustom01">نام به فارسی</label>
                            <input type="text" class="form-control" id="validationCustom01"
                                   aria-describedby="emailHelp"
                                   placeholder="نام به فارسی" name="name" value="{{$role->name}}">

                        </div>
                        <div class="form-group col-sm-6">
                            <label for="validationCustom01">نام به لاتین</label>
                            <input type="text" class="form-control" id="validationCustom01"
                                   aria-describedby="emailHelp"
                                   placeholder="نام به لاتین" name="label" value="{{$role->label}}">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label ">توضیحات</label>
                            <textarea rows="5" id="body" cols="5" class="form-control"
                                      name="text"
                                      placeholder="محتوای خود را در این قسمت وارد کنید...">{!! $role->text !!}</textarea>
                        </div>
                    </div>
                    <script>
                        var editor = CKEDITOR.replace('text', {
                            filebrowserBrowseUrl: '/ckeditor/ckfinder/ckfinder.html',
                            filebrowserUploadUrl: '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                        });
                        CKFinder.setupCKEditor(editor);
                    </script>
                </div>
                <div class="row">
                    @foreach($permissions as $key=>$permission)
                        <div class="custom-control custom-checkbox custom-control-inline mr-3 mb-2 mt-2">
                            <input type="checkbox" id="customCheckBoxInline{{$key}}" value="{{$permission->id}}" name="permissions[]" class="custom-control-input" @if(in_array($permission->id,$permission_id_arr)) checked @endif>
                            <label class="custom-control-label" for="customCheckBoxInline{{$key}}">{{$permission->name}}</label>
                        </div>
                    @endforeach
                </div>
                <div class="form-row form-group">
                    <div class="custom-control custom-checkbox custom-checkbox-success">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="status" checked>
                        <label class="custom-control-label" for="customCheck">وضعیت نمایش</label>
                    </div>
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

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
        <h3>افزودن اطلاعات کاربران</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">سطوح دسترسی</li>
                <li class="breadcrumb-item"><a href="{{route('admin.index')}}">کاربران</a></li>
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
    <div class="card">
        <h5 class="card-header">افزودن</h5>
        <div class="card-body">
            <form action="{{route('admin.store')}}" method="post" class="needs-validation" novalidate="" enctype="multipart/form-data"
                  autocomplete="off">
                @csrf
                <div class="mb-4">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="custom-file-label mr-3" for="customFile" id="picture">تصویر کاربر</label>
                            <input type="file" class="form-control custom-file-input" id="customFile" name="picture"
                                   onchange="showName(this,'picture')">
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="custom-file-label mr-3" for="customFile1" id="signature">امضا دیجیتال</label>
                            <input type="file" class="form-control custom-file-input" id="customFile1" name="signature"
                                   onchange="showName(this,'signature')">
                        </div>
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
                    <div class="form-group col-md-4">
                        <label for="validationCustom01">نام</label>
                        <input type="text" class="form-control" id="validationCustom01"
                               aria-describedby="emailHelp"
                               placeholder="نام" name="name" value="{{old('name')}}">
                        <div class="valid-feedback">
                            صحیح است!
                        </div>

                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">پست الکتروونیکی</label>
                        <input type="email" class="form-control" id=""
                               aria-describedby="emailHelp"
                               placeholder="پست الکتروونیکی" name="email" value="{{old('email')}}">

                    </div>
                    <div class="form-group col-md-4">
                        <label for="validationCustom02">نام کاربری (کد ملی)</label>
                        <input type="text" class="form-control" id="validationCustom02"
                               aria-describedby="emailHelp"
                               placeholder="نام کاربری" name="nationalCode" value="{{old('nationalCode')}}" maxlength="10">
                        <div class="valid-feedback">
                            صحیح است!
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="">رمز عبور</label>
                        <input type="password" class="form-control" id="password"
                               aria-describedby="emailHelp"
                               placeholder="رمز عبور" name="password" value="{{old('password')}}">

                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">تکرار رمز عبور</label>
                        <input type="password" class="form-control" id="confirm"
                               aria-describedby="emailHelp"
                               placeholder="تکرار رمز عبور" name="confirm">

                    </div>
                    <div class="form-group col-sm-4">
                        @if(count($roles))
                            <div class="form-group" style="width: 100%;">
                                <label for="" style="display: block;text-align: center">نقش کاربر</label>
                                <div class="form-group">
                                    <select class="js-example-basic-single" multiple dir="rtl" name="roleId[]">
                                        <option>انتخاب کنید</option>
                                        {{--@if($isSuperAdmin)
                                            <option value="{{$superAdmin->id}}">{{$superAdmin->name}}</option>
                                        @endif--}}
                                        @foreach($roles as $role)
                                            @if($role->name != 'super admin')
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">
                                در این بخش باید یکی از نقش ها انتخاب شود ولی چون هیچ موردی ثبت نشده این مورد برای
                                شما
                                نمایش داده نشده لطفا یک نقش را در ابتدا ثبت نمایید
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-row form-group">
                    <div class="custom-control custom-checkbox custom-checkbox-success">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="accept_policy" checked>
                        <label class="custom-control-label" for="customCheck">وضعیت فعالیت</label>
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

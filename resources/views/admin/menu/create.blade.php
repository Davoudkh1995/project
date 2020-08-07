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
        <h3>افزودن منو</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">فهرست</li>
                <li class="breadcrumb-item"><a href="{{route('menu.index')}}">منو</a></li>
                <li class="breadcrumb-item">افزودن</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">افزودن</h5>
        <div class="card-body">
            <form action="{{route('menu.store')}}" method="post" class="needs-validation" novalidate="" autocomplete="off">
                @csrf
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom01">عنوان منو</label>
                        <input type="text" class="form-control" id="validationCustom01" required="" name="title">
                        <div class="valid-feedback">
                            صحیح است!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="validationCustom02">/{{\Illuminate\Support\Facades\App::make('url')->to('/site')}}</label>
                        <input type="text" class="form-control" id="validationCustom02" placeholder="نامک" required="" name="slug">
                        <div class="valid-feedback">
                            صحیح است!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="validationCustom03">زیردسته</label>
                            <select class="form-control js-example-basic-single" dir="rtl" name="parent_id">
                                <option selected value="0">سردسته</option>
                                @foreach($menus as $menu)
                                    <option value="{{$menu->id}}">{{$menu->title}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-row form-group">
                        <div class="custom-control custom-checkbox custom-checkbox-success">
                            <input type="checkbox" class="custom-control-input" id="customCheck" checked name="status">
                            <label class="custom-control-label" for="customCheck">این منو نمایش داده شود؟</label>
                        </div>
                </div>
                <button class="btn btn-primary" type="submit">ذخیره درخواست</button>
            </form>
        </div>
    </div>
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

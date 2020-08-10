@extends('admin.master.index')
@section('content')
    <!-- begin::page header -->
    <div class="page-header">
        <h5>ثبت اطلاعات کاربران</h5>
        <hr>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">سطوح دسترسی</li>
                <li class="breadcrumb-item"><a href="/admin/admin">کاربران</a></li>
                <li class="breadcrumb-item">ثبت اطلاعات</li>
            </ol>
        </nav>
    </div>
    <div class="row mb-4">
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
    <form autocomplete="off" action="{{route('admin.store')}}" method="post" enctype="multipart/form-data" id="submitForm">
        @csrf

        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="custom-file-label mr-3 ml-3" for="customFile" id="e-signature">امضا دیجیتال</label>
                                <input type="file" class="form-control custom-file-input" id="customFile" name="signature"
                                       onchange="showName(this,'e-signature')">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">نام و نام خانوادگی</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp"
                                       placeholder="نام و نام خانوادگی" name="name" value="{{old('name')}}">

                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">پست الکتروونیکی</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp"
                                       placeholder="پست الکتروونیکی" name="email" value="{{old('email')}}">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="">نام کاربری (کد ملی)</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp"
                                       placeholder="نام کاربری" name="nationalCode" value="{{old('nationalCode')}}" oninput="this.value = this.value.replace(/[^0-9]/gi, '');" maxlength="10">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="">کارشناس</label>
                                <select class="js-example-basic-single" dir="rtl" name="category_id[]" required multiple>
                                    <option value="0">انتخاب کنید</option>
                                    @if(count(DB::table('category_receptions')->get()))
                                        @foreach(DB::table('category_receptions')->get() as $category)
                                            <option value="{{$category->code}}">{{$category->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">رمز عبور</label>
                                <input type="password" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp"
                                       placeholder="رمز عبور" name="password" value="{{old('password')}}">

                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">تکرار رمز عبور</label>
                                <input type="password" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp"
                                       placeholder="تکرار رمز عبور" name="confirm" value="{{old('confirm')}}">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"></div>
                        <div style="display: table;margin: 30px auto">
                            <div class="custom-control custom-switch custom-checkbox-dark">
                                <input type="checkbox" class="custom-control-input display-block" id="customSwitch6_"
                                       name="accept_policy" checked>
                                <label class="custom-control-label display-block" for="customSwitch6_">وضعیت
                                    نمایش</label>
                            </div>
                        </div>
                        <div class="m-auto" style="display: table;">
                            <a onclick="submitForm()" type="submit" class="btn float-right bg-dark-gradient">ثبت
                                اطلاعات</a>
                        </div>

                        <div class="text-center">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="type" value="1"
                                       class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">مسئول</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="type" value="0"
                                       class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">کاربر</label>
                            </div>
                        </div>
                        <div style="display: table;margin: 30px auto;width: 100%;">
                            @if(count($roles))
                                <div class="form-group" style="width: 100%;">
                                    <label for="" style="display: block;text-align: center">نقش کاربر</label>
                                    <div class="form-group">
                                        <select class="js-example-basic-single" multiple dir="rtl" name="roleId[]">
                                            <option>انتخاب کنید</option>
                                            @if($isSuperAdmin)
                                                <option value="{{$superAdmin->id}}">{{$superAdmin->name}}</option>
                                            @endif
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
                </div>
            </div>
        </div>
    </form>
    <script>
        function submitForm() {
            $('#submitForm').submit();
        }
    </script>
@endsection

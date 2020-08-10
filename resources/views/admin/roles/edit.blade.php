@extends('admin.master.index')
@section('content')
    <!-- begin::page header -->
    <div class="page-header">
        <h5>ویرایش اطلاعات نقشها</h5>
        <hr>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">سطوح دسترسی</li>
                <li class="breadcrumb-item"><a href="/admin/role">نقشها</a></li>
                <li class="breadcrumb-item">ویرایش اطلاعات</li>
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
    <form autocomplete="off" action="{{route('role.update',['id'=>$role->id])}}" method="post" enctype="multipart/form-data" id="submitForm">
        {{csrf_field()}}
        {{method_field('patch')}}
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">نام به فارسی</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp"
                                       placeholder="نام به فارسی" name="name" value="{{$role->name}}">

                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">نام به لاتین</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
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

                        <div class="row mt-5">
                            <h3 style="width: 100%;" class="mr-3">دسترسی ها</h3>
                            @foreach($permissions as $key=>$permission)
                                <div class="custom-control custom-checkbox custom-control-inline mr-3 mb-2 mt-2">
                                    <input type="checkbox" id="customCheckBoxInline{{$key}}" value="{{$permission->id}}" name="permissions[]" class="custom-control-input" @if(in_array($permission->id,$permission_id_arr)) checked @endif>
                                    <label class="custom-control-label" for="customCheckBoxInline{{$key}}">{{$permission->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"></div>
                        <div class="m-auto" style="display: table;">
                            <a onclick="submitForm()" type="submit" class="btn float-right bg-dark-gradient">ویرایش
                                اطلاعات</a>
                        </div>
                        <div style="display: table;margin: 30px auto">
                            <div class="custom-control custom-switch custom-checkbox-dark">
                                <input type="checkbox" class="custom-control-input display-block" id="customSwitch6_"
                                       name="status" @if($role->status == 1) checked @endif>
                                <label class="custom-control-label display-block" for="customSwitch6_">وضعیت
                                    نمایش</label>
                            </div>
                        </div>
                        <div style="display: table;margin: 30px auto">
                            <a href="/admin/role" type="submit" class="btn float-right bg-youtube">لیست موارد</a>
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
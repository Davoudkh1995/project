@extends('admin.master.index')
@section('style')
    <!-- begin::select2 -->
    <link rel="stylesheet" href="/admin/assets/vendors/select2/css/select2.min.css" type="text/css">
    <!-- end::select2 -->
    <!-- begin::dataTable -->
    <link rel="stylesheet" href="/admin/assets/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">
    <!-- end::dataTable -->
@endsection
@section('script')
    <!-- begin::select2 -->
    <script src="/admin/assets/vendors/select2/js/select2.min.js"></script>
    <script src="/admin/assets/js/examples/select2.js"></script>
    <!-- end::select2 -->
    <!-- begin::dataTable -->
    <script src="/admin/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/admin/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/admin/assets/js/examples/datatable.js"></script>
    <!-- end::dataTable -->
@endsection
@section('header')
    <div>
        <h3>فضای مجازی</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">فهرست</li>
                <li class="breadcrumb-item">فضای مجازی</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">وبرایش مورد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/admin/saveSocialChange" method="post" id="changeModal">
                    @csrf
                    <div class="modal-body">
                        <div class="col-12">
                            <label for="">لینک</label>
                            <input type="text" class="form-control" id="customSocialMedia" required="" name="link">
                            <input type="hidden" name="item_id" id="editItemId">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="saveEdit" data-id="">ذخیره تغییرات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">فضای مجازی</h5>
        <div class="card-body">

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

            <form action="{{route('socialmedia.store')}}" method="post" class="needs-validation" novalidate=""
                  autocomplete="off">
                @csrf
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="validationCustom03">نوع</label>
                            <select class="form-control js-example-basic-single" dir="rtl" name="type">
                                <option selected>انتخاب کنید</option>
                                @if(!in_array(1,$types)) @else
                                    <option value="1">اینستاگرام</option> @endif
                                @if(!in_array(2,$types)) @else
                                    <option value="2">لینکدین</option> @endif
                                @if(!in_array(3,$types)) @else
                                    <option value="3">توییتر</option> @endif
                                @if(!in_array(4,$types)) @else
                                    <option value="4">تلگرام</option> @endif
                                @if(!in_array(5,$types)) @else
                                    <option value="5">یوتیوب</option> @endif
                                @if(!in_array(6,$types)) @else
                                    <option value="6">گپ</option> @endif
                                @if(!in_array(7,$types)) @else
                                    <option value="7">سروش</option> @endif
                                @if(!in_array(8,$types)) @else
                                    <option value="8">آپارات</option> @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="">لینک</label>
                        <input type="text" class="form-control" id="" required="" name="link">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">ذخیره درخواست</button>
            </form>
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">لیست فضای مجازی</h5>
        <div class="card-body">
            <table id="example1" style="width: 100%" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نوع</th>
                    <th>وضعیت</th>
                    <th>اقدامات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $key=>$item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->PersianTitle}}</td>
                        <td>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" data-id="{{$item->id}}" class="custom-control-input"
                                           id="customSwitch_{{$key}}" @if($item->status == 1) checked @endif>
                                    <label class="custom-control-label" for="customSwitch_{{$key}}"></label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop2" type="button" class="btn btn-warning dropdown-toggle"
                                        data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    اقدامات
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                    <a class="dropdown-item editItem" data-id="{{$item->id}}"><i
                                                class="fa fa-pencil ml-3"></i>ویرایش</a>
                                    {{--<form action="{{route('menu.destroy',$item->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="dropdown-item" type="submit" style="cursor: pointer"><i class="fa fa-trash ml-3"></i>حذف</button>
                                    </form>--}}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
        $(document).ready(function () {
            $('.parents').select2();
        });
        $('.editItem').click(function () {
            var item_id = $(this).data('id');
            $.post('/admin/getSocialmediaItem', {id: item_id, '_token': "{{csrf_token()}}"}, function ($response) {
                $('#customSocialMedia').val($response['link']);
                $('#editItemId').val($response['id']);
            });
            $('#exampleModal').modal('show');
        });
        $('#saveEdit').click(function () {
            $(this).parents('#changeModal').submit();
        })
        $('.custom-control-input').click(function () {
            var item_id = $(this).data('id');
            $.post('/admin/changeSocialStatus', {id: item_id, '_token': "{{csrf_token()}}"}, function ($response) {
                alert('وضعیت تغییر کرد')
            });
        });
    </script>
@endsection

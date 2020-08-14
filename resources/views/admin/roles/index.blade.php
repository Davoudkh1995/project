@extends('admin.master.index')
@section('style')
    <!-- begin::dataTable -->
    <link rel="stylesheet" href="/admin/assets/vendors/dataTable/responsive.bootstrap.min.css" type="text/css">
    <!-- end::dataTable -->
@endsection
@section('script')
    <!-- begin::dataTable -->
    <script src="/admin/assets/vendors/dataTable/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/vendors/dataTable/dataTables.bootstrap4.min.js"></script>
    <script src="/admin/assets/vendors/dataTable/dataTables.responsive.min.js"></script>
    <script src="/admin/assets/js/examples/datatable.js"></script>
    <!-- end::dataTable -->
@endsection
@section('header')
    <div>
        <h3>مشاغل</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">سطوح دسترسی</li>
                <li class="breadcrumb-item">مشاغل</li>
            </ol>
        </nav>
    </div>
    <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            اقدامات
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="{{route('role.create')}}">افزودن</a>
            <form action="{{route('multiRemoveRole')}}" method="post">
                @csrf
                <input type="hidden" name="ids" id="ids" >
                <a class="dropdown-item" onclick="removeAll(this)" style="cursor: pointer;">حذف موارد</a>
            </form>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">مشاغل</h5>
        <div class="card-body">
            <table id="example1" style="width: 100%" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>مورد</th>
                    <th>ردیف</th>
                    <th>نام نقش</th>
                    <th>توصیف نقش</th>
                    <th>ویرایش</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 0;
                @endphp
                @if($isSuperAdmin)
                    <tr>
                        <th>-</th>
                        <td><?= $i ?></td>
                        <td>{{$superAdmin->name}}</td>
                        <td>{{$superAdmin->label}}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop2" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    اقدامات
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                    <a class="dropdown-item" href="{{route('role.edit',$superAdmin->id)}}"><i class="fa fa-pencil ml-3"></i>ویرایش</a>
                                    <form action="{{route('role.destroy',$superAdmin->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a class="dropdown-item" onclick="removeItem(this);" style="cursor: pointer"><i
                                                    class="fa fa-trash ml-3"></i>حذف</a>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endif
                @if(count($roles))
                    @foreach($roles as $key=>$role)
                        <tr>
                            <td class="checkboxDiv" data-id="{{$role->id}}">
                                <div class="custom-control custom-checkbox custom-checkbox-dark">
                                    <input type="checkbox" class="custom-control-input inputcheckbox"
                                           id="customCheck{{$role->id}}"
                                           name="ids[]" data-check="{{$role->id}}">
                                    <label class="custom-control-label" for="customCheck{{$role->id}}"></label>
                                </div>
                            </td>
                            <td><?= ++$i ?></td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->label}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop2" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        اقدامات
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                        <a class="dropdown-item" href="{{route('role.edit',$role->id)}}"><i class="fa fa-pencil ml-3"></i>ویرایش</a>
                                        <form action="{{route('role.destroy',$role->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a class="dropdown-item" onclick="removeItem(this);" style="cursor: pointer"><i
                                                        class="fa fa-trash ml-3"></i>حذف</a>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">
                            موردی یافت نشد
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function removeAll(tag) {
            let arr_of_ids = [];
            var form = $(tag).parent();
            Swal.fire({
                title: 'تذکر',
                text: "عملیات حذف انجام شود؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف شود',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    var body = $('#example1').find('tbody');
                    var checkboxes = body.find('.checkboxDiv');
                    checkboxes.each(function (index, value) {
                        var input = $(this).find('input[type="checkbox"]');
                        if(input.prop("checked") == true){
                            arr_of_ids.push($(this).data('id'));
                        }
                    });
                    $('#ids').val(arr_of_ids);
                    if (arr_of_ids.length > 0){
                        form.submit();
                    } else{
                        Swal.fire({
                            icon: 'error',
                            title: 'ناموفق!',
                            text: 'هیچ موردی انتخاب نشده',
                        });
                    }
                }
            });
        }

        function removeItem(tag) {
            var form = $(tag).parent();
            Swal.fire({
                title: 'تذکر',
                text: "مورد حذف شود؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'حذف شود',
                cancelButtonText: 'انصراف',
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            })
        }
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

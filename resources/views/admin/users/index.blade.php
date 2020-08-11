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
        <h3>ویرایش اطلاعات دسترسی</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">سطوح دسترسی</li>
                <li class="breadcrumb-item">کاربران</li>
            </ol>
        </nav>
    </div>
    <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            اقدامات
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="{{route('admin.create')}}">افزودن</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">کاربران</h5>
        <div class="card-body">
            <table id="example1" style="width: 100%" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>نام کاربری</th>
                    <th>نقش</th>
                    <th>اقدامات</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 0;
                @endphp
                @if($isSuperAdmin)
                    <tr>
                        <td><?= $i ?></td>
                        <td>{{$super_admin->name}}</td>
                        <td>{{$super_admin->nationalCode}}</td>
                        <td>
                            @foreach($super_admin->roles as $role)
                                <p style="margin: 0">{{$role->name}}</p>
                            @endforeach
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop2" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    اقدامات
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                    <a class="dropdown-item" href="{{route('admin.edit',$super_admin->id)}}"><i class="fa fa-pencil ml-3"></i>ویرایش</a>
                                    <form action="{{route('admin.destroy',$super_admin->id)}}" method="post">
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
                @if(count($admins))
                    @foreach($admins as $key=>$admin)
                        <tr>
                            <td><?= ++$i ?></td>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->nationalCode}}</td>
                            <td>
                                @foreach($admin->roles as $role)
                                    <p style="margin: 0">{{$role->name}}</p>
                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop2" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        اقدامات
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                        <a class="dropdown-item" href="{{route('admin.edit',$admin->id)}}"><i class="fa fa-pencil ml-3"></i>ویرایش</a>
                                        <form action="{{route('admin.destroy',$admin->id)}}" method="post">
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
                    @if(!$isSuperAdmin && !count($admins))
                        <tr>
                            <td colspan="5">
                                موردی یافت نشد
                            </td>
                        </tr>
                    @endif
                @endif


                </tbody>
            </table>
        </div>
    </div>
    <script>
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

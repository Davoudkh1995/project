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
        <h3>دسترسی</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">سطوح دسترسی</li>
                <li class="breadcrumb-item">دسترسی</li>
            </ol>
        </nav>
    </div>
    <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            اقدامات
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="{{route('permission.create')}}">افزودن</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">دسترسی</h5>
        <div class="card-body">
            <table id="example1" style="width: 100%" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام دسترسی</th>
                    <th>توصیف دسترسی</th>
                    <th>ویرایش</th> 
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 0;
                @endphp
               
                @if(count($permissions))
                    @foreach($permissions as $key=>$permission)
                        <tr>
                            <td><?= ++$i ?></td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->label}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop2" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        اقدامات
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                        <a class="dropdown-item" href="{{route('permission.edit',$permission->id)}}"><i class="fa fa-pencil ml-3"></i>ویرایش</a>
                                        <form action="{{route('permission.destroy',$permission->id)}}" method="post">
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
                    <tr>
                        <td colspan="4">
                            موردی یافت نشد
                        </td>
                    </tr>
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

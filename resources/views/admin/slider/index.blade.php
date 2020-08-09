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
        <h3>اسلایدر</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">فهرست</li>
                <li class="breadcrumb-item">اسلایدر</li>
            </ol>
        </nav>
    </div>
    <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            اقدامات
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="{{route('slider.create')}}" style="cursor: pointer;">افزودن</a>
            <a class="dropdown-item" onclick="selectAll(this)" style="cursor: pointer;">انتخاب همه</a>
            <a class="dropdown-item" onclick="removeAll()" style="cursor: pointer;">حذف موارد</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">منو</h5>
        <div class="card-body">
            <table id="example1" style="width: 100%" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>مورد</th>
                    <th>ردیف</th>
                    <th>تصویر</th>
                    <th>عنوان</th>
                    <th>جایگاه</th>
                    <th>وضعیت</th>
                    <th>اقدامات</th>
                </tr>
                </thead>
                <tbody data-id="1">
                @foreach($items as $key=>$item)
                    <tr>
                        <td class="checkboxDiv" data-id="{{$item->id}}">
                            <div class="custom-control custom-checkbox custom-checkbox-dark">
                                <input type="checkbox" class="custom-control-input inputcheckbox"
                                       id="customCheck{{$item->id}}" onclick="checkItem(this,'{{$item->id}}')"
                                       name="ids[]" data-check="{{$item->id}}">
                                <label class="custom-control-label" for="customCheck{{$item->id}}"></label>
                            </div>
                        </td>
                        <td>{{$key+1}}</td>
                        <td><a href="{{$item->picture}}" target="_blank"><img src="{{$item->picture}}"
                                                                              alt="{{$item->title}}" width="150"
                                                                              height="100"></a></td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->PersianPriority}}</td>
                        <td>{{$item->PersianStatus}}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop2" type="button" class="btn btn-warning dropdown-toggle"
                                        data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    اقدامات
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                                    <a class="dropdown-item" href="{{route('slider.edit',$item->id)}}"><i
                                                class="fa fa-pencil ml-3"></i>ویرایش</a>
                                    <form action="{{route('slider.destroy',$item->id)}}" method="post">
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
                </tbody>
            </table>
        </div>
    </div>
    <script>
        var counter = 0;
        let arr_of_ids = [];

        function selectAll(tag) {
            var body = $('#example1').find('tbody');
            var checkboxes = body.find('.checkboxDiv');

            if (counter % 2 == 0) {
                checkboxes.each(function (index, value) {
                    var input = $(this).find('.inputcheckbox');
                    input.attr('checked', 'checked');
                    arr_of_ids.push(input.data('check'));
                    /*if(input.prop("checked") == true){
                        arr_of_ids.push(input.data('checkboxId'))
                    }*/
                });
            } else {
                checkboxes.each(function (index, value) {
                    var input = $(this).find('.inputcheckbox');
                    input.attr('checked', false);
                    arr_of_ids.splice(arr_of_ids.indexOf(input.data('check')),1);
                });
            }
            counter = counter + 1;
            console.log(arr_of_ids);
        }

        function removeAll() {

        }

        function checkItem(tag,id) {
            var input = $(tag);

            if(input.prop("checked") == false){
                var index = arr_of_ids.indexOf(+id);
                input.attr('checked', false);
                arr_of_ids.splice(index, 1);
            }else{
                input.attr('checked', 'checked');
                arr_of_ids.push(input.data('check'));
            }
            console.log(arr_of_ids);
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

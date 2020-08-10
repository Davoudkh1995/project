@extends('admin.master.index')
@section('content')
    <style>
        .form-check-input {
            margin-right: 0;
        }
    </style>
    <!-- begin::page header -->
    <div class="page-header">
        <h5>ویرایش اطلاعات نقشها</h5>
        <hr>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">سطوح دسترسی</li>
                <li class="breadcrumb-item">نقشها</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    اقدامات
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" style="cursor: pointer" href="/admin/role/create">ثبت
                        اطلاعات</a>
                    {{--                    <a class="dropdown-item" style="cursor: pointer" onclick="remove_all_submit()">حذف موارد</a>--}}
                </div>
            </div>
            <style>
                .table td, .table th {
                    vertical-align: middle;
                }
            </style>

            <div class="table-responsive">
                <table class="table table-bordered mt-4 text-center">
                    <thead>
                    <tr>
                        {{--                        <th>انتخاب</th>--}}
                        <th>ردیف</th>
                        <th>نام نقش</th>
                        <th>توصیف نقش</th>
                        <th>ویرایش</th>
                        {{--                        <th>حذف</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @if($isSuperAdmin)
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td>{{$superAdmin['name']}}</td>
                            <td>{{$superAdmin['label']}}</td>
                            <td><a href="{{route('role.edit',['id'=>$superAdmin['id']])}}"><i
                                            class="fa fa-edit font-size-23"
                                    ></i></a></td>
                        </tr>
                    @endif
                    @if(count($roles))

                        @foreach($roles as $key=>$role)
                            <tr>
                                {{--<td class="idCheckbox">
                                    <div class="custom-control custom-checkbox custom-checkbox-primary">
                                        <input type="checkbox" class="custom-control-input" value="{{$role->id}}"
                                               onclick="remove_all(this);" id="customCheck_{{$role->id}}">
                                        <label class="custom-control-label" for="customCheck_{{$role->id}}"></label>
                                    </div>
                                </td>--}}
                                <th scope="row"><?= ++$i ?></th>
                                <td>{{$role['name']}}</td>
                                <td>{{$role['label']}}</td>
                                <td><a href="{{route('role.edit',['id'=>$role['id']])}}"><i
                                                class="fa fa-edit font-size-23"
                                        ></i></a></td>
                                {{--<td>
                                    <form action="{{route('role.destroy',['id'=>$role['id']])}}" method="post" id="remove">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <a onclick="remove(this)" style="cursor: pointer"><i class="fa fa-remove font-size-23" style="color: #ff0000;"></i></a>
                                    </form>
                                </td>--}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">موردی یافت نشد</td>
                        </tr>
                    @endif

                    </tbody>
                </table>
                <script>
                    var allCheckedSelect = [];

                    function remove_all(variable) {
                        var tag = $(variable);
                        if (tag.prop("checked") == true) {
                            allCheckedSelect.push(tag.val());
                        } else {
                            allCheckedSelect.pop();
                        }
                    }

                    function remove_all_submit() {

                        Swal.fire({
                            title: 'توجه!',
                            text: "آیا اطمینان دارید؟",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3832a8',
                            cancelButtonColor: '#a83232',
                            confirmButtonText: 'حذف مورد',
                            cancelButtonText: 'انصراف',
                        }).then((result) => {
                            if (result.value) {
                                if (allCheckedSelect.length == 0) {
                                    Swal.fire({
                                        title: 'ناموفق!',
                                        text: "هیچ موردی انتخاب نشده دکمه های Ctrl + f5 را فشاد دهید و دوباره امتحان کنید",
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3832a8',
                                        cancelButtonColor: '#a83232',
                                        confirmButtonText: 'تایید',
                                    })
                                }
                                $.ajax({
                                    datatype: 'json',
                                    type: "post",
                                    cache: false,
                                    url: "{{route('multiRemoveRole')}}",
                                    data: {'_token': '{{csrf_token()}}', allCheckedSelect: allCheckedSelect},
                                    success: function (data) {
                                        if (data['delete'] === 'success') {
                                            Swal.fire({
                                                title: 'موفقیت!',
                                                text: "موارد حذف شدند",
                                                icon: 'success',
                                                showCancelButton: false,
                                                confirmButtonColor: '#3832a8',
                                                cancelButtonColor: '#a83232',
                                                confirmButtonText: 'تایید',
                                            }).then((result1) => {
                                                if (result1.value) {
                                                    location.reload();
                                                }
                                            })
                                        }
                                    }
                                })
                            }
                        });
                    }

                    function remove(variable) {
                        var tag = $(variable);
                        var form = tag.parents('#remove');
                        Swal.fire({
                            title: 'توجه!',
                            text: "آیا اطمینان دارید؟",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3832a8',
                            cancelButtonColor: '#a83232',
                            confirmButtonText: 'حذف مورد',
                            cancelButtonText: 'انصراف',
                        }).then((result) => {
                            if (result.value) {
                                form.submit();
                            }
                        })
                    }
                </script>

            </div>
        </div>
    </div>

    <script>
        var allCheckedSelect = [];

        function any(tag) {
            var tag = $(tag);
            var parentTag = tag.parent();


            if (tag.prop("checked") == true) {
                allCheckedSelect.push(tag.val());
//                alert(tag.val());
                var allCheckedSelectCount = allCheckedSelect.length;
                $('.checkedNumber').html('تعداد مورد انتخاب شده برابر است با : ' + allCheckedSelectCount + ' مورد ');
                $(".checkedNumber").fadeIn();
                if (!parentTag.hasClass('checked')) {
                    parentTag.addClass('checked');
                }
            } else {
                if (parentTag.hasClass('checked')) {
                    parentTag.removeClass('checked');
                }
                allCheckedSelect.pop();
                var allCheckedSelectCount = allCheckedSelect.length;
                $('.checkedNumber').html('تعداد مورد انتخاب شده برابر است با : ' + allCheckedSelectCount + ' مورد ');
                $(".checkedNumber").fadeIn();
            }
        }

        function submit() {
            var tbodyMultiRemove = $('.blogsTable').find('tbody');
            $.ajax({
                datatype: 'json',
                type: "post",
                cache: false,
                {{--url: "{{route('multiRemoveRole')}}",--}}
                data: {'_token': '{{csrf_token()}}', allCheckedSelect: allCheckedSelect},
                success: function (data) {
                    var roles = data['roles'];
                    if (data['delete'] == 'success') {
                        swal({
                            title: "مقاله مورد نظر با موفقیت حذف شد",
                            icon: "success",
                            button: "تایید",
                            allowOutsideClick: true,
                        });
                        tbodyMultiRemove.html('');
                        var counterMultiRemove = 1;
                        var spanCheck = '';
                        var inputCheck = '';
                        var i = 0;
                        $.each(roles, function (key, value) {
                                if (allCheckedSelect[i] == value['id']) {
                                    spanCheck = 'checked';
                                    inputCheck = 'checked';
                                } else {
                                    spanCheck = '';
                                    inputCheck = '';
                                }
                                var itemMultiRemove = ' <tr><td class="idCheckbox"><div class="checker bg-white"><span class="' + spanCheck + '"><input class="check styled" type="checkbox" name="id" value="' + value['id'] + '" onclick="any(this);" ' + inputCheck + '></span></div></td>'
                                    + '<td>' + counterMultiRemove + '</td>'
                                    + '<td></a>' + value['name'] + '</td>'
                                    + '<td></a>' + value['label'] + '</td>'
                                    + '<td><a href="/admin/role/' + value["id"] + '/edit"><i class="glyphicon glyphicon-edit" style="color: #000;width:15px;height: 19px"></i></a></td>'
                                    + '<td><a id="' + value['id'] + '" class="singleRemove" onclick="singleRemoveFunc(this);"><i class="glyphicon glyphicon-remove cross" style="color: red"></i></a></td></tr>';
                                tbodyMultiRemove.append(itemMultiRemove);
                                counterMultiRemove = counterMultiRemove + 1;
                                i = i + 1;
                            }
                        );
                        i = 0;
                    }
//                    var paginate = data['paginate'];
//                    $('.my_paginate').find('.paginateSpan').remove();
//                    $('.my_paginate').find('.paginateSpan').append(paginate);
//                    allCheckedSelect = [];
                }
            })
            ;

        }
    </script>

    {{--search with enter--}}
    <script>
        $('#searchTitle').keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                var tag = $('.search');
                searchBlog(tag);
            }
        });
    </script>

    {{--search with button--}}
    <script>
        function searchBlog(tag) {
//            console.log(allCheckedSelect);
            var tbody1 = $('.blogsTable').find('tbody');
            var tag = $(tag);
            var value = tag.parents('.searchBox').find('#searchTitle').val();
            $.ajax({
                datatype: 'json',
                type: "post",
                cache: false,
                {{--                url: "{{route('searchTitleRole')}}",--}}
                data: {'_token': '{{csrf_token()}}', value: value},
                success: function (data) {
                    var custom = data['roles'];
                    var counter1 = 1;
                    tbody1.html('');
                    var spanCheck = '';
                    var inputCheck = '';


                    $.each(custom, function (key, value) {
                        var checking = "" + value['id'];
                        if (allCheckedSelect.includes(checking)) {
                            spanCheck = 'checked';
                            inputCheck = 'checked';
                            console.log('yes')
                        } else {
                            spanCheck = '';
                            inputCheck = '';
                            console.log('no')
                        }

                        var item1 = ' <tr><td class="idCheckbox"><div class="checker bg-white"><span class="' + spanCheck + '"><input class="check styled" type="checkbox" name="id" value="' + value['id'] + '" onclick="any(this);" ' + inputCheck + '></span></div></td>'
                            + '<td>' + counter1 + '</td>'
                            + '<td>' + value['name'] + '</td>'
                            + '<td>' + value['label'] + '</td>'
                            + '<td><a href="/admin/role/' + value["id"] + '/edit"><i class="glyphicon glyphicon-edit" style="color: #000;width:15px;height: 19px"></i></a></td>'
                            + '<td><a id="' + value['id'] + '" class="singleRemove" onclick="singleRemoveFunc(this);"><i class="glyphicon glyphicon-remove cross" style="color: red"></i></a></td></tr>';
                        tbody1.append(item1);
                        counter1 = counter1 + 1;
                    });

//                    var paginate = data['paginate'];
                    $('.my_paginate').find('.paginateSpan').remove();

                    $('.searchNumber').html('تعداد مورد یافت شده برابر است با : ' + data['size'] + ' مورد ');
                    $(".searchNumber").fadeIn();
//                    $('.my_paginate').find('.paginateSpan').append(paginate);
                }
            })

        }
    </script>


    {{-- remove blogs together --}}


    {{-- delete articles together sweetalert --}}
    <script>
        @if(session()->get('article_delete')=='success')
        swal({
            title: "مقاله مورد نظر با موفقیت حذف شد",
            icon: "success",
            button: "تایید",
            allowOutsideClick: true,
        });
        @endif
    </script>

    {{-- remove single blog --}}
    <script>
        //        $(".singleRemove").each(function () {
        //            $(this).on("click", function () {
        //                singleRemoveFunc();
        function singleRemoveFunc(tag) {
            var tag = $(tag);
            var id = tag.attr('id');
            var checking = "" + id;
            if (allCheckedSelect.includes(checking)) {
                var index = allCheckedSelect.indexOf(checking);
                console.log(index);
                allCheckedSelect.splice(index, 1);
                console.log(allCheckedSelect);
                var allCheckedSelectCount = allCheckedSelect.length;
                $(".checkedNumber").fadeOut();
                $('.checkedNumber').html('تعداد مورد انتخاب شده برابر است با : ' + allCheckedSelectCount + ' مورد ');
                $(".checkedNumber").fadeIn();
            }
            swal({
                buttons: {
                    cancel: true,
                    confirm: true
                },
                title: 'حذف شود',
                text: "اطمینان به انجام این عمل دارید؟",
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-success',
                confirmButtonText: 'تایید',
                cancelButtonText: 'انصراف',
            }, function (isConfirm) {
                if (isConfirm) {
                    var tbodySingleRemove = $('.blogsTable').find('tbody');
                    $.ajax({
                        datatype: 'json',
                        type: "post",
                        cache: false,
                        {{--                        url: "{{route('singleRemoveRole')}}",--}}
                        data: {'_token': '{{csrf_token()}}', roleId: id},
                        success: function (data) {
                            var custom = data['roles'];
                            var counterSingleRemove = 1;
                            tbodySingleRemove.html('');
                            var spanCheck = '';
                            var inputCheck = '';
                            $.each(custom, function (key, value) {
                                var checking = "" + value['id'];
                                if (allCheckedSelect.includes(checking)) {
                                    spanCheck = 'checked';
                                    inputCheck = 'checked';
                                    console.log('yes')
                                } else {
                                    spanCheck = '';
                                    inputCheck = '';
                                    console.log('no')
                                }
                                var itemSingleRemove = ' <tr><td class="idCheckbox"><div class="checker bg-white"><span class="' + spanCheck + '"><input class="check styled" type="checkbox" name="id" value="' + value['id'] + '" onclick="any(this);" ' + inputCheck + '></span></div></td>'
                                    + '<td>' + counterSingleRemove + '</td>'
                                    + '<td>' + value['name'] + '</td>'
                                    + '<td>' + value['label'] + '</td>'
                                    + '<td><a href="/admin/roles/' + value["id"] + '/edit"><i class="glyphicon glyphicon-edit" style="color: #000;width:15px;height: 19px"></i></a></td>'
                                    + '<td><a id="' + value['id'] + '" class="singleRemove" onclick="singleRemoveFunc(this);"><i class="glyphicon glyphicon-remove cross" style="color: red"></i></a></td></tr>';
                                tbodySingleRemove.append(itemSingleRemove);
                                counterSingleRemove = counterSingleRemove + 1;

                            });

//                            var paginate = data['paginate'];
//                            $('.my_paginate').find('.paginateSpan').remove();
//                            $('.my_paginate').find('.paginateSpan').append(paginate);
                        }
                    })
                }
            })

        }

        //        $('#searchTitle').focusout(function () {
        //            $(".searchNumber").fadeOut();
        //        });
        $('.check').focusout(function () {
            $(".checkedNumber").fadeOut();
        });
    </script>

@endsection
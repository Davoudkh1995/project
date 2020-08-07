@extends('admin.master.index')
@section('header')
    <div>
        <h3>داشبورد</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">فهرست</li>
                <li class="breadcrumb-item">داشبورد</li>
            </ol>
        </nav>
    </div>
    <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            اقدامات
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
            <a class="dropdown-item" href="#">عمل</a>
            <a class="dropdown-item" href="#">عمل دیگر</a>
            <a class="dropdown-item" href="#">یک عمل دیگر</a>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <h5 class="card-header">داشبورد</h5>
        <div class="card-body">
            <p class="card-text">شما وارد شدید</p>
        </div>
    </div>

@endsection

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>پنل مدیریت سایت شرکتی | گروه رونیکا</title>

    <!-- begin::global styles -->
    <link rel="stylesheet" href="/admin/assets/vendors/bundle.css" type="text/css">
    <!-- end::global styles -->

    <!-- begin::custom styles -->
    <link rel="stylesheet" href="/admin/assets/css/app.css" type="text/css">
    <!-- end::custom styles -->

    <!-- begin::favicon -->
    <link rel="shortcut icon" href="/admin/assets/media/image/favicon.png">
    <!-- end::favicon -->

    <!-- begin::theme color -->
    <meta name="theme-color" content="#3f51b5" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- end::theme color -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body class=" h-100-vh p-t-0" style="background: #33080d;">

<!-- begin::page loader-->
<div class="page-loader">
    <div class="spinner-border"></div>
    <span>در حال بارگذاری ...</span>
</div>
<!-- end::page loader -->

<div class="container h-100-vh">
    @yield('content')
</div>

<!-- begin::global scripts -->
<script src="/admin/assets/vendors/bundle.js"></script>
<!-- end::global scripts -->

<!-- begin::custom scripts -->
<script src="/admin/assets/js/app.js"></script>
<!-- end::custom scripts -->

</body>
</html>

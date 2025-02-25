<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title') | admin controller</title>


    <!-- Custom fonts for this template-->
    <link href="{{ secure_asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom styles for this template-->
    <link href="{{secure_asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
</head>

<body id="page-top">

        <div id="wrapper">
            @include('admin/side')
            
            <div id="content-wrapper" class="d-flex flex-column">
                @include('admin/topbar')
                @yield('content')                
            </div>
            
            
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="{{ secure_asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ secure_asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ secure_asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ secure_asset('js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ secure_asset('vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ secure_asset('js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ secure_asset('js/demo/chart-pie-demo.js') }}"></script>

        <!-- เพิ่ม Font Awesome และ Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap 5.3.0 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- เพิ่มไว้ก่อนปิด body tag ใน layout-admin -->
        @yield('scripts')
    </body>
</html>

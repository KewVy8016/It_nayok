<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | เเผนกเทคโนโลยีสารสนเทศ วิทยาลัยเทคนิคนครนายก</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>

<style>
    body {
        min-height: 100vh;
        margin: 0;
        padding: 0;
        padding-top: 70px; /* ปรับให้ตรงกับความสูงของ Navbar */
    }


</style>
</head>

<body>
    <!-- Sticky Navigation -->
    <nav>
        <div class="container-fluid">
            @include('component/user/nav')
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-1">
        @yield('content')
    </main>

    <!-- Footer -->
    @yield('footer', view('component/user/footer'))

    
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
     <!-- เพิ่ม Font Awesome และ Bootstrap Icons -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</body>

</html>

<style>
    /* Styling สำหรับ Navbar โดยใช้ class เฉพาะ */
    .custom-navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        height: 70px;
        z-index: 1030;
    }

    .custom-navbar .navbar-logo {
        height: 40px;
        width: auto;
        vertical-align: middle;
    }

    .custom-navbar .navbar-brand {
        font-size: 1.5rem;
        color: white !important;
    }

    .custom-navbar .navbar-nav .nav-link {
        font-weight: 500;
        padding: 10px 15px;
        border-radius: 5px;
        color: white !important;
        transition: color 0.3s ease, background-color 0.3s ease;
    }

    .custom-navbar .navbar-nav .nav-link:hover {
        background-color: #0056b3;
        color: #ffffff !important;
    }

    .custom-navbar .dropdown-menu {
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-navbar .dropdown-item:hover {
        background-color: #0056b3;
        color: white !important;
    }

    /* Responsive Styles */
    @media (max-width: 992px) {
        .custom-navbar #navbarMenu {
            display: none;
            position: absolute;
            top: 70px;
            /* ความสูงของ navbar */
            left: 0;
            right: 0;
            background-color: #007bff;
        }

        .custom-navbar #navbarMenu.show {
            display: block;
        }

        .custom-navbar .navbar-nav {
            padding: 15px;
        }

        .custom-navbar .dropdown-menu {
            background-color: #0056b3;
            border: none;
        }

        .custom-navbar .dropdown-item {
            color: white;
        }
    }
</style>

<nav class="custom-navbar navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container">
        <!-- เปลี่ยนจาก container-fluid เป็น container -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('img/logo2.png') }}" alt="Logo" class="navbar-logo me-2">

        </a>
        <button id="customToggle" class="btn btn-outline-light d-lg-none" type="button">
            Menu
        </button>
        <div id="navbarMenu" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">หน้าหลัก</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        เกี่ยวกับ
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                        <li><a class="dropdown-item" href="{{ route('about') }}">ประวัติแผนกวิชา</a></li>
                        <li><a class="dropdown-item" href="{{ route('about_teacher') }}">บุคลากร</a></li>
                        <li><a class="dropdown-item" href="{{ route('course') }}">หลักสูตร</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">ติดต่อเรา</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('student_trophy')}}">ผลงาน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('student')}}">นักเรียน/นักศึกษา</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    document.getElementById('customToggle').addEventListener('click', function() {
        const navbarMenu = document.getElementById('navbarMenu');
        if (navbarMenu.classList.contains('show')) {
            navbarMenu.classList.remove('show');
        } else {
            navbarMenu.classList.add('show');
        }
    });
</script>

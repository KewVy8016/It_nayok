@extends('layout')
@section('title', 'หลักสูตรเทคโนโลยีสารสนเทศ')
@section('content')
    <style>
        .card-img-wrapper {
            height: 400px;
            /* ปรับความสูงตามต้องการ */
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* ทำให้รูปภาพครอบคลุมพื้นที่ container */
            object-position: top;
            /* จัดตำแหน่งรูปภาพให้แสดงส่วนหัวหรือครึ่งตัว */
        }

        /* Hero Section Styling */
        .hero-section {
            position: relative;
            height: 70vh;
            min-height: 500px;
            background-image: url('{{ asset('img/Course.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.3));
        }

        /* ปรับปรุง Section Headers */
        .section-header {
            position: relative;
            margin-bottom: 4rem;
        }

        .section-header::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, #0d6efd, #0dcaf0);
            border-radius: 2px;
        }

        /* ปรับปรุงการ์ดวิชา */
        .subject-card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            background: white;
            height: 100%;
        }

        .subject-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .subject-card .card-body {
            padding: 2rem;
        }

        /* ปรับปรุงการ์ดแผนการเรียน */
        .course-plan-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            height: 100%;
        }

        .course-plan-card .card-img-top {
            height: 250px;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .course-plan-card:hover .card-img-top {
            transform: scale(1.05);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-section {
                height: 60vh;
            }

            .display-3 {
                font-size: 2.5rem;
            }

            .lead {
                font-size: 1rem;
            }

            .subject-card .card-body {
                padding: 1.5rem;
            }

            .course-plan-card .card-img-top {
                height: 200px;
            }
        }

        @media (max-width: 768px) {
            .card-img-wrapper {
                height: 300px;
                /* ปรับความสูงสำหรับหน้าจอเล็ก */
            }
        }

        /* เพิ่ม Container Styling */
        .container {
            padding: 0 1.5rem;
        }

        /* ปรับปรุง Section Spacing */
        section {
            padding: 5rem 0;
        }

        /* ปรับปรุง Button Styling */
        .btn-custom {
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* เพิ่ม Grid Spacing */
        .row {
            --bs-gutter-x: 2rem;
            --bs-gutter-y: 2rem;
        }

        /* ปรับปรุง Typography */
        h2.display-4 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .text-gradient {
            background: linear-gradient(45deg, #0d6efd, #0dcaf0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container position-relative h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-8 text-white">
                    <h1 class="fw-bold display-4 mb-4">หลักสูตรเทคโนโลยีสารสนเทศ</h1>
                    <p class="lead mb-4">พัฒนาทักษะด้าน IT สู่การเป็นมืออาชีพในยุคดิจิทัล</p>
                    <a href="#courses" class="btn btn-primary btn-custom">
                        <i class="bi bi-arrow-down-circle me-2"></i>ดูเเผนการเรียน
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- วิชาที่เรียน Section -->
    <section id="courses-list" class="py-5">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="display-4 text-gradient">วิชาที่เรียนในหลักสูตร</h2>
                <p class="lead text-muted mx-auto" style="max-width: 700px;">
                    หลักสูตรเทคโนโลยีสารสนเทศประกอบด้วยวิชาต่างๆ ที่เน้นทักษะที่ทันสมัยและจำเป็นในวงการ IT
                </p>
            </div>

            <div class="row g-4">
                @foreach ($subject as $subjects)
                    <div class="col-md-4">
                        <div class="subject-card card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-wrapper me-3">
                                        <i class="bi bi-book-fill text-primary fs-4"></i>
                                    </div>
                                    <h5 class="card-title mb-0 fw-bold">{{ $subjects->name }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- แผนการเรียน Section -->
    <section id="courses" class="py-5 bg-light">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="display-4 text-gradient">แผนการเรียน</h2>
                <p class="lead text-muted mx-auto" style="max-width: 700px;">
                    วิทยาลัยเทคนิคนครนายก... พัฒนาทักษะ สร้างอาชีพ ก้าวไกลสู่ความเป็นมืออาชีพ!
                </p>
            </div>

            <div class="row g-4">
                <!-- Card for ปวช -->
                <div class="col-lg-6">
                    <div class="course-plan-card card">
                        <div class="card-img-wrapper">
                            <img src="{{ asset('img/vocational.png') }}" class="card-img-top w-100 h-100" alt="ปวช">
                        </div>
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-3">หลักสูตร ปวช. เทคโนโลยีสารสนเทศ</h3>
                            <p class="text-muted mb-4">
                                เรียนรู้ทักษะพื้นฐานและการใช้งานเทคโนโลยีสารสนเทศ พร้อมเปิดโอกาสในการเริ่มต้นอาชีพในวงการ IT
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('vocational') }}" class="btn btn-primary btn-custom">
                                    <i class="bi bi-arrow-right-circle me-2"></i>ดูรายละเอียด
                                </a>
                                <span class="badge bg-light text-primary p-2">3 ปี</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card for ปวส -->
                <div class="col-lg-6">
                    <div class="course-plan-card card">
                        <div class="card-img-wrapper ">
                            <img src="{{ asset('img/diploma.png') }}" class="card-img-top w-100 h-100" alt="ปวส">
                        </div>
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-3">หลักสูตร ปวส. เทคโนโลยีสารสนเทศ</h3>
                            <p class="text-muted mb-4">
                                พัฒนาทักษะขั้นสูงในการใช้งานและพัฒนาเทคโนโลยีสารสนเทศเพื่อรองรับการทำงานในระดับมืออาชีพ
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('diploma') }}" class="btn btn-success btn-custom">
                                    <i class="bi bi-arrow-right-circle me-2"></i>ดูรายละเอียด
                                </a>
                                <span class="badge bg-light text-success p-2">2 ปี</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection

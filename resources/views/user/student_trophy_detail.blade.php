@extends('layout')
@section('title', 'รายละเอียดผลงาน')
@section('content')
    <div class="container py-2">
        <div class="card shadow">
            <div class="card-header header-custom">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-bold text-white">รายละเอียดผลงานนักเรียน</h4>
                        <a href="{{ url()->previous() }}" class="btn-back">
                            <span class="me-2">ย้อนกลับ</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ส่วนเนื้อหาอื่นๆ คงเดิม -->
            <div class="card-body p-0">
                <!-- รูปภาพด้านบน -->
                <div class="trophy-image-wrapper">
                    <img src="{{ Storage::url($trophy->image) }}" alt="รูปผลงาน" class="trophy-image">
                </div>

                <div class="trophy-info p-4 p-lg-5">
                    <div class="info-grid">
                        <div class="info-item">
                            <h5 class="info-label">ชื่อผลงาน</h5>
                            <p class="info-value">{{ $trophy->trophy_name }}</p>
                        </div>

                        <div class="info-item">
                            <h5 class="info-label">ประเภทผลงาน</h5>
                            <p class="info-value">{{ $trophy->trophy_type }}</p>
                        </div>
                        <div class="info-item">
                            <h5 class="info-label">ระดับรางวัล</h5>
                            <p class="info-value">{{ $trophy->trophy_level}}</p>
                        </div>

                        <div class="info-item">
                            <h5 class="info-label">วันที่ได้รับรางวัล</h5>
                            <p class="info-value">
                                {{ \Carbon\Carbon::parse($trophy->date)->locale('th')->isoFormat('D MMMM YYYY') }}
                            </p>
                        </div>

                        <div class="info-item">
                            <h5 class="info-label">สถานที่</h5>
                            <p class="info-value">{{ $trophy->placename }}</p>
                        </div>

                        <div class="info-item">
                            <h5 class="info-label">รายละเอียด</h5>
                            <p class="info-value">{{ $trophy->trophy_detail }}</p>
                        </div>

                        @php
                            $student_names = array_filter(explode(',', $trophy->student_name));
                        @endphp

                        <div class="info-item">
                            <h5 class="info-label">นักศึกษา</h5>
                            <div class="info-value">
                                <ul class="student-list">
                                    @foreach ($student_names as $name)
                                        <li>{{ trim($name) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="info-item">
                            <h5 class="info-label">ครูที่ปรึกษา</h5>
                            <p class="info-value">{{ $trophy->teacher_name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* สไตล์ใหม่สำหรับส่วน header */
        .header-custom {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 1.5rem 1rem;
            border-bottom: none;
        }

        .btn-back {
            background-color: #ffffff;
            color: #1e3c72;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-back:hover {
            background-color: #f8f9fa;
            color: #1e3c72;
            transform: translateX(5px);
        }

        /* สไตล์เดิมที่เหลือคงเดิม */
        .trophy-image-wrapper {
            position: relative;
            width: 100%;
            height: 500px;
            background-color: #f8f9fa;
            overflow: hidden;
        }

        .trophy-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .trophy-info {
            background-color: #ffffff;
        }

        .info-grid {
            display: grid;
            gap: 1.5rem;
            max-width: 900px;
            margin: 0 auto;
        }

        .info-item {
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 1.5rem;
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 1rem;
            color: #212529;
            margin-bottom: 0;
            line-height: 1.6;
        }

        .student-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .student-list li {
            position: relative;
            padding-left: 1rem;
            margin-bottom: 0.5rem;
        }

        .student-list li:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #0d6efd;
        }

        .student-list li:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 991.98px) {
            .trophy-image-wrapper {
                height: 300px;
            }

            .info-grid {
                gap: 1rem;
            }

            .info-item {
                padding-bottom: 1rem;
            }

            .header-custom {
                padding: 1rem;
            }

            .btn-back {
                padding: 0.4rem 1rem;
                font-size: 0.9rem;
            }
        }

        @media (min-width: 992px) {
            .trophy-image-wrapper {
                height: 500px;
            }
        }
    </style>
@endsection

@section('footer') {{-- ลบ Footer ออก --}} @endsection
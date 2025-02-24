@extends('layout')
@section('title', 'ผลงานนักเรียน')
@section('content')
    <style>
        .project-card {
            transition: all 0.3s ease;
            height: 100%;
        }

        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .project-image {
            height: 250px;
            object-fit: cover;
        }

        .category-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .filter-button.active {
            background-color: #0d6efd !important;
            color: white !important;
        }
    </style>

    <div class="container py-5">
        <!-- หัวข้อและตัวกรอง -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="mb-3" style="border-left: 5px solid #0d6efd; padding-left: 15px;">ผลงานนักเรียนทั้งหมด</h2>
                <hr class="mb-4">
            </div>
        </div>

        <!-- แถวที่ 1 -->
        <div class="row g-4">
            <!-- ผลงาน 1 -->
            @foreach ($trophy as $item)
                <!-- ผลงาน 1 -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card project-card">
                        <div class="position-relative">
                            <img src="{{ Storage::url($item['image']) }}" class="card-img-top project-image" alt="project">
                            <span class="badge bg-primary category-badge">{{ $item->trophy_type }}</span>
                        </div>
                        <div class="card-body">
                            @php
                                $badgeColor = match ($item->trophy_level) {
                                    'ชนะเลิศ' => 'warning', // gold color for first place
                                    'รองชนะเลิศอันดับ 1' => 'secondary', // silver color for second place
                                    'รองชนะเลิศอันดับ 2' => 'danger', // bronze color for third place
                                    'ชมเชย' => 'info', // blue for honorable mention
                                    'เข้าร่วม' => 'primary', // standard blue for participation
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeColor }} me-2">{{ $item->trophy_level }}</span>
                            <h5 class="card-title">{{ $item->trophy_name }}</h5>
                            <p class="card-text text-muted">{{ \Str::limit($item->trophy_detail, 200, '...') }}</p>
                            <div class="d-flex align-items-center mt-3">
                                <div>
                                    @php
                                        $student_names = $item->student_name;
                                        $student_names = array_filter(explode(',', $item->student_name));
                                    @endphp
                                    @foreach ($student_names as $name)
                                        <h6 class="mb-0">นักศึกษา {{ trim($name) }}</h6>
                                    @endforeach
                                    <h6 class="mb-0">อาจารย์ {{ $item->teacher_name }}</h6>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <small
                                    class="text-muted">{{ \Carbon\Carbon::parse($item->date)->locale('th')->isoFormat('D MMMM YYYY') }}</small>
                                <a href="{{ route('student_trophy_detail', ['id' => $item->id]) }}"
                                    class="btn btn-outline-primary btn-sm">ดูรายละเอียด</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

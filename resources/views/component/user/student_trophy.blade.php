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
</head>

<body>

    <div class="container py-5">
        <!-- หัวข้อและตัวกรอง -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="position-relative d-inline-block mb-4">
                    ผลงานนักเรียน
                    <div class="position-absolute start-0 end-0 bottom-0" style="height: 3px; width: 100%;">
                        <div class="bg-primary h-100"></div>
                    </div>
                </h2>
                <div class="d-flex align-items-center gap-3">
                    <p class="text-muted lead mb-0">รวบรวมผลงานและความสำเร็จของนักเรียนในการแข่งขันต่างๆ</p>
                    <div class="bg-light rounded-3 shadow-sm p-2">
                        <span class="badge bg-primary px-3 py-2 me-2">ผลงานทั้งหมด</span>
                        <span class="text-primary">
                            <i class="fas fa-trophy me-1"></i>
                            {{ count($trophy) }} รายการ
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- กริดแสดงผลงาน -->
        <div class="row g-4 justify-content-center">
            @foreach ($trophy as $item)
            <!-- ผลงาน 1 -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card project-card">
                <div class="position-relative">
                    <img src="{{ Storage::url($item['image']) }}" class="card-img-top project-image"
                    alt="project">
                    <span class="badge bg-primary category-badge">{{ $item->trophy_type }}</span>
                </div>
                <div class="card-body">
                    @php
                        $badgeColor = match($item->trophy_level) {
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
                        @foreach($student_names as $name)
                            <h6 class="mb-0">นักศึกษา {{ trim($name) }}</h6>
                        @endforeach
                        <h6 class="mb-0">อาจารย์ {{$item->teacher_name}}</h6>
                        
                    </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">{{ \Carbon\Carbon::parse($item->date)->locale('th')->isoFormat('D MMMM YYYY') }}</small>
                    <a href="{{ route('student_trophy_detail',['id' => $item->id])}}" class="btn btn-outline-primary btn-sm">ดูรายละเอียด</a>
                    </div>
                </div>
                </div>
            </div>
            @endforeach


            <!-- ปุ่มดูเพิ่มเติม -->
            <div class="text-center mt-5">
                <a href="{{ route('student_trophy') }}" class="btn btn-primary px-4 py-2">
                    ดูผลงานเพิ่มเติม
                </a>
            </div>
        </div>

        <script>
            // สคริปต์สำหรับปุ่มตัวกรอง
            const filterButtons = document.querySelectorAll('.filter-button');
            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });
        </script>

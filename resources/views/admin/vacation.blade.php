<link rel="stylesheet" href="{{ secure_asset('css/admin/teacher-form.css') }}">
@extends('layout-admin')

@section('title', 'Table vocational')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>เเผนการเรียนปวช.</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fileUploadModal">
                    Add File
                </button>
            </div>
            <div class="card-body">
                {{-- success message --}}
                @if (session('status'))
                    <div class="container"> 
                        <div class="alert mt-2 alert-{{ session('status')['type'] }}">
                            {{ session('status')['message'] }}
                        </div>
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr class="align-middle text-center">
                            <th>ระดับการศึกษา</th>
                            <th>ปี พ.ศ.</th>
                            <th>ไฟล์</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studyplan as $item)
                        <tr class="align-middle text-center">
                            <td class="align-middle">{{ $item->name }}</td>
                            <td class="align-middle">{{ $item->year }}</td>
                            <td class="align-middle">
                                <a href="{{ Storage::url($item->pathfile) }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="fas fa-file-pdf"></i> ดูไฟล์
                                </a>
                            </td>
                            <td class="align-middle">
                                <form action="{{ route('delete_studyplan', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบไฟล์นี้ใช่หรือไม่?')">
                                        <i class="fas fa-trash"></i> ลบ
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Vacation Modal -->
        <div class="modal fade" id="addVacationModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Vacation Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control" name="start_date" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control" name="end_date" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Supporting Document</label>
                                <input type="file" class="form-control" name="document">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Reason</label>
                                <textarea class="form-control" name="reason" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal สำหรับเพิ่มไฟล์ -->
    <div class="modal fade" id="fileUploadModal" tabindex="-1" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="fileUploadModalLabel">
                        <i class="fas fa-upload me-2"></i>อัพโหลดไฟล์
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('insert_studyplan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="educationLevel" class="form-label fw-bold">ระดับการศึกษา</label>
                                <select class="form-select" id="educationLevel" name="educationLevel" required>
                                    <option value="" disabled selected>เลือกระดับการศึกษา</option>
                                    <option value="ปวช.">ปวช.</option>
                                    <option value="ปวส.">ปวส.</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="year" class="form-label fw-bold">ปี พ.ศ.</label>
                                <input type="number" class="form-control" id="year" name="year" min="2543"
                                    max="2643" placeholder="ระบุปี พ.ศ." required>
                            </div>
                            <div class="col-12">
                                <label for="fileUpload" class="form-label fw-bold">เลือกไฟล์</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-file-alt"></i></span>
                                    <input type="file" class="form-control" id="fileUpload" name="fileUpload"
                                        accept=".pdf" required onchange="updateFileName()">
                                </div>
                                <div id="fileName" class="mt-2 text-muted"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>ยกเลิก
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-cloud-upload-alt me-1"></i>อัพโหลด
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CSS ปรับแต่งใหม่ -->
    <style>
        .modal-content {
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px;
        }

        .input-group-text {
            background-color: #eef1f6;
            border-radius: 8px 0 0 8px;
        }

        .btn {
            border-radius: 8px;
            padding: 10px 24px;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004999;
        }

        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
        }

        .input-group .form-control {
            flex: 1;
        }

        @media (max-width: 576px) {
            .modal-dialog {
                margin: 1rem;
            }
        }
    </style>

    <script>
        function updateFileName() {
            var input = document.getElementById('fileUpload');
            var fileName = input.files.length > 0 ? input.files[0].name : "ยังไม่ได้เลือกไฟล์";
            document.getElementById('fileName').textContent = "ไฟล์ที่เลือก: " + fileName;
        }
    </script>
    <script>
        // ตั้งค่าเริ่มต้นของปีเป็นปี พ.ศ. ปัจจุบัน
        document.addEventListener("DOMContentLoaded", function() {
            var yearInput = document.getElementById('year');
            var currentYear = new Date().getFullYear() + 543; // แปลง ค.ศ. เป็น พ.ศ.
            yearInput.value = currentYear;
        });
    </script>


@endsection

@section('scripts')
    <!-- ตรวจสอบว่าในไฟล์ layout-admin มี Bootstrap JS และ jQuery หรือไม่ -->
    <!-- หากไม่มี ให้เพิ่มตรงนี้ -->


    <script>
        $(document).ready(function() {
            // การทำงานของ Modal ควรทำงานอัตโนมัติด้วย Bootstrap JS
            // แต่ถ้ายังไม่ทำงาน เราสามารถเพิ่มโค้ดนี้
            $('.btn[data-bs-toggle="modal"]').click(function() {
                var target = $(this).data('bs-target');
                $(target).modal('show');
            });
        });
    </script>



@endsection

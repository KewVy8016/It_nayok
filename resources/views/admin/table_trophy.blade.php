@extends('layout-admin')

@section('title', 'จัดการข้อมูลรางวัล')
@section('content')
    <div class="container d-flex justify-content-start mb-3">
        <a href="{{ route('add-trophy') }}" class="btn btn-success rounded-pill px-4">
            <i class="bi bi-plus-circle me-2"></i> เพิ่มผลงานใหม่
        </a>
    </div>
    <div class="container mt-1">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" style="width: 5%;">ID</th>
                            <th class="text-center" style="width: 12%;">รูปภาพ</th>
                            <th class="text-center" style="width: 18%;">ชื่อรางวัล</th>
                            <th class="text-center" style="width: 10%;">ประเภท</th>
                            <th class="text-center" style="width: 10%;">ระดับ</th>
                            <th class="text-center" style="width: 12%;">สถานที่</th>
                            <th class="text-center" style="width: 10%;">วันที่</th>
                            <th class="text-center" style="width: 13%;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!$trophys || count($trophys) == 0)
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-trophy fs-3 d-block mb-3"></i>
                                        ไม่มีข้อมูลรางวัล
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($trophys as $trophy)
                            <tr>
                                <td class="text-center align-middle">{{ $trophy->id }}</td>
                                <td class="text-center">
                                    <div class="image-wrapper">
                                        @if($trophy->image)
                                            <img src="{{ Storage::url($trophy->image) }}" alt="trophy image">
                                        @else
                                            <div class="no-image">
                                                <i class="bi bi-image text-secondary"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="title-text">{{ \Illuminate\Support\Str::limit($trophy->trophy_name, 80) }}</div>
                                    <small class="text-muted">
                                        ครู: {{ \Illuminate\Support\Str::limit($trophy->teacher_name, 25) }}
                                    </small>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="category-badge">{{ $trophy->trophy_type }}</span>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="level-badge">{{ $trophy->trophy_level }}</span>
                                </td>
                                <td class="text-center align-middle">{{ \Illuminate\Support\Str::limit($trophy->placename, 20) }}</td>
                                <td class="text-center align-middle">
                                    <div class="text-muted">
                                        {{ \Carbon\Carbon::parse($trophy->date)->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-sm me-1 edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editTrophyModal" 
                                            data-id="{{ $trophy->id }}"
                                            data-name="{{ $trophy->trophy_name }}" 
                                            data-detail="{{ $trophy->trophy_detail }}"
                                            data-type="{{ $trophy->trophy_type }}"
                                            data-level="{{ $trophy->trophy_level }}"
                                            data-place="{{ $trophy->placename }}"
                                            data-date="{{ $trophy->date }}"
                                            data-teacher="{{ $trophy->teacher_name }}"
                                            data-student="{{ $trophy->student_name }}"
                                            data-image="{{ $trophy->image ? Storage::url($trophy->image) : '' }}"
                                            data-image-path="{{ $trophy->image }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <a href="{{ route('delete_trophy', $trophy->id) }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('คุณต้องการลบรางวัลนี้ใช่หรือไม่?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal แก้ไขรางวัล -->
    <div class="modal fade" id="editTrophyModal" tabindex="-1" aria-labelledby="editTrophyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editTrophyModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>แก้ไขข้อมูลรางวัล
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editTrophyForm" action="{{route('update_trophy')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="trophy_id" id="edit_trophy_id">
                        <input type="hidden" name="current_image_path" id="current_image_path">
                        <div class="row mb-4">
                            <div class="col-md-4 text-center">
                                <div class="edit-image-preview mb-3">
                                    <img id="edit_image_preview" src="" alt="รูปภาพรางวัล" class="img-fluid rounded">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_trophy_image" class="form-label fw-bold">เปลี่ยนรูปภาพ</label>
                                    <input type="file" class="form-control" id="edit_trophy_image" name="trophy_image"
                                        accept="image/*">
                                    <small class="form-text text-muted">
                                        ขนาดไฟล์ไม่เกิน 2MB | รองรับ JPEG, PNG, GIF
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="edit_trophy_name" class="form-label fw-bold">ชื่อรางวัล <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_trophy_name" name="trophy_name"
                                        required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="edit_trophy_type" class="form-label fw-bold">ประเภทผลงาน <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="edit_trophy_type" name="trophy_type" required>
                                                <option value="">เลือกประเภทผลงานนักเรียน</option>
                                                <option value="การเเข่งขัน">การเเข่งขัน</option>
                                                <option value="โครงงาน">โครงงาน</option>
                                                <option value="ประกวด">ประกวด</option>
                                            </select>
                                            @error('trophy_type')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="edit_trophy_level" class="form-label fw-bold">ระดับรางวัล <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" id="edit_trophy_level" name="trophy_level" required>
                                                <option value="">เลือกระดับรางวัล</option>
                                                <option value="ชนะเลิศ">ชนะเลิศ</option>
                                                <option value="รองชนะเลิศอันดับ 1">รองชนะเลิศอันดับ 1</option>
                                                <option value="รองชนะเลิศอันดับ 2">รองชนะเลิศอันดับ 2</option>
                                                <option value="ชมเชย">ชมเชย</option>
                                                <option value="เข้าร่วม">เข้าร่วม</option>
                                            </select>
                                            @error('trophy_level')
                                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="edit_placename" class="form-label fw-bold">สถานที่ <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="edit_placename" name="placename" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="edit_date" class="form-label fw-bold">วันที่ <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="edit_date" name="date" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="edit_teacher_name" class="form-label fw-bold">ชื่อครู <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="edit_teacher_name" name="teacher_name"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="edit_student_name" class="form-label fw-bold">ชื่อนักเรียน <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="edit_student_name" name="student_name"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_trophy_detail" class="form-label fw-bold">รายละเอียดรางวัล</label>
                                    <textarea class="form-control" id="edit_trophy_detail" name="trophy_detail" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>ยกเลิก
                    </button>
                    <button type="submit" form="editTrophyForm" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>บันทึกการแก้ไข
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: none;
        }

        .table thead th {
            background-color: #e7f1ff;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            padding: 12px;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .image-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }

        .image-wrapper:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .no-image i {
            font-size: 2rem;
            opacity: 0.5;
        }

        .title-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
            font-weight: 500;
        }

        .category-badge, .level-badge {
            display: inline-block;
            padding: 0.35em 0.8em;
            font-size: 0.85em;
            font-weight: 500;
            background-color: #e7f1ff;
            color: #0d6efd;
            border-radius: 30px;
            transition: all 0.2s ease;
        }

        .level-badge {
            background-color: #e7fff0;
            color: #198754;
        }

        .category-badge:hover {
            background-color: #0d6efd;
            color: #fff;
        }

        .level-badge:hover {
            background-color: #198754;
            color: #fff;
        }

        .btn-group .btn {
            padding: 0.35rem 0.6rem;
            border-radius: 5px;
            transition: all 0.2s;
        }

        .btn-group .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-group .btn i {
            font-size: 0.875rem;
        }

        .edit-image-preview {
            width: 100%;
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .edit-image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #editTrophyModal .modal-content {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 992px) {
            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .image-wrapper {
                width: 60px;
                height: 60px;
            }

            .btn-group .btn {
                padding: 0.2rem 0.4rem;
            }

            .edit-image-preview {
                height: 150px;
                margin-bottom: 15px;
            }
        }
    </style>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all edit buttons
            const editButtons = document.querySelectorAll('.edit-btn');

            // Add click event listener to each edit button
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get data attributes
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const detail = this.getAttribute('data-detail');
                    const type = this.getAttribute('data-type');
                    const level = this.getAttribute('data-level');
                    const place = this.getAttribute('data-place');
                    const date = this.getAttribute('data-date');
                    const teacher = this.getAttribute('data-teacher');
                    const student = this.getAttribute('data-student');
                    const imagePath = this.getAttribute('data-image-path');
                    const imageUrl = this.getAttribute('data-image');

                    // Set values in the form
                    document.getElementById('edit_trophy_id').value = id;
                    document.getElementById('edit_trophy_name').value = name;
                    document.getElementById('edit_trophy_detail').value = detail || '';
                    document.getElementById('edit_trophy_type').value = type;
                    document.getElementById('edit_trophy_level').value = level;
                    document.getElementById('edit_placename').value = place;
                    document.getElementById('edit_date').value = date;
                    document.getElementById('edit_teacher_name').value = teacher;
                    document.getElementById('edit_student_name').value = student;
                    document.getElementById('current_image_path').value = imagePath || '';
                    
                    const imagePreview = document.getElementById('edit_image_preview');
                    if (imageUrl) {
                        imagePreview.src = imageUrl;
                        imagePreview.style.display = 'block';
                    } else {
                        imagePreview.src = '';
                        imagePreview.style.display = 'none';
                    }
                });
            });

            // Preview image when a new file is selected
            document.getElementById('edit_trophy_image').addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imagePreview = document.getElementById('edit_image_preview');
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Handle form submission
            document.getElementById('editTrophyForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                // Use fetch API for form submission
                fetch(this.getAttribute('action'), {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw response;
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Close the modal
                        const modalElement = document.getElementById('editTrophyModal');
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        modal.hide();

                        // Show success message (using SweetAlert if available)
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกสำเร็จ',
                                text: 'แก้ไขข้อมูลรางวัลเรียบร้อยแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            alert('บันทึกการแก้ไขเรียบร้อยแล้ว');
                            location.reload();
                        }
                    })
                    .catch(error => {
                        let errorMessage = 'เกิดข้อผิดพลาดในการบันทึกข้อมูล';

                        if (error.json) {
                            error.json().then(errorData => {
                                if (errorData && errorData.message) {
                                    errorMessage = errorData.message;
                                }

                                // Show error message
                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'เกิดข้อผิดพลาด',
                                        text: errorMessage
                                    });
                                } else {
                                    alert(errorMessage);
                                }
                            });
                        } else {
                            // Show generic error message
                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด',
                                    text: errorMessage
                                });
                            } else {
                                alert(errorMessage);
                            }
                        }
                    });
            });

            // Add hover effect for table rows
            const tableRows = document.querySelectorAll('table tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#f8f9fa';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                });
            });
        });
    </script>
@endsection
@endsection
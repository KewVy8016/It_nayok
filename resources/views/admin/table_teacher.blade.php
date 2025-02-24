@extends('layout-admin')

@section('title', 'Table teacher')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Table teacher</h4>
            <a href="{{ route('add-teacher') }}" class="btn btn-success rounded-pill px-4">
                <i class="bi bi-plus-circle me-2"></i> เพิ่มบุคคลากร
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-center" style="width: 15%;">รูปภาพ</th>
                            <th style="width: 25%;">ชื่อ-นามสกุล</th>
                            <th style="width: 15%;">เบอร์โทรศัพท์</th>
                            <th style="width: 25%;">ตำแหน่ง</th>
                            <th class="text-center" style="width: 15%;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($teachers->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-person-x fs-2 d-block mb-3"></i>
                                        ไม่พบข้อมูลอาจารย์
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($teachers as $index => $teacher)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center py-3">
                                    <div class="teacher-image-container">
                                        @if (isset($teacher->image) && !empty($teacher->image))
                                            <img src="{{ Storage::url($teacher->image) }}"
                                                class="img-thumbnail rounded-circle" alt="รูปอาจารย์">
                                        @else
                                            <div
                                                class="no-image-placeholder rounded-circle d-flex align-items-center justify-content-center bg-light">
                                                <i class="bi bi-person fs-1 text-secondary"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-1">
                                        {{ isset($teacher->nameprefix) ? $teacher->nameprefix : '' }}
                                        {{ $teacher->name }}
                                        {{ isset($teacher->lastname) ? $teacher->lastname : '' }}
                                    </h6>
                                </td>
                                <td>{{ isset($teacher->tel) ? $teacher->tel : '-' }}</td>
                                <td>
                                    @if (isset($teacher->position) && !empty($teacher->position))
                                        <span class="badge bg-info text-dark">{{ $teacher->position }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-sm me-1 edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editTeacherModal" data-id="{{ $teacher->id }}"
                                            data-nameprefix="{{ $teacher->nameprefix }}" data-name="{{ $teacher->name }}"
                                            data-lastname="{{ $teacher->lastname }}" data-tel="{{ $teacher->tel }}"
                                            data-position="{{ $teacher->position }}"
                                            data-image="{{ isset($teacher->image) ? Storage::url($teacher->image) : '' }}"
                                            data-image-path="{{ $teacher->image }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <a href="{{ route('delete_teacher', $teacher->id) }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('คุณต้องการลบข้อมูลอาจารย์ท่านนี้ใช่หรือไม่?')">
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

    <!-- Modal แก้ไขข้อมูล -->
    <div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="editTeacherModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editTeacherModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>แก้ไขข้อมูลอาจารย์
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editTeacherForm" method="POST" action="{{ route('update_teacher') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="teacher_id" id="edit_teacher_id">
                        <input type="hidden" name="current_image_path" id="current_image_path">

                        <div class="row mb-4">
                            <div class="col-md-4 text-center">
                                <div class="position-relative mx-auto mb-3" style="width: 150px; height: 150px;">
                                    <div id="edit_profile_preview"
                                        class="rounded-circle w-100 h-100 border d-flex align-items-center justify-content-center bg-light">
                                        <i class="bi bi-person fs-1 text-secondary"></i>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_image" class="form-label fw-bold">เปลี่ยนรูปภาพ</label>
                                    <input type="file" class="form-control" id="edit_image" name="image"
                                        accept="image/*">
                                    <small class="form-text text-muted">ขนาดไฟล์ไม่เกิน 2MB</small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="edit_nameprefix" class="form-label fw-bold">คำนำหน้า</label>
                                        <select class="form-select" id="edit_nameprefix" name="nameprefix">
                                            <option value="">เลือกคำนำหน้า</option>
                                            <option value="นาย">นาย</option>
                                            <option value="นาง">นาง</option>
                                            <option value="นางสาว">นางสาว</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="edit_name" class="form-label fw-bold">ชื่อ <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="edit_name" name="name"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="edit_lastname" class="form-label fw-bold">นามสกุล</label>
                                        <input type="text" class="form-control" id="edit_lastname" name="lastname">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_tel" class="form-label fw-bold">เบอร์โทรศัพท์</label>
                                        <input type="tel" class="form-control" id="edit_tel" name="tel"
                                            pattern="[0-9]{9,10}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="edit_position" class="form-label fw-bold">ตำแหน่ง</label>
                                        <input type="text" class="form-control" id="edit_position" name="position">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>ยกเลิก
                    </button>
                    <button type="submit" form="editTeacherForm" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>บันทึกการแก้ไข
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .teacher-image-container {
            width: 100px;
            height: 100px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .teacher-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image-placeholder {
            width: 100%;
            height: 100%;
            border: 1px solid #dee2e6;
        }

        .table> :not(caption)>*>* {
            vertical-align: middle;
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
                    const nameprefix = this.getAttribute('data-nameprefix');
                    const name = this.getAttribute('data-name');
                    const lastname = this.getAttribute('data-lastname');
                    const tel = this.getAttribute('data-tel');
                    const position = this.getAttribute('data-position');
                    const imagePath = this.getAttribute('data-image-path');
                    const imageUrl = this.getAttribute('data-image');

                    // Set values in the form
                    document.getElementById('edit_teacher_id').value = id;
                    document.getElementById('edit_nameprefix').value = nameprefix;
                    document.getElementById('edit_name').value = name;
                    document.getElementById('edit_lastname').value = lastname || '';
                    document.getElementById('edit_tel').value = tel || '';
                    document.getElementById('edit_position').value = position || '';
                    document.getElementById('current_image_path').value = imagePath || '';

                    // Update image preview
                    const profilePreview = document.getElementById('edit_profile_preview');
                    if (imageUrl) {
                        profilePreview.innerHTML =
                            `<img src="${imageUrl}" class="rounded-circle w-100 h-100" style="object-fit: cover;">`;
                    } else {
                        profilePreview.innerHTML =
                            '<i class="bi bi-person fs-1 text-secondary"></i>';
                    }
                });
            });

            // Preview image when a new file is selected
            document.getElementById('edit_image').addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const profilePreview = document.getElementById('edit_profile_preview');
                        profilePreview.innerHTML =
                            `<img src="${e.target.result}" class="rounded-circle w-100 h-100" style="object-fit: cover;">`;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Handle form submission
            document.getElementById('editTeacherForm').addEventListener('submit', function(e) {
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
                        const modalElement = document.getElementById('editTeacherModal');
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        modal.hide();

                        // Show success message
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกสำเร็จ',
                                text: 'แก้ไขข้อมูลอาจารย์เรียบร้อยแล้ว',
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
        });
    </script>
@endsection
@endsection

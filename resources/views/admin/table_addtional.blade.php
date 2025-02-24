@extends('layout-admin')

@section('title', 'จัดการ Additional Links')
@section('content')
    <div class="container d-flex justify-content-start mb-3">
        <a href="{{ route('add-addtional') }}" class="btn btn-success rounded-pill px-4">
            <i class="bi bi-plus-circle me-2"></i> เพิ่มลิงก์ใหม่
        </a>
    </div>
    <div class="container mt-1">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-center" style="width: 15%;">รูปภาพ</th>
                            <th class="text-center" style="width: 25%;">ชื่อ</th>
                            <th class="text-center" style="width: 30%;">URL</th>
                            <th class="text-center" style="width: 15%;">แสดงผล</th>
                            <th class="text-center" style="width: 10%;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($addtionals) == 0)
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-3"></i>
                                        ไม่มีข้อมูล Additional Links
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($addtionals as $item)
                            <tr>
                                <td class="text-center align-middle">{{ $item->id }}</td>
                                <td class="text-center">
                                    <div class="image-wrapper">
                                        <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }} image">
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="title-text">{{ $item->name }}</div>
                                </td>
                                <td class="align-middle">
                                    <div class="url-text">
                                        <a href="{{ $item->url }}" target="_blank"
                                            class="text-decoration-none text-truncate d-block">
                                            {{ $item->url }}
                                        </a>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="status-badge {{ $item->show ? 'status-active' : 'status-inactive' }}">
                                        {{ $item->show ? 'แสดงผล' : 'ซ่อน' }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-sm me-1 edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editAdditionalModal" data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}" data-url="{{ $item->url }}"
                                            data-show="{{ $item->show }}" data-image-path="{{ $item->image }}"
                                            data-image="{{ Storage::url($item->image) }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <a href="{{ route('delete-addtional', ['id' => $item->id]) }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('คุณต้องการลบลิงก์นี้ใช่หรือไม่?')">
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

    <!-- Modal แก้ไข Additional Link -->
    <div class="modal fade" id="editAdditionalModal" tabindex="-1" aria-labelledby="editAdditionalModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editAdditionalModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>แก้ไขลิงก์
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editAdditionalForm" action="{{ route('update-addtional') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="additional_id" id="edit_additional_id" required>
                        <input type="hidden" name="current_image_path" id="current_image_path">

                        <div class="row mb-4">
                            <div class="col-md-4 text-center">
                                <div class="edit-image-preview mb-3">
                                    <img id="edit_image_preview" src="" alt="รูปภาพ" class="img-fluid rounded">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_additional_image" class="form-label fw-bold">เปลี่ยนรูปภาพ</label>
                                    <input type="file" class="form-control" id="edit_additional_image"
                                        name="additional_image" accept="image/*">
                                    <small class="form-text text-muted">
                                        ขนาดไฟล์ไม่เกิน 1MB | รองรับ JPEG, PNG
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="edit_additional_name" class="form-label fw-bold">ชื่อ <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_additional_name"
                                        name="additional_name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_additional_url" class="form-label fw-bold">URL <span
                                            class="text-danger">*</span></label>
                                    <input type="url" class="form-control" id="edit_additional_url"
                                        name="additional_url" required placeholder="https://example.com">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold">การแสดงผล <span class="text-danger">*</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="additional_show"
                                            id="show_active" value="1" required>
                                        <label class="form-check-label" for="show_active">
                                            แสดงผล
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="additional_show"
                                            id="show_inactive" value="0">
                                        <label class="form-check-label" for="show_inactive">
                                            ซ่อน
                                        </label>
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
                    <button type="submit" form="editAdditionalForm" class="btn btn-primary">
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
            width: 70px;
            height: 70px;
            margin: 0 auto;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
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

        .title-text {
            font-weight: 500;
            line-height: 1.5;
        }

        .url-text {
            color: #6c757d;
            font-size: 0.9rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 300px;
        }

        .status-badge {
            display: inline-block;
            padding: 0.35em 0.8em;
            font-size: 0.85em;
            font-weight: 500;
            border-radius: 30px;
            transition: all 0.2s ease;
        }

        .status-active {
            background-color: #e1f5ea;
            color: #10b981;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #ef4444;
        }

        .status-badge:hover {
            filter: brightness(0.95);
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
            height: 180px;
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
            object-fit: contain;
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
                    const url = this.getAttribute('data-url');
                    const show = this.getAttribute('data-show');
                    const imageUrl = this.getAttribute('data-image');
                    const imagePath = this.getAttribute(
                        'data-image-path'); // ต้องเพิ่ม attribute นี้ใน button

                    // Set values in the form
                    document.getElementById('edit_additional_id').value = id;
                    document.getElementById('edit_additional_name').value = name;
                    document.getElementById('edit_additional_url').value = url;
                    document.getElementById('edit_image_preview').src = imageUrl;
                    document.getElementById('current_image_path').value = imagePath;

                    // Set radio button based on show value
                    if (show === '1') {
                        document.getElementById('show_active').checked = true;
                    } else {
                        document.getElementById('show_inactive').checked = true;
                    }
                });
            });

            // ตรวจสอบฟอร์มก่อนส่ง
            document.getElementById('editAdditionalForm').addEventListener('submit', function(e) {
                e.preventDefault();

                // ตรวจสอบว่ามี ID หรือไม่
                const additionalId = document.getElementById('edit_additional_id').value;
                if (!additionalId) {
                    alert('ไม่พบรหัส Additional ID กรุณาลองใหม่อีกครั้ง');
                    return;
                }

                // ตรวจสอบการเลือกสถานะการแสดงผล
                const showActive = document.getElementById('show_active').checked;
                const showInactive = document.getElementById('show_inactive').checked;
                if (!showActive && !showInactive) {
                    alert('กรุณาเลือกสถานะการแสดงผล');
                    return;
                }

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
                        const modalElement = document.getElementById('editAdditionalModal');
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        modal.hide();

                        // Show success message (using SweetAlert if available)
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกสำเร็จ',
                                text: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
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

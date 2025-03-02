@extends('layout-admin')

@section('title', 'Manage News')
@section('content')
    <div class="container d-flex justify-content-start mb-3">
        <a href="{{ route('add-new') }}" class="btn btn-success rounded-pill px-4">
            <i class="bi bi-plus-circle me-2"></i> เพิ่มข่าวใหม่
        </a>
    </div>
    <div class="container mt-1">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-center" style="width: 12%;">รูปภาพ</th>
                            <th class="text-center" style="width: 18%;">หัวข้อ</th>
                            <th class="text-center" style="width: 20%;">รายละเอียด</th>
                            <th class="text-center" style="width: 10%;">ประเภท</th>
                            <th class="text-center" style="width: 12%;">สร้างโดย</th>
                            <th class="text-center" style="width: 13%;">เวลาที่สร้าง</th>
                            <th class="text-center" style="width: 10%;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($table_news) == 0)
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-3"></i>
                                        ไม่มีข่าวสาร
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($table_news as $item)
                            <tr>
                                <td class="text-center align-middle">{{ $item['id'] }}</td>
                                <td class="text-center">
                                    <div class="image-wrapper">
                                        <img src="{{ asset($item['image_path']) }}" alt="news image">
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="title-text">{{ \Illuminate\Support\Str::limit($item['title'], 80) }}</div>
                                </td>
                                <td class="align-middle">
                                    <div class="description-text">{{ $item['describe'] }}</div>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="category-badge">{{ $item->category }}</span>
                                </td>
                                <td class="text-center align-middle">{{ $item['created_by'] }}</td>
                                <td class="text-center align-middle">
                                    <div class="text-muted">
                                        {{ \Carbon\Carbon::parse($item->created_time)->format('Y-m-d') }}
                                        <br>
                                        <small>{{ \Carbon\Carbon::parse($item->created_time)->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-sm me-1 edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editNewsModal" data-id="{{ $item->id }}"
                                            data-title="{{ $item->title }}" data-describe="{{ $item->describe }}"
                                            data-category="{{ $item->category }}"
                                            data-image="{{ asset($item['image_path']) }}"
                                            data-image-path="{{ $item['image_path'] }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <a href=" {{ route('delete_new', $item->id) }}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('คุณต้องการลบข่าวนี้ใช่หรือไม่?')">
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
    <!-- Modal แก้ไขข่าว -->
    <div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editNewsModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>แก้ไขข่าว
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editNewsForm" action="{{route('update_new')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="news_id" id="edit_news_id">
                        <input type="hidden" name="current_image_path" id="current_image_path">

                        <div class="row mb-4">
                            <div class="col-md-4 text-center">
                                <div class="edit-image-preview mb-3">
                                    <img id="edit_image_preview" src="" alt="รูปภาพข่าว" class="img-fluid rounded">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_news_image" class="form-label fw-bold">เปลี่ยนรูปภาพ</label>
                                    <input type="file" class="form-control" id="edit_news_image" name="news_image"
                                        accept="image/*">
                                    <small class="form-text text-muted">
                                        ขนาดไฟล์ไม่เกิน 2MB | รองรับ JPEG, PNG, GIF
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="edit_news_title" class="form-label fw-bold">หัวข้อข่าว <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="edit_news_title" name="news_title"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_news_category" class="form-label fw-bold">ประเภทข่าว <span
                                            class="text-danger">*</span></label>
                                    <select name="news_type" class="form-control" id="edit_news_category" required>
                                        <option value="news">ข่าวสาร</option>
                                        <option value="breaking_news">ข่าวด่วน</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="edit_news_description" class="form-label fw-bold">รายละเอียดข่าว <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="edit_news_description" name="news_description" rows="5" required></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>ยกเลิก
                    </button>
                    <button type="submit" form="editNewsForm" class="btn btn-primary">
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
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
            font-weight: 500;
        }

        .description-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.5;
            max-height: 3em;
        }

        .category-badge {
            display: inline-block;
            padding: 0.35em 0.8em;
            font-size: 0.85em;
            font-weight: 500;
            background-color: #e7f1ff;
            color: #0d6efd;
            border-radius: 30px;
            transition: all 0.2s ease;
        }

        .category-badge:hover {
            background-color: #0d6efd;
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
        }

        .edit-image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #editNewsModal .modal-content {
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
        // Vanilla JavaScript implementation - No jQuery or AJAX
        document.addEventListener('DOMContentLoaded', function() {
            // Get all edit buttons
            const editButtons = document.querySelectorAll('.edit-btn');

            // Add click event listener to each edit button
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get data attributes
                    const id = this.getAttribute('data-id');
                    const title = this.getAttribute('data-title');
                    const describe = this.getAttribute('data-describe');
                    const category = this.getAttribute('data-category');
                    const imagePath = this.getAttribute('data-image-path');
                    const imageUrl = this.getAttribute('data-image');

                    // Set values in the form
                    document.getElementById('edit_news_id').value = id;
                    document.getElementById('edit_news_title').value = title;
                    document.getElementById('edit_news_description').value = describe;
                    document.getElementById('edit_news_category').value = category;
                    document.getElementById('current_image_path').value = imagePath;
                    document.getElementById('edit_image_preview').src = imageUrl;
                });
            });

            // Preview image when a new file is selected
            document.getElementById('edit_news_image').addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('edit_image_preview').src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Handle form submission
            document.getElementById('editNewsForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                // Use fetch API for form submission
                fetch(this.getAttribute('action') || window.location.href, {
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
                        const modalElement = document.getElementById('editNewsModal');
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        modal.hide();

                        // Show success message (using SweetAlert if available)
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกสำเร็จ',
                                text: 'แก้ไขข่าวเรียบร้อยแล้ว',
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

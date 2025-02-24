@extends('layout-admin')

@section('title', 'จัดการรายละเอียดวิชาหลักสูตร')
@section('content')
    <div class="container d-flex justify-content-start mb-3">
        <a href="{{ route('add-detailcourse') }}" class="btn btn-success rounded-pill px-4">
            <i class="bi bi-plus-circle me-2"></i> เพิ่มรายละเอียดวิชาหลักสูตร
        </a>
    </div>
    <div class="container mt-1">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" style="width: 10%;">#</th>
                            <th class="text-center" style="width: 70%;">ชื่อรายละเอียดวิชาหลักสูตร</th>
                            <th class="text-center" style="width: 20%;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($detailcourses) == 0)
                            <tr>
                                <td colspan="3" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox fs-3 d-block mb-3"></i>
                                        ไม่มีข้อมูลรายละเอียดวิชาหลักสูตร
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($detailcourses as $item)
                            <tr>
                                <td class="text-center align-middle">{{ $item->id }}</td>
                                <td class="align-middle">{{ $item->name }}</td>
                                <td class="text-center align-middle">
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-sm me-1 edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editDetailCourseModal" data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <a href="{{route('delete_detailcourse', ['id' => $item->id])}}" class="btn btn-danger btn-sm"
                                            onclick="return confirm('คุณต้องการลบรายการนี้ใช่หรือไม่?')">
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

    <!-- Modal แก้ไขรายละเอียดวิชาหลักสูตร -->
    <div class="modal fade" id="editDetailCourseModal" tabindex="-1" aria-labelledby="editDetailCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editDetailCourseModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>แก้ไขรายละเอียดวิชาหลักสูตร
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editDetailCourseForm" action="{{ route('update_detailcourse') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label fw-bold">ชื่อรายละเอียดวิชาหลักสูตร <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>ยกเลิก
                    </button>
                    <button type="submit" form="editDetailCourseForm" class="btn btn-primary">
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

        @media (max-width: 992px) {
            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .btn-group .btn {
                padding: 0.2rem 0.4rem;
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

                    // Set values in the form
                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_name').value = name;
                });
            });

            // Handle form submission
            document.getElementById('editDetailCourseForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

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
                        const modalElement = document.getElementById('editDetailCourseModal');
                        const modal = bootstrap.Modal.getInstance(modalElement);
                        modal.hide();

                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกสำเร็จ',
                                text: 'แก้ไขรายละเอียดวิชาหลักสูตรเรียบร้อยแล้ว',
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
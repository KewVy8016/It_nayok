@extends('layout-admin')

@section('title', 'Dashboard')

@section('content')


    <div class="container py-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0 font-weight-bold">ข้อมูลนักเรียนปีการศึกษา 2567</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="students-table">
                        <thead class="bg-light">
                            <tr class="text-center">
                                <th class="py-3">ระดับการศึกษา</th>
                                <th class="py-3 text-primary">จำนวนนักเรียนชาย</th>
                                <th class="py-3 text-danger">จำนวนนักเรียนหญิง</th>
                                <th class="py-3 text-success">จำนวนรวม</th>
                                <th class="py-3">การจัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                                <tr data-id="{{ $student->id }}" class="text-center">
                                    <td class="py-3 font-weight-bold">{{ $student->education_level }}</td>
                                    <td class="py-3 text-primary">{{ $student->male_count }}</td>
                                    <td class="py-3 text-danger">{{ $student->female_count }}</td>
                                    <td class="py-3 text-success font-weight-bold">
                                        {{ $student->male_count + $student->female_count }}
                                    </td>
                                    <td class="py-3">
                                        <button class="btn btn-warning btn-sm rounded-pill px-3 edit-btn"
                                            data-id="{{ $student->id }}" data-level="{{ $student->education_level }}"
                                            data-male="{{ $student->male_count }}"
                                            data-female="{{ $student->female_count }}">
                                            <i class="fas fa-edit mr-1"></i> แก้ไข
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fas fa-info-circle mr-2"></i>ไม่พบข้อมูลนักเรียน
                                    </td>
                                </tr>
                            @else
                                <tr class="bg-light text-center">
                                    <td class="py-3 font-weight-bold">รวมทั้งหมด</td>
                                    <td class="py-3 text-primary font-weight-bold">{{ $students->sum('male_count') }}</td>
                                    <td class="py-3 text-danger font-weight-bold">{{ $students->sum('female_count') }}</td>
                                    <td class="py-3 text-success font-weight-bold">
                                        {{ $students->sum('male_count') + $students->sum('female_count') }}
                                    </td>
                                    <td class="py-3">-</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal สำหรับแก้ไขข้อมูล -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title font-weight-bold" id="editModalLabel">
                        <i class="fas fa-user-edit mr-2"></i>แก้ไขข้อมูลนักเรียน
                    </h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <form id="editForm" action="{{ route('update_student') }}" method="POST">
                        @csrf

                        <input type="hidden" id="student_id" name="student_id">
                        <div class="form-group">
                            <label for="education_level" class="font-weight-bold">ระดับการศึกษา</label>
                            <select class="form-control form-control-lg" id="education_level" name="education_level"
                                required>
                                <option value="ปวช.1">ปวช.1</option>
                                <option value="ปวช.2">ปวช.2</option>
                                <option value="ปวช.3">ปวช.3</option>
                                <option value="ปวส.1">ปวส.1</option>
                                <option value="ปวส.2">ปวส.2</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="male_count" class="font-weight-bold text-primary">
                                <i class="fas fa-male mr-1"></i>จำนวนนักเรียนชาย
                            </label>
                            <input type="number" class="form-control form-control-lg" id="male_count" name="male_count"
                                min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="female_count" class="font-weight-bold text-danger">
                                <i class="fas fa-female mr-1"></i>จำนวนนักเรียนหญิง
                            </label>
                            <input type="number" class="form-control form-control-lg" id="female_count" name="female_count"
                                min="0" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>ยกเลิก
                    </button>
                    <button type="submit" form="editForm" class="btn btn-primary px-4">
                        <i class="fas fa-save mr-1"></i>บันทึก
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // เมื่อคลิกปุ่ม "บันทึก" ในโมดัลแก้ไข
            $('#saveChanges').click(function() {
                var studentId = $('#student_id').val();
                var formData = {
                    'education_level': $('#education_level').val(),
                    'male_count': $('#male_count').val(),
                    'female_count': $('#female_count').val(),
                    '_token': $('input[name="_token"]').val(),
                    '_method': 'PUT'
                };

                // ส่งข้อมูลไปยัง route ที่มี ID
                $.ajax({
                    url: '/update_student/' + studentId,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#editModal').modal('hide');

                        // แสดง Toast notification แทน alert
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'บันทึกข้อมูลเรียบร้อยแล้ว',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        // รีโหลดหน้าเพื่อแสดงข้อมูลที่อัปเดต
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด',
                            text: xhr.responseText
                        });
                    }
                });
            });

            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                var level = $(this).data('level');
                var male = $(this).data('male');
                var female = $(this).data('female');

                // กำหนดค่าให้กับฟอร์ม
                $('#student_id').val(id);
                $('#education_level').val(level);
                $('#male_count').val(male);
                $('#female_count').val(female);

                $('#editModal').modal('show');
            });

            // เพิ่ม hover effect ให้กับแถวตาราง
            $('#students-table tbody tr').hover(
                function() {
                    $(this).addClass('bg-light');
                },
                function() {
                    $(this).removeClass('bg-light');
                }
            );
        });
    </script>
@endsection

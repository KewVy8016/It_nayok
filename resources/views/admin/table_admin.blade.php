@extends('layout-admin')

@section('content')
    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-user-shield me-2"></i>{{ __('จัดการผู้ดูแลระบบ') }}</h4>
                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                    <i class="fas fa-plus-circle me-1"></i> เพิ่มผู้ดูแลระบบ
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="80">รูปโปรไฟล์</th>
                                <th>ชื่อผู้ใช้</th>
                                <th>อีเมล</th>
                                <th>สร้างเมื่อ</th>
                                <th class="text-center" width="150">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                                <tr>
                                    <td>
                                        <img src="{{ asset($admin->image) }}" alt="Profile" class="rounded-circle"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                    </td>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#editAdminModal{{ $admin->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteAdminModal{{ $admin->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-users-slash mb-3 text-muted" style="font-size: 3rem;"></i>
                                            <h5 class="text-muted">ไม่พบข้อมูลผู้ดูแลระบบ</h5>
                                            <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                                                data-bs-target="#addAdminModal">
                                                <i class="fas fa-plus-circle me-1"></i> เพิ่มผู้ดูแลระบบใหม่
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (isset($admins) && method_exists($admins, 'links'))
                    <div class="d-flex justify-content-center mt-4">
                        {{ $admins->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal เพิ่มผู้ดูแลระบบใหม่ -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addAdminModalLabel">
                        <i class="fas fa-user-plus me-2"></i>{{ __('เพิ่มผู้ดูแลระบบใหม่') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form method="POST" action="{{route('store_admin')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="form-label fw-bold">{{ __('ชื่อผู้ใช้') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input id="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror" name="username"
                                            value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    </div>
                                    @error('username')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="form-label fw-bold">{{ __('อีเมล') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label fw-bold">{{ __('รหัสผ่าน') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password-confirm" class="form-label fw-bold">{{ __('ยืนยันรหัสผ่าน') }}
                                        <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image" class="form-label fw-bold">{{ __('รูปโปรไฟล์') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                                        <input id="image" type="file"
                                            class="form-control @error('image') is-invalid @enderror" name="image"
                                            required accept="image/*">
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="image-preview mt-2 text-center d-none">
                                    <div class="bg-light p-3 rounded">
                                        <img id="preview-image" src="#" alt="Preview" class="img-fluid rounded"
                                            style="max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>ยกเลิก
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>{{ __('บันทึก') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal แก้ไขผู้ดูแลระบบ -->
    @foreach ($admins ?? [] as $admin)
        <div class="modal fade" id="editAdminModal{{ $admin->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-user-edit me-2"></i>{{ __('แก้ไขข้อมูลผู้ดูแลระบบ') }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('update_admin', $admin->id) }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="modal-body">
                            <div class="text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    <img src="{{ asset($admin->image) }}" alt="Profile"
                                        class="rounded-circle img-thumbnail"
                                        style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_username{{ $admin->id }}"
                                            class="form-label fw-bold">{{ __('ชื่อผู้ใช้') }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input id="edit_username{{ $admin->id }}" type="text"
                                                class="form-control" name="username" value="{{ $admin->username }}"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_email{{ $admin->id }}"
                                            class="form-label fw-bold">{{ __('อีเมล') }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input id="edit_email{{ $admin->id }}" type="email"
                                                class="form-control" name="email" value="{{ $admin->email }}"
                                                required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="edit_image{{ $admin->id }}"
                                            class="form-label fw-bold">{{ __('รูปโปรไฟล์') }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-image"></i></span>
                                            <input id="edit_image{{ $admin->id }}" type="file"
                                                class="form-control" name="image" accept="image/*">
                                        </div>
                                        <small class="text-muted">อัปโหลดรูปใหม่เฉพาะเมื่อต้องการเปลี่ยนรูปโปรไฟล์</small>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            id="change_password{{ $admin->id }}" name="change_password">
                                        <label class="form-check-label" for="change_password{{ $admin->id }}">
                                            เปลี่ยนรหัสผ่าน
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6 password-fields{{ $admin->id }} d-none">
                                    <div class="form-group">
                                        <label for="edit_password{{ $admin->id }}"
                                            class="form-label fw-bold">{{ __('รหัสผ่านใหม่') }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input id="edit_password{{ $admin->id }}" type="password"
                                                class="form-control" name="password" autocomplete="new-password">
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 password-fields{{ $admin->id }} d-none">
                                    <div class="form-group">
                                        <label for="edit_password_confirm{{ $admin->id }}"
                                            class="form-label fw-bold">{{ __('ยืนยันรหัสผ่านใหม่') }}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input id="edit_password_confirm{{ $admin->id }}" type="password"
                                                class="form-control" name="password_confirmation"
                                                autocomplete="new-password">
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>ยกเลิก
                            </button>
                            <button type="submit" class="btn btn-info text-white">
                                <i class="fas fa-save me-1"></i>{{ __('บันทึกการเปลี่ยนแปลง') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal ลบผู้ดูแลระบบ -->
        <div class="modal fade" id="deleteAdminModal{{ $admin->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle me-2"></i>{{ __('ยืนยันการลบผู้ดูแลระบบ') }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center py-4">
                        <div class="mb-3">
                            <img src="{{ asset($admin->image) }}" alt="Profile"
                                class="rounded-circle border border-3 border-danger"
                                style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        <h5>คุณต้องการลบผู้ดูแลระบบ "<span class="fw-bold">{{ $admin->username }}</span>" ใช่หรือไม่?</h5>
                        <p class="text-muted">การกระทำนี้ไม่สามารถเรียกคืนได้
                            และข้อมูลทั้งหมดของผู้ดูแลระบบนี้จะถูกลบออกจากระบบ</p>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>ยกเลิก
                        </button>
                        <form method="GET" action="{{ route('delete_admin', $admin->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash me-1"></i>{{ __('ยืนยันการลบ') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // แสดงตัวอย่างรูปภาพ
            const imageInput = document.getElementById('image');
            const previewImage = document.getElementById('preview-image');
            const imagePreview = document.querySelector('.image-preview');

            if (imageInput) {
                imageInput.addEventListener('change', function() {
                    if (this.files && this.files[0]) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                            imagePreview.classList.remove('d-none');
                        }

                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }

            // เปิด/ปิดรหัสผ่าน
            const toggleBtns = document.querySelectorAll('.toggle-password');
            toggleBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // แสดง/ซ่อนฟิลด์รหัสผ่านในการแก้ไข
            @foreach ($admins ?? [] as $admin)
                const changePasswordCheckbox{{ $admin->id }} = document.getElementById(
                    'change_password{{ $admin->id }}');
                const passwordFields{{ $admin->id }} = document.querySelectorAll(
                    '.password-fields{{ $admin->id }}');

                if (changePasswordCheckbox{{ $admin->id }}) {
                    changePasswordCheckbox{{ $admin->id }}.addEventListener('change', function() {
                        passwordFields{{ $admin->id }}.forEach(field => {
                            if (this.checked) {
                                field.classList.remove('d-none');
                                field.querySelector('input').setAttribute('required', 'required');
                            } else {
                                field.classList.add('d-none');
                                field.querySelector('input').removeAttribute('required');
                            }
                        });
                    });
                }
            @endforeach
        });
    </script>
@endpush
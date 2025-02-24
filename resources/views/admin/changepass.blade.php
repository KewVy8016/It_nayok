@extends('layout-admin')

@section('title', 'เปลี่ยนรหัสผ่าน')

@section('content')
    <div class="container">
        <div class="form-container">
            <h2>เปลี่ยนรหัสผ่าน</h2>

            @if (session('status'))
                <div class="alert alert-{{ session('status.type') }}">
                    {{ session('status.message') }}
                </div>
            @endif

            <form action="{{ route('update_password') }}" method="POST" id="passwordForm">
                @csrf
                <input type="hidden" name="admin_id" value="{{ Auth::guard('admins')->user()->id }}">

                <div class="form-group">
                    <label for="current_password">รหัสผ่านปัจจุบัน:</label>
                    <div class="password-input-container">
                        <input type="password" name="current_password" id="current_password" required>
                        <i class="toggle-password fa fa-eye-slash" data-target="current_password"></i>
                    </div>
                    @error('current_password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password">รหัสผ่านใหม่:</label>
                    <div class="password-input-container">
                        <input type="password" name="new_password" id="new_password" required minlength="8">
                        <i class="toggle-password fa fa-eye-slash" data-target="new_password"></i>
                    </div>
                    <div class="password-strength-meter">
                        <div class="meter-bar"></div>
                    </div>
                    <small class="password-hint">รหัสผ่านต้องมีอย่างน้อย 8 ตัวอักษร</small>
                    @error('new_password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="confirm_password">ยืนยันรหัสผ่านใหม่:</label>
                    <div class="password-input-container">
                        <input type="password" name="confirm_password" id="confirm_password" required>
                        <i class="toggle-password fa fa-eye-slash" data-target="confirm_password"></i>
                    </div>
                    <span id="password-match-status"></span>
                    @error('confirm_password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="submit-btn" id="changePasswordBtn">ยืนยันการเปลี่ยนรหัสผ่าน</button>
            </form>
        </div>
    </div>

    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-weight: 500;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .password-input-container {
            position: relative;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="password"]:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
        }

        .error {
            display: block;
            color: #dc3545;
            margin-top: 5px;
            font-size: 14px;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #357abd;
        }

        .password-strength-meter {
            height: 5px;
            background-color: #eee;
            margin-top: 8px;
            border-radius: 3px;
            overflow: hidden;
        }

        .meter-bar {
            height: 100%;
            width: 0;
            background-color: #dc3545;
            transition: width 0.3s, background-color 0.3s;
        }

        .password-hint {
            color: #666;
            font-size: 13px;
        }

        #password-match-status {
            font-size: 14px;
            display: block;
            margin-top: 5px;
        }

        .match-success {
            color: #28a745;
        }

        .match-error {
            color: #dc3545;
        }
    </style>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // แสดง/ซ่อนรหัสผ่าน
                const toggleButtons = document.querySelectorAll('.toggle-password');
                toggleButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const targetId = this.getAttribute('data-target');
                        const input = document.getElementById(targetId);

                        if (input.type === 'password') {
                            input.type = 'text';
                            this.classList.remove('fa-eye-slash');
                            this.classList.add('fa-eye');
                        } else {
                            input.type = 'password';
                            this.classList.remove('fa-eye');
                            this.classList.add('fa-eye-slash');
                        }
                    });
                });

                // ตรวจสอบความแข็งแรงของรหัสผ่าน
                const newPassword = document.getElementById('new_password');
                const strengthMeter = document.querySelector('.meter-bar');

                newPassword.addEventListener('input', function() {
                    const password = this.value;
                    let strength = 0;

                    if (password.length >= 8) strength += 20;
                    if (password.match(/[a-z]/)) strength += 20;
                    if (password.match(/[A-Z]/)) strength += 20;
                    if (password.match(/[0-9]/)) strength += 20;
                    if (password.match(/[^a-zA-Z0-9]/)) strength += 20;

                    strengthMeter.style.width = strength + '%';

                    if (strength <= 40) {
                        strengthMeter.style.backgroundColor = '#dc3545'; // แดง
                    } else if (strength <= 80) {
                        strengthMeter.style.backgroundColor = '#ffc107'; // เหลือง
                    } else {
                        strengthMeter.style.backgroundColor = '#28a745'; // เขียว
                    }
                });

                // ตรวจสอบว่ารหัสผ่านตรงกันหรือไม่
                const confirmPassword = document.getElementById('confirm_password');
                const matchStatus = document.getElementById('password-match-status');

                function checkPasswordMatch() {
                    if (confirmPassword.value === '') {
                        matchStatus.textContent = '';
                        matchStatus.className = '';
                        return;
                    }

                    if (newPassword.value === confirmPassword.value) {
                        matchStatus.textContent = 'รหัสผ่านตรงกัน';
                        matchStatus.className = 'match-success';
                    } else {
                        matchStatus.textContent = 'รหัสผ่านไม่ตรงกัน';
                        matchStatus.className = 'match-error';
                    }
                }

                confirmPassword.addEventListener('input', checkPasswordMatch);
                newPassword.addEventListener('input', function() {
                    if (confirmPassword.value !== '') {
                        checkPasswordMatch();
                    }
                });

                // ยืนยันก่อนส่งฟอร์ม
                const form = document.getElementById('passwordForm');
                form.addEventListener('submit', function(e) {
                    if (!confirm(
                            'คุณต้องการเปลี่ยนรหัสผ่านใช่หรือไม่? หลังจากเปลี่ยนรหัสผ่านแล้ว ระบบจะออกจากระบบโดยอัตโนมัติ'
                            )) {
                        e.preventDefault();
                    }
                });
            });
        </script>
    @endpush
@endsection

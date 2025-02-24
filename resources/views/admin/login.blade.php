<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบผู้ดูแล</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Kanit', sans-serif;
        }
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }
        .card-header {
            background-color: #4a90e2;
            padding: 30px 20px;
            text-align: center;
            border-bottom: none;
        }
        .card-header h2 {
            color: white;
            margin: 0;
            font-weight: 600;
        }
        .card-body {
            padding: 40px 30px;
        }
        .form-control {
            height: 50px;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            font-size: 16px;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.15);
            border-color: #4a90e2;
        }
        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
        }
        .btn-primary {
            background-color: #4a90e2;
            border: none;
            height: 50px;
            font-weight: 600;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background-color: #3175c5;
            transform: translateY(-2px);
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            height: 50px;
            font-weight: 600;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 8px;
            font-weight: 500;
            padding: 15px;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .alert-danger {
            background-color: #ffeaee;
            color: #b92c3a;
            border-left: 4px solid #dc3545;
        }
        .alert-success {
            background-color: #e7f7ed;
            color: #1e7e34;
            border-left: 4px solid #28a745;
        }
        .alert-warning {
            background-color: #fff8e6;
            color: #b7791f;
            border-left: 4px solid #ffc107;
        }
        .alert-info {
            background-color: #e7f3ff;
            color: #0c5396;
            border-left: 4px solid #17a2b8;
        }
        .alert-dismissible .btn-close {
            padding: 15px;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
        }
        .invalid-feedback {
            font-size: 14px;
            margin-top: 5px;
        }
        .form-text {
            color: #6c757d;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h2>เข้าสู่ระบบผู้ดูแล</h2>
                        </div>
                        <div class="card-body">
                            <!-- แสดงข้อความแจ้งเตือนจากการเปลี่ยนรหัสผ่าน -->
                            @if(session('status'))
                                <div class="alert alert-{{ session('status.type') }} alert-dismissible fade show" role="alert">
                                    <i class="fas fa-{{ session('status.type') == 'success' ? 'check-circle' : 'info-circle' }} me-2"></i>
                                    {{ session('status.message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- แสดงข้อความแจ้งเตือนจากการล็อกอิน -->
                            @error('status')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    {{ $message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror

                            <!-- แสดงข้อความแจ้งเตือนทั่วไป -->
                            @if ($errors->has('login_error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    {{ $errors->first('login_error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- แสดงข้อความแจ้งเตือนหากถูก logout โดยระบบ -->
                            @if(session('logout_message'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <i class="fas fa-info-circle me-2"></i>
                                    {{ session('logout_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <!-- แสดงข้อความแจ้งเตือนหากเซสชั่นหมดอายุ -->
                            @if(session('session_expired'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="fas fa-clock me-2"></i>
                                    {{ session('session_expired') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.login.submit') }}" id="loginForm">
                                @csrf
                                <div class="mb-4">
                                    <label for="Email" class="form-label">อีเมล</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               name="email" 
                                               id="Email" 
                                               value="{{ old('email') }}"
                                               required 
                                               autocomplete="email">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="Password" class="form-label">รหัสผ่าน</label>
                                    <div class="input-group password-container">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               name="password" 
                                               id="Password" 
                                               required>
                                        <i class="password-toggle fas fa-eye-slash" id="togglePassword"></i>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row g-2 mt-3">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ
                                        </button>
                                    </div>
                                    
                                    <div class="col-6">
                                        <a href="{{ route('home') }}" class="btn btn-secondary w-100 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-home me-2"></i>กลับหน้าหลัก
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('Password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle eye icon
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
            
            // Auto-dismiss alerts after 3 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 3000);
            });
            
            // Basic form validation
            const loginForm = document.getElementById('loginForm');
            loginForm.addEventListener('submit', function(event) {
                let valid = true;
                const email = document.getElementById('Email').value;
                const password = document.getElementById('Password').value;
                
                // Simple email validation
                if (!email.includes('@') || !email.includes('.')) {
                    valid = false;
                    // Could add custom validation messages here
                }
                
                // Simple password validation (not empty)
                if (password.trim() === '') {
                    valid = false;
                    // Could add custom validation messages here
                }
                
                // Form will submit normally if valid
            });
        });
    </script>
</body>
</html>
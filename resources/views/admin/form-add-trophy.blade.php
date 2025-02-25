<link rel="stylesheet" href="{{secure_asset('css/admin/formtrophy.css')}}">
@extends('layout-admin')

@section('title', 'Form Add Trophy')

@section('content')
    <div class="container d-flex justify-content-start mb-1">
        <a href="{{route('table_trophy')}}" class="btn btn-success">
            <i class="bi bi-arrow-left-circle"></i> ไปหน้าจัดการผลงาน
        </a>
    </div>
    <div class="container mt-1 mb-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">เพิ่มข้อมูลผลงานนักเรียน</h2>
            </div>
            {{-- success message --}}
            @if (session('status'))
                <div class="container">
                    <div class="alert mt-2 alert-{{ session('status')['type'] }}">
                        {{ session('status')['message'] }}
                    </div>
                </div>
            @endif
            {{-- end success message --}}
            <div class="card-body p-4">
                <form id="ajax-form" action="{{route('insert_trophy')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label">รูปภาพ</label>
                        <div class="custom-file-upload" id="drop-zone">
                            <input type="file" name="image" id="image-upload" class="d-none" accept=".jpeg,.png,.jpg">
                            <div id="drop-zone-text">
                                คลิกหรือลากไฟล์มาวางที่นี่
                            </div>
                            <img id="image-preview" class="preview-image d-block mx-auto" style="display: none;">
                        </div>
                    </div>
                    @error('image')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror

                    <div class="mb-4">
                        <label class="form-label">ชื่อผลงานนักเรียน</label>
                        <input type="text" name="trophy_name" class="form-control">
                        @error('trophy_name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">รายละเอียดผลงานนักเรียน</label>
                        <textarea name="trophy_detail" class="form-control" rows="3"></textarea>
                        @error('trophy_detail')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">ประเภทผลงาน</label>
                        <select name="trophy_type" class="form-select select2">
                            <option value="">เลือกประเภทผลงานนักเรียน</option>
                            <option value="การเเข่งขัน">การเเข่งขัน</option>
                            <option value="โครงงาน">โครงงาน</option>
                            <option value="ประกวด">ประกวด</option>
                        </select>
                        @error('trophy_type')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label">ระดับรางวัล</label>
                        <select name="trophy_level" class="form-select select2">
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

                    <div class="mb-4">
                        <label class="form-label">สถานที่</label>
                        <input type="text" name="placename" class="form-control">
                        @error('placename')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">วันที่</label>
                        <input type="date" name="date" class="form-control">
                        @error('date')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">ชื่อครู</label>
                        <input type="text" name="teacher_name" class="form-control">
                        @error('teacher_name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">ชื่อนักเรียน</label>
                        <input type="text" name="student_name" class="form-control">
                        @error('student_name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-5">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{secure_asset('js/form-add-trophy.js')}}">
    </script>
@endsection
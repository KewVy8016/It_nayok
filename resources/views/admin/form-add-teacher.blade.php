<link rel="stylesheet" href="{{ asset('css/admin/teacher-form.css') }}">
@extends('layout-admin')

@section('title', 'Form Add Teacher')

@section('content')
    <div class="container d-flex justify-content-start mb-1">
        <a href="{{ route('table_teacher') }}" class="btn btn-success">
            <i class="bi bi-arrow-left-circle"></i> ไปหน้าจัดการบุคลากร
        </a>
    </div>
    <div class="container mt-1 mb-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">เพิ่มบุคคลากรใหม่</h2>
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
                <form id="ajax-form" action="{{ route('insert_teacher') }}" method="POST" enctype="multipart/form-data">
                    @csrf
    
                    @error('prefixname')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <div class="mb-4 row">
                        <div class="col-2">
                            <label class="form-label">คำนำหน้า</label>
                            <select name="nameprefix" class="form-control" class="text-center">
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">ชื่อ</label>
                            <input type="text" name="name" class="form-control">
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col">
                            <label class="form-label">นามสกุล</label>
                            <input type="text" name="lastname" class="form-control">
                            @error('lastname')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">ตำแหน่ง</label>
                        <input type="text" name="position" id="" class="form-control">
                    </div>
                    @error('position')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                    <div class="mb-4">
                        <label class="form-label">เบอร์โทรศัพท์</label>
                        <input type="tel" name="tel" class="form-control">
                    </div>
                    @error('tel')
                        <div class="alert alert-danger mt-2 ">{{ $message }}</div>
                    @enderror

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

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-5">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="{{ asset('js/ajax-form-add-new.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('js/form-add-new.js') }}"></script>
@endsection

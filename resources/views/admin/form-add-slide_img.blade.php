<link rel="stylesheet" href="{{ asset('css/admin/add-slide_img.css') }}">
@extends('layout-admin')

@section('title', 'Form add slide image')

@section('content')
    <div class="container d-flex justify-content-start mb-1">
        <a href="{{ route('table_slide') }}" class="btn btn-success">
            <i class="bi bi-arrow-left-circle"></i> กลับไปยังหน้าจัดการภาพสไลด์
        </a>
    </div>
    <div class="container mt-1 mb-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">เพิ่มภาพสไลด์หลัก</h2>
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
                <form id="ajax-form" action="{{ route('insert_slide') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">ชื่อภาพ</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror

                    <div class="mb-4">
                        <label class="form-label">รูปภาพประกอบข่าว</label>
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
                        <button type="submit" class="btn btn-primary px-5">บันทึกภาพ</button>
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

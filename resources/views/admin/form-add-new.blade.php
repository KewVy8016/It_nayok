<link rel="stylesheet" href="{{ asset('css/admin/add-new.css') }}">
@extends('layout-admin')

@section('title', 'Form Add New')

@section('content')
    <div class="container d-flex justify-content-start mb-1">
        <a href="{{ route('table_news') }}" class="btn btn-success">
            <i class="bi bi-arrow-left-circle"></i> กลับไปยังหน้าจัดการข่าว
        </a>
    </div>
    <div class="container mt-1 mb-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0 ">เพิ่มข่าวใหม่</h2>
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
                <form id="ajax-form" action="{{ route('insert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">ชื่อข่าว</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror

                    <div class="mb-4">
                        <label class="form-label">รายละเอียดข่าว</label>
                        <textarea name="content" class="form-control" rows="5"></textarea>
                    </div>
                    @error('content')
                        <div class="alert alert-danger mt-2 ">{{ $message }}</div>
                    @enderror

                    <div class="mb-4">
                        <label class="form-label">ประเภทข่าว</label>
                        <select name="news_type" class="form-control">
                            <option value="news">ข่าวสาร</option>
                            <option value="breaking_news">ข่าวด่วน</option>
                        </select>
                    </div>
                    @error('news_type')
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
                        <button type="submit" class="btn btn-primary px-5">บันทึกข่าว</button>
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

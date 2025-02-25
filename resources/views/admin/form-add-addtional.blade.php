<link rel="stylesheet" href="{{ secure_asset('css/admin/form-addtional.css') }}">
@extends('layout-admin')

@section('title', 'Form Add addtional')

@section('content')
    <div class="container d-flex justify-content-start mb-3">
        <a href="{{ route('table_addtional') }}" class="btn btn-success">
            <i class="bi bi-arrow-left-circle"></i> กลับไปตารางจัดการ
        </a>
    </div>
    <div class="container mt-1 mb-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">เพิ่มส่วนเพิ่มเติม</h2>
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
                <form id="data-form" action="{{ route('insert_addtional') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" name="name" class="form-control">
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">URL</label>
                        <input type="text" name="url" class="form-control">
                        @error('url')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">รูปภาพ</label>
                        <div class="custom-file-upload" id="drop-zone">
                            <input type="file" name="image" id="image-upload" class="d-none" accept=".jpeg,.png,.jpg">
                            <div id="drop-zone-text">คลิกหรือลากไฟล์มาวางที่นี่</div>
                            <img id="image-preview" class="preview-image d-block mx-auto" style="display: none;">
                        </div>
                        @error('image')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">แสดงผล</label>
                        <select name="show" class="form-control">
                            <option value="yes">แสดง</option>
                            <option value="no">ไม่เเสดง</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-5">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script src="{{ secure_asset('js/form-addtional.js') }}"></script>
    @endsection

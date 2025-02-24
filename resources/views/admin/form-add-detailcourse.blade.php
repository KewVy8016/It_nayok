<link rel="stylesheet" href="{{ asset('css/admin/add-new.css') }}">
@extends('layout-admin')

@section('title', 'Form Add New')

@section('content')
    <div class="container d-flex justify-content-start mb-1">
        <a href="{{route('table_detailcourse')}}" class="btn btn-success">
            <i class="bi bi-arrow-left-circle"></i> กลับไปยังตารางรายวิชา
        </a>
    </div>
    <div class="container mt-1 mb-5">
        <div class="card">
            <div class="card-header">
                <h2 class="mb-0">เพิ่มแนะนำวิชา</h2>
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
                <form id="ajax-form" action="{{ route('insert_detailcourse') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">ชื่อวิชา</label>
                        <input type="text" name="course_name" class="form-control">
                    </div>
                    @error('course_name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-5">บันทึกข้อมูล</button>
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

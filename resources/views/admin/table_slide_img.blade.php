@extends('layout-admin')

@section('title', 'จัดการรูปภาพสไลด์')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">จัดการรูปภาพสไลด์</h4>
            <a href="{{ route('add-slide') }}" class="btn btn-success rounded-pill px-4">
                <i class="bi bi-plus-circle me-2"></i> เพิ่มสไลด์ใหม่
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" style="width: 8%;">#</th>
                            <th class="text-center" style="width: 40%;">รูปภาพ</th>
                            <th style="width: 42%;">หัวข้อ</th>
                            <th class="text-center" style="width: 10%;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($table_slide->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-image fs-2 d-block mb-3"></i>
                                        ไม่พบข้อมูลสไลด์
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @foreach ($table_slide as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center py-3">
                                    <div class="slide-image-container">
                                        <img src="{{ asset($item->image) }}" class="img-thumbnail" alt="{{ $item->title }}">
                                    </div>
                                </td>
                                <td>
                                    <h6 class="mb-1">{{ $item->title }}</h6>
                                    @if(!empty($item->description))
                                        <small class="text-muted">{{ Str::limit($item->description, 100) }}</small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('delete_slide', $item->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('คุณต้องการลบสไลด์นี้ใช่หรือไม่?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .slide-image-container {
            width: 100%;
            height: 150px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .slide-image-container img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
        
        .table > :not(caption) > * > * {
            vertical-align: middle;
        }
    </style>
@endsection

@extends('layout')
@section('title', 'รายละเอียดข่าว')
@section('content')
    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- Card สำหรับรายละเอียดข่าว -->
                <div class="card">
                    <!-- เช็คว่ามีข่าวหรือไม่ -->
                    @if ($news)
                        <div class="card-header">
                            <h3 class="card-title">{{ $news->title }}</h3> <!-- ชื่อข่าว -->
                        </div>
                        <div class="card-body">
                            <!-- แสดงภาพข่าว (ถ้ามี) -->
                            @if ($news->image_path)
                                <img src="{{ asset('storage/' . $news->image_path) }}" class="img-fluid mb-3" alt="News Image">
                            @endif
                            <div class="card-content">
                                <h3>รายละเอียด</h3>
                                <!-- เนื้อหาข่าว -->
                                <p>{{ $news->describe }}</p> <!-- เนื้อหาของข่าว -->
                            </div>

                            
                        </div>
                        <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                            <small>เผยแพร่เมื่อ: {{ $news->created_at->format('d M Y') }}</small>
                            <!-- ถ้าต้องการปุ่มย้อนกลับ -->
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">กลับ</a>
                        </div>
                    @else
                        <p>ไม่พบข้อมูลข่าวที่คุณต้องการ</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer') {{-- ลบ Footer ออก --}} @endsection
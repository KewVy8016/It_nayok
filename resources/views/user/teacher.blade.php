@extends('layout')

@section('title', 'บุลคลากร')

@section('content')
<style>
    /* Custom CSS */
    .staff-img {
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin: 0 auto;
        border: 3px solid #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .staff-card {
        transition: all 0.3s ease;
        border: none;
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .staff-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .staff-card:hover .staff-img {
        transform: scale(1.05);
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.2);
    }

    .staff-card .card-body {
        padding: 2rem 1.5rem;
        position: relative;
        z-index: 1;
    }

    .card-title {
        color: #333;
        font-weight: 600;
        margin-top: 1rem;
        font-size: 1.25rem;
    }

    .card-text {
        color: #666;
        font-size: 1rem;
    }

    .page-title {
        color: #333;
        font-weight: bold;
        margin-bottom: 2rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .page-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: linear-gradient(to right, #007bff, #00d2ff);
        border-radius: 2px;
    }

    /* เพิ่มเอฟเฟกต์พื้นหลังเมื่อโฮเวอร์ */
    .staff-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #007bff, #00d2ff);
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 0;
    }

    .staff-card:hover::before {
        opacity: 0.1;
    }

    /* เพิ่มเอฟเฟกต์เมื่อคลิก */
    .staff-card:active {
        transform: translateY(-5px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }
</style>

    <div class="container mb-5 py-2">

        <div class="row mb-4">
            <div class="col-12">
            <h2 class="mb-3" style="border-left: 5px solid #0d6efd; padding-left: 15px;">บุคคลากร</h2>
            <hr class="mb-4">
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
            @foreach ($teacher as $item)
                <div class="col">
                    <div class="card h-100 staff-card text-center">
                        <div class="card-body">
                            <img src="{{ Storage::url($item['image']) }}" class="staff-img mb-3 rounded-circle"
                                alt="{{ $item->name }} photo">
                            <h5 class="card-title">
                                {{ $item->nameprefix . ' ' . $item->name . '  ' . $item->lastname }}
                            </h5>
                            <p class="card-text">{{ $item->position }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

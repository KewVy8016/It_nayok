@extends('layout')

@section('title', 'เเผนการเรียน ปวช.')

@section('content')
<style>
  /* สไตล์สำหรับทำให้ PDF responsive */
  .pdf-container {
    width: 100%;
    max-width: 100%;
  }
  
  .pdf-page-container {
    margin-bottom: 20px;
    width: 100%;
  }
  
  canvas.pdf-canvas {
    max-width: 100%;
    height: auto !important;
    display: block;
    margin: 0 auto;
  }
  
  @media (max-width: 768px) {
    .pdf-page-container {
      margin-bottom: 15px;
    }
  }
</style>
<div class="container mt-5">
  <!-- หัวข้อของเมนู -->
  <h2>ประกาศนียบัตรวิชาชีพ (ปวช.) สาขาวิชา เทคโนโลยีสารสนเทศ</h2>
  <div class="accordion" id="accordionExample">
    @foreach($studyplan as $plan)
    <!-- - แสดง PDF -->
    <div class="accordion-item m-3">
      <h2 class="accordion-header" id="heading{{ $loop->index }}">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
            data-bs-target="#collapse{{ $loop->index }}" 
            aria-expanded="false" 
            aria-controls="collapse{{ $loop->index }}">
          เเผนการเรียนปีการศึกษา {{ $plan->year }}
        </button>
      </h2>
      <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse" 
         aria-labelledby="heading{{ $loop->index }}" 
         data-bs-parent="#accordionExample">
        <div class="accordion-body">
          <h5>{{ $plan->name }} {{$plan->year}}</h5>
          <!-- สร้างคอนเทนเนอร์สำหรับแสดงหน้า PDF ทั้งหมด -->
          <div id="pdf-container-{{ $loop->index }}" class="pdf-container" style="border: 1px solid #ccc;"></div>
          <div class="mt-3">
            <a href="{{ asset('storage/'.$plan->pathfile) }}" 
               class="btn btn-primary" 
               download>
              <i class="fas fa-download"></i> ดาวน์โหลด PDF
            </a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>


@endsection

@section('footer') {{-- ลบ Footer ออก --}} @endsection
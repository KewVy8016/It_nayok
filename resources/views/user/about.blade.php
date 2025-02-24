@extends('layout')

@section('title', 'เกี่ยวกับเเผนก')

@section('content')

    <style>
        /* Custom CSS */
        .header-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            animation: fadeIn 2s ease-in-out;
        }

        .history-section {
            background-color: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s ease-out, transform 1s ease-out;
        }

        .history-section.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .page-title {
            color: #333;
            font-weight: bold;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 0.5rem;
            animation: slideIn 1.5s ease-out;
        }

        .page-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 40%;
            height: 3px;
            background: linear-gradient(to right, #007bff, #00d2ff);
            border-radius: 2px;
            animation: expandLine 1.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes expandLine {
            from {
                width: 0;
            }

            to {
                width: 40%;
            }
        }
    </style>
    <img src="{{ asset('img/it_build_img.png') }}" alt="Header Image" class="header-image">

    <div class="container my-5">
        <div class="history-section" id="historySection">
            <h1 class="page-title text-center">ประวัติแผนกวิชาเทคโนโลยีสารสนเทศ</h1>
            <div class="history-text">
                <p>
                    เมื่อปี พ.ศ. 2548 โดยดำริของท่านเกรียงศักดิ์ เจริญวุฒิ ผู้อำนวยการวิทยาลัยเทคนิคนครนายก
                    โดยมอบหมายให้ อาจารย์สมโภช ตามสายลม และอาจารย์ไพรัช ปานดำ
                    เป็นผู้เริ่มต้นก่อตั้งและเป็นอาจารย์ประจำแผนกวิชาฯ
                    ในช่วงแรก โดยจัดการเรียนการสอนนักศึกษาระดับประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.)
                    และเปิดรับนักศึกษารุ่นแรกจำนวน 20 คน
                    จากนักเรียนระดับประกาศนียบัตรวิชาชีพ (ปวช.) และระดับมัธยมศึกษาตอนปลาย (ม.6) หรือเทียบเท่า
                    ในเขตจังหวัดนครนายกและจังหวัดใกล้เคียง
                </p>
                <p>
                    ต่อมาในปี พ.ศ. 2557 โดยดำริของท่านผู้อำนวยการศิริ จันบำรุง ผู้อำนวยการวิทยาลัยเทคนิคนครนายก
                    มีนโยบายให้แผนกวิชาเทคโนโลยีสารสนเทศ เปิดรับนักเรียนระดับประกาศนียบัตรวิชาชีพ (ปวช.)
                    โดยเร่งเห็นถึงความสำคัญของการจัดการเรียนการสอน วิวัฒนาการและความก้าวหน้าของเทคโนโลยีในปัจจุบัน
                    ว่ามีความจำเป็นต่อการดำเนินชีวิตในสังคมปัจจุบันและอนาคต จึงให้มีการเปิดการเรียนการสอนครบทั้งระดับ
                    คือ ประกาศนียบัตรวิชาชีพ (ปวช.) และระดับประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.)
                    เพื่อรองรับนักเรียนนักศึกษาที่สนใจทางด้านเทคโนโลยีในด้านต่างๆ
                    และมีความสนใจในความก้าวหน้าทางด้านเทคโนโลยีในปัจจุบันและในอนาคต
                </p>
            </div>
        </div>
    </div>

    <script>
        // JavaScript เพื่อเพิ่มเอฟเฟกต์เมื่อเลื่อนมาถึงส่วนประวัติ
        document.addEventListener('DOMContentLoaded', function() {
            const historySection = document.getElementById('historySection');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        historySection.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.5
            }); // เริ่มแสดงเมื่อมองเห็น 50% ของส่วนประวัติ

            observer.observe(historySection);
        });
    </script>
    
@endsection

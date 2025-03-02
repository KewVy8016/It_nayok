<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.4.1/swiper-bundle.min.css">
<link rel="stylesheet" href="{{ secure_asset('css/slide.css') }}">

<body>
    <div class="container ">

        <!-- Left Block - Slider -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($slide as $item)
                    <div class="swiper-slide">
                        <img src="{{ asset($item['image']) }}" alt="Slide {{ $item['id'] }}">
                    </div>
                @endforeach
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>


    </div>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.4.1/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
            });
        });


        var swiper = new Swiper('.custom-swiper-container', {
            slidesPerView: 3, // กำหนดให้แสดงการ์ด 3 ใบในแต่ละแถว
            spaceBetween: 20, // ระยะห่างระหว่างการ์ด
            //loop: true,          // การเลื่อนวนรอบ
            grabCursor: true, // ให้มีลูกศรเมื่อผู้ใช้เลื่อนด้วยเมาส์หรือนิ้ว
            simulateTouch: true, // รองรับการเลื่อนบนอุปกรณ์มือถือ
            freeMode: true, // เปิดโหมดฟรีเพื่อให้เลื่อนเองได้
        });
    </script>
</body>

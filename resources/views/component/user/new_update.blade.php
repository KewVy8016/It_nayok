<style>
    .news-item {
        transition: all 0.3s ease;
    }

    .news-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .hidden-news {
        display: none;
    }

    #newsContainer.show-all .hidden-news {
        display: block;
    }

    /* ปรับ scrollable-news ให้ยืดหยุ่น */
    .scrollable-news {
        overflow-y: auto;
        transition: max-height 0.3s ease;
        scrollbar-width: thin;
    }

    .scrollable-news::-webkit-scrollbar {
        width: 6px;
    }

    .scrollable-news::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }

    .scrollable-news::-webkit-scrollbar-thumb {
        background: #0d6efd;
        border-radius: 3px;
    }

    .news-item:last-child {
        margin-bottom: 0 !important;
        border-bottom: none !important;
    }

    /* เพิ่ม transition ให้การเปลี่ยนความสูงดูนุ่มนวล */
    .card {
        transition: height 0.3s ease;
    }
</style>

<div class="container py-4">
    <div class="row">
        <!-- ข่าวสารล่าสุด (ฝั่งซ้าย) -->
        <div class="col-md-6 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h4 mb-0">ข่าวสารล่าสุด</h2>
                <button class="btn btn-link text-decoration-none p-0" onclick="toggleNews()">
                    ดูทั้งหมด <i class="bi bi-chevron-right"></i>
                </button>
            </div>

            <div id="newsContainer">
                <?php foreach($news as $index => $item): ?>
                <div class="news-item card mb-3 <?php echo $index >= 3 ? 'hidden-news' : ''; ?>">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span class="badge bg-primary mb-2">ข่าวสาร</span>
                            <small class="text-muted"><?php echo date('Y/m/d',strtotime($item['created_time'])) ?></small>
                        </div>
                        <h5 class="card-title"><?php echo $item['title']; ?></h5>
                        <a href="{{ route('new_detail',['id'=>$item->id])}}" class="btn btn-outline-primary btn-sm">
                            อ่านเพิ่มเติม
                            
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ประกาศสำคัญ (ฝั่งขวา) -->
        <div class="col-md-6">
            <div class="card border-primary h-100">
                <div class="card-header bg-primary text-white">
                    <h3 class="h5 mb-0">ประกาศสำคัญ</h3>
                </div>
                <div class="card-body p-0">
                    <div class="scrollable-news" id="importantNews">
                        <!-- ประกาศต่างๆ -->
                        @foreach ($breaking_news as $item)
                        <div class="news-item p-3 border-bottom">
                            <div class="d-flex justify-content-between">
                                <span class="badge bg-primary mb-2">ด่วน</span>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($item->created_time)->format('Y/m/d') }}</small>
                            </div>
                            <h5>{{$item->title}}</h5>
                            <p>{{ \Str::limit($item->describe, 100, '...') }}</p>
                            <a href="{{ route('new_detail',['id'=>$item->id])}}" class="btn btn-primary btn-sm">อ่านเพิ่มเติม</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function adjustHeight() {
    const leftColumn = document.getElementById('newsContainer');
    const rightColumn = document.getElementById('importantNews');
    
    // รอให้ DOM อัพเดทเสร็จก่อนวัดความสูง
    setTimeout(() => {
        const leftHeight = leftColumn.offsetHeight;
        rightColumn.style.maxHeight = `${leftHeight}px`;
    }, 50);
}

function toggleNews() {
    const container = document.getElementById('newsContainer');
    const button = container.previousElementSibling.querySelector('button');
    
    container.classList.toggle('show-all');
    
    if (container.classList.contains('show-all')) {
        button.innerHTML = 'แสดงน้อยลง <i class="bi bi-chevron-up"></i>';
    } else {
        button.innerHTML = 'ดูทั้งหมด <i class="bi bi-chevron-right"></i>';
    }
    
    // ปรับความสูงหลังจากที่มีการ toggle
    adjustHeight();
}

// เรียกใช้ตอนโหลดหน้าเว็บครั้งแรก
window.addEventListener('load', adjustHeight);

// ปรับความสูงเมื่อมีการ resize หน้าจอ
window.addEventListener('resize', adjustHeight);
</script>
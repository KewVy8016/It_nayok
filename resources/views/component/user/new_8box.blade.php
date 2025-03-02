<style>
    .news-card {
        transition: transform 0.2s;
        height: 100%;
    }
    .news-card:hover {
        transform: translateY(-5px);
    }
    .news-img-container {
        position: relative;
        padding-top: 56.25%; /* 16:9 Aspect Ratio */
        overflow: hidden;
    }
    .news-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<div class="container mt-5">
<div class="row g-4">
    @foreach ($addtional as $item)
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="{{ $item->url }}" target="_blank" class="text-decoration-none">
                <div class="card news-card shadow-sm">
                    <div class="news-img-container">
                        <img src="{{ asset($item->image) }}" class="news-img" alt="{{ $item->name }}">
                    </div>
                    <div class="card-body bg-primary text-white">
                        <p class="card-text mb-0">{{ $item->name }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
    
</div>
</div>

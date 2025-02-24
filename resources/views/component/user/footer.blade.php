<footer class="bg-primary text-white py-4"
<div class="footer-wrapper">
    <div class="container py-3">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-md-6">
                <h5 class="department-title mb-2">แผนกเทคโนโลยีสารสนเทศ</h5>
                <div class="contact-info">
                    <span class="contact-label">ติดต่อ : </span>
                    <a href="https://www.facebook.com/ITnayoktech2548" target="_blank" rel="noopener noreferrer"
                        class="fb-link">
                        <i class="bi bi-facebook"></i>
                        <span class="fb-text">www.facebook.com/ITnayoktech2548</span>
                    </a>
                </div>
                <div class="admin-link">
                    <a href="{{ url('admin/Formlogin') }}" class="admin-btn">
                        <i class="bi bi-person-circle"></i>
                        <span>ผู้ดูแลระบบ</span>
                    </a>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="college-info">
                    <p class="thai-name">วิทยาลัยเทคนิคนครนายก</p>
                    <p class="eng-name text-light">Nakhonnayok Technical College</p>
                </div>
            </div>
        </div>
    </div>
</div>
</footer>
<style>
    .footer-wrapper {
        background-color: rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .department-title {
        color: #fff;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .contact-info {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.5rem;
        color: #fff;
    }

    .contact-label {
        color: #fff;
    }

    .fb-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #fff;
        text-decoration: none;
        transition: all 0.3s ease;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
    }

    .fb-link:hover {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .fb-text {
        position: relative;
    }

    .fb-link:hover .fb-text {
        text-decoration: underline;
    }

    .college-info {
        text-align: left;
    }

    .thai-name,
    .eng-name {
        margin: 0;
        line-height: 1.5;
    }

    .thai-name {
        font-weight: 600;
        color: #fff;
    }

    @media (min-width: 768px) {
        .college-info {
            text-align: right;
        }
    }

    @media (max-width: 767px) {
        .contact-info {
            margin-bottom: 1rem;
        }

        .department-title {
            font-size: 1.1rem;
        }
    }


    .admin-link {
        margin-top: 1rem;
    }

    .admin-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #fff;
        text-decoration: none;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .admin-btn:hover {
        color: white;
        background-color: rgba(255, 255, 255, 0.1);
        text-decoration: underline;
    }
</style>

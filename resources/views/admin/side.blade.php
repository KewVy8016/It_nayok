<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin ItNayoktech <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard')}}">
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - News Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>จัดการข่าว</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom news:</h6>
                <a class="collapse-item" href="{{route('table_news')}}">ตารางข่าว</a>
                <a class="collapse-item" href="{{route('add-new')}}">เพิ่มข่าว</a>
            </div>
        </div>
    </li>

    
    <!-- Nav Item - Slide Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSlide"
            aria-expanded="true" aria-controls="collapseSlide">
            <i class="fas fa-fw fa-wrench"></i>
            <span>จัดการภาพสไลด์</span>
        </a>
        <div id="collapseSlide" class="collapse" aria-labelledby="headingSlide"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Slide:</h6>
                <a class="collapse-item" href="{{route('table_slide')}}">ตารางภาพสไลด์</a>
                <a class="collapse-item" href="{{route('add-slide')}}">เพิ่มรูปภาพสไลด์</a>
            </div>
        </div>
    </li>
    
    <!-- Nav Item - Teacher Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTea"
            aria-expanded="true" aria-controls="collapseTea">
            <i class="fas fa-fw fa-wrench"></i>
            <span>จัดการบุคคลากร</span>
        </a>
        <div id="collapseTea" class="collapse" aria-labelledby="headingSlide"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Teacher:</h6>
                <a class="collapse-item" href="{{route('table_teacher')}}">ตารางบุคลากร</a>
                <a class="collapse-item" href="{{route('add-teacher')}}">เพิ่มบุคลากร</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - trophy Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTrophy"
            aria-expanded="true" aria-controls="collapseTrophy">
            <i class="fas fa-fw fa-wrench"></i>
            <span>จัดการผลงานนักเรียน</span>
        </a>
        <div id="collapseTrophy" class="collapse" aria-labelledby="headingSlide"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Trophy:</h6>
                <a class="collapse-item" href="{{route('table_trophy')}}">ตารางผลงานนักเรียน</a>
                <a class="collapse-item" href="{{route('add-trophy')}}">เพิ่มผลงานนักเรียน</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - extra Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseExtra"
            aria-expanded="true" aria-controls="collapseExtra">
            <i class="fas fa-fw fa-wrench"></i>
            <span>จัดการส่วนเพิ่มเติม</span>
        </a>
        <div id="collapseExtra" class="collapse" aria-labelledby="headingSlide"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Extra":</h6>
                <a class="collapse-item" href="{{route('table_addtional')}}">ตารางส่วนเพิ่มเติม</a>
                <a class="collapse-item" href="{{route('add-addtional')}}">เพิ่มส่วนเพิ่มเติม</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Detailcourse Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDetailcourse"
            aria-expanded="true" aria-controls="collapseDetailcourse">
            <i class="fas fa-fw fa-wrench"></i>
            <span>จัดการเเนะนำรายวิชา</span>
        </a>
        <div id="collapseDetailcourse" class="collapse" aria-labelledby="headingSlide"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Detailcourse":</h6>
                <a class="collapse-item" href="{{route('table_detailcourse')}}">ตารางเเนะนำวิชา</a>
                <a class="collapse-item" href="{{route('add-detailcourse')}}">เพิ่มคำเเนะนำวิชา</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Vacation Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudyplan"
            aria-expanded="true" aria-controls="collapseStudyplan">
            <i class="fas fa-fw fa-wrench"></i>
            <span>จัดการเเผนการเรียน</span>
        </a>
        <div id="collapseStudyplan" class="collapse" aria-labelledby="headingSlide"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Studyplan":</h6>
                <a class="collapse-item" href="{{route('table_vocational')}}">ตารางปวช.</a>
                <a class="collapse-item" href="{{route('table_diploma')}}">ตารางปวส.</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
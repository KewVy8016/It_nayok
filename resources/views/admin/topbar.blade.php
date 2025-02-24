<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('admins')->user()->username }}</span>
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Check if user is root -->
        @if(auth()->user()->role === 'root')
            <!-- Nav Item - Admin Management -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="{{route('table_admin')}}">
                    <i class="fas fa-users-cog fa-fw"></i>
                    <span class="d-none d-lg-inline text-gray-600 small">Admin Management</span>
                </a>
            </li>
        @endif


        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                <img class="img-profile rounded-circle" src="{{Storage::url($admin = Auth::guard('admins')->user()->image) }}" style="width: 40px; height: 40px; object-fit: cover;">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('profile')}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout_admin') }}">
                    Logout
                </a>
                
            

            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->

<!-- leftbar-tab-menu -->
<div class="startbar d-print-none">
    <!--start brand-->
    <div class="brand">
        <a href="{{ route('customer.dashboard') }}" class="logo">
            <span>
                <img src="{{ asset('') }}assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
            </span>
            <span class="">
                <img src="{{ asset('') }}assets/images/logo-light.png" alt="logo-large" class="logo-lg logo-light">
                <img src="{{ asset('') }}assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark">
            </span>
        </a>
    </div>
    <!--end brand-->
    <!--start startbar-menu-->
    <div class="startbar-menu">
        <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
            <div class="d-flex align-items-start flex-column w-100">
                <!-- Navigation -->
                <ul class="navbar-nav mb-auto w-100">
                    <li class="menu-label mt-2">
                        <span>Main</span>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.dashboard') }}">
                            <i class="iconoir-report-columns menu-icon"></i>
                            <span>Dashboard</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer.bookings.index') }}">
                            <i class="iconoir-ticket menu-icon"></i>
                            <span>Previous Trips</span>
                        </a>
                    </li><!--end nav-item-->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.edit') }}">
                            <i class="iconoir-user menu-icon"></i>
                            <span>My Profile</span>
                        </a>
                    </li><!--end nav-item-->
                </ul>
            </div>
        </div><!--end startbar-collapse-->

        <!-- Bottom Buttons -->
        <div class="sidebar-bottom p-3">
            <a href="{{ url('/') }}" class="btn btn-primary w-100 mb-2">
                <i class="fas fa-globe me-2"></i> Book a Flight
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div><!--end startbar-menu-->
</div><!--end startbar-->
<div class="startbar-overlay d-print-none"></div>
<!-- end leftbar-tab-menu-->

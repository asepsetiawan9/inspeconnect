<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
            <img src="{{ asset('img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Dashboard Perumahan</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'map' ? 'active' : '' }}" href="{{ route('map') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-map-big text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Peta Sebaran</span>
                </a>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">MANAJEMEN DATA</h6>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}"
                    href="{{ route('page', ['page' => 'user-management']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Pengguna</span>
                </a>
            </li>
        <!-- it will be delete -->
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'population-data') == true ? 'active' : '' }}"
                    href="{{ route('page', ['page' => 'population-data']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Rumah</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'poverty') == true ? 'active' : '' }}"
                    href="{{ route('page', ['page' => 'poverty']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Rumah Tidak Layak</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'worthy') ? 'active' : '' }}"
                    href="{{ route('worthy') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Rumah Layak Huni</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'assistance') == true ? 'active' : '' }}"
                    href="{{ route('page', ['page' => 'assistance']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-regular fa-hand-holding-heart text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data Bantuan</span>
                </a>
            </li>

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">MANAJEMEN APLIKASI</h6>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ str_contains(request()->url(), 'profile') == true ? 'active' : '' }}"
                    href="{{ route('page', ['page' => 'profile']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-cog text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Ubah Profil</span>
                </a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{ str_contains(request()->url(), 'datamanagement') == true ? 'active' : '' }}"
                    href="{{ route('page', ['page' => 'datamanagement']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-cog text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Management Data</span>
                </a>
            </li>
        </ul>
    </div>

</aside>

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 " href="{{ route('home') }}" target="_blank">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEh4wVJSIl6zSaIJFqJoUQQrBCEkZWRELZhC7Y0akNfNlGtP7wgtu1P1854LOair3KVjgRSSHvckQhZIJ3AkTvR4Snm7fqi8oERF45iHtcYb69PvCPQls_O1gDRY9W7Zn6JUNR_FAVt64JCCoSk2I7CxQtS8SWEhmgcrJ5FUMxDDcIpNoIWE_tqosSrjjw/s1000/logo-kota-garut.png"  alt="logo" class="w-full h-full">
                <span class="ms-1 font-weight-bold">Inspeconnect</span>
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
            
            <li class="nav-item mt-3 d-flex align-items-center">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">MANAJEMEN DATA</h6>
            </li>
            <li class="nav-item">
                @can('admin-role')
                    <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}"
                        href="{{ route('page', ['page' => 'user-management']) }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Pengguna</span>
                    </a>
                @endcan
            </li>
            <li class="nav-item">
                @can('admin-role')
                    <a class="nav-link {{ str_contains(request()->url(), 'consultant') == true ? 'active' : '' }}"
                        href="{{ route('page', ['page' => 'consultant']) }}">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-paper-diploma text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Data Konsultan</span>
                    </a>
                @endcan
            </li>
            
            
            <li class="nav-item">
                @can('admin-role')
                    {{-- @can('skpd-role') --}}
                        <a class="nav-link {{ str_contains(request()->url(), 'schedule') == true ? 'active' : '' }}"
                            href="{{ route('page', ['page' => 'schedule']) }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-handshake-o text-success text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Jadwal Konsultasi</span>
                        </a>
                    {{-- @endcan --}}
                @endcan
            </li>
            <li class="nav-item">
                {{-- @can('admin-role') --}}
                    @can('skpd-role')
                        <a class="nav-link {{ str_contains(request()->url(), 'schedule') == true ? 'active' : '' }}"
                            href="{{ route('page', ['page' => 'schedule']) }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-handshake-o text-success text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Jadwal Konsultasi</span>
                        </a>
                    @endcan
                {{-- @endcan --}}
            </li>
            
            

           
            <li class="nav-item">
            <a class="nav-link {{ str_contains(request()->url(), 'report') == true ? 'active' : '' }}"
                    href="{{ route('page', ['page' => 'report']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-flag text-success text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lapor</span>
                </a>
            </li>
        <!-- it will be delete -->
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
        </ul>
    </div>

</aside>

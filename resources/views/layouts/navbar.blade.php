<!-- Navbar: Start -->
<style>
    .btn-pramuka {
        color: #fff;
        background-color: #663996;
        border-color: #663996;
    }
</style>
<nav class="layout-navbar shadow-none py-0">
    <div class="container">
        <div class="navbar navbar-expand-lg landing-navbar px-2">
            <!-- Menu logo wrapper: Start -->
            <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                <!-- Mobile menu toggle: Start-->
                <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="ti ti-menu-2 ti-sm align-middle"></i>
                </button>
                <!-- Mobile menu toggle: End-->
                <a href="{{route('home-depan')}}" class="app-brand-link w-px-150">
                    <img src="{{ asset('assets/img/logo-pramuka.png') }}" class="w-100" />
                </a>
            </div>
            <!-- Menu logo wrapper: End -->
            <!-- Menu wrapper: Start -->
            <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                    type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti ti-x ti-sm"></i>
                </button>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ Request::route()->getName() == 'home-depan' ? 'active' : '' }}"
                            href="{{ route('home-depan') }}">Beranda</a>
                    </li>
                    <li class="nav-item {{ Request::route()->getName() == 'sambutan-magis' ? 'active' : '' }} {{ Request::route()->getName() == 'sejarah' ? 'active' : '' }} {{ Request::route()->getName() == 'visi-misi' ? 'active' : '' }} {{ Request::route()->getName() == 'ad-art' ? 'active' : '' }}  {{ Request::route()->getName() == 'kepengurusan' ? 'active' : '' }} {{ Request::route()->getName() == 'program-kerja' ? 'active' : '' }} {{ Request::route()->getName() == 'prestasi' ? 'active' : '' }}">
                      <a class="nav-link dropdown-toggle fw-medium" data-bs-toggle="dropdown" aria-expanded="false"
                            href="">Profile</a>
                        <ul class="dropdown-menu"  style="left: 260px; top:50px">
                            <li><a class="dropdown-item" href="{{ route('sambutan-magis') }}">Sambutan Mabigus</a></li>
                            <li><a class="dropdown-item" href="{{ route('sejarah') }}">Sejarah</a></li>
                            <li><a class="dropdown-item" href="{{ route('visi-misi') }}">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="{{ route('ad-art') }}">AD/ART</a></li>
                            <li><a class="dropdown-item" href="{{ route('kepengurusan') }}">Kepengurusan</a></li>
                            <li><a class="dropdown-item" href="{{ route('program-kerja') }}">Program Kerja</a></li>
                            <li><a class="dropdown-item" href="{{ route('prestasi') }}">Prestasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ Request::route()->getName() == 'campaign' ? 'active' : '' }}"
                            href="{{ route('campaign') }}">Agenda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium  {{ Request::route()->getName() == 'berita' ? 'active' : '' }}"
                            href="{{ route('berita') }}">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ Request::route()->getName() == 'artikel' ? 'active' : '' }}"
                            href="{{ route('artikel') }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ Request::route()->getName() == 'materi' ? 'active' : '' }}"
                            href="{{ route('materi') }}">Materi</a>
                    </li>

                    <li class="nav-item {{ Request::route()->getName() == 'galeri-foto' ? 'active' : '' }} {{ Request::route()->getName() == 'galeri-vidio' ? 'active' : '' }}">
                      <a class="nav-link dropdown-toggle fw-medium" data-bs-toggle="dropdown" aria-expanded="false"
                            href="">Galeri</a>
                      <ul class="dropdown-menu dropdown-menu" style="left: 677px; top:50px">
                        <li><a class="dropdown-item" href="{{ route('galeri-foto') }}">Foto</a></li>
                            <li><a class="dropdown-item" href="{{ route('galeri-vidio') }}">Vidio</a></li>
                      </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ Request::route()->getName() == 'dokumen' ? 'active' : '' }}"
                            href="{{ route('dokumen') }}">Dokumen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-medium {{ Request::route()->getName() == 'contact' ? 'active' : '' }}"
                            href="{{ route('contact') }}">Kontak</a>
                    </li>
                </ul>
            </div>
            <div class="landing-menu-overlay d-lg-none"></div>
            @if (Route::has('login') && env('APP_ENABLE_LOGIN', false))
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <li>
                        @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('dashboard.home') }}" class="btn btn-pramuka">
                                <span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span>
                                <span class="d-none d-md-block">Home</span>
                            </a>
                        @elseif(auth()->user()->isAdminAngkatan())
                            <a href="{{ route('admin-angkatan.dashboard') }}" class="btn btn-pramuka">
                                <span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span>
                                <span class="d-none d-md-block">Home</span>
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="btn btn-pramuka">
                                <span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span>
                                <span class="d-none d-md-block">Home</span>
                            </a>
                        @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-pramuka"><span
                                    class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span><span
                                    class="d-none d-md-block">Login</span></a>
                @endif
                </li>
                </ul>
                @endif
            </div>
        </div>
    </nav>

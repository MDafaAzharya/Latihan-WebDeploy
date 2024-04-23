<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{url('/')}}" class="app-brand-link">
      <span class="app-brand-logo w-50">
        <img src="{{asset('assets/img/logo-pramuka.png')}}" class="w-100"/>
      </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <li class="menu-item {{ Route::is('dashboard.home') ? 'active' : '' }}">
      <a href="{{route('dashboard.home')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-layout-dashboard"></i>
        <div data-i18n="Home">{{__('Dashboard')}}</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon ti ti-home-2"></i>
        <div data-i18n="Front_galeri">Beranda</div>
      </a>
      <ul class="menu-sub">
      <li class="menu-item {{ Route::is('carousel_admin') ? 'active' : '' }}">
        <a href="{{route('carousel_admin')}}" class="menu-link">
          <i class="menu-icon ti ti-carousel-horizontal"></i>
          <div data-i18n="carousel">{{__('Carousel')}}</div>
        </a>
      </li>
      <li class="menu-item {{ Route::is('profile_admin') ? 'active' : '' }}">
        <a href="{{route('profile_admin')}}" class="menu-link">
          <i class="menu-icon ti ti-info-hexagon"></i>
          <div data-i18n="profile">{{__('Profile Pramuka')}}</div>
        </a>
      </li>
      <li class="menu-item {{ Route::is('faq_admin') ? 'active' : '' }}">
        <a href="{{route('faq_admin')}}" class="menu-link">
          <i class="menu-icon ti ti-user-question"></i>
          <div data-i18n="faq">{{__('FAQ')}}</div>
        </a>
      </li>
      </ul>
  </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon ti ti-user-circle"></i>
          <div data-i18n="front_profil">Profile</div>
      </a>
      <ul class="menu-sub">
          <li
              class="menu-item  {{ Route::is('mabigus_admin') ? 'active' : '' }}">
              <a href="{{route('mabigus_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="mabigus">{{ __('Sambutan Mabigus') }}</div>
              </a>
          </li>
          <li class="menu-item {{ Route::is('sejarah_admin') ? 'active' : '' }} ">
              <a href="{{route('sejarah_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="sejarah">{{ __('Sejarah') }}</div>
              </a>
          </li>
          <li class="menu-item {{ Route::is('visimisi_admin') ? 'active' : '' }} ">
              <a href="{{route('visimisi_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="visi_misi">{{ __('Visi & Misi') }}</div>
              </a>
          </li>
          <li class="menu-item {{ Route::is('ad-art_admin') ? 'active' : '' }}">
              <a href="{{route('ad-art_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="ad_art">{{ __('AD/ART') }}</div>
              </a>
          </li>
          <li class="menu-item {{ Route::is('kepengurusan_admin') ? 'active' : '' }}">
              <a href="{{route('kepengurusan_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="kepengurusan">{{ __('Kepengurusan') }}</div>
              </a>
          </li>
          <li class="menu-item {{ Route::is('proker_admin') ? 'active' : '' }}">
              <a href="{{route('proker_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="proker">{{ __('Program Kerja') }}</div>
              </a>
          </li>
          <li class="menu-item {{ Route::is('prestasi_admin') ? 'active' : '' }} ">
              <a href="{{route('prestasi_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="prestasi">{{ __('Prestasi') }}</div>
              </a>
          </li>
      </ul>
  </li>
  <li class="menu-item {{ Route::is('agenda_admin') ? 'active' : '' }}">
    <a href="{{route('agenda_admin')}}" class="menu-link">
      <i class="menu-icon ti ti-calendar-event"></i>
      <div data-i18n="agenda">{{__('Agenda')}}</div>
    </a>
  </li>
  <li class="menu-item {{ Route::is('konten_admin') ? 'active' : '' }}">
    <a href="{{route('konten_admin')}}" class="menu-link">
      <i class="menu-icon ti ti-clipboard-list"></i>
      <div data-i18n="berita">{{__('Berita, Artikel, Materi')}}</div>
    </a>
  </li>
  <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon ti ti-photo-shield"></i>
          <div data-i18n="Front_galeri">Galeri</div>
      </a>
      <ul class="menu-sub">
          <li
              class="menu-item {{ Route::is('foto_admin') ? 'active' : '' }}">
              <a href="{{route('foto_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="foto">{{ __('Foto') }}</div>
              </a>
          </li>
          <li class="menu-item {{ Route::is('video_admin') ? 'active' : '' }}">
              <a href="{{route('video_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="video">{{ __('Video') }}</div>
              </a>
          </li>
      </ul>
  </li>
  <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon ti ti-script"></i>
        <div data-i18n="Front_galeri">Dokumen</div>
      </a>
      <ul class="menu-sub">
          <li
              class="menu-item {{ Route::is('kategori_dokumen_admin') ? 'active' : '' }}">
              <a href="{{route('kategori_dokumen_admin')}}" class="menu-link">
                  <i class="menu-icon menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="kategori_dokumen">{{ __('kategori Dokumen') }}</div>
              </a>
          </li>
          <li class="menu-item {{ Route::is('dokumen_admin') ? 'active' : '' }}">
              <a href="{{route('dokumen_admin')}}" class="menu-link">
                  <i class="menu-icon menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="dokumen">{{ __('File') }}</div>
              </a>
          </li>
      </ul>
  </li>
  <li class="menu-item {{ Route::is('kontak_admin') ? 'active' : '' }}">
    <a href="{{route('kontak_admin')}}" class="menu-link">
      <i class="menu-icon ti ti-phone"></i>
      <div data-i18n="kontak">{{__('Kontak')}}</div>
    </a>
  </li>
  <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon ti ti-help-hexagon"></i>
        <div data-i18n="Front_galeri">Soal Soal</div>
      </a>
      <ul class="menu-sub">
          <li
              class="menu-item {{ Route::is('sku_admin') ? 'active' : '' }}">
              <a href="{{route('sku_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="kategori_dokumen">{{ __('SKU') }}</div>
              </a>
          </li>
          <li class="menu-item {{ Route::is('skk_admin') ? 'active' : '' }}">
              <a href="{{route('skk_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="skk">{{ __('SKK') }}</div>
              </a>
          </li>
          <li class="menu-item  {{ Route::is('kategori_skk_admin') ? 'active' : '' }}">
              <a href="{{route('kategori_skk_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="kategori_skk">{{ __('Kategori SKK') }}</div>
              </a>
          </li>
      </ul>
  </li>
  <li class="menu-item {{ Route::is('barang_admin') ? 'active' : '' }}">
    <a href="{{route('barang_admin')}}" class="menu-link">
    <i class="menu-icon ti ti-tool"></i>
    <div data-i18n="barang">{{__('Barang')}}</div>
    </a>
  </li>
  <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon ti ti-user-circle"></i>
        <div data-i18n="Front_galeri">User</div>
      </a>
      <ul class="menu-sub">
          <li
              class="menu-item {{ Route::is('user_admin') ? 'active' : '' }}">
              <a href="{{route('user_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="data_user">{{ __('Data User') }}</div>
              </a>
          </li>
          <li class="menu-item  {{ Route::is('pengajuan_user_admin') ? 'active' : '' }}">
              <a href="{{route('pengajuan_user_admin')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="data_pengajuan_akun">{{ __('Data Pengajuan Akun') }}</div>
              </a>
          </li>
      </ul>
  </li>

  </ul>
</aside>

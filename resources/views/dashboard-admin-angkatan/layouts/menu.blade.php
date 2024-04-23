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
    <li class="menu-item {{ Route::is('admin-angkatan.dashboard') ? 'active' : '' }}">
      <a href="{{route('admin-angkatan.dashboard')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-layout-dashboard"></i>
        <div data-i18n="Home">{{__('Dashboard')}}</div>
      </a>
    </li>
  <li class="menu-item {{ Route::is('pengajuan-admin-angkatan') ? 'active' : '' }}">
    <a href="{{route('pengajuan-admin-angkatan')}}" class="menu-link">
    <i class="menu-icon ti ti-receipt-refund"></i>
      <div data-i18n="pengajuan">{{__('Daftar Pengajuan SKU')}}</div>
    </a>
  </li>
  <li class="menu-item {{ Route::is('skk-admin-angkatan') ? 'active' : '' }}">
    <a href="{{route('skk-admin-angkatan')}}" class="menu-link">
    <i class="menu-icon ti ti-receipt-refund"></i>
      <div data-i18n="skk">{{__('Daftar Pengajuan SKK')}}</div>
    </a>
  </li>
  <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon ti ti-user-circle"></i>
        <div data-i18n="Front_galeri">User</div>
      </a>
      <ul class="menu-sub">
          <li
              class="menu-item {{ Route::is('user_admin_angkatan') ? 'active' : '' }}">
              <a href="{{route('user_admin_angkatan')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="data_user">{{ __('Data User') }}</div>
              </a>
          </li>
          <li class="menu-item {{ Route::is('pengajuan_user_admin_angkatan') ? 'active' : '' }}">
              <a href="{{route('pengajuan_user_admin_angkatan')}}" class="menu-link">
                  <i class="menu-icon tf-icons ti ti-chalkboard"></i>
                  <div data-i18n="data_pengajuan_akun">{{ __('Data Pengajuan Akun') }}</div>
              </a>
          </li>
      </ul>
  </li>
  </ul>
</aside>

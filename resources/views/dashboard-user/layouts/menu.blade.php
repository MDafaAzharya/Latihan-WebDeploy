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
      <a href="{{route('user.dashboard')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-layout-dashboard"></i>
        <div data-i18n="Home">{{__('Dashboard')}}</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="ti ti-mail"></i>
      <div data-i18n="sku">SKU</div>
      </a>
      <ul class="menu-sub">
      <li class="menu-item {{ Route::is('pengajuan-user') ? 'active' : '' }}">
        <a href="{{route('pengajuan-user')}}" class="menu-link">
        <i class="ti ti-receipt-refund"></i>
          <div data-i18n="pengajuan">{{__('Pengajuan')}}</div>
        </a>
      </li>
      <li class="menu-item {{ Route::is('daftar-pengajuan-user') ? 'active' : '' }}">
        <a href="{{route('daftar-pengajuan-user')}}" class="menu-link">
        <i class="ti ti-clipboard-list"></i>
          <div data-i18n="daftarpengajuan">{{__('Daftar Pengajuan')}}</div>
        </a>
      </li>
      </ul>
  </li>
  <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="ti ti-vocabulary"></i>
      <div data-i18n="skk">SKK</div>
      </a>
      <ul class="menu-sub">
      <li class="menu-item {{ Route::is('skk-user') ? 'active' : '' }}">
        <a href="{{route('skk-user')}}" class="menu-link">
        <i class="ti ti-receipt-refund"></i>
          <div data-i18n="skk">{{__('Pengajuan')}}</div>
        </a>
      </li>
      <li class="menu-item {{ Route::is('daftar-skk-user') ? 'active' : '' }}">
        <a href="{{route('daftar-skk-user')}}" class="menu-link">
        <i class="ti ti-clipboard-list"></i>
          <div data-i18n="daftarskk">{{__('Daftar Pengajuan')}}</div>
        </a>
      </li>
      </ul>
  </li>
  </ul>
</aside>

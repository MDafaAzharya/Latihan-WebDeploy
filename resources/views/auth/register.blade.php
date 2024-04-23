<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-bsi" data-assets-path="{{ asset('/assets') }}/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Donor Relationship</title>

  <meta name="description" content="" />

  <link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/fontawesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/tabler-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/flag-icons.css') }}" />
  <link rel="stylesheet" href="{{ asset('/assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('/assets/vendor/css/rtl/theme-bsi.css') }}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />
  <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/node-waves/node-waves.css') }}" />
  <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
  <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
  <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('/assets/vendor/css/pages/page-auth.css') }}" />
  <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
  <script src="{{ asset('/assets/js/config.js') }}"></script>
  <style>
    .btn-pramuka {
    color: #fff;
    background-color: #663996;
    border-color: #663996;
  }
  </style>
</head>

<body>
  <div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
      <div class="d-none d-lg-flex col-lg-7 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
          <img src="{{ asset('/assets/img/illustrations/auth-login-illustration-light.png') }}" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-login-illustration-light.png" data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

          <img src="{{ asset('/assets/img/illustrations/bg-shape-image-light.png') }}" alt="auth-login-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png" />
        </div>
      </div>
      <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
        <div class="w-px-400 mx-auto">
          <div class="app-brand mb-4">
            {{-- <span class="app-brand-logo w-100 mb-5">
              <img src="{{asset('/assets/img/logo-wide.png')}}" class="w-100"/>
            </span> --}}
          </div>
          <form id="formAuthentication" class="mb-3" action="{{ route('signup') }}" method="POST">
            @csrf
            <input type="hidden" name="tingkat_skk" value="1">
            <input type="hidden" name="tingkat" value="1">
            <input type="hidden" name="role" value="user">
            <div class="mb-3">
                <label for="nama" class="form-label">{{ __('Nama Lengkap') }}</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="username" name="nama" placeholder="Enter your Nama" required autocomplete="nama" autofocus value="{{ old('nama') }}" />
                @error('nama')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nomor" class="form-label">{{ __('Nomor Telepon') }}</label>
                <input type="number" class="form-control @error('nomor') is-invalid @enderror" id="nomor" name="nomor" placeholder="Enter your nomor" required autocomplete="nomor" autofocus value="{{ old('nomor') }}" />
                @error('nomor')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="angkatan" class="form-label">Angkatan</label>
                <select name="angkatan" class="form-control">
                  @for ($i = 1; $i <= 100; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
                </select>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">{{ __('Email') }}</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="username" name="email" placeholder="Enter your email" required autocomplete="username" autofocus value="{{ old('email') }}" />
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between"> <label class="form-label"
                        for="password">{{ __('Password') }}</label>
                </div>
                <div class="input-group input-group-merge"> <input type="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" name="password"
                        required autocomplete="current-password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" /> <span class="input-group-text cursor-pointer"><i
                            class="ti ti-eye-off"></i></span> </div> @error('password')
                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="mb-3 form-password-toggle"> <label for="email"
                    class="form-label">{{ __('Konfirmasi Password') }}</label>
                <div class="input-group input-group-merge"> <input type="password" id="password_confirmation"
                        class="form-control " name="password_confirmation"
                        required autocomplete="current-password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" /> <span class="input-group-text cursor-pointer"><i
                            class="ti ti-eye-off"></i></span> </div>
            </div>

            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                <label class="form-check-label" for="remember-me"> Remember Me </label>
              </div>
            </div>
            <button type="submit" class="btn btn-pramuka d-grid w-100">{{ __('Register') }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
  <script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
  <script src="{{ asset('/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
  <script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('/assets/vendor/libs/hammer/hammer.js') }}"></script>
  <script src="{{ asset('/assets/vendor/libs/i18n/i18n.js') }}"></script>
  <script src="{{ asset('/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  <script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
  <script src="{{ asset('/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
  <script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
  <script src="{{ asset('/assets/js/main.js') }}"></script>
  <script src="{{ asset('/assets/js/pages-auth.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@if (session()->has('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: "Sukses!",
            text: "{{ session()->get('success') }}",
            icon: "success",
            button: "OK",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        });
    });
</script>

@endif

</body>

</html>

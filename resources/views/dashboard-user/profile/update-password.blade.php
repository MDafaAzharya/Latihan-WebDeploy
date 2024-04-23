@extends('dashboard-user.layouts.app')

@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
    <style>
        .user-profile-header-banner img {
            width: 100%;
            -o-object-fit: cover;
            object-fit: cover;
            height: 250px;
        }

        .user-profile-header {
            margin-top: -2rem;
        }

        .user-profile-header .user-profile-img {
            border: 5px solid;
            width: 120px;
        }

        .light-style .user-profile-header .user-profile-img {
            border-color: #fff;
        }

        .dark-style .user-profile-header .user-profile-img {
            border-color: #2f3349;
        }

        .dataTables_wrapper .card-header .dataTables_filter label {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        @media (max-width: 767.98px) {
            .user-profile-header-banner img {
                height: 150px;
            }

            .user-profile-header .user-profile-img {
                width: 100px;
            }
        }
    </style>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Profil </span></h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="content-wrapper">
        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img src="{{ asset('assets/img/banner.jpg') }}" alt="Banner image" class="rounded-top" />
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            {{-- <img src="{{ asset('assets/img/avatar.jpg') }}" alt="user image"
                                class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" /> --}}
                                <div class="card-body">
                                    <form action="{{ route('dashboard.update-photo-profile-user') }}" role="form"
                                        method="POST" id="form-foto-profil" enctype="multipart/form-data">
                                        @csrf
                                        <div
                                            class="d-flex gap-3 flex-column align-items-center flex-md-row align-items-md-start">
                                            <div class="form-group mb-0 foto-profil-container">
                                                <div class="position-relative" style="width: 200px; height: 200px;">
                                                    @if (Auth::user()->gambar)
                                                        <img src="{{ asset('storage/assets/img/profile/' . Auth::user()->gambar) }}"
                                                            alt="" class="w-100 h-100"
                                                            style="object-fit: cover; border-radius: 5px;">
                                                    @else
                                                        <div class="d-flex justify-content-center align-items-center text-white"
                                                            style="width: 200px; height: 200px; background-color: #BF360C; font-size: 4em">
                                                            {{ Str::substr(Auth::user()->nama, 0, 1) }}
                                                        </div>
                                                    @endif
                                                    <!---->
                                                </div>
                                            </div>
                                            <div class="ml-md-3 mt-3 mt-sm-0">
                                                <div class="input-group">
                                                    <input type="file" name="document_photo"
                                                        accept=".jpg, .jpeg, .png" required="required"
                                                        class="form-control rep" style="box-shadow: none;">

                                                    <button type="submit" class="btn btn-primary shadow-0"><i
                                                            class="fa fa-save"></i>
                                                        Simpan</button>

                                                </div>
                                                <div class="alert alert-warning mt-3 mb-0 small">
                                                    <ul class="mb-0" style="padding-inline-start: 15px;">
                                                        <li>
                                                            Foto ukuran 300 x 300 px atau 300 x 400 px, tipe
                                                            JPG/JPEG/PNG, max 1MB
                                                        </li>
                                                        <li>
                                                            Foto resmi menggunakan seragam sekolah / jas almamater
                                                        </li>
                                                        <li>
                                                            Menggunakan backdrop sesuai dengan ketentuan sekolah /
                                                            kampus
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div
                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item d-flex gap-1">
                                            <i class="ti ti-color-swatch"></i>
                                            {{ Auth::user()->unit_kerja }}
                                        </li>
                                        <li class="list-inline-item d-flex gap-1"><i
                                                class="ti ti-map-pin"></i>{{ Auth::user()->wilayah }}</li>
                                        <li class="list-inline-item d-flex gap-1">
                                            @php
                                                $monthNames = [
                                                    'January' => 'Januari',
                                                    'February' => 'Februari',
                                                    'March' => 'Maret',
                                                    'April' => 'April',
                                                    'May' => 'Mei',
                                                    'June' => 'Juni',
                                                    'July' => 'Juli',
                                                    'August' => 'Agustus',
                                                    'September' => 'September',
                                                    'October' => 'Oktober',
                                                    'November' => 'November',
                                                    'December' => 'Desember',
                                                ];

                                                $mulai = \Carbon\Carbon::parse(Auth::user()->created_at);
                                                $indonesianMonth_mulai = $monthNames[$mulai->format('F')];
                                                $bergabung = $indonesianMonth_mulai . ' ' . $mulai->format('Y');
                                            @endphp
                                            <i class="ti ti-calendar"></i> Bergabung {{ $bergabung }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->

        <!-- Navbar pills -->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('dashboard.profile_admin_user') }}"><i
                                class="ti-xs ti ti-user-check me-1"></i>
                            Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('dashboard.ubah-password-user') }}"><i
                                class="ti-xs ti ti-user-check me-1"></i>
                            Update Password</a>
                    </li>
                </ul>
            </div>
        </div>
        <!--/ Navbar pills -->

        <!-- User Profile Content -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <h5 class="card-header">Ganti Password</h5>
                    <div class="card-body">
                        <form method="post" action="{{ route('dashboard.update-password-user') }}">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="currentPassword">Password Sekarang</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control @error('lama_salah') is-invalid @enderror" type="password"
                                            name="currentPassword" id="currentPassword" onkeyup="checkpanjang()"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                      </div>
                                      <span class="invalid-feedback-old" role="alert">
                                          <strong id="invalid-feedback-old" class="text-danger"></strong>
                                      </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">Password Baru</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" id="newPassword" name="newPassword"
                                            onkeyup="checkpanjangnew()"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                      </div>
                                      <span class="invalid-feedback-new" role="alert">
                                          <strong id="invalid-feedback-new" class="text-danger"></strong>
                                      </span>
                                </div>
        
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="confirmPassword">Konfirmasi Password Baru</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="confirmPassword" id="confirmPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                      </div>
                                      <span class="invalid-feedback-confirm" role="alert">
                                          <strong id="invalid-feedback-confirm"></strong>
                                      </span>
                                </div>
                                <div class="col-12 mb-4">
                                    <h6>Syarat:</h6>
                                    <ul class="ps-3 mb-0">
                                        <li class="mb-1">Minimum 8 Panjang Karakter</li>
                                    </ul>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary me-2" id="submitpassword" disabled>Update
                                        Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ User Profile Content -->
    </div>
    <div class="content-backdrop fade"></div>
    </div>
@endsection

@push('script')
<script>
    function checkpanjang() {
        var inputText = document.getElementById("currentPassword").value;
        if (inputText.length <= 7) {
            document.getElementById("invalid-feedback-old").textContent = "Input must be exactly 8 characters long.";
        } else {
            document.getElementById("invalid-feedback-old").textContent = "";
        }
    }

    function checkpanjangnew() {
        var inputText = document.getElementById("newPassword").value;
        if (inputText.length <= 7) {
            document.getElementById("invalid-feedback-new").textContent = "Input must be exactly 8 characters long.";
        } else {
            document.getElementById("invalid-feedback-new").textContent = "";
        }
    }
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil elemen input dan tombol
        var newPasswordInput = document.getElementById("newPassword");
        var confirmPasswordInput = document.getElementById("confirmPassword");
        var submitButton = document.getElementById("submitpassword");
        var errorMessage = document.getElementById("invalid-feedback-confirm");

        // Tambahkan event listener untuk memeriksa kesesuaian kata sandi
        newPasswordInput.addEventListener("input", checkPasswordMatch);
        confirmPasswordInput.addEventListener("input", checkPasswordMatch);

        function checkPasswordMatch() {
            var newPassword = newPasswordInput.value;
            var confirmPassword = confirmPasswordInput.value;

            if (newPassword === confirmPassword) {
                // Kata sandi sesuai, aktifkan tombol submit dan hapus pesan kesalahan
                submitButton.removeAttribute("disabled");
                errorMessage.textContent = "";
            } else {
                // Kata sandi tidak sesuai, nonaktifkan tombol submit dan tampilkan pesan kesalahan
                submitButton.setAttribute("disabled", "disabled");
                errorMessage.textContent = "Konfirmasi kata sandi tidak sesuai dengan kata sandi baru.";
            }
        }
    });
</script>
@endpush

@extends('dashboard.layouts.app')

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
                                <form action="{{ route('dashboard.update-photo-profile') }}" role="form" method="POST"
                                    id="form-foto-profil" enctype="multipart/form-data">
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
                                                <input type="file" name="document_photo" accept=".jpg, .jpeg, .png"
                                                    required="required" class="form-control rep" style="box-shadow: none;">

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
                        <a class="nav-link active" href="{{ route('profile.index') }}"><i
                                class="ti-xs ti ti-user-check me-1"></i>
                            Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.ubah-password') }}"><i
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
                <div class="card">
                    <div class="card-body">
                        <form role="form" method="POST" enctype="multipart/form-data"
                            action="{{ route('profile.update', Auth::user()->id) }}" class="biodata-form">
                            @csrf
                            @method('put')
                            <h4 class="mb-3">Informasi Dasar</h4>
                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nama Lengkap
                                            <span class="text-danger">*</span></label>
                                        <input name="nama" type="text" placeholder="Contoh: Budi Setiawan"
                                            value="{{ Auth::user()->nama }}"
                                            class="form-control @error('nama')
                                                is-invalid
                                            @enderror">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email">Email<span
                                                class="text-danger">*</span></label>
                                        <input type="email" value="{{ auth::user()->email }}" disabled="disabled"
                                            class="form-control
                                            @error('email')
                                            is-invalid
                                            @enderror">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">
                                            No. Telp. <span class="text-danger">*</span> <i data-mdb-toggle="tooltip"
                                                data-mdb-placement="right" title="Masukkan tanpa awalan 0 atau +62"
                                                class="fa fa-question-circle text-muted small"
                                                data-mdb-title="Masukkan tanpa awalan 0 atau +62"></i></label>
                                        <div
                                            class="input-group form-outline @error('nomor')
                                            mb-3
                                        @enderror">
                                            <span class="input-group-text">+62</span>
                                            <input name="nomor" type="tel" required="required"
                                                placeholder="8123456789" value="{{ auth::user()->nomor }}"
                                                class="form-control
                                                @error('nomor')
                                                    is-invalid
                                                @enderror">
                                            @error('nomor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="gender" class="form-label">Jenis Kelamin
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="gender" required="required" class="form-control">
                                            <option value="1"
                                                {{ AUth::user()->jenis_kelamin == '1' ? 'selected="selected"' : '' }}>
                                                Laki - Laki</option>
                                            <option value="2"
                                                {{ AUth::user()->jenis_kelamin == '2' ? 'selected="selected"' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="religion" class="form-label">Nomor Tanda Anggota <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="nta" placeholder=".."
                                            value="{{ Auth::user()->nta }}"
                                            class="form-control @error('nta')
                                                is-invalid
                                            @enderror">
                                        @error('nta')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="place_of_birth" class="form-label">Tempat Lahir <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="tempat_lahir" placeholder="Bandung"
                                            value="{{ Auth::user()->tempat_lahir }}"
                                            class="form-control @error('tempat_lahir')
                                                is-invalid
                                            @enderror">
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label" for="ecommerce-product-barcode">Tanggal Lahir</label>
                                    <div class="input-group date">
                                        <input type="date" class="form-control" name="tanggal_lahir"
                                            value="{{ Auth::user()->tanggal_lahir }}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="religion" class="form-label">Agama <span
                                                class="text-danger">*</span></label>
                                                <select name="agama" class="form-control">
                                                    <option value="Islam">Islam</option>
                                                    <option value="Kristen">Kristen</option>
                                                    <option value="Buddha">Buddha</option>
                                                    <option value="Hindu">Hindu</option>
                                                    <option value="Konghucu">Konghucu</option>
                                                </select>
                                        @error('agama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="home_address" class="form-label">
                                            Alamat Rumah <span class="text-danger">*</span>
                                        </label>
                                        <textarea name="alamat_rumah" rows="4" placeholder="Jl. Giligrejo No.10"
                                            class="form-control @error('alamat_rumah')
                                            is-invalid
                                        @enderror">{{ Auth::user()->alamat }}</textarea>
                                        @error('alamat_rumah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 row w-100 mx-auto px-0">
                                    <div class="col-12 row w-100 mx-auto px-0">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="id-province" class="form-label">Provinsi <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="provinsi" placeholder="Bandung"
                                                    value="{{ Auth::user()->provinsi }}"
                                                    class="form-control @error('provinsi')
                                                            is-invalid
                                                        @enderror">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="id-city" class="form-label">Kota/Kabupaten
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="kota" placeholder="Bandung"
                                                    value="{{ Auth::user()->kota }}"
                                                    class="form-control @error('kota')
                                                    is-invalid
                                                @enderror">
                                                @error('kota')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="id-subdistrict" class="form-label">
                                                    Kecamatan <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="kecamatan" placeholder="Bandung"
                                                    value="{{ Auth::user()->kecamatan }}"
                                                    class="form-control @error('kecamatan')
                                                    is-invalid
                                                @enderror">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label for="postal-code" class="form-label">Kode Pos
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input id="postal-code" name="kode_pos" type="text"
                                                    placeholder="Contoh: 50742" required="required"
                                                    class="form-control @error('kode_pos')
                                                        is-invalid
                                                    @enderror"
                                                    value="{{ Auth::user()->kode_pos }}">
                                                @error('kode_pos')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}tanggal_lahir
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mb-3">Link dan Social Media</h4>
                            <div class="row g-3">
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label for="facebook" class="form-label">Facebook</label>
                                        <input name="socmed_facebook" type="url"
                                            placeholder="https://facebook.com/Username"
                                            value="{{ Auth::user()->sosmed_facebook }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="instagram" class="form-label">Instagram</label>
                                        <input name="socmed_instagram" type="url"
                                            placeholder="https://instagram.com/Username"
                                            value="{{ Auth::user()->sosmed_instagram }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="instagram" class="form-label">tiktok</label>
                                        <input name="socmed_tiktok" type="url"
                                            placeholder="https://tiktok.com/Username"
                                            value="{{ Auth::user()->sosmed_tiktok }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4"><button type="submit"
                                    class="btn btn-block btn-center col-12 px-4 py-2 btn-primary">
                                    Simpan Perubahan
                                </button></div>
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
@endpush

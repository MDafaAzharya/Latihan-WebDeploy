@extends('dashboard-user.layouts.app')

@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />

    <style>
        @media (min-width: 320px) and (max-width: 767px){
        .form-control{
            width :65vw;
        }
        .ck.ck-editor {
            width: 63% !important;
        }
    }
    </style>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Pengajuan SKU </h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mb-2"> 
	    <div class="card-body"> 
        @php
        $pengajuanBelumLulus = \App\Models\PengajuanSKU::where('nama_lengkap', Auth::id())
                                    ->where('status', 'test')
                                    ->count() > 0;
        @endphp
        @if (Auth::user()->jenis_kelamin && Auth::user()->tempat_lahir && Auth::user()->tanggal_lahir && Auth::user()->agama && 
            Auth::user()->alamat && Auth::user()->provinsi && Auth::user()->kota && Auth::user()->kecamatan) 
            @if ($pengajuanBelumLulus)
                <button class="btn btn-primary mb-3" onclick="showAlert()">Minta Pengajuan</button> 
                <script> 
                    function showAlert() { 
                        Swal.fire('Belum bisa mengajukan!', 'Anda masih mempunyai pengajuan yang belum lulus.', 'warning') 
                    } 
                </script> 
            @else
                <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Minta Pengajuan</a> 
            @endif
        @else 
            <button class="btn btn-primary mb-3" onclick="showAlert()">Minta Pengajuan</button> 
            <script> 
                function showAlert() { 
                    Swal.fire('Belum bisa mengajukan!', 'Silahkan isi data diri Anda di profil terlebih dahulu.', 'warning') 
                } 
            </script> 
        @endif
    </div> 
    </div>
    <div class="card">
        <h5 class="card-header">Pengajuan</h5>
        <div class="card-datatable text-nowrap table-responsive">
            <table class="datatables-ajax table table-striped-columns" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tingkat</th>
                        <th>Detail</th>
                        <th>Sertifikat</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-px-400 mx-auto">
                        <form id="formAuthentication" class="mb-3" action="{{ route('pengajuan_user.data-pengajuan_user-register') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="status" value="Test">
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Nama ') }}</label>
                                @foreach ($namauser as $nama)
                                <input type="hidden" name="id" id="id" value="{{$nama->id}}">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" placeholder="nama" required autocomplete="kategori" autofocus readonly
                                    value="{{ $nama->nama }}" />
                                    @endforeach @error('nama')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Angkatan ') }}</label>
                                <input type="text" class="form-control @error('angkatan') is-invalid @enderror"
                                    id="angkatan" name="angkatan" placeholder="angkatan" required autocomplete="kategori" autofocus readonly
                                    value="{{ Auth::user()->angkatan }}" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">{{ __('Tingkat') }}</label>
                                <select name="tingkat" id="tingkat" class="form-select form-control">
                                    @foreach ($tingkat as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == Auth::user()->tingkat ? 'selected' : '' }} {{ $item->id != Auth::user()->tingkat ? 'disabled' : '' }}>
                                            {{ $item->nama_tingkat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="mb-3"> <div class="form-check"> <input class="form-check-input" type="checkbox" id="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /> <label class="form-check-label" for="remember-me"> Remember Me </label> </div> </div> --}} <button
                                class="btn btn-primary d-grid form-control">{{ __('Tambah') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('vendor-js')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('page-js')
    <script type="text/javascript">
        moment.locale('id');

        var table = $('#table').DataTable({
            ajax: `{{ route('pengajuan.pengajuan-user-datatable') }}`,
            scrollX: true,
            // searching: true,
            paging: true,
            processing: true,
            serverSide: true,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama',
                    name: 'nama',
                    searchable: false
                },
                {
                    data: 'tingkat',
                    name: 'tingkat',
                    searchable: false
                },
                {
                    data: 'detail',
                    name: 'detail',
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        })
        $(document).delegate('.btn-edit', 'click', function() {
            // e.preventDefault();
            const id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: "{{ url('user/detail-user/detail-user-edit') }}/" + id,
                type: 'get',
                data: {
                    _token: `{{ csrf_token() }}`,
                    id
                },
            })
        })
    </script>
@endsection

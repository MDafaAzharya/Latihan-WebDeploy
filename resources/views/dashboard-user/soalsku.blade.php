@extends('dashboard-user.layouts.app')

@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
    <style>
        .checkbox{
            cursor :pointer;
        }
        .btn-save{
            height:25px;
        }
        @media (min-width: 320px) and (max-width: 767px){
        .btn-save{
            height:35px;
        }
        .form-control{
            width :65vw;
        }
    }
    </style>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Tes SKU </h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
       
        <div class="ms-3 mt-3">
            @foreach ($nama_pengaju as $nama)
            <p><strong>Nama pengaju : {{$nama->nama }}</strong></p>
            @endforeach
            @foreach ($nama_tingkat as $list)
            <p><strong>Tingkat : {{$list->nama_tingkat }}</strong></p>
            @endforeach
        </div>
        <h5 class="card-header">Daftar Soal</h5>
        @foreach ($soalSKU as $item)
        <form action="{{ route('pengajuan.soal-sku-user-jawaban') }}" method="post">
        @csrf
            <input type="hidden" name="soal_id" value="{{ $item->id }}">
            <input type="hidden" name="pengaju_id" value="{{$user->nama_lengkap}}">
            <input type="hidden" name="pengajuan" value="{{$user->id}}">
            <div class="row mx-5">
                <div class="col-4">{{ $item->soal }}</div>
                <div class="col-5" style="text-align: right;">
                @php
                    $jawaban = \App\Models\JawabanSKU::where('soal', $item->id)
                        ->where('pengaju', $user->nama_lengkap)
                        ->first();
                @endphp
                <input class="checkbox" type="checkbox" name="validasi" id="validasi" {{ $jawaban && $jawaban->status == 1 ? 'checked' : '' }}>
                </div>
                <hr class="opacity-75 mt-2">
            </div>
        </form>
        @endforeach
        <div class="d-flex justify-content-end me-5 my-3">
        <button class="btn btn-primary p-2 mx-1" data-bs-toggle="modal" data-bs-target="#buatSertifikatModal" {{ $semuaJawabanSudahTerjawab ? '' : 'disabled' }}>
            Selesai & Buat Sertifikat
        </button>
        </div>
       
    </div>

    <div class="modal fade" id="buatSertifikatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="mb-3" method="post"
                action="{{ route('generate-sertifikat-user') }}" enctype="multipart/form-data">
                @csrf
                @foreach ($nama_pengaju as $item)
                <input type="hidden" name="pengaju" value="{{ $item-> id}}">
                @endforeach
                @foreach ($nama_penguji as $item)
                <input type="hidden" name="penguji" value="{{ $item->id}}">
                @endforeach
                <div class="modal-body">
                @foreach ($nama_pengaju as $item)
                    <div class="mb-3"> <label for="email" class="form-label">{{ __('Nama') }}</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                        id="nama" name="nama" placeholder="nama" required autocomplete="kategori" autofocus readonly
                        value="{{ $item->nama }}" /> @error('nama')
                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="mb-3"> <label for="email" class="form-label">{{ __('Tempat Lahir') }}</label>
                        <input type="text" class="form-control @error('tempat') is-invalid @enderror"
                        id="tempat" name="tempat" placeholder="tempat" required autocomplete="kategori" autofocus readonly
                        value="{{ $item->tempat_lahir }}" /> @error('tempat')
                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="mb-3"> <label for="email" class="form-label">{{ __('Tanggal') }}</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                        id="tanggal" name="tanggal" placeholder="tanggal" required autocomplete="kategori" autofocus readonly
                        value="{{ $item->tanggal_lahir }}" /> @error('tanggal')
                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    @endforeach
                    @foreach ($nama_tingkat as $list)
                    <div class="mb-3"> <label for="email" class="form-label">{{ __('Tingkat') }}</label>
                        <input type="text" class="form-control @error('tingkat') is-invalid @enderror"
                        id="tingkat" name="tingkat" placeholder="tingkat" required autocomplete="kategori" autofocus readonly
                        value="{{ $list->nama_tingkat }}" /> @error('tingkat')
                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    @endforeach
                {{-- <div class="mb-3"> <div class="form-check"> <input class="form-check-input" type="checkbox" id="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /> <label class="form-check-label" for="remember-me"> Remember Me </label> </div> </div> --}} <button
                    class="btn btn-primary d-grid form-control">{{ __('Kirim') }}</button>
                    </div>
                </form>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var checkboxes = document.querySelectorAll('input[name="validasi"]');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                var form = this.closest('form');
                form.submit();
            });
        });
    });
</script>

@endsection

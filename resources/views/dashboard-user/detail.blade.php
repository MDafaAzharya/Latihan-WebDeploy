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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Result Tes SKU </h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
       
        <div class="ms-3 mt-3">
           @foreach ($penguji as $nama)
                <p><strong>Nama penguji : {{$nama->nama }}</strong></p>
           @endforeach
           @foreach ($pengaju as $nama)
                <p><strong>Nama pengaju : {{$nama->nama }}</strong></p>
           @endforeach
        </div>
        <h5 class="card-header">Daftar Soal</h5>
        @foreach ($soal as $index => $item)
            <div class="row mx-5">
                <div class="col-4">{{ $item->soal }}</div>
                <div class="col-5" style="text-align: right;">
                <p>{{ \Carbon\Carbon::parse($tanggal[$index])->format('d F Y') }}</p>
                </div>
                <hr class="opacity-75 mt-2">
            </div>
        @endforeach
        <div class="d-flex justify-content-end me-5 my-3">
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

@endsection

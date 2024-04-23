@extends('dashboard.layouts.app')

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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Soal SKK </h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mb-2">
        <div class="card-body">
            <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah
                Soal</a>
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">Soal SKK </h5>
        <div class="card-datatable text-nowrap table-responsive">
            <table class="datatables-ajax table table-striped-columns" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Kategori</th>
                        <th>Kategori Khusus</th>
                        <th>Action</th>
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
                        <form id="formAuthentication" class="mb-3" action="{{ route('skk.data-skk-register') }}"
                            method="POST">
                            @csrf
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Soal') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="nama" placeholder="name" required autocomplete="kategori" autofocus
                                    value="{{ old('name') }}" /> @error('name')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">{{ __('Tingkat') }}</label>
                                <select name="tingkat" id="tingkat" class="form-select">
                                @foreach ($tingkat as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_tingkat }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">{{ __('Kategori') }}</label>
                                <select name="kategori" id="kategori" class="form-select form-control">
                                @foreach ($kategori_khusus as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
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

    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-px-400 mx-auto">
                        <form id="formAuthentication" class="mb-3" method="post"
                            action="{{ route('skk.data-skk-update') }}">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Soal') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="nama" name="nama" placeholder="name" required autocomplete="kategori" autofocus
                                    value="{{ old('name') }}" /> @error('name')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">{{ __('Tngkat') }}</label>
                                <select name="tingkat" id="tingkat_edit" class="form-select">
                                @foreach ($tingkat as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_tingkat }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">{{ __('Kategori') }}</label>
                                <select name="kategori_edit" id="kategori_edit" class="form-select form-control">
                                @foreach ($kategori_khusus as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                                </select>
                            </div>
                            {{-- <div class="mb-3"> <div class="form-check"> <input class="form-check-input" type="checkbox" id="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /> <label class="form-check-label" for="remember-me"> Remember Me </label> </div> </div> --}} <button
                                class="btn btn-primary d-grid form-control">{{ __('Edit Data') }}</button>
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
            ajax: `{{ route('skk.data-skk-datatable') }}`,
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
                    data: 'kategori',
                    name: 'kategori',
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

        $(document).delegate('.btn-delete', 'click', function() {
            const id = $(this).data('id');
            Swal.fire({
                title: "Hapus Data ?",
                text: "Apakah anda yakin akan menghapus data ini ?",
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus',
                icon: 'question'
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('dashboard/skk_admin/data-skk-delete') }}/" + id,
                        type: 'get',
                        data: {
                            _token: `{{ csrf_token() }}`,
                            id
                        },
                        success: function(resp) {
                            return Swal.fire('Berhasil !', 'Data berhasil dihapus', 'success')
                                .then(() => table.ajax.reload());
                        },
                        error: function(err) {
                            const errorResp = JSON.parse(err.responseText);
                            return Swal.fire('Gagal !',
                                `Data gagal dihapus: ${errorResp.message}`, 'error');
                        }
                    })
                }
            })
        })
        $(document).delegate('.btn-edit', 'click', function() {
            const id = $(this).data('id');
            $.ajax({
                url: "{{ url('dashboard/skk_admin/data-skk-edit') }}/" + id,
                type: 'get',
                data: {
                    _token: `{{ csrf_token() }}`,
                    id
                },
                success: function(resp) {
                    $('#id').val(resp.id);
                    $('#nama').val(resp.soal);
                    $('#tingkat_edit').val(resp.kategori);
                    $('#kategori_edit').val(resp.kategori_khusus);
                    $('#editmodal').modal('show');
                },
                error: function(err) {
                    const errorResp = JSON.parse(err.responseText);
                    return Swal.fire('Gagal !',
                        `Data gagal dihapus: ${errorResp.message}`, 'error');
                }
            })
        })
    </script>
@endsection

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
       
    }
    </style>
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Kategori Dokumen </h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mb-2">
        <div class="card-body">
            <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah
                Kategori</a>
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">Kategori Dokumen</h5>
        <div class="card-datatable text-nowrap table-responsive">
            <table class="datatables-ajax table table-striped-columns" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
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
                        <form id="formAuthentication" class="mb-3" action="{{ route('kategori_dokumen.data-kategori_dokumen-register') }}"
                            method="POST">
                            @csrf
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Nama Kategori') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="name" required autocomplete="kategori" autofocus
                                    value="{{ old('name') }}" /> @error('name')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                            action="{{ route('kategori_dokumen.data-kategori_dokumen-update') }}">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Nama Kategori') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="nama" name="name" placeholder="name" required autocomplete="kategori" autofocus
                                    value="{{ old('name') }}" /> @error('name')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
            ajax: `{{ route('kategori_dokumen.data-kategori_dokumen-datatable') }}`,
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
                    data: 'name',
                    name: 'name',
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
                        url: "{{ url('dashboard/kategori_dokumen_admin/data-kategori_dokumen-delete') }}/" + id,
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
            // e.preventDefault();
            const id = $(this).data('id');
            $.ajax({
                url: "{{ url('dashboard/kategori_dokumen_admin/data-kategori_dokumen-edit') }}/" + id,
                type: 'get',
                data: {
                    _token: `{{ csrf_token() }}`,
                    id
                },
                success: function(resp) {
                    $('#id').val(resp.id);
                    $('#nama').val(resp.name);
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

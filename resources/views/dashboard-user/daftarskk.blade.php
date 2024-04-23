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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Daftar Pengaju SKK </h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <h5 class="card-header">Pengaju</h5>
        <div class="card-datatable text-nowrap table-responsive">
            <table class="datatables-ajax table table-striped-columns" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tingkat</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
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
                        <form id="formAuthentication" class="mb-3" action="{{ route('skk.daftar-skk-user-update') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="nama" id="nama">
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Nama ') }}</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="username_palsu" name="nama_palsu" placeholder="nama" required autocomplete="kategori" autofocus readonly
                                    />
                                 
                            </div>
                            <input type="hidden" name="tingkat" id="tingkat">
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Tingkat ') }}</label>
                                <input type="text" class="form-control @error('tingkat') is-invalid @enderror"
                                    id="tingkat_palsu" name="tingkat_palsu" placeholder="tingkat" required autocomplete="kategori" autofocus readonly
                                     />
                                
                            </div>
                            <input type="hidden" name="kategori" id="kategori">
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Kategori ') }}</label>
                                <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                    id="kategori_palsu" name="kategori_palsu" placeholder="tingkat" required autocomplete="kategori" autofocus readonly
                                     />
                                
                            </div>
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('tanggal ') }}</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                id="tanggal" name="tanggal" placeholder="tanggal" required autocomplete="kategori" autofocus
                                />
                              
                              
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
            ajax: `{{ route('skk.daftar-skk-user-datatable') }}`,
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
                    data: 'pengaju',
                    name: 'pengaju',
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
                    data: 'tanggal',
                    name: 'tanggal',
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
            $.ajax({
                url: "{{ url('user/daftar-skk-user/daftar-skk-user-edit') }}/" + id,
                type: 'get',
                data: {
                    _token: `{{ csrf_token() }}`,
                    id
                },
                success: function(resp) {
                    $('#id').val(resp.id);
                    $('#nama').val(resp.nama);
                    $('#username_palsu').val(resp.nama_lengkap);
                    $('#tingkat').val(resp.tingkat);
                    $('#tingkat_palsu').val(resp.tingkat_palsu);
                    $('#kategori').val(resp.kategori);
                    $('#kategori_palsu').val(resp.kategori_palsu);
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

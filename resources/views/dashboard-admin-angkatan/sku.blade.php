@extends('dashboard-admin-angkatan.layouts.app')

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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Pengajuan </h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <h5 class="card-header">Daftar Pengajuan</h5>
        <div class="card-datatable text-nowrap table-responsive">
            <table class="datatables-ajax table table-striped-columns" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tingkat</th>
                        <th>Angkatan</th>
                        <th>Penguji</th>
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
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-px-400 mx-auto">
                        <form id="formAuthentication" class="mb-3" method="post"
                            action="{{ route('pengajuan.pengajuan-admin-angkatan-update') }}">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="username" id="username">
                            <input type="hidden" name="tingkat" id="tingkat">
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Nama') }}</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="username_palsu" name="username_palsu" required autocomplete="nama" autofocus readonly
                                    value="{{ old('nama') }}" /> @error('nama')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('tingkat') }}</label>
                                <input type="text" class="form-control @error('image') is-invalid @enderror"
                                    id="tingkat_palsu" name="tingkat_palsu" autofocus readonly
                                    value="{{ old('judul') }}" /> @error('judul')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">{{ __('Penguji') }}</label>
                                <select name="penguji" id="penguji" class="form-select form-control">
                                    @foreach ($penguji as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="mb-3"> <div class="form-check"> <input class="form-check-input" type="checkbox" id="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /> <label class="form-check-label" for="remember-me"> Remember Me </label> </div> </div> --}} <button
                                class="btn btn-primary d-grid form-control">{{ __('Simpan') }}</button>
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
            ajax: `{{ route('pengajuan.pengajuan-admin-angkatan-datatable') }}`,
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
                },
                {
                    data: 'angkatan',
                    name: 'angkatan',
                },
                {
                    data: 'penguji',
                    name: 'penguji',
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
             const id = $(this).data('id');
             $.ajax({
                 url: "{{ url('admin-angkatan/pengajuan-admin-angkatan/pengajuan-admin-angkatan-edit') }}/" + id,
                 type: 'get',
                 data: {
                     _token: `{{ csrf_token() }}`,
                     id
                 },
                 success: function(resp) {
                     $('#id').val(resp.id);
                     $('#username_palsu').val(resp.nama_lengkap);
                     $('#tingkat_palsu').val(resp.tingkat_palsu);
                     $('#username').val(resp.nama);
                      $('#tingkat').val(resp.tingkat);
                     console.log(resp.penguji);
                     $('#tingkat').empty();
                    $('#penguji').append($('<option>', {
                      value: '',
                      text: 'Select penguji',
                    }));
                    $.each(resp.penguji, function (index, value) {
                      $('#penguji').append($('<option>', {
                        value: value.id,
                        text: value.nama,
                      }));
                    });
                    $('#penguji').val('default-value')
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
    <script>
      $('.btn-close').click(function(){
        $('#editmodal').modal('hide');
        window.location.reload();
      })
    </script>
@endsection

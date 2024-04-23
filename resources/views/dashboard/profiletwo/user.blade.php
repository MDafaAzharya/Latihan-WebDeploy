@extends('dashboard.layouts.app')

@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> User </h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <h5 class="card-header">Daftar User</h5>
        <div class="card-datatable text-nowrap table-responsive">
            <table class="datatables-ajax table table-striped-columns" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Tingkat</th>
                        <th>Role</th>
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
                        <form id="formAuthentication" class="mb-3" method="post"
                            action="{{ route('user.data-user-update') }}">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="email" required autocomplete="kategori" autofocus
                                    value="{{ old('email') }}" /> @error('email')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Password') }}</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="password" autocomplete="kategori" autofocus
                                    value="{{ old('password') }}" /> @error('password')
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
            ajax: `{{ route('user.data-user-datatable') }}`,
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
                    data: 'username',
                    name: 'username',
                    searchable: false
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'tingkat',
                    name: 'tingkat',
                },
                 {
                    data: 'role',
                    name: 'role',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        })

        $(document).delegate('.btn-promosi', 'click', function () {
            const id = $(this).data('id');
            const username = $(this).data('username');
            const btnText = $(this).text().trim(); // Simpan teks tombol sebelum masuk ke dalam fungsi $.ajax

            // Tampilkan Sweet Alert untuk konfirmasi dengan nama pengguna
            Swal.fire({
                title: 'Konfirmasi ' + (btnText === 'Turunkan Jabatan' ? 'Penurunan Jabatan' : 'Promosi'),
                text: `Apakah Anda yakin ingin ${btnText === 'Turunkan Jabatan' ? 'menurunkan jabatan' : 'mempromosikan'} pengguna ${username}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna menekan tombol "Ya"
                    const url = (btnText === 'Turunkan Jabatan') ? "{{ url('dashboard/user_admin/data-user-down') }}/" : "{{ url('dashboard/user_admin/data-user-promosi') }}/";

                    $.ajax({
                        url: url + id,
                        type: 'post',
                        data: {
                            _token: `{{ csrf_token() }}`,
                            user_id: id,
                            // Tambahkan data lain yang diperlukan untuk promosi/turunkan jabatan pengguna
                        },
                        success: function (response) {
                            // Handle respons setelah promosi/turunkan jabatan berhasil
                            Swal.fire('Berhasil !', `Pengguna telah ${btnText === 'Turunkan Jabatan' ? 'diturunkan jabatannya' : 'dipromosikan menjadi Admin Angkatan'}.`, 'success');
                            location.reload(true);
                        },
                        error: function (err) {
                            const errorResp = JSON.parse(err.responseText);
                            Swal.fire('Gagal !', `Proses gagal: ${errorResp.message}`, 'error');
                        }
                    });
                }
            });
        });

        $(document).delegate('.btn-edit', 'click', function() {
            const id = $(this).data('id');
            $.ajax({
                url: "{{ url('dashboard/user_admin/data-user-edit') }}/" + id,
                type: 'get',
                data: {
                    _token: `{{ csrf_token() }}`,
                    id
                },
                success: function(resp) {
                    $('#id').val(resp.id);
                    $('#email').val(resp.email);
                    $('#password').val(''); 
                    $('#password_changed').val('0');
                    $('#editmodal').modal('show');
                },
                error: function(err) {
                    const errorResp = JSON.parse(err.responseText);
                    return Swal.fire('Gagal !',
                        `Data gagal dihapus: ${errorResp.message}`, 'error');
                }
            })
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
                        url: "{{ url('dashboard/user_admin/data-user-delete') }}/" + id,
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

    </script>
@endsection

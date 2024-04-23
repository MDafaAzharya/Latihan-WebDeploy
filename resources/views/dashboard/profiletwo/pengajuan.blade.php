@extends('dashboard.layouts.app')

@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Pengajuan </h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mb-2">
        <div class="card-body">
            <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah
                Data</a>
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">Pengajuan</h5>
        <div class="card-datatable text-nowrap">
            <table class="datatables-ajax table table-striped-columns" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Penguji</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="expandedTextModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
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
                        <form id="formAuthentication" class="mb-3" action="{{ route('prestasi.data-prestasi-register') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Judul') }}</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    id="judul" name="judul" placeholder="Judul" required autocomplete="judul" autofocus
                                    value="{{ old('judul') }}" /> @error('judul')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Deskripsi') }}</label>
                                <textarea id="editor" name="text" class="mb-3"></textarea>
                                <script>
                                    ClassicEditor
                                        .create( document.querySelector( '#editor' ) )
                                        .catch( error => {
                                            console.error( error );
                                        } );
                                </script>
                            </div>
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Gambar') }}</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="gambar" autofocus
                                    value="{{ old('judul') }}" /> @error('judul')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <div class="mb-3"> <div class="form-check"> <input class="form-check-input" type="checkbox" id="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /> <label class="form-check-label" for="remember-me"> Remember Me </label> </div> </div> --}} <button
                                class="btn btn-primary d-grid w-100">{{ __('Tambah') }}</button>
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
                            action="{{ route('prestasi.data-prestasi-update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Judul') }}</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    id="title" name="judul" required autocomplete="judul" autofocus
                                    value="{{ old('title') }}" /> @error('judul')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Deskripsi') }}</label>
                                <textarea id="text" name="text" class="text_edit mb-3"></textarea>
                                <script>
                                    let myEditor;
                                    ClassicEditor
                                        .create( document.querySelector( '#text' ) )
                                        .then(editor => {
                                            window.editor = editor;
                                            myEditor = editor;
                                        })
                                        .catch( error => {
                                            console.error( error );
                                        } );
                                </script>
                            </div>
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Gambar') }}</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="gambar" name="gambar" autofocus
                                    value="{{ old('judul') }}" /> @error('judul')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-start mb-3">
                                <img src="" id="gambar_edit" alt="" srcset="" width="150" height="100">
                                <p class="ms-md-2"> *Klik pilih gambar jika ingin mengganti gambar</p>
                            </div>
                            {{-- <div class="mb-3"> <div class="form-check"> <input class="form-check-input" type="checkbox" id="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /> <label class="form-check-label" for="remember-me"> Remember Me </label> </div> </div> --}} <button
                                class="btn btn-primary d-grid w-100">{{ __('Tambah') }}</button>
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
    <!-- <script type="text/javascript">
        moment.locale('id');

        var table = $('#table').DataTable({
            ajax: `{{ route('prestasi.data-prestasi-datatable') }}`,
            // scrollX: true,
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
                    data: 'judul',
                    name: 'judul',
                    searchable: false
                },
                {
                    data: 'text_short',
                    name: 'text',
                },
                {
                    data: 'gambar',
                    name: 'gambar',
                    render: function(data, type, row) {
                                if (type === 'display') {
                                    return '<img src="' + data + '" alt="' + row.judul + '" width="100" height="100">';
                                }
                                return data;
                            },
                    searchable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        })

        $('#table tbody').on('click', '.btn-expand', function () {
            var data = table.row($(this).parents('tr')).data();
            $('#expandedTextModal .modal-body').text(data.text_full);
            $('#expandedTextModal').modal('show');
        });

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
                        url: "{{ url('dashboard/prestasi_admin/data-prestasi-delete') }}/" + id,
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
                url: "{{ url('dashboard/prestasi_admin/data-prestasi-edit') }}/" + id,
                type: 'get',
                data: {
                    _token: `{{ csrf_token() }}`,
                    id
                },
                success: function(resp) {
                    $('#id').val(resp.id);
                    $('#title').val(resp.title);
                    myEditor.setData(resp.text);

                    var imageUrl = "{{ asset('storage/images/') }}/" + resp.image;
                    $('#gambar_edit').attr('src', imageUrl);
                    $('#editmodal').modal('show');
                },
                error: function(err) {
                    const errorResp = JSON.parse(err.responseText);
                    return Swal.fire('Gagal !',
                        `Data gagal dihapus: ${errorResp.message}`, 'error');
                }
            })
        })
    </script> -->
@endsection

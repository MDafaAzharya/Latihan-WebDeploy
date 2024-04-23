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
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Berita, Artikel, & Materi </h4>
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
        <h5 class="card-header">Berita, Artikel, & Materi</h5>
        <div class="card-datatable text-nowrap table-responsive">
            <table class="datatables-ajax table table-striped-columns" id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
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
                        <form id="formAuthentication" class="mb-3" action="{{ route('konten.data-konten-register') }}"
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
                                    CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
                                        toolbar: {
                                            items: [
                                                'heading', '|',
                                                'bold', 'italic', 'strikethrough', 'underline', '|',
                                                'bulletedList', 'numberedList', 'todoList',
                                                'outdent', 'indent', '|',
                                                'undo', 'redo',
                                                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                                                'alignment', '|',
                                                'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                                            ],
                                            shouldNotGroupWhenFull: true
                                        },
                                        list: {
                                            properties: {
                                                styles: true,
                                                startIndex: true,
                                                reversed: true
                                            }
                                        },
                                        heading: {
                                            options: [
                                                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                                                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                                                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                                                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                                            ]
                                        },
                                        placeholder: 'Welcome to CKEditor 5!',
                                        fontFamily: {
                                            options: [
                                                'default',
                                                'Arial, Helvetica, sans-serif',
                                                'Courier New, Courier, monospace',
                                                'Georgia, serif',
                                                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                                                'Tahoma, Geneva, sans-serif',
                                                'Times New Roman, Times, serif',
                                                'Trebuchet MS, Helvetica, sans-serif',
                                                'Verdana, Geneva, sans-serif'
                                            ],
                                            supportAllValues: true
                                        },
                                        fontSize: {
                                            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                                            supportAllValues: true
                                        },
                                        link: {
                                            decorators: {
                                                addTargetToExternalLinks: true,
                                                defaultProtocol: 'https://',
                                                toggleDownloadable: {
                                                    mode: 'manual',
                                                    label: 'Downloadable',
                                                    attributes: {
                                                        download: 'file'
                                                    }
                                                }
                                            }
                                        },
                                        removePlugins: [
                                            'AIAssistant',
                                            'CKBox',
                                            'CKFinder',
                                            'EasyImage',
                                            'RealTimeCollaborativeComments',
                                            'RealTimeCollaborativeTrackChanges',
                                            'RealTimeCollaborativeRevisionHistory',
                                            'PresenceList',
                                            'Comments',
                                            'TrackChanges',
                                            'TrackChangesData',
                                            'RevisionHistory',
                                            'Pagination',
                                            'WProofreader',
                                            'MathType',
                                            'SlashCommand',
                                            'Template',
                                            'DocumentOutline',
                                            'FormatPainter',
                                            'TableOfContents',
                                            'PasteFromOfficeEnhanced'
                                        ]
                                    });
                                </script>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">{{ __('kelas') }}</label>
                                <select name="kategori" id="kategori" class="form-select form-control">
                                    <option value="Berita">Berita</option>
                                    <option value="Artikel">Artikel</option>
                                    <option value="Materi">Materi</option>
                                </select>
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
                                class="btn btn-primary d-grid form-control">{{ __('Tambah') }}</button>
                        </form>
                    </div>
                </div>
            </div>
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

    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="w-px-400 mx-auto">
                        <form id="formAuthentication" class="mb-3" method="POST"
                            action="{{ route('konten.data-konten-update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Judul') }}</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    id="title_edit" name="judul" required autocomplete="judul" autofocus
                                    value="{{ old('title') }}" /> @error('judul')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Deskripsi') }}</label>
                                <textarea id="text" name="text" class="text_edit mb-3"></textarea>
                                <script>
                                    let myEditor;
                                    CKEDITOR.ClassicEditor.create(document.getElementById("text"), {
                                        toolbar: {
                                            items: [
                                                'heading', '|',
                                                'bold', 'italic', 'strikethrough', 'underline', '|',
                                                'bulletedList', 'numberedList', 'todoList',
                                                'outdent', 'indent', '|',
                                                'undo', 'redo',
                                                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                                                'alignment', '|',
                                                'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                                            ],
                                            shouldNotGroupWhenFull: true
                                        },
                                        list: {
                                            properties: {
                                                styles: true,
                                                startIndex: true,
                                                reversed: true
                                            }
                                        },
                                        heading: {
                                            options: [
                                                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                                                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                                                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                                                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                                            ]
                                        },
                                        placeholder: 'Welcome to CKEditor 5!',
                                        fontFamily: {
                                            options: [
                                                'default',
                                                'Arial, Helvetica, sans-serif',
                                                'Courier New, Courier, monospace',
                                                'Georgia, serif',
                                                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                                                'Tahoma, Geneva, sans-serif',
                                                'Times New Roman, Times, serif',
                                                'Trebuchet MS, Helvetica, sans-serif',
                                                'Verdana, Geneva, sans-serif'
                                            ],
                                            supportAllValues: true
                                        },
                                        fontSize: {
                                            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                                            supportAllValues: true
                                        },
                                        link: {
                                            decorators: {
                                                addTargetToExternalLinks: true,
                                                defaultProtocol: 'https://',
                                                toggleDownloadable: {
                                                    mode: 'manual',
                                                    label: 'Downloadable',
                                                    attributes: {
                                                        download: 'file'
                                                    }
                                                }
                                            }
                                        },
                                        removePlugins: [
                                            'AIAssistant',
                                            'CKBox',
                                            'CKFinder',
                                            'EasyImage',
                                            'RealTimeCollaborativeComments',
                                            'RealTimeCollaborativeTrackChanges',
                                            'RealTimeCollaborativeRevisionHistory',
                                            'PresenceList',
                                            'Comments',
                                            'TrackChanges',
                                            'TrackChangesData',
                                            'RevisionHistory',
                                            'Pagination',
                                            'WProofreader',
                                            'MathType',
                                            'SlashCommand',
                                            'Template',
                                            'DocumentOutline',
                                            'FormatPainter',
                                            'TableOfContents',
                                            'PasteFromOfficeEnhanced'
                                        ]
                                        })
                                        .then(editor => {
                                            window.editor = editor;
                                            myEditor = editor;
                                        })
                                        .catch( error => {
                                            console.error( error );
                                        } );
                                </script>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">{{ __('Kategori') }}</label>
                                <select name="kategori" id="kategori_edit" class="form-select form-control">
                                    <option value="Berita">Berita</option>
                                    <option value="Artikel">Artikel</option>
                                    <option value="Materi">Materi</option>
                                </select>
                            </div>
                            <div class="mb-3"> <label for="email" class="form-label">{{ __('Gambar') }}</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="gambar" name="gambar" autofocus
                                    value="{{ old('judul') }}" /> @error('judul')
                                    <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-md-flex justify-content-start mb-3">
                                <img src="" id="gambar_edit" alt="" srcset="" width="150" height="100">
                                <p class="ms-md-2 col-8"> *Klik pilih gambar jika ingin mengganti gambar</p>
                            </div>
                            {{-- <div class="mb-3"> <div class="form-check"> <input class="form-check-input" type="checkbox" id="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /> <label class="form-check-label" for="remember-me"> Remember Me </label> </div> </div> --}} <button
                                class="btn btn-primary d-grid form-control">{{ __('Edit') }}</button>
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
            ajax: `{{ route('konten.data-konten-datatable') }}`,
            // scrollX: true,
            // searching: true,
            paging: true,
            processing: true,
            serverSide: true,
            scrollX: true,
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
                    data: 'kategori',
                    name: 'kategori',
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
                        url: "{{ url('dashboard/konten_admin/data-konten-delete') }}/" + id,
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
                url: "{{ url('dashboard/konten_admin/data-konten-edit') }}/" + id,
                type: 'get',
                data: {
                    _token: `{{ csrf_token() }}`,
                    id
                },
                success: function(resp) {
                    $('#id').val(resp.id);
                    $('#title_edit').val(resp.title);
                    $('#kategori_edit').val(resp.kategori);
                    myEditor.setData(resp.text);

                    var imageUrl = "{{ asset('storage/images/') }}/" + resp.image;
                    $('#gambar_edit').attr('src', imageUrl);
                    $('#editmodal').modal('show');
                    console.log(resp.kategori);
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

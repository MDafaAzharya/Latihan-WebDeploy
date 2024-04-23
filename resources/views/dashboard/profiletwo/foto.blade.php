@extends('dashboard.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"> Dashboard /</span> Galeri</h4>
    {{-- <div class="card-body d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard.kelolaprogram.create') }}" class="btn btn-primary">
                <i class="tf-icons ti ti-user-plus"></i>
                <span class="mx-2">Tambah Program</span>
            </a>
        </div> --}}
    <div class="card mb-3">
        <div class="p-2">
            <div class="ms-auto p-2">
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">
                    <i class="tf-icons ti ti-user-plus"></i>
                    <span class="mx-2">Tambah foto</span>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($image as $item)
           
            <style>
                /* Menentukan tinggi tetap dengan rasio aspek 16:9 */
                .image-card {
                    /* position: relative; */
                    padding-bottom: 52.6%;
                    /* 9:16 ratio (9 / 16 * 100) */
                    height: 0;
                    overflow: hidden;
                }

                .image-card img {
                    /* position: absolute; */
                    object-fit: contain;
                    /* Untuk memastikan gambar terisi penuh di dalam kotak */
                }
            </style>
            <div class="col-sm-4 mb-3 ">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="MonthlyCampaign" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="MonthlyCampaign">
                                <a class="dropdown-item deleteprogram" type="button" id=""
                                    data-id="{{ $item->id }}">Hapus</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="bg-primary rounded-3 image-card text-center mb-3 overflow-hidden">
                            <img class="img-fluid" src="{{ asset('storage/images/' . $item->image )}}"
                                alt="campaign image" />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end">
        {{ $image->links('pagination::bootstrap-5') }}
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                    </div>
                    <form id="addNewCCForm" class="row g-3" method="post" action="{{ route('foto.data-foto-register') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="program_id" id="program_id_modal">
                        <div class="col-12">
                            <label class="form-label w-100" for="modalAddCard">Upload Foto</label>
                            <div class="input-group">
                                {{-- <input addNewCCModaltype="hidden" name="program_id" id="program_id"> --}}
                                <input type="file" class="form-control" name="foto" required>
                            </div>
                            <div id="error-message"></div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1" id="SubmitDonasi">Upload</button>
                            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal"
                                aria-label="Close">
                                Batal
                            </button>
                        </div>
                    </form>
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
    <!-- <script src="{{ asset('assets/js/forms-selects.js') }}"></script> -->
    <script>
        @if (session()->has('success'))
            $(function() {
                Swal.fire({
                    icon: 'success',
                    type: 'success',
                    text: '{{ session()->get('success') }}',
                });
                setTimeout(
                    "location.href='{{ route('foto_admin') }}'",
                    1000);
            });
        @endif
    </script>
    <script>
        $('.deleteprogram').on('click', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Anda tidak akan dapat mengembalikan data ini !!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('dashboard/foto_admin/data-foto-delete') }}/" + id,
                        type: "get",
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                type: 'success',
                                text: 'Data Berhasil Di Hapus',
                            });
                            setTimeout(
                                "location.href='{{ route('foto_admin') }}'",
                                1000);
                        }
                    });
                };
            })
        });
    </script>
@endsection
@extends('dashboard.layouts.app')

@section('vendor-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
@endsection

@section('content')
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Data Pengajuan Akun </h4>
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
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
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
            ajax: `{{ route('pengajuan.data-pengajuan-user-datatable') }}`,
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
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $(document).on('click', '.btn-edit', function() {
            var id = $(this).data('id');

            // Send AJAX request to approveUser route
            $.ajax({
                url:  "{{ url('dashboard/pengajuan_user_admin/approve-pengajuan-user') }}/" + id,
                type: 'GET',
                success: function(response) {
                    // Handle success, e.g., refresh the DataTable
                    Swal.fire({
                        icon: 'success',
                        title: 'User approved successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Reload the page after 1.5 seconds
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>
@endsection

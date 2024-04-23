
@extends('dashboard.layouts.app')

@section('vendor-css')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css')}}" />
@endsection

@section('content')
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Donatur /</span> Data Donatur</h4>
  @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{session()->get('success')}}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <div class="card mb-5">
    <div class="card-body d-flex align-items-center justify-content-end">
      <a href="{{route('donasi.create')}}" class="btn btn-primary">
        <i class="tf-icons ti ti-user-plus"></i>
       <span class="mx-2">Tambah Data</span>
      </a>
    </div>
  </div>
  <div class="card">
      <h5 class="card-header">Data Donatur</h5>
      <div class="card-datatable text-nowrap">
        <table class="datatables-ajax table table-striped-columns" id="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Kode User</th>
              <th>Nama</th>
              <th>Referensi</th>
              <th>No HP</th>
              <th>Email</th>
              <th>Unit Kerja</th>
              <th>Wilayah</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kelamin</th>
              <th>Kategori</th>
              <th>Aksi</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
@endsection

@section('vendor-js')
  <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
  <script type="text/javascript" src="{{ asset('assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('page-js')
  <script type="text/javascript">
    moment.locale('id');

    var table = $('#table').DataTable({
      ajax: `{{route('donasi.datatables')}}`,
      scrollX: true,
      searching: true,
      paging: true,
      processing: true,
      serverSide: true,
      fixedColumns: {
        left: 3,
        right: 1
      },
      columns: [
        {
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'unique_id',
          name: 'unique_id'
        },
         {
          data: 'name',
          name: 'name'
        },
        {
          data: 'referensi',
          name: 'referensi'
        },
        {
          data: 'phone',
          name: 'phone'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          data: 'unit_kerja',
          name: 'unit_kerja'
        },
        {
          data: 'wilayah',
          name: 'wilayah'
        },
        {
          data: function(data){
            return moment(data.birthdate).format('LL');
          },
          name: 'birthdate'
        },
        {
          data: 'gender',
          name: 'gender'
        },
        {
          data: 'kategori.name',
          name: 'kategori_id'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    })

    $(document).delegate('.btn-delete', 'click', function(){
      const id = $(this).data('id');

      Swal.fire({
        title: "Hapus Data ?",
        text: "Apakah anda yakin akan menghapus data ini ?",
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Hapus',
        icon: 'question'
      }).then(result => {
        if(result.isConfirmed){
          $.ajax({
            url: `{{url('donasi')}}/${id}`,
            type: `delete`,
            data: {
              _token: `{{csrf_token()}}`,
              id
            },
            success: function(resp){
              return Swal.fire('Berhasil !', 'Data berhasil dihapus', 'success').then(() => table.ajax.reload());
            },
            error: function(err){
              const errorResp = JSON.parse(err.responseText);
              return  Swal.fire('Gagal !', `Data gagal dihapus: ${errorResp.message}`, 'error');
            }
          })
        }
      })
    })
  </script>
@endsection

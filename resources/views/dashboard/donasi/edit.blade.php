
@extends('dashboard.layouts.app')

@push('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush

@section('content')
    @error("error_message")
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="card">
      <form method="post" action="{{route('donasi.update', [Crypt::encryptString($donasi->id)])}}">
        @csrf
        <h5 class="card-header">Edit Data Donatur</h5>
        <div class="card-body">
          <div class="row mb-2">
            <div class="col col-md-4">
              <div class="form-group">
                <label class="mb-1">Referensi</label>
                <input type="text" name="referensi" class="form-control  @error('referensi') is-invalid @enderror" value="{{old('referensi', $donasi->referensi)}}">
                @error('referensi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col col-md-4">
              <div class="form-group">
                <label class="mb-1">Referensi</label>
                <input type="text" name="unique_id" class="form-control  @error('unique_id') is-invalid @enderror" value="{{$donasi->unique_id}}" disabled>
                @error('unique_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col col-md-4">
              <div class="form-group">
                <label class="mb-1">Nama</label>
                <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror" value="{{old('nama', $donasi->name)}}">
                @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col col-md-4">
              <div class="form-group">
                <label class="mb-1">No Hp</label>
                <input type="text" name="no_hp" class="form-control  @error('no_hp') is-invalid @enderror" value="{{old('no_hp', $donasi->phone)}}">
                @error('no_hp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col col-md-4">
              <div class="form-group">
                <label class="mb-1">Email</label>
                <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" value="{{old('email', $donasi->email)}}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col col-md-4">
              <div class="form-group">
                <label class="mb-1">Unit Kerja</label>
                <input type="text" name="unit_kerja" class="form-control  @error('unit_kerja') is-invalid @enderror" value="{{old('unit_kerja', $donasi->unit_kerja)}}">
                @error('unit_kerja')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col col-md-4">
              <div class="form-group">
                <label class="mb-1">Wilayah</label>
                <input type="text" name="wilayah" class="form-control  @error('wilayah') is-invalid @enderror" value="{{old('wilayah', $donasi->wilayah)}}">
                @error('wilayah')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col col-md-4">
              <div class="form-group">
                <label class="mb-1">Tanggal Lahir</label>
                <input type="text" name="tgl_lahir" class="form-control  @error('tgl_lahir') is-invalid @enderror" id="datepicker" value="{{old('tgl_lahir', date('m/d/Y', strtotime($donasi->birthdate)))}}">
                @error('tgl_lahir')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="col col-md-4">
              <div class="form-group">
                <label class="mb-1">Jenis Kelamin</label>
                <div class="w-100">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender-male" value="L" {{old('gender', $donasi->gender) == 'L' ? 'checked' : ''}}>
                    <label class="form-check-label" for="gender-male">Laki-laki</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender-female" value="P" {{old('gender', $donasi->gender) == 'P' ? 'checked' : ''}}>
                    <label class="form-check-label" for="gender-female">Perempuan</label>
                  </div>
                </div>
                @error('gender')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="col col-md-4">
              <label class="mb-1">Kategori</label>
              <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                @foreach ($kategori as $item)
                    <option value="{{$item->id}}"  {{old('kategori', $donasi->kategori_id) == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                @endforeach
              </select>
              @error('kategori')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          </div>
        </div>
        <div class="card-footer d-flex align-items-center justify-content-end">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
@endsection

@push('scripts')
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript">
    $('#datepicker').datepicker();
  </script>
@endpush

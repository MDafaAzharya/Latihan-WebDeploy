@extends('dashboard.layouts.app')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Kontak </h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <section>
        <div class="card">
            <div class="card-body">
            <form id="formAuthentication" class="mb-3"
            action="{{ route('kontak.data-kontak-update') }}" method="POST">
            @csrf
            @foreach($kontak as $key => $data)
                <input type="hidden" name="id" value="{{$data->id}}"/>
                <div class="mb-3"> <label for="email" class="form-label">{{ __('Alamat') }}</label>
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                        id="alamat" name="alamat" required autofocus
                        value="{{$data->alamat}}" /> @error('alamat')
                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3"> <label for="email" class="form-label">{{ __('No Telepon') }}</label>
                    <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                        id="telepon" name="telepon" required autofocus
                        value="{{ $data->telepon }}" /> @error('telepon')
                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3"> <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" name="email" required placeholder="Link Url" autofocus
                        value="{{ $data->email }}" /> @error('email')
                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3"> <label for="email" class="form-label">{{ __('Email untuk menerima pesan') }}</label>
                    <input type="email" class="form-control @error('email_to') is-invalid @enderror"
                        id="email_to" name="email_to" required placeholder="Link Url" autofocus
                        value="{{ $data->email_to }}" /> @error('email_to')
                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mt-3 col-md-2 offset-lg-10">
                    {{-- <div class="mb-3"> <div class="form-check"> <input class="form-check-input" type="checkbox" id="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /> <label class="form-check-label" for="remember-me"> Remember Me </label> </div> </div> --}} <button class="btn btn-primary d-grid w-100">{{ __('Update') }}</button>
                </div>
                @endforeach
            </form>
            </div>
        </div>
    </section>
@endsection

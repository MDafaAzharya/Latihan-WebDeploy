@extends('layouts.index')

@section('content')
 <section id="landingContact" class="section-dr-py bg-body landing-contact">
    <div class="container mt-5">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2314267175957!2d107.67144387437382!3d-6.981994468370
      932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68c276a65f472b%3A0x2e9d823378f26b24!2sPT.%20Inovindo%20Digital%20Media!5e0!3m2!1s
      id!2sid!4v1703664607305!5m2!1sid!2sid" width="100%" height="500" style="border:0;"></iframe>
      <h3 class="text-center mb-1 mt-3"><span class="section-title">Hubungi Kami</h3>
      <p class="text-center mb-4 mb-lg-5 pb-md-3">Ada pertanyaan ? Silakan hubungi kami pada kontak dibawah.</p>
      <div class="row gy-4">
        <div class="col-lg-6">  
          <div class="card p-3">
            <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h4><strong>Kirim Pesan</strong></h4>
                <form action="{{ route('email.send') }}" method="post">
                @csrf
                  <div class="row">
                      <div class="mb-3 col-lg-6"> 
                          <input type="text" class="form-control @error('nama') is-invalid @enderror"
                              id="nama" name="nama" placeholder="Nama" required autocomplete="nama" autofocus
                              value="{{ old('nama') }}" /> @error('nama')
                              <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="mb-3 col-lg-6"> 
                          <input type="email" class="form-control @error('email') is-invalid @enderror"
                              id="email" name="email" placeholder="Email" required autocomplete="email" autofocus
                              value="{{ old('email') }}" /> @error('email')
                              <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                  </div>
                  <div class="mb-3"> 
                        <input type="text" class="form-control @error('subjek') is-invalid @enderror"
                            id="subjek" name="subjek" placeholder="subjek" required autocomplete="subjek" autofocus
                            value="{{ old('subjek') }}" /> @error('subjek')
                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3"> 
                        <textarea class="form-control @error('pesan') is-invalid @enderror" id="pesan" name="pesan" cols="51" rows="5"
                            placeholder="Pesan" required autocomplete="pesan" autofocus>{{ old('pesan') }}</textarea>
                        @error('pesan')
                        <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>
                    <div class="mt-3 col-lg-4 offset-lg-8 ">
                    {{-- <div class="mb-3"> <div class="form-check"> <input class="form-check-input" type="checkbox" id="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /> <label class="form-check-label" for="remember-me"> Remember Me </label> </div> </div> --}} <button class="btn btn-primary d-grid w-100">{{ __('Kirim Pesan') }}</button>
                </div>
                </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="">
            <h4 class="ms-3"><strong>Kontak Kami</strong></h4>
            <div class="card-body">
              <div class="d-flex">
                <div class="d-flex align-items-start justify-center">
                  <div class="text-primary mx-3"> <i class="ti ti-map-pin"></i> </div>
                </div>
                @foreach ($contact as $item)
                <div>
                  <h5 class="mb-1">Alamat</h5>
                    <address>{{ $item->alamat}}</address>
                </div>
              </div>
              <div class="d-flex">
                <div class="d-flex align-items-start justify-center">
                  <div class="text-primary mx-3"> <i class="ti ti-phone"></i> </div>
                </div>
                <div>
                  <h5 class="mb-1">Telepon</h5>
                    <p>{{ $item -> telepon }}
                </div>
              </div>
              <div class="d-flex">
                <div class="d-flex align-items-start justify-center">
                  <div class="text-primary mx-3"> <i class="ti ti-mail"></i> </div>
                </div>
                <div>
                  <h5 class="mb-1">Email</h5>
                    <p>{{ $item->email }}
                </div>
              </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

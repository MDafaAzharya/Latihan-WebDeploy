@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css') }}">
@endsection

@section('content')
<style>
    .btn-pramuka {
      color: #fff;
      background-color: #663996;
      border-color: #663996;
    }
    .owl-carousel .owl-item .carousel-image {
      width: 70vw;
      height: 25vw;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .accordion-button::after {
      background-color: #fff ;
      padding: 10;
      border-radius:20px;
      font-weight: 900;
    } 
    .accordion-button[aria-expanded="true"]::after {
    }
    .profile-image{
      width:500px;
      height:300px;
      object-fit: cover;

    }
    @media (min-width: 320px) and (max-width: 767px){
      .owl-carousel .owl-item .carousel-image {
        width: 75vw;
        height: 45vw;
        object-fit: cover;
      }
      .profile-image{
      width:300px;
      height:170px;
      object-fit: cover;
      }
      .profile-body{
       margin-top:-30px; 
      }
    }
</style>
    <div data-bs-spy="scroll" class="scrollspy-example">
      <section class="pt-5 ">
        <div id="landingHero" class="section-py">
          <div class="owl-carousel owl-theme">
            @foreach ($carousel as $index => $image)
                <img src="{{ asset('storage/images/' . $image->image) }}" alt="" class="carousel-image"  data-index="{{ $index }}">
              @endforeach
          </div>
        </div>
      </section>

     <section class="py-3 bg-body profile-body">
        <div class="container">
          <div class="row">
          @foreach ($profile as $item)
            <div class="col-lg-6">
                <img src="{{ asset('storage/images/' . $item->image) }}" alt="" srcset=""  class="profile-image mx-auto mx-md-0 d-flex">
            </div>
            <div class="col-lg-6">
                <h3 class="mt-3 mt-md-0"><strong>{{ $item->title }}</strong></h3>
                <p class="fs-5">{!! $item->text !!}</p>
            </div>
            @endforeach
          </div>
        </div>
     </section>

      <section class="pt-5">
        <div class="container">
          <h3 class="text-center"><span class="section-title">Berita Terkini</h3>
          <div class="row gy-5 mt-2 mt-md-0">
            @foreach ($berita->take(6) as $item)
            <div class="col-lg-4 col-sm-6">
              <div class="card h-100 bg-label-primary text-white shadow-lg">
                <div class="card-body">
                  <div class="bg-primary rounded-3 text-center mb-3 overflow-hidden">
                    <img
                      class="img-pr img-fluid"
                      src="{{ asset('storage/images/' . $item->image) }}"
                      alt="campaign image" />
                  </div>
                  <div>
                    <ul class="p-0 m-0">
                      <li class="d-flex mb-3 pb-1">
                        <div class="w-100 align-items-center">
                          <div class="col-12">
                            <h6 class="mb-2">{{  $item->title }}</small>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <a href="{{ route('berita-detail', ['slug' => $item->slug]) }}" class="btn bg-secondary w-100 text-white">Selengkapnya</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="row mt-5">
            <div class="col-12 d-flex align-items-center justify-content-center mb-5">
              <a href="{{ route('berita') }}"><button class="btn btn-pramuka btn-lg">Selengkapnya</button></a>
            </div>
          </div>
        </div>
      </section>

      <section class="pt-5 bg-body">
        <div class="container">
          <h3 class="text-center"><span class="section-title">Jejak Prestasi</h3>
          <div class="row gy-5 mt-2 mt-md-0">
            @foreach ($prestasi->take(6) as $item)
            <div class="col-lg-4 col-sm-6">
              <div class="card h-100 bg-label-primary text-white shadow-lg">
                <div class="card-body">
                  <div class="bg-primary rounded-3 text-center mb-3 overflow-hidden">
                    <img
                      class="img-pr img-fluid"
                      src="{{ asset('storage/images/' . $item->image) }}"
                      alt="campaign image" />
                  </div>
                  <div>
                    <ul class="p-0 m-0">
                      <li class="d-flex mb-3 pb-1">
                        <div class="w-100 align-items-center">
                          <div class="col-12">
                            <h6 class="mb-2">{!! substr($item->text, 0, 80) !!}</small>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <a href="{{ route('prestasi-detail', ['id' => $item->id]) }}"" class="btn bg-secondary w-100 text-white">Selengkapnya</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="row mt-5">
            <div class="col-12 d-flex align-items-center justify-content-center mb-5">
              <a href="{{ route('prestasi') }}"><button class="btn btn-pramuka btn-lg">Selengkapnya</button></a>
            </div>
          </div>
        </div>
      </section>

      <section class="py-5 mb-3">
        <div class="container">
        <h3 class="text-center mb-3"><span class="section-title">FAQ</h3>
          <div class="row mt-5">
            <div class="col-lg-6">
                <img src="{{ asset('assets/img/faq.svg')}}" alt="" srcset="" style="width:80%;" class="mx-auto mx-md-0 d-flex">
            </div>
            <div class="col-lg-6">
              @foreach ($faq as $index => $item)
              <div class="accordion my-2"  id="accordionExample{{ $index }}">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne{{ $index }}">
                    <button class="accordion-button bg-body" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$index}}" aria-expanded="false" aria-controls="collapseOne">
                    {{$item->pertanyaan}}
                    </button>
                  </h2>
                  <div id="collapseOne{{ $index }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body bg-body">
                     <p>{{$item->jawaban}}</p>
                    </div>
                  </div>
                </div>
              </div>  
              @endforeach 
            </div>
          </div>
        </div>
     </section>
@endsection


@section('script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/js/jquery-1.9.0.min.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 
  <script>
  $(document).ready(function(){
    $(".owl-carousel").owlCarousel({
      center: true,
      autoWidth: true,
      startPosition: 0,
      margin: 80,
      loop: true,
      nav: true,
      animateOut: 'slideOutDown',
      animateIn: 'flipInX',
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:3,
            nav:true,
        },
      },
    });
  });

  const chartProgressList = document.querySelectorAll('.chart-progress');
  if (chartProgressList) {
    chartProgressList.forEach(function (chartProgressEl) {
      const color = "#00a39e",
        series = chartProgressEl.dataset.series;
      const progress_variant = chartProgressEl.dataset.progress_variant
        ? chartProgressEl.dataset.progress_variant
        : 'false';
      const optionsBundle = radialBarChart(color, series, progress_variant);
      const chart = new ApexCharts(chartProgressEl, optionsBundle);
      chart.render();
    });
  }
</script>
@endsection

@extends('layouts.index')


@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <style>
      .img-pr{
        height:170px;
      }
      @media (min-width: 320px) and (max-width: 767px){
        .img-pr{
          height:100%;
        }
      }
    </style>  
@endsection


@section('content')
  <section class="section-dr-py bg-body ">
    <div class="container">
      <h3 class="text-center mb-3 mb-md-5"><span class="section-title">Berita</h3>
      <div class="row mt-5">
        <div class="col-12 col-md-4">
        <form action="{{ route('berita') }}" method="GET">
        <div class="input-group">
            <input type="text" name="query" placeholder="Cari Berita ...." class="form-control" value="{{ request('query') }}" />
            <div class="input-group-append">
                <button class="btn btn-primary rounded-left" type="submit"><i class="ti ti-search"></i> Cari</button>
            </div>
        </div>
        </form>
        </div>
      </div>
      <div class="row gy-5 mt-2 mt-md-3">
        @foreach ($berita as $item)
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
                        <h6 class="mb-2">{!! substr($item->title, 0, 80) !!}</small>
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
        
      {{-- <div class="row mt-5">
        <div class="col-12 d-flex align-items-center justify-content-center">
          <button class="btn btn-primary btn-lg">Lebih Banyak</button>
        </div>
      </div> --}}
    </div>
  </section>
@endsection



@section('script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script type="text/javascript">
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

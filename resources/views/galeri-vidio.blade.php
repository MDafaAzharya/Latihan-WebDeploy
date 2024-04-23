@extends('layouts.index')


@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
@endsection


@section('content')
  <section class="section-dr-py bg-body ">
    <div class="container">
      <h3 class="text-center mb-3 mb-md-1"><span class="section-title">Vidio</h3>
      <div class="row gy-5 mt-2 mt-md-3">
        @foreach ($video as $item)
        <div class="col-lg-4 col-sm-6">
          <div class="card h-100 bg-label-primary text-white shadow-lg">
            <div class="card-body">
              <div class="bg-transparent rounded-3 text-center mb-3 overflow-hidden">
              <iframe height="180" class="rounded-3"
                    src="{{ $item -> video }}&loop=1">
                  </iframe>
              </div>
              <a href="{{ $item -> video }}" class="btn bg-secondary w-100 text-white">lihat</a>
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

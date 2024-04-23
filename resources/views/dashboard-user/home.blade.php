@extends('dashboard-user.layouts.app')

@section('content')
  <h4 class="py-3 mb-4">Dashboard</h4>

  <div class="row">
    <div class="col-xl-4 mb-4 col-lg-5 col-12">
      <div class="card">
        <div class="card-body">
          <div id="chart" class="w-100">
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-8 mb-4 col-lg-7 col-12">
      <div class="card h-100">
        <div class="card-header">
          <div class="d-flex justify-content-between mb-3">
            <h5 class="card-title mb-0">{{__('Statistik')}}</h5>
          </div>
        </div>
        <div class="card-body">
          <div class="row gy-3">
            <?php $total = 0 ?>
            @foreach ($kategori as $idx => $item)
              <?php $total += $item->jumlah_data?>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-{{$item->label}} me-3 p-2">
                    <i class="ti {{$item->icon}} ti-sm"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">{{  number_format($item->jumlah_data, 0, ',', '.') }}</h5>
                    <small>{{$item->name}}</small>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mb-4 g-4">
    <div class="col-12 col-xl-12">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Donatur Berdasarkan Usia</h5>
        </div>
        <div class="card-body row g-3">
          <div class="col-md-6">
            <div id="ageCategoryChart"></div>
          </div>
          <div class="col-md-6 d-flex justify-content-around align-items-start">
              @foreach ($ageCategory as $idx => $item)
                @if ($idx % 3 == 0)
                  <div>
                @endif
                  <div class="d-flex align-items-baseline">
                    <span class="text-primary me-2"><i class="ti ti-circle-filled fs-6"></i></span>
                    <div>
                      <p class="mb-2">Usia {{$item->age_group}}</p>
                      <h5>{{number_format($item->age_count, 0, ',', '.')}}</h5>
                    </div>
                  </div>
                @if ($idx % 3 == 2)
                  </div>
                @endif
              @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="row mb-4 g-4">
    <div class="col-12 col-xl-12">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Donatur 30 Hari Terakhir</h5>
        </div>
        <div class="card-body row g-3">
          <div class="col-md-12">
            <div id="last30DaysChart"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('page-js')
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    var j = jQuery.noConflict();
j(document).ready(function () {
    j('#slider').nivoSlider();
});
  </script>
  <script type="text/javascript">
    const kategoriOptions = {
      chart: {
        type: 'pie'
      },
      series: {!! json_encode(array_column($kategori->toArray(), 'jumlah_data')) !!},
      labels: {!! json_encode(array_column($kategori->toArray(), 'name')) !!},
      colors: {!! json_encode(array_column($kategori->toArray(), 'color')) !!}
    }
    var chartKategori = new ApexCharts(document.querySelector("#chart"), kategoriOptions);

    chartKategori.render();

    const ageCategoryOptions = {
        series: [{
          data: {!! json_encode(array_column($ageCategory, 'age_count')) !!}
        }],
        colors: ['#f6ad3c'],
        chart: {
          type: 'bar',
          height: 350,
          toolbar: {
            show: false
          }
        },
        plotOptions: {
          bar: {
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: {!! json_encode(array_column($ageCategory, 'age_group')) !!},
        },
    };

    var chartAgeCategory = new ApexCharts(document.querySelector("#ageCategoryChart"), ageCategoryOptions);
    chartAgeCategory.render();

    const last30DaysOptions = {
      series: [{
        data: {!! json_encode($last30Days) !!}
      }],
      chart: {
        type: 'bar',
        height: 350,
        toolbar: {
          show: false
        }
      },
      dataLabels: {
        enabled: false
      },
      xaxis: {
        type: 'datetime'
      }
    }

    var last30Days = new ApexCharts(document.querySelector("#last30DaysChart"), last30DaysOptions);
    last30Days.render();
  </script>
@endsection

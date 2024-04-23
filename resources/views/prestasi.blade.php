@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    <style>
      .img-pr{
        height:140px;
      }
      @media (min-width: 320px) and (max-width: 767px){
        .img-pr{
          height:100%;
        }
      }
    </style>
@endsection


@section('content')
  <section class="section-dr-py bg-body first-section-pt">
    <div class="container mt-2">
      <div class="row">
        <div class="col-lg-8">
          <div class="card px-3">
            <div class="card-body">
              <div class="w-full p-2">
              </div>
              <h4 class="mb-4"><strong>Prestasi</strong></h4>
                <div class="row">
                  @foreach ($prestasi as $item)
                  <div class="card col-lg-5 col-md-5 col-sm-12 mx-lg-4 mx-md-4 mb-5 h-100 bg-label-secondary text-white shadow-sm">
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
                                <h6 class="mb-2">{{ $item->title }}</small>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <a href="{{ route('prestasi-detail', ['id' => $item->id]) }}" class="btn bg-secondary w-100 text-white">Selengkapnya</a>
                    </div>
                  </div>
                  @endforeach
                </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h5 class="card-title m-0 me-2 pt-1 mb-2 d-flex align-items-center">
                <i class="ti ti-list-details ms-n1 me-2"></i>Profil
              </h5>
            </div>
            <div class="card-body pb-2 mt-2">
              <div class="card">
                <div class="card-header">
                </div>
                  @include('menu-profile')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


@section('script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script type="text/javascript">
    const expensesRadialChartEl = document.querySelector('#campaignChart'),
    supportTrackerOptions = {
      series: [85],
      labels: ['Dana Terkumpul'],
      chart: {
        height: 360,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          offsetY: 10,
          startAngle: -140,
          endAngle: 130,
          hollow: {
            size: '65%'
          },
          track: {
            background: "#fff",
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: -20,
              color: "#5d596c",
              fontSize: '13px',
              fontWeight: '400',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: 10,
              color: "#00a39d",
              fontSize: '38px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: ["#f6ad3c"],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: ["#f6ad3c"],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 10
      },
      grid: {
        padding: {
          top: -20,
          bottom: 5
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      },
      responsive: [
        {
          breakpoint: 1025,
          options: {
            chart: {
              height: 330
            }
          }
        },
        {
          breakpoint: 769,
          options: {
            chart: {
              height: 280
            }
          }
        }
      ]
    };

  if (typeof expensesRadialChartEl !== undefined && expensesRadialChartEl !== null) {
    const expensesRadialChart = new ApexCharts(expensesRadialChartEl, supportTrackerOptions);
    expensesRadialChart.render();
  }
</script>
@endsection

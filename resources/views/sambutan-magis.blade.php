@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
@endsection


@section('content')
  <section class="section-dr-py bg-body first-section-pt">
    <div class="container mt-2">
      <div class="row">
        <div class="col-lg-8">
          <div class="card px-3">
            <div class="card-body">
              <div class="w-full p-2">
                {{-- <img
                    class="img-fluid w-100"
                    src="{{asset('assets/img/hari-pramuka-nasional-2_169.jpeg')}}"
                    alt="campaign image" /> --}}
              </div>
              <h4 class="mb-4"><strong>Sambutan Mabigus</strong></h4>
              @foreach ($mabigus as $item)
              <p>
                  {!! $item->text !!}
              </p>
              @endforeach
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

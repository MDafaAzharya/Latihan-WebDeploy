@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
@endsection


@section('content')
  <section class="section-dr-py bg-body first-section-pt">
    <div class="container mt-2">
      <div class="row">
        <div class="col-lg-7">
          <div class="card px-3">
            <div class="card-body">
              <div class="w-full p-2">
                <img
                    class="img-fluid w-100"
                    src="{{asset('assets/img/front-pages/campaign-image.jpg')}}"
                    alt="campaign image" />
              </div>
              <h4 class="mb-2">Makanan Gratis untuk Masyarakat Miskin di Jawa Barat</h4>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed convallis, orci a lobortis tristique, risus augue egestas nisi, vitae condimentum lectus nulla eu massa. Nullam nec odio diam. Nullam turpis ante, pellentesque in pellentesque sit amet, pulvinar quis risus. Proin est velit, placerat ut lacus nec, ullamcorper egestas odio. Nullam fermentum ligula ac orci commodo, et rutrum ipsum tempor. In accumsan et augue sed suscipit. Suspendisse consectetur, lacus nec sodales vulputate, justo nisi tincidunt purus, nec fringilla dolor tellus quis nulla.
              </p>
              <p>
                Duis blandit tempus feugiat. Duis urna dui, tincidunt in leo vel, laoreet maximus mauris. Suspendisse ligula nunc, ornare eget molestie ac, eleifend eu odio. Nunc pellentesque eleifend diam ac tempus. Maecenas urna neque, varius ut posuere nec, congue fermentum magna. Morbi gravida ultrices mauris, at pulvinar lorem sagittis vitae. Sed ullamcorper bibendum leo, sed ultricies ex sagittis a. Vivamus a pellentesque lectus. Nam accumsan purus in neque congue ultricies. Quisque vel nulla quis mauris suscipit blandit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam ut sem id risus rhoncus lacinia in quis purus. Vestibulum at fringilla velit.
              </p>
              <p>
                Aenean convallis nisi congue erat varius dignissim. Morbi in erat ac diam molestie elementum. Praesent tristique convallis metus at tincidunt. Mauris purus tortor, tincidunt eu purus at, consequat sagittis nisi. Etiam faucibus posuere sapien vel molestie. Etiam et libero dui. Ut et risus id nunc dictum faucibus. Fusce lacus libero, volutpat sit amet libero non, tempor pellentesque libero. Ut eget aliquet lectus. Sed non ultricies sapien, non luctus lorem.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card mb-3">
            <div class="card-header pb-0">
              <h5 class="card-title mb-0">Info Program</h5>
              <small class="text-muted">Dana Terkumpul</small>
            </div>
            <div class="card-body">
              <div id="campaignChart"></div>
              <div class="mt-md-2 text-center mt-lg-3 mt-3">
                <h3 class="text-primary my-3">850.000 <small>/ 1.000.000</small></h3>
                <button class="btn bg-secondary btn-lg text-white">Donasi Sekarang</button>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h5 class="card-title m-0 me-2 pt-1 mb-2 d-flex align-items-center">
                <i class="ti ti-list-details ms-n1 me-2"></i> Timeline Kegiatan
              </h5>
            </div>
            <div class="card-body pb-0">
              <ul class="timeline ms-1 mb-0">
                <li class="timeline-item timeline-item-transparent ps-4">
                  <span class="timeline-point timeline-point-primary"></span>
                  <div class="timeline-event">
                    <div class="timeline-header">
                      <h6 class="mb-0">Funding</h6>
                    </div>
                    <p class="mb-2">18 Agustus 2023 - 18 Oktober 2023</p>
                  </div>
                </li>
                <li class="timeline-item timeline-item-transparent ps-4">
                  <span class="timeline-point timeline-point-secondary"></span>
                  <div class="timeline-event">
                    <div class="timeline-header">
                      <h6 class="mb-0">Report</h6>
                    </div>
                    <div class="d-flex flex-wrap gap-2 pt-1">
                      <a href="javascript:void(0)" class="me-3 d-flex align-items-center">
                        <i class="ti ti-file-text text-warning me-2 ti-xs"></i>
                        <span class="fw-medium text-heading">Laporan Kegiatan</span>
                      </a>
                      <a href="javascript:void(0)" class="d-flex align-items-center">
                        <i class="ti ti-table text-success me-2 ti-xs"></i>
                        <span class="fw-medium text-heading">Daftar Donatur</span>
                      </a>
                    </div>
                  </div>
                </li>
                <li class="timeline-item timeline-item-transparent ps-4 border-transparent">
                  <span class="timeline-point timeline-point-secondary"></span>
                  <div class="timeline-event pb-0">
                    <div class="timeline-header">
                      <h6 class="mb-0">Selesai</h6>
                    </div>
                  </div>
                </li>
              </ul>
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

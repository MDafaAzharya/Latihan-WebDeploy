@extends('layouts.index')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />

    <style>
      .accordion-button.text-uppercase {
        background-color: #663996;
        color: #ffffff; 
      }
      .accordion-button.text-uppercase[aria-expanded="true"] {
        background-color: transparent !important; 
        color: #000000; 
      }
      .accordion-button.text-uppercase[aria-expanded="false"] {
        background-color: #663996;
        color: #ffffff; 
      }
    </style>
@endsection


@section('content')
  <section class="section-dr-py bg-body first-section-pt">
    <div class="container mt-2">
      <div class="row">
        <div class="col-lg-12">
          <h3><strong>Dokumen</strong></h3>
          <p>
            <b>Gerakan Pramuka</b> mempunyai Tata Aturan Dalam Menjalankan organisasi. Terdapat Undang-undang, Anggaran Dasar-Anggaran Rumah Tangga 
            sebagai landasan utama. Dalam setiap penyelenggaraan program terdapat petunjuk yang di tetapkan dengan surat keputusan.Pun teknis dan panduan juga ada
            sebagai acuan serta pedoman.  
          </p>
        </div>
        <div class="col-lg-12">
          @foreach ($dokumen as $index => $item)
            <div class="accordion"  id="accordionExample{{ $index }}">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne{{ $index }}">
                  <button class="accordion-button text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$index}}" aria-expanded="false" aria-controls="collapseOne">
                  {{ $item->name }}
                  </button>
                </h2>
                <div id="collapseOne{{ $index }}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                  @foreach ($item->dokumen as $doc)   
                  <div class="row mt-2">
                      <div class="col-4">{{$doc->name}}</div>
                      <div class="col-5" style="text-align: right;">
                        <a href="{{ asset('document/' . $doc->name_file) }}" download>Download</a>
                      </div>
                      <hr class="opacity-75 mt-2">
                  </div> 
                  @endforeach                   
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

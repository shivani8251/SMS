@php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';

  $fetchChartUrl = (Auth::user()->user_type=="admin") ? 'admin.home.graph' : 'user.home.graph';
@endphp

@extends($template)

@section('content')
@section('mytitle', 'Dashboard')

<style type="text/css">

  @media (min-width: 1200px)
  {
    .col-xl-20 {
      -webkit-box-flex: 0;
      -webkit-flex: 0 0 20%;
      -ms-flex: 0 0 20%;
      flex: 0 0 20%;
      max-width: 20%;
    }
  }

  @media (min-width: 992px)
  {
    .col-lg-20 {
      -webkit-box-flex: 0;
      -webkit-flex: 0 0 20%;
      -ms-flex: 0 0 20%;
      flex: 0 0 20%;
      max-width: 20%;
    }
  }
  @media (min-width: 768px)
  {
    .col-md-20 {
      -webkit-box-flex: 0;
      -webkit-flex: 0 0 20%;
      -ms-flex: 0 0 20%;
      flex: 0 0 20%;
      max-width: 20%;
    }
  }

  table th {
    font-size: 10px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 11px !important;
    padding: 10px !important;
  }

  table.picker__table td {
    padding: 0 !important;
  }

  .select2-container {
    width: 100% !important;
  }

  .daterangepicker .calendar-table th, .daterangepicker .calendar-table td {
     line-height: 12px; 
   }

  .select2-container--classic .select2-selection--single, .select2-container--default .select2-selection--single {
    min-height: 30px !important;
    padding: 0px !important;
  }

  .daterange
  {
    height: 2rem;
  }

  html .navbar-sticky .app-content .content-wrapper {
    padding: 1rem 1rem 0 !important;
    margin-top: 3rem !important;
  }
</style>
 <!-- BEGIN: Content-->
    <div class="app-content content mt-2">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
          <section id="widgets-Statistics">
            
            <div class="row">
              @if(Auth::user()->user_type!='admin')
                @if(isset($alerts[0]))
                  <div class="col-12">
                    <div class="card mb-1">
                      <div class="row">
                        <div class="col-12">
                          @php
                            $colorsClass= array("text-primary", "text-dark", "text-info", "text-warning", "text-secondary", "text-danger");
                          @endphp
                          <marquee behavior="scroll" direction="left" class="mx-1 my-0" style="margin-top: 7px !important;" onMouseOver="this.stop()" onMouseOut="this.start()">
                            @foreach($alerts as $alert)
                              @php
                                $random_color = $colorsClass[array_rand($colorsClass)];
                              @endphp
                              <span class="mandatory {{$random_color}} font-weight-700">
                                @if(isset($alert->description))
                                  {{$alert->description}}&emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                                @endif
                              </span>
                            @endforeach
                          </marquee>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
              @endif

              <div class="col-12">
                <div class="row">
                  {{-- @if(Auth::user()->user_type!='admin') --}}
                    {{-- <div class="col-xl-3 col-lg-3 col-md-3 col-12 pl-1 pr-1">
                      <div class="card mb-1">
                        <div class="card-body d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center">
                            <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                              <div class="avatar-content">
                                <i class="bx bx-pyramid text-dark" height="40"></i>
                              </div>
                            </div>
                            <div class="total-amount">
                              <h6 class="text-dark" style="font-size: 11px; font-weight: 500;">TOTAL RECHARGE</h6>
                              <h5 class="text-dark mb-0">{{isset($total_recharges) ? $total_recharges : '0'}}</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> --}}

                    {{-- <div class="col-xl-3 col-lg-3 col-md-3 col-12 pl-1 pr-1">
                      <div class="card mb-1">
                        <div class="card-body d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center">
                            <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                              <div class="avatar-content">
                                <i class="bx bx-pyramid text-dark" height="40"></i>
                              </div>
                            </div>
                            <div class="total-amount">
                              <h6 class="text-dark" style="font-size: 11px; font-weight: 500;">TOTAL USAGES </h6>
                              <h5 class="text-dark mb-0">{{isset($total_usages) ? $total_usages : '0'}}</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                  {{-- @endif --}}
                  <div class="col-xl-20 col-lg-20 col-md-20 col-12 pl-1 pr-1">
                    <div class="card mb-1">
                      <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                          <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                            <div class="avatar-content">
                              <img height="40" width="auto" src="{{ asset('public/assets/img/sidebar/available_belance.jpg') }}" />
                            </div>
                          </div>
                          <div class="total-amount">
                            <h6 class="text-dark" style="font-size: 11px; font-weight: 500;">AVAILABLE BALANCE</h6>
                            <h5 class="text-dark mb-0">{{isset(Auth::user()->credit) ? Auth::user()->credit : '0'}}</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  @if(Auth::user()->user_type!='user')
                    <div class="col-xl-20 col-lg-20 col-md-20 col-12 pl-0 pr-1">
                      <div class="card mb-1">
                        <div class="card-body d-flex align-items-center justify-content-between">
                          <div class="d-flex align-items-center">
                            <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                              <div class="avatar-content">
                                <img height="40" width="auto" src="{{ asset('public/assets/img/sidebar/reseller.png') }}" />
                              </div>
                            </div>
                            <div class="total-amount">
                              <h6 class="text-dark" style="font-size: 11px; font-weight: 500;">TOTAL RESELLERS</h6>
                              <h5 class="text-dark mb-0">{{isset($total_resellers) ? $total_resellers : 0}}</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-20 col-lg-20 col-md-20 col-12 pl-0 pr-1">
                      <div class="card mb-1">
                        <div class="card-body d-flex align-items-center justify-content-between" style="padding-bottom: 38px;">
                          <div class="d-flex align-items-center">
                            <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                              <div class="avatar-content">
                                <img height="40" width="auto" src="{{ asset('public/assets/img/sidebar/user.png') }}" />
                              </div>
                            </div>
                            <div class="total-amount">
                              <h6 class="text-dark" style="font-size: 11px; font-weight: 500;">TOTAL USERS</h6>
                              <h5 class="text-dark mb-0">{{isset($total_users) ? $total_users : 0}}</h5>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
                  <div class="col-xl-20 col-lg-20 col-md-20 col-12 pl-0 pr-1">
                    <div class="card mb-1">
                      <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                          <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                            <div class="avatar-content">
                              <img height="40" width="auto" src="{{ asset('public/assets/img/sidebar/campaign.png') }}" />
                            </div>
                          </div>
                          <div class="total-amount">
                            <h6 class="text-dark" style="font-size: 11px; font-weight: 500;">TODAY CAMPAIGNS</h6>
                            <h5 class="text-dark mb-0">{{isset($total_campaigns) ? $total_campaigns : 0}}</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-20 col-lg-20 col-md-20 col-12 pl-0 pr-1">
                    <div class="card mb-1">
                      <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                          <div class="avatar bg-rgba-primary m-0 p-15 mr-75 mr-xl-2">
                            <div class="avatar-content">
                              <img height="40" width="auto" src="{{ asset('public/assets/img/sidebar/total_numbers.jpg') }}" />
                            </div>
                          </div>
                          <div class="total-amount">
                            <h6 class="text-dark" style="font-size: 11px; font-weight: 500;">TOTAL NUMBERS TODAY</h6>
                            <h5 class="text-dark mb-0">{{isset($total_numbers) ? $total_numbers : 0}}</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-7 col-lg-7 col-md-7 col-12 dashboard-greetings">
                <div class="row">
                  <div class="col-12">
                    <div class="card pl-2 pt-2 pr-2">
                      <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-12 float-left">
                          <h6 class="card-title float-left" style="font-size: 16px !important;">Day wise Usages Graph</h6>
                        </div>
                        <div class="col-xl-7 col-lg-7 col-md-7 col-12 float-right">
                          <h6 class="float-left d-none d-xl-block" style="margin-left: 20px;">Duration :</h6>
                          <h6 class="float-left d-md-none d-sm-block" style="margin-left: 0px;">Duration :</h6>
                          <div class="form-group position-relative has-icon-left float-right">
                            <input type="text" class="form-control form-control-sm daterange" id="date-range" placeholder="Select Date" autocomplete="off" style="width: 210px;"> 
                            <div class="form-control-position">
                              <i class='bx bx-calendar-check'></i>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-body mt-0 p-0">
                        <div id="day-wise-usage-chart"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-5 col-lg-5 col-md-5 col-12">
                <div class="card pl-2 pt-2 pr-2">
                  <div class="row">
                    <div class="col-12 float-left">
                      <h4 class="card-title float-left">Last 5 Campaign Status</h4>
                    </div>
                  </div>
                  <div class="card-body mt-0 p-0">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered w-100">
                        <thead>
                          <tr>
                            <th>SN</th>
                            <th>Userame</th>
                            <th>Messsages</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(isset($campaigns[0]))
                            @foreach($campaigns as $key => $campaign)
                              <tr>
                                <td>{{++$key}}</td>
                                <td>{{$campaign->username}}</td>
                                <td>{{$campaign->number_count}}</td>
                                <td>
                                  @if($campaign->status=="sent")
                                    <span class="badge badge-pill badge-success">Sent</span>
                                  @elseif($campaign->status=="pending")
                                    <span class="badge badge-pill badge-info">Pending</span>
                                  @elseif($campaign->status=="process")
                                    <span class="badge badge-pill badge-primary">Process</span>
                                  @else
                                    <span class="badge badge-pill badge-danger">Discard</span>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                          @else
                            <tr>
                              <td colspan="4" class="text-center">No campaigns found !</td>
                            </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </section>

        </div>
      </div>
    </div>
    <!-- END: Content-->

@endsection

@section('script')

<script src="{{ asset('public/assets/vendors/js/charts/apexcharts.min.js') }}"></script>

<script type="text/javascript">
  
  $(document).ready(function() {

    $(".daterange").daterangepicker({
      locale: {
        format: 'DD-MM-YYYY'
      },
      minYear: 1901,
      maxYear: parseInt(moment().format("YYYY"), 10),
      // singleDatePicker: !0,
      showDropdowns: !0
      // singleDatePicker: false,
    });


    $("#date-range").on("change", function(evt){
      evt.preventDefault();

      var date_range = $(this).val();
      fetchDayWiseUsagesGraph(date_range);
    });

    var date_range = "";
    fetchDayWiseUsagesGraph(date_range);

    function fetchDayWiseUsagesGraph(date_range = "")
    {
      $.getJSON('{{ route($fetchChartUrl) }}', {date_range}, function(response) {

        var e = "#5A8DEE",
          t = [e, "#FDAC41", "#FF5B5C", "#39DA8A", "#00CFDD"],
          i = {
          chart: {
              height: 350,
              type: "area",
              stacked: !1
          },
          colors: t,
          stroke: {
              width: [0, 2, 5],
              curve: "smooth"
          },
          // title: {
          //   text: 'Number Of Orders',
          //   align: 'left'
          // },
          plotOptions: {
              bar: {
                  columnWidth: "10%"
              }
          },
          series: [],
          fill: {
              opacity: [.85, .25, 1],
              gradient: {
                  inverseColors: !1,
                  shade: "light",
                  type: "vertical",
                  opacityFrom: .85,
                  opacityTo: .75,
                  stops: [0, 100, 100, 100]
              }
          },
          labels: response.campaign_dates,
          markers: {
              size: 0
          },
          legend: {
              offsetY: 8
          },
          xaxis: {
              type: "date",
              title: {
                  text: "Dates"
              }
          },
          yaxis: {
              min: 0,
              tickAmount: 5,
              title: {
                  text: "Campaigns"
              }
          },
          tooltip: {
              shared: !0,
              intersect: !1,
              y: {
                  formatter: function(e) {
                      return void 0 !== e ? e : e
                  }
              }
          }
        };
        var dchart = new ApexCharts(document.querySelector("#day-wise-usage-chart"), i);
        dchart.render();

        dchart.updateSeries([{
          name: 'Campaigns',
          type: "column",
          data: response.campaign_counts
        }])

      });
    }
});

</script>

@endsection

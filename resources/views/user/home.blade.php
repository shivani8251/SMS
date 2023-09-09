@extends('user/app')

@section('content')
@section('mytitle', 'User Dashboard')

 <!-- BEGIN: Content-->
    <div class="app-content content mt-2">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
          <section id="widgets-Statistics">
            {{-- <div class="row">
              <div class="col-12">
                <h4>Statistics</h4>
                <hr>
              </div>
            </div> --}}
            <div class="row">

              <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                <div class="card">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                        <div class="avatar-content">
                          <img src="{{asset('public/assets/images/others/dashboard_1.png')}}" height="40">
                        </div>
                      </div>
                      <div class="total-amount">
                        <h6 class="text-dark" style="font-size: 12px;">TOTAL RESELLER</h6>
                        <h5 class="text-dark mb-0">548</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                <div class="card">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                        <div class="avatar-content">
                          <img src="{{asset('public/assets/images/others/dashboard_2.png')}}" height="40">
                        </div>
                      </div>
                      <div class="total-amount">
                        <h6 class="text-dark" style="font-size: 12px;">TOTAL USERS</h6>
                        <h5 class="text-dark mb-0">92</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                <div class="card">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                        <div class="avatar-content">
                          <img src="{{asset('public/assets/images/others/dashboard_3.png')}}" height="40">
                        </div>
                      </div>
                      <div class="total-amount">
                        <h6 class="text-dark" style="font-size: 12px;">TOTAL CAMPAIGN</h6>
                        <h5 class="text-dark mb-0">66</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                <div class="card">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                      <div class="avatar bg-rgba-primary m-0 p-25 mr-75 mr-xl-2">
                        <div class="avatar-content">
                          <img src="{{asset('public/assets/images/others/dashboard_4.png')}}" height="40">
                        </div>
                      </div>
                      <div class="total-amount">
                        <h6 class="text-dark" style="font-size: 12px;">TOTAL NO. (TODAY'S)</h6>
                        <h5 class="text-dark mb-0">436921</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            {{-- <div class="row">

              <div class="col-12 dashboard-greetings">
                <div class="card pl-2 pt-2 pr-2">
                  <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-12 float-left">
                      <h4 class="card-title float-left">Day wise Usages Graph</h4>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-8 col-12 float-right">
                      <h6 class="float-left d-none d-xl-block" style="margin-left: 250px;">Duration :</h6>
                      <h6 class="float-left d-md-none d-sm-block" style="margin-left: 0px;">Duration :</h6>
                      <div class="form-group position-relative has-icon-left float-right">
                        <input type="text" class="form-control form-control-sm daterange" id="sale-date-range" placeholder="Select Date" autocomplete="off" style="width: 250px;"> 
                        <div class="form-control-position">
                          <i class='bx bx-calendar-check'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body mt-0 p-0">
                    <div id="sale-chart"></div>
                  </div>
                </div>
              </div>

            </div> --}}
          </section>

        </div>
      </div>
    </div>
    <!-- END: Content-->

@endsection

@section('script')

<script type="text/javascript">
  
  $(document).ready(function() {

    
  });

</script>

@endsection

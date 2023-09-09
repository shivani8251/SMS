@php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';

  $serverSideDataTable = (Auth::user()->user_type=="admin") ? 'admin.reseller.report.dataTable' : 'user.reseller.report.dataTable';
  $createCreditPageUrl = (Auth::user()->user_type=="admin") ? 'admin.credit.add' : 'user.credit.add';
@endphp

@extends($template)

@section('mytitle', 'Resellers')
@section('content')
<!-- BEGIN: Content-->
<style type="text/css">
  table th {
    font-size: 14px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 15px !important;
    padding: 10px !important;
  }

  .select2-container {
    width: 100% !important;
  }

  table.picker__table td {
    padding: 0 !important;
  }

  .daterangepicker .calendar-table th, .daterangepicker .calendar-table td {
     line-height: 12px; 
   }

  .dt-buttons{
    float: left !important;
    padding-bottom: 10px;
  }
</style>
<div class="app-content content mt-2">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <!-- Dashboard Ecommerce Starts -->          
      <section class="list-group-navigation">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <h6 class="mb-1 float-left">LIST OF ALL RESELLER CREDIT REPORT</h6>
                    <div class="float-right">
                      <a href="{{ route($createCreditPageUrl, 'reseller') }}" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> ADD CREDIT</a>
                    </div>
                  </div>
                  <div class="col-12">
                    <hr />
                    <form id="search-form">
                      <input type="hidden" id="todays-date" value="{{date('d-m-Y').' - '.date('d-m-Y')}}">
                      <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <select id="user-filter" class="form-control select2 filter-select2" data-placeholder="Select User">
                              <option value="All">All Resellers</option>
                              @foreach($users as $user)
                                <option value="{{$user->user_unique_id}}">{{ucfirst($user->username).' ('.$user->user_unique_id.')'}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group position-relative has-icon-left">
                            <input type="text" class="form-control daterange" id="date-range" placeholder="Select date range" autocomplete="off" /> 
                            <div class="form-control-position">
                              <i class='bx bx-calendar-check'></i>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <button type="button" id="reset-btn" class="btn btn-secondary">Reset</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-12">
                    <hr class="mb-0 pb-0" />
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered w-100" id="reseller-list-table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>User Type</th>
                            <th>No.&nbsp;of&nbsp;SMS&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th>Per SMS Price (INR)</th>
                            <th>Description</th>
                            <th>Tax Status</th>
                            <th>Tax (%)</th>
                            <th>Tax (INR)</th>
                            <th>Txn Type</th>
                            <th>Total Amount (INR)</th>
                            <th>Created By</th>
                            <th>Created At</th>
                          </tr>
                        </thead>                                   
                      </table>
                    </div>
                  </div>
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

<script>
  $(function() {

    $(".daterange").daterangepicker({
      locale: {
        format: 'DD-MM-YYYY'
      },
      minYear: 1901,
      maxYear: parseInt(moment().format("YYYY"), 10),
      showDropdowns: !0
    });

    $('#reset-btn').on('click', function(evt) {
      evt.preventDefault();
      var today = $("#todays-date").val();
      $('#user-filter').val('All').trigger('change');
      $('#date-range').val(today);
      resellerListTable('All', '');
    });

    $('#user-filter').on('change', function(evt) {
      evt.preventDefault();

      var user = this.value;
      var date_range = $('#date-range').val();
      resellerListTable(user, date_range);
    });

    $('#date-range').on('change', function(evt) {
      evt.preventDefault();

      var date_range = this.value;
      var user = $('#user-filter').val();
      resellerListTable(user, date_range);
    });

    var user = 'All';
    var date_range = '';
    resellerListTable(user, date_range);

    function resellerListTable(user = 'All', date_range = '') {
      $('#reseller-list-table').DataTable().clear().destroy();

      $("#reseller-list-table").DataTable({
        serverSide: true,
        processing: true,
        searching: true,
        // dom: 'lfrtip',
        "aLengthMenu": [[25, 50, 100, 200, 300, 400, 500, 1000, -1], [25, 50, 100, 200, 300, 400, 500, 1000, "All"]],
        "iDisplayLength": 25,
        order: [],
        ajax: {
            url: "{{ route($serverSideDataTable) }}",
            type: "GET",
            data: {
              user: user,
              date_range: date_range
            }
        },
        "columns": [
          { data: 'id' },
          { data: 'username' },
          { data: 'user_type' },          
          { data: 'no_of_sms' },
          { data: 'per_sms_price' },
          { data: 'description' },
          { data: 'tax_status' },
          { data: 'tax_percent' },
          { data: 'tax_amount' },
          { data: 'txn_type' },
          { data: 'total_amount' },
          { data: 'created_by' },
          { data: 'created_at' },
        ]
      });
    }

  });
</script>

@endsection

@php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';

  $serverSideDataTableUrl = (Auth::user()->user_type=="admin") ? 'admin.complaints.serverSideDataTable' : 'user.complaints.serverSideDataTable';
  $formUrl = (Auth::user()->user_type=="admin") ? 'admin.complaints.form' : 'user.complaints.form';
@endphp

@extends($template)

@section('mytitle', 'Complaints')
@section('content')
<!-- BEGIN: Content-->
<style type="text/css">
  table th {
    font-size: 15px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 14px !important;
    padding: 10px !important;
  }

  .select2-container {
    width: 100% !important;
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

      <section class="users-list-wrapper">    
        <div class="users-list-table">
          <div class="card">
            <div class="card-body">

              <div class="row">
                <div class="col-12">
                  <h6 class="float-left">List of All Complaints</h6>
                  @if(Auth::user()->user_type!='admin')
                    <div class="float-right">
                      <a href="{{ route($formUrl) }}" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> ADD COMPLAINT</a>
                    </div>
                  @endif
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100" id="complaints-list-table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Created At</th>
                          <th>User/Reseller</th>
                          <th>Subject</th>
                          <th>Description</th>
                        </tr>
                      </thead>                                   
                    </table>
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

    /*---------------------Starting of query for Complaints----------------------*/

      complaintsListTable();
      function complaintsListTable() {
        $('#complaints-list-table').DataTable().clear().destroy();

        $("#complaints-list-table").DataTable({
          serverSide: true,
          processing: true,
          searching: true,
          dom: 'lBfrtip',
          "aLengthMenu": [[25, 50, 100, 200, 300, 400, 500, 1000, -1], [25, 50, 100, 200, 300, 400, 500, 1000, "All"]],
          "iDisplayLength": 25,
          order: [],
          ajax: {
              url: "{{ route($serverSideDataTableUrl) }}",
              type: "GET",
              data: {}
          },
          "columns": [
            { data: 'id' },
            { data: 'created_at' },
            { data: 'sender' },
            { data: 'subject' },
            { data: 'description' }
          ]
        });
      }

    /*---------------------Ending of query for Complaints----------------------*/

  });
</script>

@endsection

@extends('admin/app')

@section('mytitle', 'Search Mobile Numbers')
@section('content')

<!-- BEGIN: Content-->
<style type="text/css">
  table th {
    font-size: 12px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 13px !important;
    padding: 10px !important;
  }

  .select2-container {
    width: 100% !important;
  }

  table.picker__table td {
    padding: 0 !important;
    font-size: 12px;
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
          <div class="col-12">

            <div class="card">
              <div class="card-header pb-0">
                <h6 class="mb-0">Find out Common Mobile no(Availble in both unique id)</h6>
              </div>
              <hr class="mb-0" />
              <div class="card-body">

                <form method="post" id="update-status-form" enctype="multipart/form-data">
                  @csrf

                  <div class="row">
                    <div class="col-5">
                      <div class="form-group">
                        <label class="form-control-label">First Unique ID <span class="text-danger">*</span> </label>
                        <input type="text" placeholder="Enter first unqiue id *" autocomplete="off" name="first_unqiue_id" id="first_unqiue_id" class="form-control" required />
                      </div>
                    </div>

                    <div class="col-5">
                      <div class="form-group">
                        <label class="form-control-label">Second Unique ID <span class="text-danger">*</span> </label>
                        <input type="text" placeholder="Enter second unqiue id *" autocomplete="off" name="second_unqiue_id" id="second_unqiue_id" class="form-control" required />
                      </div>
                    </div>

                    <div class="col-2">
                      <div class="form-group mt-2">
                        <button type="button" class="btn btn-success" id="submit-btn">Search</button>
                      </div>
                    </div>
                  </div>

                  <div class="row d-none" id="mobile-numbers-group">
                    <div class="col-12">
                      <hr />
                      <div class="card-header mt-1 p-0">
                        <h6 class="mb-1">Search Result :- </h6>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="mobile-numbers-table">
                          <thead>
                            <tr>
                              <th>SN</th>
                              <th>Matched Mobile Number</th>
                              <th>Status</th>
                              <th>Created At</th>
                            </tr>
                          </thead>                                   
                        </table>
                      </div>
                    </div>
                    
                  </div>

                </form>

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

    $(document).on('click', '#submit-btn', function(evt) {
      evt.preventDefault();
      var first_unqiue_id = $("#first_unqiue_id").val();
      var second_unqiue_id = $("#second_unqiue_id").val();

      if(first_unqiue_id=='')
      {
        toastr.error('First unqiue id cannot be empty !', '', {
          closeButton: !0,
          tapToDismiss: !1,
          progressBar: true,
          timeOut: 1000
        });
      }
      else if(second_unqiue_id=='')
      {
        toastr.error('Second unqiue id cannot be empty !', '', {
          closeButton: !0,
          tapToDismiss: !1,
          progressBar: true,
          timeOut: 1000
        });
      }
      else
      {
        reportTable(first_unqiue_id, second_unqiue_id);
        if($("#mobile-numbers-group").hasClass('d-none'))
        {
          $("#mobile-numbers-group").removeClass('d-none')
        }
      }

    });

    reportTable('', '');
    function reportTable(first_unqiue_id = '', second_unqiue_id = '') {
      $('#mobile-numbers-table').DataTable().clear().destroy();

      var whatsappTable = $("#mobile-numbers-table").DataTable({
        serverSide: true,
        processing: true,
        searching: true,
        dom: 'lBfrtip',
        "aLengthMenu": [[25, 50, 100, 200, 300, 400, 500, 1000, -1], [25, 50, 100, 200, 300, 400, 500, 1000, "All"]],
        "iDisplayLength": 25,
        buttons: [
          'copy',
          {
            text: '<i class="bx bxs-file-pdf"></i> PDF',
            className: 'btn-danger btn mb-0',
            extend : "pdfHtml5",
            exportOptions: { columns: ":visible" },
            attr: { id: 'pdf' },
            filename: 'searched-list',
          },
          {
            text: '<i class="bx bx-printer"></i> Print',
            className: 'btn-warning btn mb-0',
            extend : "print",
            attr: { id: 'print' },
            exportOptions: { columns: ":visible" },
          },
          {
            text: '<i class="bx bx-file"></i> CSV',
            className: 'btn-success btn mb-0',
            attr: { id: 'csv' },
            extend : "csv",
            filename: 'searched-list',
          },
          
        ],
        order: [],
        ajax: {
            url: "{{ route('admin.search.numbers.dataTable') }}",
            type: "GET",
            data: {
              first_unqiue_id: first_unqiue_id,
              second_unqiue_id: second_unqiue_id
            }
        },
        "columns": [
          { data: 'sn' },
          { data: 'mobile_number' },
          { data: 'status' },
          { data: 'created_at' }
        ],
        // fnInitComplete : function()
        // {
        //   if($("#mobile-numbers-group").hasClass('d-none'))
        //   {
        //     $("#mobile-numbers-group").removeClass('d-none')
        //   }
          // if ($(this).find('tbody tr').length<=1)
          // {
          //    // $(this).parent().hide();
          //   if(!$("#mobile-numbers-group").hasClass('d-none'))
          //   {
          //     $("#mobile-numbers-group").addClass('d-none')
          //   }
          // }
          // else
          // {
          //   if($("#mobile-numbers-group").hasClass('d-none'))
          //   {
          //     $("#mobile-numbers-group").removeClass('d-none')
          //   }
          // }
        // } 
        
      });

    }

  });
</script>

@endsection

@extends('admin/app')

@section('mytitle', 'Alerts')
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
                  <h6 class="float-left">List of All Alerts</h6>
                  <div class="float-right">
                    <a href="javascript:void(0);" id="add-alert-btn" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> Add Alerts</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100" id="alert-list-table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Date</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th>Actions</th>
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

<div class="modal fade text-left" id="alert-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="alert-form-heading">Send Alerts</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <form method="post" id="alert-form">
        <div class="modal-body">
          @csrf
          {{-- <input type="hidden" id="alert_id" name="alert_id" /> --}}
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label class="form-control-label">Description <span class="text-danger">*</span></label>
                <textarea type="text" placeholder="Enter description" name="description" id="description" rows="4" class="form-control" required></textarea>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" id="submit-btn" class="btn btn-success ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Save</span>
          </button>
          <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
          </button>            
        </div>
        
      </form>
    </div>
  </div>
</div>

@endsection

@section('script')   

<script>
  $(function() {

    /*---------------------Starting of query for Alerts----------------------*/

      $(document).on('click', '.deactivate-alert-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to deactivate this alert ?',
            buttons: {
              yes: function() {
                  $.get("{{ route('admin.alert.deactivate') }}", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#alert-list-table').DataTable().ajax.reload();
                      } else {
                          toastr.error(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                      }
                  }, 'json');
              },
              no: function() {}
            }
        });
      });

      $(document).on('click', '.activate-alert-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to activate this alert ?',
            buttons: {
              yes: function() {
                  $.get("{{ route('admin.alert.activate') }}", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#alert-list-table').DataTable().ajax.reload();
                      } else {
                          toastr.error(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                      }
                  }, 'json');
              },
              no: function() {}
            }
        });
      });

      alertListTable();
      function alertListTable() {
        $('#alert-list-table').DataTable().clear().destroy();

        $("#alert-list-table").DataTable({
          serverSide: true,
          processing: true,
          searching: true,
          order: [],
          ajax: {
              url: "{{ route('admin.alert.serverSideDataTable') }}",
              type: "GET",
              data: {}
          },
          "columns": [
            { data: 'id' },
            { data: 'datetime' },
            { data: 'description' },
            { data: 'status' },
            { data: 'actions' }
          ]
        });
      }

      $('#alert-modal').on('hidden.bs.modal', function () {
        $('#alert-form')[0].reset();
        // $('#alert_id').val("");
        // $('#heading').val("");
        $('#description').val("");
      });

      $("#add-alert-btn").on("click", function(event) {
        event.preventDefault();
        $("#alert-form-heading").text("Send Alerts");
        $("#alert-modal").modal("show");
      });

      // $(document).on("click", ".edit-alert-btn", function() {
      //   $("#alert-form-heading").text("Edit Property Alerts");
      //   let id = $(this).data("id");

      //   $.get("", {id}, function(data) {
      //     if (data != "")
      //     {
      //       $("#alert_id").val(data.id);
      //       $("#property_type").val(data.property_type).trigger('change');
      //       $("#alert-name").val(data.name);
      //     }
      //   }, "json");
      //   $("#alert-modal").modal("show");
      // });

      var alertForm = $("#alert-form").validate({
        errorPlacement: function (error, element) {}
      });

      $("#alert-form").submit(function(event) {
        event.preventDefault();
        if (alertForm.valid())
        {
          $.post("{{ route('admin.alert.save') }}", $(this).serialize(), function(data) {
            // console.log(data)
            if (data.status) {
              toastr.success(data.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 1000
              });
              $('#alert-modal').modal("hide");
              $('#alert-list-table').DataTable().ajax.reload();
            }
            else
            {
              toastr.error(data.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 1000
              });
            }
          }, 'json');
        }
      });

    /*---------------------Ending of query for Alerts----------------------*/

  });
</script>

@endsection

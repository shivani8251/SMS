@extends('admin/app')

@section('mytitle', 'Settings')
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
                  <h6>List of All Settings</h6>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100" id="setting-list-table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Key Name</th>
                          <th>Key Value</th>
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

<div class="modal fade text-left" id="setting-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Setting</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
        </div>
        <form method="post" id="setting-form">
          <div class="modal-body">
            @csrf
            <input type="hidden" id="setting_id" name="id" />
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label class="form-control-label">Key Name <span class="text-danger">*</span></label>
                  <input type="text" placeholder="Enter key name" name="key_name" id="key_name" class="form-control" required readonly />
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label class="form-control-label">Key Value <span class="text-danger">*</span></label>
                  <input type="text" placeholder="Enter key value" name="key_value" id="key_value" class="form-control" required />
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

    /*---------------------Starting of query for Setting----------------------*/

      settingListTable();
      function settingListTable() {
        $('#setting-list-table').DataTable().clear().destroy();

        $("#setting-list-table").DataTable({
          serverSide: true,
          processing: true,
          searching: true,
          order: [],
          ajax: {
              url: "{{ route('admin.setting.serverSideDataTable') }}",
              type: "GET",
              data: {}
          },
          "columns": [
            { data: 'id' },
            { data: 'key_name' },
            { data: 'key_value' },
            { data: 'actions' }
          ]
        });
      }

      $('#setting-modal').on('hidden.bs.modal', function () {
        $('#setting-form')[0].reset();
        $('#setting_id').val("");
        $('#key_name').val("");
        $('#key_value').val("");
      });

      $(document).on("click", ".edit-setting-btn", function() {
        let id = $(this).data("id");
        $.get("{{ route('admin.setting.fetch') }}", {id}, function(data) {
          if (data != "")
          {
            $("#setting_id").val(data.id);
            $("#key_name").val(data.key_name);
            $("#key_value").val(data.key_value);
          }
        }, "json");
        $("#setting-modal").modal("show");
      });

      var settingForm = $("#setting-form").validate({
        errorPlacement: function (error, element) {}
      });

      $("#setting-form").submit(function(event) {
        event.preventDefault();
        if (settingForm.valid())
        {
          $.post("{{ route('admin.setting.save') }}", $(this).serialize(), function(data) {
            // console.log(data)
            if (data.status) {
              toastr.success(data.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 1000
              });
              $('#setting-modal').modal("hide");
              $('#setting-list-table').DataTable().ajax.reload();
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

    /*---------------------Ending of query for Setting----------------------*/

  });
</script>

@endsection

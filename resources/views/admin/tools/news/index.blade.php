@php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';

  $serverSideDataTable = (Auth::user()->user_type=="admin") ? 'admin.news.serverSideDataTable' : 'user.news.serverSideDataTable';
@endphp

@extends($template)

@section('mytitle', 'News')
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
                  <h6 class="float-left">List of All News</h6>
                  @if(Auth::user()->user_type=="admin")
                    <div class="float-right">
                      <a href="javascript:void(0);" id="add-news-btn" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> Add News</a>
                    </div>
                  @endif
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100" id="news-list-table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Date</th>
                          <th>Title</th>
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

<div class="modal fade text-left" id="news-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="news-form-heading">Send News</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
          </button>
        </div>
        <form method="post" id="news-form">
          <div class="modal-body">
            @csrf
            {{-- <input type="hidden" id="news_id" name="news_id" /> --}}
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label class="form-control-label">Heading <span class="text-danger">*</span></label>
                  <input type="text" placeholder="Enter heading" name="heading" id="heading" class="form-control" required>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label class="form-control-label">Description <span class="text-danger">*</span></label>
                  <textarea type="text" placeholder="Enter description" name="description" id="description" class="form-control" rows="4" required></textarea>
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

    /*---------------------Starting of query for News----------------------*/

      $(document).on('click', '.deactivate-news-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to deactivate this news ?',
            buttons: {
              yes: function() {
                  $.get("{{ route('admin.news.deactivate') }}", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#news-list-table').DataTable().ajax.reload();
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

      $(document).on('click', '.activate-news-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to activate this news ?',
            buttons: {
              yes: function() {
                  $.get("{{ route('admin.news.activate') }}", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#news-list-table').DataTable().ajax.reload();
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

      newsListTable();
      function newsListTable() {
        $('#news-list-table').DataTable().clear().destroy();

        $("#news-list-table").DataTable({
          serverSide: true,
          processing: true,
          searching: true,
          order: [],
          ajax: {
              url: "{{ route($serverSideDataTable) }}",
              type: "GET",
              data: {}
          },
          "columns": [
            { data: 'id' },
            { data: 'datetime' },
            { data: 'heading' },
            { data: 'description' },
            { data: 'status' },
            { data: 'actions' }
          ]
        });
      }

      $('#news-modal').on('hidden.bs.modal', function () {
        $('#news-form')[0].reset();
        // $('#news_id').val("");
        $('#heading').val("");
        $('#description').val("");
      });

      $("#add-news-btn").on("click", function(event) {
        event.preventDefault();
        $("#news-form-heading").text("Send News");
        $("#news-modal").modal("show");
      });

      // $(document).on("click", ".edit-news-btn", function() {
      //   $("#news-form-heading").text("Edit Property News");
      //   let id = $(this).data("id");

      //   $.get("", {id}, function(data) {
      //     if (data != "")
      //     {
      //       $("#news_id").val(data.id);
      //       $("#property_type").val(data.property_type).trigger('change');
      //       $("#news-name").val(data.name);
      //     }
      //   }, "json");
      //   $("#news-modal").modal("show");
      // });

      var newsForm = $("#news-form").validate({
        errorPlacement: function (error, element) {}
      });

      $("#news-form").submit(function(event) {
        event.preventDefault();
        if (newsForm.valid())
        {
          $.post("{{ route('admin.news.save') }}", $(this).serialize(), function(data) {
            // console.log(data)
            if (data.status) {
              toastr.success(data.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 1000
              });
              $('#news-modal').modal("hide");
              $('#news-list-table').DataTable().ajax.reload();
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

    /*---------------------Ending of query for News----------------------*/

  });
</script>

@endsection

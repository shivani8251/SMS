@php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';

  $saveUrl = (Auth::user()->user_type=="admin") ? 'admin.complaints.save' : 'user.complaints.save';
  $redirectUrl = (Auth::user()->user_type=="admin") ? 'admin.complaints.index' : 'user.complaints.index';
@endphp

@extends($template)

@section('mytitle', 'Complaints')
@section('content')
<!-- BEGIN: Content-->
<style type="text/css">
  table th {
    font-size: 10px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 11px !important;
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
            <div class="card-header">
              <h6 class="float-left">ADD COMPLAINT</h6>
              <div class="float-right">
                <a href="{{ route($redirectUrl) }}" class="btn btn-sm btn-primary"><i class="bx bx-left-arrow-alt"></i> Back</a>
              </div>
            </div>
            <div class="card-body">
              <form method="post" id="complaint-form" enctype="multipart/form-data">
                <div class="modal-body">
                  @csrf
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label">Subject <span class="text-danger">*</span></label>
                        <input type="text" placeholder="Enter subject" name="subject" id="subject" class="form-control" required />
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label">Description <span class="text-danger">*</span></label>
                        <textarea type="text" placeholder="Enter description" name="description" id="description" class="form-control" rows="4" required></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row group">
                    <label class="text-warning d-none col-12 mt-1 mb-1" id="warning-msg"></label>
                    <div class="col-lg-12 mt-1">
                      <div class="form-group">
                        <button type="submit" id="submit-btn" class="btn btn-success">Save</button>
                      </div>
                    </div>
                  </div>

                </div>
                
              </form>
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

      var complaintForm = $("#complaint-form").validate({
        // errorPlacement: function (error, element) {}
      });

      $("#complaint-form").submit(function(event) {
        event.preventDefault();

        var formData = new FormData($(this)[0]);
        if (complaintForm.valid())
        {
          $.ajax({
            type: 'POST',
            url: "{{ route($saveUrl) }}",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
              $("#warning-msg").removeClass('d-none');
              $("#warning-msg").text('Data is being saved do not refresh or submit again');
              $('#submit-btn').prop('disabled', true);
            },
            success: function(data)
            {
              if (data.status) {
                toastr.success(data.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 1000
                });
                location.reload();
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
              setTimeout(function() {
                $("#warning-msg").addClass('d-none');
                $('#submit-btn').prop('disabled', false);
              }, 500);
            }
          });
        }
      });

    /*---------------------Ending of query for Complaints----------------------*/

  });
</script>

@endsection

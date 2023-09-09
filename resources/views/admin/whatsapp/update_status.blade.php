@extends('admin/app')

@section('mytitle', 'Update Campaign Status')
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
              <div class="card-body">

                <form method="post" id="update-status-form" enctype="multipart/form-data">
                  @csrf

                  <div class="row">
                    <div class="col-8">
                      <div class="form-group">
                        <label class="form-control-label">ENTER UNQIUE CAMPAIGN ID <span class="text-danger">*</span> </label>
                        <input type="text" placeholder="Enter campaign unqiue id *" autocomplete="off" name="unqiue_campaign_id" id="unqiue_campaign_id" class="form-control" required />
                      </div>
                    </div>

                    <div class="col-4">
                      <div class="form-group mt-2">
                        <button type="button" class="btn btn-success" id="submit-btn">Submit</button>
                      </div>
                    </div>
                  </div>

                  <div class="row d-none" id="campaign-details-group">
                    <div class="col-12">
                      <hr />
                      <div class="card-header mt-1 p-0">
                        <h6 class="mb-1">CAMPAIGN DETAILS</h6>
                      </div>
                    </div>

                    <input type="hidden" name="id" id="capmaign-id" />

                    <div class="col-6">
                      <div class="form-group">
                        <label class="form-control-label">Username <span class="text-danger">*</span> </label>
                        <input type="text" placeholder="Enter username *" autocomplete="off" name="campaign_name" id="campaign_name" class="form-control" required readonly />
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label class="form-control-label">Phone Number Count <span class="text-danger">*</span> </label>
                        <input type="text" placeholder="Enter phone number count *" autocomplete="off" name="phone_number_count" id="phone_number_count" class="form-control" required readonly />
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label class="form-control-label">Full Name <span class="text-danger">*</span> </label>
                        <input type="text" placeholder="Enter full name *" autocomplete="off" name="full_name" id="full_name" class="form-control" required readonly />
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label class="form-control-label">Email <span class="text-danger">*</span> </label>
                        <input type="text" placeholder="Enter email *" autocomplete="off" name="email" id="email" class="form-control" required readonly />
                      </div>
                    </div>

                    <div class="col-12"><hr /></div>

                    <div class="col-6">
                      <div class="form-group">
                        <label class="form-control-label">Paste Phone Numbers To Change Status <span class="text-danger">*</span> </label>
                        <textarea type="text" placeholder="Enter phone numbers *" autocomplete="off" name="phone_numbers" id="phone_numbers" class="form-control" rows="5" required></textarea>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        <label class="form-control-label">New Status <span class="text-danger">*</span> </label>
                        <select name="new_status" id="new_status" class="form-control select2" required>
                          <option value="Failed">Failed</option>
                          <option value="Undelivered">Undelivered</option>
                        </select>
                      </div>
                    </div>

                    <label class="text-warning d-none col-12 mt-1 mb-1" id="warning-msg"></label>
                    <div class="col-lg-12 mt-1">
                      <div class="form-group">
                        <button type="submit" id="send-btn" class="btn btn-success">Submit</button>
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
      var unqiue_campaign_id = $("#unqiue_campaign_id").val();

      $.get("{{ route('admin.campaign.details.fetch') }}", {unqiue_campaign_id}, function(res) {
        if(res.status)
        {
          $("#capmaign-id").val(res.data.id);
          $("#campaign_name").val(res.data.username);
          $("#phone_number_count").val(res.data.numbers_counts);
          $("#full_name").val(res.data.full_name);
          $("#email").val(res.data.email_id);
          if($('#campaign-details-group').hasClass('d-none'))
          {
            $('#campaign-details-group').removeClass('d-none');
          }
        }
        else
        {
          $("#capmaign-id").val('');
          $("#campaign_name").val('');
          $("#phone_number_count").val('');
          $("#full_name").val('');
          $("#email").val('');
          if(!$('#campaign-details-group').hasClass('d-none'))
          {
            $('#campaign-details-group').addClass('d-none');
          }
          toastr.error(res.message, '', {
            closeButton: !0,
            tapToDismiss: !1,
            progressBar: true,
            timeOut: 1000
          });
        }
      }, 'json');
    });

    var whatsappForm = $("#update-status-form").validate({
      // errorPlacement: function (error, element) {}
    });

    $("#update-status-form").submit(function(event) {
      event.preventDefault();

      var formData = new FormData($(this)[0]);

      if (whatsappForm.valid())
      {
        $.ajax({
          type: 'POST',
          url: "{{ route('admin.campaign.status.post') }}",
          data: formData,
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function() {
            $("#warning-msg").removeClass('d-none');
            $("#warning-msg").text('Data is being saved do not refresh or submit again');
            $('#send-btn').prop('disabled', true);
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
              $('#send-btn').prop('disabled', false);
            }, 500);
          }
        });
      }
    });

  });
</script>

@endsection

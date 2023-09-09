@php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';
  if($type=='reseller')
  {
    $redirectUrl = (Auth::user()->user_type=="admin") ? 'admin.reseller.report.index' : 'user.reseller.report.index';
  }
  else
  {
    $redirectUrl = (Auth::user()->user_type=="admin") ? 'admin.user.report.index' : 'user.user.report.index';
  }
  $saveUrl = (Auth::user()->user_type=="admin") ? 'admin.credit.save' : 'user.credit.save';
@endphp

@extends($template)

@section('mytitle', 'Add Credit')
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
              <div class="card-header">
                <h6 class="float-left mb-1">ADD {{isset($type) ? strtoupper($type) : ''}} CREDIT</h6>
                <div class="float-right">
                  <a href="{{ route($redirectUrl) }}" class="btn btn-sm btn-primary"><i class="bx bx-left-arrow-alt"></i> Back</a>
                </div>
              </div>
              <div class="card-body">
                <form method="post" id="add-credit-form" enctype="multipart/form-data">
                  @csrf

                  <div class="row">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Select {{ucfirst($type)}} <span class="text-danger">*</span> </label>
                        <select data-placeholder="Select {{$type}} *" name="user" class="form-control select2" required>
                          @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->username.' ('.$user->user_unique_id.')'}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">No. of SMS <span class="text-danger">*</span> </label>
                        <input type="text" placeholder="Enter No. of SMS *" autocomplete="off" name="no_of_sms" class="form-control numberOnly" required />
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Per SMS price <span class="text-danger">*</span> </label>
                        <input type="text" placeholder="Enter Per SMS price *" autocomplete="off" name="per_sms_price" class="form-control numberOnly" required />
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Tax Included </label>
                        <select name="tax_status" class="form-control select2">
                          <option value="No">No</option>
                          <option value="Yes">Yes</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-group">
                        <label class="form-control-label">Description</label>
                        <textarea type="text" rows="5" placeholder="Enter description" autocomplete="off" name="description" class="form-control"></textarea>
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
    
    var creditForm = $("#add-credit-form").validate({
      // errorPlacement: function (error, element) {}
    });

    $("#add-credit-form").submit(function(event) {
      event.preventDefault();

      var formData = new FormData($(this)[0]);
      if (creditForm.valid())
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

  });
</script>

@endsection

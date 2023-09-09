@php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';

  $resellerIndexUrl = (Auth::user()->user_type=="admin") ? 'admin.reseller.index' : 'user.reseller.index';
  $profilePicUpload = (Auth::user()->user_type=="admin") ? 'login.profilepic.upload' : 'user.login.profilepic.upload';
  $resellerSave = (Auth::user()->user_type=="admin") ? 'admin.reseller.save' : 'user.reseller.save';
@endphp

@extends($template)

@section('mytitle', 'Resellers')
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
                <h6 class="float-left mb-1">ADD NEW RESELLER</h6>
                <div class="float-right">
                  <a href="{{ route($resellerIndexUrl) }}" class="btn btn-sm btn-primary"><i class="bx bx-left-arrow-alt"></i> Back</a>
                </div>
              </div>
              <div class="card-body">
                <form method="post" id="reseller-form" enctype="multipart/form-data">
                  @csrf

                  <div class="row">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Fullname <span class="text-danger">*</span> </label>
                        <input type="text" placeholder="Enter full name *" autocomplete="off" name="full_name" class="form-control" required />
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Username <span class="text-danger">*</span> </label>
                        <input type="text" placeholder="Enter username *" autocomplete="off" name="username" class="form-control" required />
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Email Id <span class="text-danger">*</span> </label>
                        <input type="email" placeholder="Enter email id *" autocomplete="off" name="email_id" class="form-control" required />
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Company </label>
                        <input type="text" placeholder="Enter company" autocomplete="off" name="company" class="form-control" />
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Mobile No. <span class="text-danger">*</span> </label>
                        <input type="number" placeholder="Enter mobile *" autocomplete="off" name="mobile" minlength="10" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control numberOnly" required />
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Image Option <span class="text-danger">*</span> </label>
                        <select data-placeholder="Select option *" name="image_status" class="form-control select2" required />
                          <option value="">--Select--</option>
                          <option value="0">Single</option>
                          @if(Auth::user()->image_status==1)
                            <option value="1">Multiple</option>
                          @endif
                        </select>
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Password <span class="text-danger">*</span> </label>
                        <input type="password" placeholder="Enter password *" autocomplete="off" name="password" class="form-control" required />
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Profile Pic</label>
                        <input type="hidden" name="profilepic" class="uploaded-profilepic-file" />
                        <p class="alert alert-success profilepic-upload-status d-none"></p>
                        <button type="button" name="profilepic_upload" id="profilepic_upload" class="btn btn-outline-primary btn-block"><i class="bx bx-upload"></i> Upload</button>
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

<div class="modal fade text-left w-100" id="upload-profilepic-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Profile Picture</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <form id="choose-profilepic-form" method="post" enctype="multipart/form-data">
              @csrf
              <div class="file-loading">
                <input id="profilepic-file" name="file" accept=".jpg, .png, .jpeg, .pdf" class="file doc_file_input" type="file">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')

<script>

  /*=====Scorecard upload======*/

    $("#profilepic-file").fileinput({
      theme: 'fas',
      uploadUrl: "{{ route($profilePicUpload) }}",
      uploadAsync: false,
      fileActionSettings: {
        showUpload: false
      },
      uploadExtraData: function() {
        return {
          _token: $("input[name='_token']").val(),
        };
      },
      allowedFileExtensions: ['jpg', 'png', 'jpeg', 'pdf'],
      overwriteInitial: false,
      maxFileSize:5120,
      maxFilesNum: 1,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      }
    })
    .on('filebatchuploadsuccess', function(event, data, previewId, index) {
      let nearestInput = $("input.uploaded-profilepic-file");
      let nearestBtn = $("button#profilepic_upload");
      let nearestStatus = $("p.profilepic-upload-status");

      $("input.uploaded-profilepic-file").val(data.response.file);
      if (nearestInput.val())
      {
        $(nearestBtn).addClass("d-none");
        $(nearestStatus).html(data.response.file+'<span class="float-right">'+
          '<a class="text-danger remove-profilepic-btn" href="javascript:void(0);">'+
            '<i class="bx bx-x-circle"></i>'+
          '</a>'+
        '</span>');
        $(nearestStatus).removeClass("d-none");
      }
      else
      {
        $(nearestBtn).removeClass("d-none");
        $(nearestStatus).addClass("d-none");
      }
      $("#upload-profilepic-modal").modal('hide');
      $('#choose-profilepic-form')[0].reset();

    });

  /*=====Scorecard upload======*/

  $(function() {


    $("#profilepic_upload").on("click", function() {
      $("#upload-profilepic-modal").modal('show');
    });

    $(document).on("click", ".remove-profilepic-btn", function() {
      $(this).closest('div').find("p.profilepic-upload-status").addClass('d-none');
      $(this).closest("div").find("button#profilepic_upload").removeClass('d-none');
      $(this).closest("div").find("input.uploaded-profilepic-file").val("");
    });

    /*-------------------------------------------------------*/
    
    var resellerForm = $("#reseller-form").validate({
      // errorPlacement: function (error, element) {}
    });

    $("#reseller-form").submit(function(event) {
      event.preventDefault();

      var formData = new FormData($(this)[0]);
      if (resellerForm.valid())
      {
        $.ajax({
          type: 'POST',
          url: "{{ route($resellerSave) }}",
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
              window.location.href = "{{ route($resellerIndexUrl) }}";
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

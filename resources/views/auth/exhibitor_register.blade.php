@extends('user.app')

@section('mytitle', 'User Registration')
@section('content')

<!-- BEGIN: Content-->

<style type="text/css">
  .select2-container .select2-selection--single {
      box-sizing: border-box;
      cursor: pointer;
      display: block;
      height: 42px;
      user-select: none;
      -webkit-user-select: none;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #444;
      line-height: 40px;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 42px;
    position: absolute;
    top: 1px;
    right: 1px;
    width: 20px;
}
</style>

<!-- =========================== Login/Signup =================================== -->
<section>
  <div class="container mt-5 pt-5">
    
    <div class="row">
      
      <div class="col-lg-2 col-md-12 col-sm-12"></div>
      <div class="col-lg-8 col-md-12 col-sm-12">
        <div class="login_signup">
          <h3 class="login_sec_title">Exhibitor Registration</h3>
          {{-- <form action="{{ route('register') }}" method="post" enctype="multipart/form-data"> --}}
          <form id="exhibitor-registration-form" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="text-bold-600" for="first_name">{{ __('First Name') }} <span class="text-danger">*</span></label>
                  <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" placeholder="Enter first name" required autocomplete="Enter first name" autofocus>
                  @error('first_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="text-bold-600" for="last_name">{{ __('Last Name') }} <span class="text-danger">*</span></label>
                  <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="Enter last name" required autocomplete="Enter last name" autofocus>
                  @error('last_name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group mb-50">
                  <label class="text-bold-600" for="exhibitor-email">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                  <input id="exhibitor-email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" required autocomplete="email">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group mb-50">
                  <label class="text-bold-600" for="email">{{ __('Gender') }} <span class="text-danger">*</span></label>
                  <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" placeholder="Select gender" required>
                    <option value="">--Select--</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                  @error('gender')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label class="form-control-label" for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                <fieldset class="form-group position-relative has-icon-left">
                  <input type="text" class="form-control pickadate @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" placeholder="Date of birth" value="{{ old('date_of_birth') }}" required>
                  @error('date_of_birth')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  <div class="form-control-position">
                    <i class='bx bx-calendar'></i>
                  </div>
                </fieldset>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label  class="text-bold-600" for="mobileno">{{ __('Mobile Number') }} <span class="text-danger">*</span></label>
                  <input type="number" name="mobileno" id="mobileno" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control numberOnly @error('mobileno') is-invalid @enderror" placeholder="Enter mobile number" maxlength="10" value="{{ old('mobileno') }}"  required autocomplete="mobileno" autofocus>
                  @error('mobileno')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group mb-2">
                  <label class="text-bold-600" for="exhibitor-password">{{ __('Password') }} <span class="text-danger">*</span></label>
                  <input id="exhibitor-password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group mb-2">
                  <label class="text-bold-600" for="exhibitor-password-confirm">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                  <input id="exhibitor-password-confirm" type="password" class="form-control @error('exhibitor-password-confirm') is-invalid @enderror" placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password">
                </div>
              </div>

              {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">School <span class="text-danger">*</span></label>
                  <input type="text" name="school" id="school" class="form-control" placeholder="Enter school name" value="{{ old('school') }}" required>
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">Class <span class="text-danger">*</span></label>
                  <input type="text" name="class" id="class" class="form-control" placeholder="Enter class name" value="{{ old('class') }}" required>
                </div>
              </div> --}}


              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label" for="city">City</label>
                  <select name="city" id="city" class="form-control select2 @error('city') is-invalid @enderror" data-placeholder="Select City">
                    <option value="">--Select--</option>
                  </select>
                  @error('city')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label" for="type">Please select Invitees/Competition <span class="text-danger">*</span></label>
                  <select name="type" id="type" class="form-control select2 @error('type') is-invalid @enderror" data-placeholder="--Select--" required>
                    <option value="">--Select--</option>
                    <option value="Invitees">Invitees</option>
                    <option value="Competition">Competition</option>
                  </select>
                  @error('type')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label" for="profile_pic">Profile Pic <span class="text-danger">*</span></label>
                  <input type="hidden" id="profile_pic" name="profile_pic" class="uploaded-profile-pic @error('profile_pic') is-invalid @enderror" required />
                  @error('profile_pic')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  <p class="alert alert-success profile_pic_file-upload-status d-none"></p>
                  <button type="button" name="profile_pic_upload" id="profile_pic_upload" class="btn btn-outline-primary btn-block"><i class="bx bx-upload"></i> Upload</button>
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label" for="address_proof">Address Proof <span class="text-danger">*</span></label>
                  <input type="hidden" name="address_proof" class="uploaded-file @error('address_proof') is-invalid @enderror" required />
                  @error('address_proof')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                  <p class="alert alert-success file-upload-status d-none"></p>
                  <button type="button" name="image_upload" id="image_upload" class="btn btn-outline-primary btn-block"><i class="bx bx-upload"></i> Upload</button>
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label" for="proof_type">Address proof Aadhar card/ Voter id card <span class="text-danger">*</span></label>
                  <select name="proof_type" id="proof_type" class="form-control select2 @error('proof_type') is-invalid @enderror" data-placeholder="--Select--" required>
                    <option value="">--Select--</option>
                    <option value="Aadhaar Card">Aadhaar Card</option>
                    <option value="Voter Id card">Voter Id card</option>
                    <option value="Id Proof">Id Proof</option>
                  </select>
                  @error('proof_type')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label" for="proof_details">Proof Details <span class="text-danger">*</span></label>
                  <input type="text" name="proof_details" id="proof_details" class="form-control @error('proof_details') is-invalid @enderror" placeholder="" value="{{ old('proof_details') }}" required>
                  @error('proof_details')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label" for="about">About Yourself <span class="text-danger">*</span></label>
                  <textarea type="text" name="about" id="about" class="form-control @error('proof_details') is-invalid @enderror" placeholder="About Yourself" rows="3" required></textarea>
                  @error('about')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label" for="address">Address <span class="text-danger">*</span></label>
                  <textarea type="text" name="address" id="address" class="form-control @error('proof_details') is-invalid @enderror" placeholder="Enter address" rows="3" required></textarea>
                  @error('address')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  {{-- <label class="form-control-label">Please select Invitees/Competition</label> --}}
                  <select name="frame" id="frame" class="form-control select2 @error('frame') is-invalid @enderror" data-placeholder="Select Required Frame *" required>
                    <option value="">--Select--</option>
                    @for($i=1; $i<=20; $i++)
                      <option value="{{$i}}">{{$i}}</option>
                    @endfor
                  </select>
                  @error('frame')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  {{-- <label class="form-control-label">Please select Invitees/Competition</label> --}}
                  <input type="text" name="prewon_award" id="prewon_award" class="form-control @error('prewon_award') is-invalid @enderror" placeholder="Previous award won *" required />
                  @error('prewon_award')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="col-lg-4 col-md-12 mt-3"></div>
              <div class="col-lg-4 col-md-12 mt-3">
                <div class="form-group mb-5">
                  <button type="submit" id="submit-btn" class="btn btn-md btn-success btn-block glow w-100 position-relative">Sign Up</button>
                </div>
              </div>

              {{-- <div class="col-lg-12 col-md-12">
                <div class="login_flex">
                  <div class="login_flex_1">
                    <input id="news" class="checkbox-custom" name="news" type="checkbox">
                    <label for="news" class="checkbox-custom-label">Sign Up for Newsletter</label>
                  </div>
                  <div class="login_flex_2">
                    <div class="form-group mb-0">
                      <button type="submit" class="btn btn-md btn-theme">Sign Up</button>
                    </div>
                  </div>
                </div>
              </div> --}}

            </div>
      
          
          </form>
        </div>
      </div>
      
    </div>
  </div>
</section>
<!-- =========================== Login/Signup =================================== -->

<div class="modal fade text-left w-100" id="upload-profile_pic-modal" tabindex="-1" role="dialog"
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
            <form id="choose-profile_pic-form" method="post" enctype="multipart/form-data">
              @csrf
              <div class="file-loading">
                <input id="profile-pic-file" name="file" accept=".jpg, .png, .jpeg" class="file doc_file_input" type="file">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-left w-100" id="upload-document-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Image</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <form id="choose-img-form" method="post" enctype="multipart/form-data">
              @csrf
              <div class="file-loading">
                <input id="file" name="file" accept=".jpg, .png, .jpeg" class="file doc_file_input" type="file">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- END: Content-->
@endsection

@section('script')

<script>

  /*=====Profile Picture upload======*/

    $("#profile-pic-file").fileinput({
      theme: 'fas',
      uploadUrl: "{{ route('exhibitor.profilepic.upload') }}",
      uploadAsync: false,
      fileActionSettings: {
        showUpload: false
      },
      uploadExtraData: function() {
        return {
          _token: $("input[name='_token']").val(),
        };
      },
      allowedFileExtensions: ['jpg', 'png', 'jpeg'],
      overwriteInitial: false,
      maxFileSize:5120,
      maxFilesNum: 1,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      }
    })
    .on('filebatchuploadsuccess', function(event, data, previewId, index) {
      let nearestInput = $("input.uploaded-profile-pic");
      let nearestBtn = $("button#profile_pic_upload");
      let nearestStatus = $("p.profile_pic_file-upload-status");

      $("input.uploaded-profile-pic").val(data.response.file);
      if (nearestInput.val())
      {
        $(nearestBtn).addClass("d-none");
        $(nearestStatus).html(data.response.file+'<span class="float-right">'+
          '<a class="text-danger remove-document-btn" href="javascript:void(0);">'+
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
      $("#upload-profile_pic-modal").modal('hide');
      $('#choose-profile_pic-form')[0].reset();

    });

  /*=====Profile Picture upload======*/
  /*=====School ID Proof upload======*/

    $("#file").fileinput({
      theme: 'fas',
      uploadUrl: "{{ route('exhibitor.addressproof.upload') }}",
      uploadAsync: false,
      fileActionSettings: {
        showUpload: false
      },
      uploadExtraData: function() {
        return {
          _token: $("input[name='_token']").val(),
        };
      },
      allowedFileExtensions: ['jpg', 'png', 'jpeg'],
      overwriteInitial: false,
      maxFileSize:5120,
      maxFilesNum: 1,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      }
    })
    .on('filebatchuploadsuccess', function(event, data, previewId, index) {
      let nearestInput = $("input.uploaded-file");
      let nearestBtn = $("button#image_upload");
      let nearestStatus = $("p.file-upload-status");

      $("input.uploaded-file").val(data.response.file);
      if (nearestInput.val())
      {
        $(nearestBtn).addClass("d-none");
        $(nearestStatus).html(data.response.file+'<span class="float-right">'+
          '<a class="text-danger remove-document-btn" href="javascript:void(0);">'+
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
      $("#upload-document-modal").modal('hide');
      $('#choose-img-form')[0].reset();

    });

  /*=====School ID Proof upload======*/


  $(function() {

    $("#profile_pic_upload").on("click", function() {
      $("#upload-profile_pic-modal").modal('show');
    });

    $(document).on("click", ".remove-document-btn", function() {
      $(this).closest('div').find("p.profile_pic_file-upload-status").addClass('d-none');
      $(this).closest("div").find("button#profile_pic_upload").removeClass('d-none');
      $(this).closest("div").find("input.uploaded-profile-pic").val("");
    });

    $("#image_upload").on("click", function() {
      $("#upload-document-modal").modal('show');
    });

    $(document).on("click", ".remove-document-btn", function() {
      $(this).closest('div').find("p.file-upload-status").addClass('d-none');
      $(this).closest("div").find("button#image_upload").removeClass('d-none');
      $(this).closest("div").find("input.uploaded-file").val("");
    });

    $(".pickadate").pickadate({
      format: "dd-mm-yyyy",
      selectYears: 90,
      selectMonths: true,
      max: true
    });

    var exhibitorForm = $("#exhibitor-registration-form").validate({
      errorPlacement: function (error, element) {}
    });

    $("#exhibitor-registration-form").submit(function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      if (exhibitorForm.valid())
      {
        let email = $('#exhibitor-email').val();
        $.get("{{ route('exhibitor.checkEmail') }}", {email}, function(res)
        {
          if(res<=0)
          {
            let password = $('#exhibitor-password').val();
            let confirmPassword = $('#exhibitor-password-confirm').val();
            let validatedPassword = validateConfirmPassword(password, confirmPassword);
            if (validatedPassword)
            {
              $.ajax({
                type: 'POST',
                url: "{{ route('exhibitor.save') }}",
                data: formData,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                  // $("#warning-msg").removeClass('d-none');
                  // $("#warning-msg").text('Data is being saved do not refresh or submit again');
                  $('#submit-btn').prop('disabled', true);
                },
                success: function(data)
                {
                  if (data.status) {
                    toastr.success(data.message, '', {
                      closeButton: !0,
                      tapToDismiss: !1,
                      progressBar: true,
                      timeOut: 50000
                    });
                    window.location.href = "{{ route('exhibitor.home') }}";
                  }
                  else
                  {
                    toastr.error(data.message, '', {
                      closeButton: !0,
                      tapToDismiss: !1,
                      progressBar: true,
                      timeOut: 50000
                    });
                  }
                  setTimeout(function() {
                    // $("#warning-msg").addClass('d-none');
                    $('#submit-btn').prop('disabled', false);
                  }, 50000);
                }
              });
            }
            else
            {
              // alert("Both password not matched");
              toastr.error('Both password not matched', '', {
                closeButton: !0,
                tapToDismiss: !1,
                progressBar: true,
                timeOut: 50000
              });
            }
          }
          else
          {
            toastr.error('Email address already exist !', '', {
              closeButton: !0,
              tapToDismiss: !1,
              progressBar: true,
              timeOut: 50000
            });
          }
        }, 'json');
        
      }
    });

    function validateConfirmPassword(password, confirmPassword)
    {
      if (password != confirmPassword)
      {
        return false;
      }
      else
      {
        return true;
      }
    }

  });
</script>

@endsection
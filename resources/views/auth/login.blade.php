@extends('user.layouts.app')

@section('mytitle', 'Users/Resellers Login')
@section('content')

<!-- BEGIN: Content-->

<!-- =========================== Login/Signup =================================== -->
<section>
  <div class="container mt-3">
    
    <div class="row">
      
      <div class="col-lg-3 col-md-12 col-sm-12"></div>
      <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="login_signup">
          <h3 class="login_sec_title mb-3">Users/Resellers Login</h3>
          {{-- <p class="text-center">Let us get you connected to something amazing.</p> --}}
          {{-- <form action="{{ route('login') }}" method="POST"> --}}
          <form id="student-login-form" method="POST" enctype="multipart/form-data">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @csrf
            <div class="form-group">
              <label class="text-bold-600" for="email">{{ __('Email Address') }}</label>
              <input type="text" id="email" class="form-control bg-light {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('username') ?: old('email') }}" placeholder="Email address" required autocomplete="email" autofocus>
              @if ($errors->has('username') || $errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
            
            <div class="form-group">
              <label class="text-bold-600" for="exampleInputPassword1">{{ __('Password') }}</label>
              <input id="password" type="password" class="form-control bg-light @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <div class="g-recaptcha" data-sitekey="6LepLkEUAAAAANR6z99Aud9YK4ntjEeOUz70SKNg"></div>
              <span id="captcha_error" style="color: red;"></span>
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            
            @if (Route::has('password.request'))
              <div class="login_flex">
                <div class="login_flex_1">
                  <a href="{{ route('password.request') }}" class="text-bold">{{ __('Forgot Your Password?') }}</a>
                </div>
              </div>
            @endif

            <div class="form-group mt-3 mb-2">
              <button type="submit" id="submit-btn" class="btn btn-md btn-success position-relative w-100">Login</button>
            </div>
          
          </form>
        </div>
      </div>

      <div class="col-12 text-center mt-5">
        Don't have an account ? <a href="{{ route('register') }}" class="glow w-100 position-relative">Register Now<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></a>
      </div>
    </div>
  </div>
</section>
<!-- =========================== Login/Signup =================================== -->


<!-- END: Content-->
@endsection

@section('script')

<script>
  $(function() {
    
    function isCaptchaChecked()
    {
      return grecaptcha && grecaptcha.getResponse().length !== 0;
    }

    var studentLoginForm = $("#student-login-form").validate({
      errorPlacement: function (error, element) {}
    });

    $("#student-login-form").submit(function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      if (studentLoginForm.valid())
      {
        if (isCaptchaChecked())
        {
          $.ajax({
            type: 'POST',
            url: "",
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
                  timeOut: 500
                });
                location.reload();
                {{--window.location.href = "{{ route('user.home') }}";--}}
              }
              else
              {
                toastr.error(data.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 500
                });
              }
              setTimeout(function() {
                $('#submit-btn').prop('disabled', false);
              }, 500);
            }
          });
        }
        else
        {
          // alert("Both password not matched");
          toastr.error('Please check recaptcha !', '', {
            closeButton: !0,
            tapToDismiss: !1,
            progressBar: true,
            timeOut: 500
          });
        }
      }
    });
  });
</script>

@endsection
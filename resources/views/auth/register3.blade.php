@extends('layouts.app')

@section('content')
<!-- BEGIN: Content-->
<style type="text/css">
.row {
    margin-right: -35px;
    margin-left: -35px;
  }

  .checkbox label:after {
    border: 1px solid #737a82;
  }
</style>
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <!-- register section starts -->
      <section class="row flexbox-container">
        <div class="col-xl-8 col-10">
          <div class="card bg-authentication mb-0">
            <div class="row m-0">
              <!-- register section left -->
              <div class="col-md-12 col-12 px-0">
                <div class="card disable-rounded-right mb-0 custom-padding h-100 d-flex justify-content-center">
                  <div class="card-header pb-0">
                    <div class="card-title text-center" style="width: 100%;">
                      <h4 class="mb-2">{{ __('Register') }}</h4>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row m-0">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group mb-50">
                            <label class="text-bold-600" for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter name" required autocomplete="name" autofocus>
                            @error('name')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group mb-50">
                            <label class="text-bold-600" for="username">{{ __('Username') }} <span class="text-danger">*</span></label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Enter username" required autocomplete="username" autofocus>
                            @error('username')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group mb-50">
                            <label class="text-bold-600" for="email">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" required autocomplete="email">
                            @error('email')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group mb-50">
                            <label class="text-bold-600" for="contact_no">{{ __('Contact Number') }} <span class="text-danger">*</span></label>
                            <input type="text" id="contact_no" class="form-control numberOnly @error('contact_no') is-invalid @enderror" maxlength="10" name="contact_no" value="{{ old('contact_no') }}" placeholder="Enter contact number" required autocomplete="contact_no">
                            @error('contact_no')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group mb-50">
                            <label class="text-bold-600" for="aadhar_card_no">{{ __('Aadhar Card Number') }}</label>
                            <input type="text" id="aadhar_card_no" value="{{ old('aadhar_card_no') }}" class="form-control numberOnly" name="aadhar_card_no" placeholder="Enter aadhar card number" maxlength="12" />
                          </div>
                        </div>
                      </div>
                      <hr />
                      <div class="row m-0">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group mb-2">
                            <label class="text-bold-600" for="password">{{ __('Password') }} <span class="text-danger">*</span></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">
                            @error('password')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group mb-2">
                            <label class="text-bold-600" for="password-confirm">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password">
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                          <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                            <div class="text-center">
                              <div class="checkbox checkbox-sm">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms">
                                <label class="checkboxsmall" for="terms">
                                  <span>I accept Property Bank's <a class="card-link" target="_BLANK" href="{{ asset('assets/others/t_and_c.pdf') }}">Terms and Conditions</a>.</span>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-1 text-center">
                          <button type="submit" id="register-btn" class="btn btn-primary glow position-relative w-50">{{ __('Register') }} <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                          </button>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12"></div>
                      </div>
                    </form>
                    <hr>
                    <div class="text-center mb-1"><span class="mr-25">Already have an account?</span><a href="login"><span>{{ __('Login') }}</span> </a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- register section endss -->
    </div>
  </div>
</div>
<!-- END: Content-->
@endsection

@section('script')

<script type="text/javascript">

  $(function() {

    $(document).on("change", "#is_rera_registered", function() {
      $("#rera_reg_no_group").toggle();
    });

    $("#register-btn").prop('disabled', true);

    $(document).on("change", '#terms', function() {
      if (this.checked)
      {
        $("#register-btn").prop('disabled', false);
      }
      else
      {
        $("#register-btn").prop('disabled', true);
      }
    });

  });
</script>

@endsection

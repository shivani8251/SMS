@extends('layouts.app')

@section('content')
<!-- BEGIN: Content-->
<style type="text/css">
.row {
    margin-right: -35px;
    margin-left: -35px;
  }
</style>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
         <!-- reset password start -->
            <section class="row flexbox-container">
                <div class="col-xl-7 col-10">
                    <div class="card bg-authentication mb-0">
                        <div class="row m-0">
                            <div class="col-12 d-xl-none d-sm-block pt-1 text-center bg-white">
                              <img style="height: 90px; width: auto; margin-bottom: 5px;" src="{{ asset('assets/img/logo.png') }}">
                              <hr>
                            </div>
                            <!-- left section-login -->
                            <div class="col-md-6 col-12 px-0">
                                <div class="card disable-rounded-right d-flex justify-content-center mb-0 custom-padding h-100">
                                    <div class="card-header pb-0">
                                        <div class="card-title mt-0">
                                            <h4 class="text-center mb-2">{{ __('Forgot Password') }}</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if (session('success'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if (session('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        <form class="mb-2" method="POST" action="{{ route('forget-password') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="text-bold-600" for="email">{{ __('E-Mail Address') }}</label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter registered email" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary glow position-relative w-100">{{ __('Send Password Reset Link') }}<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                            <hr />
                                            <a href="{{ route('login') }}" class="btn btn-primary glow position-relative w-100"><i class="bx bx-left-arrow-alt"></i> Back to login</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- right section image -->
                            <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                <img class="img-fluid" src="{{ asset('assets/images/pages/reset-password.png') }}" alt="branding logo">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- reset password ends -->
      </div>
    </div>
  </div>
    <!-- END: Content-->
@endsection

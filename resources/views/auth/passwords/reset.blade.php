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
                                    <div class="card-header pb-1">
                                        <div class="card-title">
                                            <h4 class="text-center mb-0">{{ __('Reset Password') }}</h4>
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
                                        <form class="mb-2" method="POST" action="{{ route('reset-password') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">

                                            <div class="form-group">
                                                <label for="password" class="text-bold-600">{{ __('Password') }}</label>

                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter new password"  autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="password-confirm"  class="text-bold-600">{{ __('Confirm Password') }}</label>

                                                <input id="password-confirm" type="password" class="form-control" placeholder="Confirm new password" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary glow position-relative w-100">{{ __('Reset Password') }}<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
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

@extends('admin.layouts.app')

@section('content')
  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <!-- login page start -->
        <section id="auth-login" class="row flexbox-container">
          <div class="col-xl-8 col-11">
            <div class="card bg-authentication mb-0">
              <div class="row m-0">
                <!-- left section-login -->
                <div class="col-md-6 col-12 px-0">
                  <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                    <div class="card-header pb-1">
                      <div class="card-title">
                        <h4 class="text-center mb-2">{{ __('Admin Login') }}</h4>
                      </div>
                    </div>
                    <div class="card-body">
                      @if(session()->has('status'))
                        <div class="alert alert-success">
                          {{ session('status') }}
                        </div>
                      @endif
                      <form action="{{ route('admin.auth') }}" method="POST">
                        @csrf
                        <div class="form-group mb-50">
                          <label class="text-bold-600" for="username">{{ __('User ID') }}</label>
                          <input id="username" type="input" class="form-control @error('username') is-invalid @enderror @error('email_id') is-invalid @enderror" name="username" value="{{ old('username') ? old('username') : old('email_id') }}" placeholder="Email address" required autocomplete="username" autofocus>
                          @error('username')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          @error('email_id')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label class="text-bold-600" for="exampleInputPassword1">{{ __('Password') }}</label>
                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                          @error('password')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                          <div class="text-left">
                            <div class="checkbox checkbox-sm">
                              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                              <label class="checkboxsmall" for="remember">
                                <small>{{ __('Keep me logged in') }}</small>
                              </label>
                            </div>
                          </div>
                          <!-- @if (Route::has('password.request'))
                            <div class="text-right">
                              <a class="card-link" href="{{ route('password.request') }}">
                                <small>{{ __('Forgot Your Password?') }}</small>
                              </a>
                            </div>
                          @endif -->
                        </div>
                        <button type="submit" class="btn btn-primary glow w-100 position-relative">{{ __('Login') }}<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                      </form>
                      <!-- <hr> -->
                      <!-- <div class="text-center">
                        <small class="mr-25">Don't have an account?</small><a href="register"><small>Sign up</small></a>
                      </div> -->
                    </div>
                  </div>
                </div>
                <!-- right section image -->
                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                  <img class="img-fluid" src="{{ asset('public/assets/images/logo/login.png') }}" alt="branding logo">
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- login page ends -->
      </div>
    </div>
  </div>
    <!-- END: Content-->
@endsection

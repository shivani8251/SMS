@extends('admin.layouts.app')

@section('content')
<!-- BEGIN: Content-->
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
                        <div class="col-md-6 col-12 px-0">
                            <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                <div class="card-header pb-1">
                                    <div class="card-title text-center">
                                        <h4 class="mb-2">{{ __('Admin Registration') }}</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('register') }}" method="post">
                                        @csrf
                                        <div class="form-group mb-50">
                                            <label class="text-bold-600" for="name">{{ __('Name') }}</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-group mb-50">
                                            <label class="text-bold-600" for="email">{{ __('Email Address') }}</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email address" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="text-bold-600" for="password">{{ __('Password') }}</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="text-bold-600" for="password-confirm">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                        <button type="submit" class="btn btn-primary glow position-relative w-100">{{ __('Register') }}<i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center"><small class="mr-25">Already have an account?</small><a href="login"><small>{{ __('Login') }}</small> </a></div>
                                </div>
                            </div>
                        </div>
                        <!-- image section right -->
                        <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                            <img class="img-fluid" src="{{ asset('public/assets/images/pages/register.png') }}" alt="branding logo">
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

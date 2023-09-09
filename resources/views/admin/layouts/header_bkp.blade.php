<div class="header-navbar-shadow"></div>
<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top">
  <div class="navbar-wrapper">
    <div class="navbar-container content">
      <div class="navbar-collapse" id="navbar-mobile">
        <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu d-xl-none mr-auto">
              <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="javascript:void(0);">
                <i class="ficon bx bx-menu"></i>
              </a>
            </li>
          </ul>
          <ul class="nav navbar-nav bookmark-icons">
            <li class="nav-item d-none d-lg-block mr-1">
              <a class="nav-link" href="{{ route('home') }}">
                <h5 class="mt-1" style="color: #fff;">@yield('mytitle')</h5>
              </a>
            </li>
            {{-- <li class="dropdown dropdown-language nav-item">
              <a class="dropdown-toggle nav-link" style="margin-top: 5px;" id="dropdown-flag" href="javascript:void(0);">
                <span class="selected-language text-white">|</span> <span class="selected-language text-white ml-1">Total Credits : {{isset(Auth::user()->credit) ? Auth::user()->credit : '0'}}</span>
              </a>
            </li> --}}
          </ul>

          <ul class="nav navbar-nav bookmark-icons">
            <li class="nav-item d-xl-none d-sm-block mt-1">
              <img style="height: auto; width: 35px; margin-right: 5px; margin-bottom: 5px;" src="{{ asset('public/assets/img/favicon.png') }}"><span class="h4 text-white"> {{isset(Auth()->user()->company) ? Auth()->user()->company : ''}}</span>
            </li>
          </ul>
          
        </div>
        <ul class="nav navbar-nav float-right">
         
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link nav-link-expand">
              <i class="ficon bx bx-fullscreen text-white"></i>
            </a>
          </li>
          
          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="javascript:void(0);" data-toggle="dropdown">
              <div class="user-nav d-sm-flex d-none">
                <span class="user-name text-white">{{isset(Auth::user()->full_name) ? Auth::user()->full_name : Auth::user()->user_type}}</span>
                <span class="user-status text-white">Available</span>
              </div>
              <span>
                <img class="round" src="{{ isset(Auth::user()->profilepic) ? asset('public/storage/users/'.Auth::user()->profilepic) : asset('public/assets/img/user.png') }}" alt="avatar" height="40" width="40"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right pb-0">
                <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                   <i class="bx bxs-user mr-50"></i> {{ __('Profile') }}
                </a>
                <a class="dropdown-item" data-toggle="modal" data-target="#change-password-modal" href="javascript:void(0);">
                   <i class="bx bx-key mr-50"></i> {{ __('Change Password') }}
                </a>
                <a class="dropdown-item" data-toggle="modal" data-target="#update-credit-modal" href="javascript:void(0);">
                   <i class="bx bx-money mr-50"></i> {{ __('Add Credit Balance') }}
                </a>
                <div class="dropdown-divider mb-0"></div>
                <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="bx bx-power-off mr-50"></i> {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div class="modal fade text-left" id="change-password-modal" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Change Password </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <form method="post" id="change-password-form">
        <div class="modal-body">
          @csrf
          <input type="hidden" name="id" id="id" value="{{Auth::user()->id}}" />
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Old Password</label>
                <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Enter old password" required>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter confirm password" required>
              </div>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Save</span>
          </button>
          <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
          </button>            
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade text-left" id="update-credit-modal" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Credit </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <form method="post" id="update-credit-form">
        <div class="modal-body">
          @csrf
          <input type="hidden" name="id" value="{{Auth::user()->id}}" />
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Credit</label>
                <input type="number" name="credit" class="form-control numberOnly" placeholder="Enter credit" required />
              </div>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" id="submit-credit-btn" class="btn btn-success ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Save</span>
          </button>
          <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
          </button>            
        </div>
      </form>
    </div>
  </div>
</div>

@section('header_script')

<script>
        
  $(function() {

    var employeeForm = $("#change-password-form").validate({
      errorPlacement: function (error, element) {}
    });

    $("#change-password-form").submit(function(event) {
      event.preventDefault();

      if (employeeForm.valid())
      {
        let old_password = $('#old_password').val();
        let password = $('#password').val();
        let confirmPassword = $('#confirm_password').val();
        let validatedPassword = validateConfirmPassword(password, confirmPassword);
        if (validatedPassword)
        {
          $.post("{{ route('login.password.change') }}", $(this).serialize(), function(data) {
            // console.log(data);
            if (data.status) {
              toastr.success(data.message, '', {
                closeButton: !0,
                tapToDismiss: !1,
                progressBar: true,
                timeOut: 1000
              });
              setTimeout(function() {
                $('#change-password-form')[0].reset();
                $("#change-password-modal").modal("hide");
              }, 1000);
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
          }, 'json');
        }
        else
        {
          toastr.error("Both password not matched", '', {
            closeButton: !0,
            tapToDismiss: !1,
            progressBar: true,
            timeOut: 1000
          });
          // alert("Both password not matched");
        }
      }
    });

    var adminCreditForm = $("#update-credit-form").validate({
      errorPlacement: function (error, element) {}
    });

    $("#update-credit-form").submit(function(event) {
      event.preventDefault();

      if (adminCreditForm.valid())
      {
        $.post("{{ route('admin.credit.update') }}", $(this).serialize(), function(data) {
          // console.log(data);
          if (data.status) {
            toastr.success(data.message, '', {
              closeButton: !0,
              tapToDismiss: !1,
              progressBar: true,
              timeOut: 1000
            });
            setTimeout(function() {
              $('#update-credit-form')[0].reset();
              $("#update-credit-modal").modal("hide");
            }, 1000);
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
@php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';

  $userAddUrl = (Auth::user()->user_type=="admin") ? 'admin.user.add' : 'user.user.add';
  $userDeactivate = (Auth::user()->user_type=="admin") ? 'admin.user.deactivate' : 'user.user.deactivate';
  $userActivate = (Auth::user()->user_type=="admin") ? 'admin.user.activate' : 'user.user.activate';
  $userServerSideDataTable = (Auth::user()->user_type=="admin") ? 'admin.user.serverSideDataTable' : 'user.user.serverSideDataTable';
  $userPasswordReset = (Auth::user()->user_type=="admin") ? 'admin.user.password.reset' : 'user.user.password.reset';
@endphp

@extends($template)

@section('mytitle', 'Users')
@section('content')
<!-- BEGIN: Content-->
<style type="text/css">
  table th {
    font-size: 14px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 15px !important;
    padding: 10px !important;
  }

  .select2-container {
    width: 100% !important;
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
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <h6 class="float-left mb-1">LIST OF ALL USER</h6>
                    <div class="float-right">
                      <a href="{{ route($userAddUrl) }}" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> ADD NEW USER</a>
                    </div>
                  </div>
                  <div class="col-12">
                    <hr class="mb-0 pb-0" />
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered w-100" id="user-list-table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>User Type</th>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Email ID</th>
                            <th>Credit</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>                                   
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>
</div>
<!-- END: Content-->

<div class="modal fade text-left" id="reset-password-modal" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reset User Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <form method="post" id="reset-password-form">
        <div class="modal-body">
          @csrf
          <input type="hidden" name="id" id="user-id" />
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">New Password</label>
                <input type="password" name="password" id="user-password" class="form-control" placeholder="Enter password" required />
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="user-confirm-password" class="form-control" placeholder="Enter confirm password" required />
              </div>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" id="save-password-btn" class="btn btn-success ml-1">
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

@endsection

@section('script')

<script>
  $(function() {

    $(document).on('click', '.reset-password-btn', function(){
      var id = $(this).data('id');
      $("#user-id").val(id);
      $("#reset-password-modal").modal("show");
    });

    var employeeForm = $("#reset-password-form").validate({
      errorPlacement: function (error, element) {}
    });

    $("#reset-password-form").submit(function(event) {
      event.preventDefault();

      if (employeeForm.valid())
      {
        let userPassword = $('#user-password').val();
        let userConfirmPassword = $('#user-confirm-password').val();
        let validatedUserPassword = validateUserConfirmPassword(userPassword, userConfirmPassword);
        if (validatedUserPassword)
        {
          $.ajax({
            url: "{{ route($userPasswordReset) }}",
            dataType: 'json',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function() {
              $('#save-password-btn').prop('disabled', true);
            },
            success: function(data) {
              if (data.status)
              {
                toastr.success(data.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 1000
                });
                setTimeout(function() {
                  $('#reset-password-form')[0].reset();
                  $("#reset-password-modal").modal("hide");
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
              $('#save-password-btn').prop('disabled', false);
            }
          });
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

    function validateUserConfirmPassword(password, confirmPassword)
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

    $(document).on('click', '.deactivate-user-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to deactivate this user ?',
            buttons: {
              yes: function() {
                  $.get("{{ route($userDeactivate) }}", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#user-list-table').DataTable().ajax.reload();
                      } else {
                          toastr.error(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                      }
                  }, 'json');
              },
              no: function() {}
            }
        });
    });

    $(document).on('click', '.activate-user-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to activate this user ?',
            buttons: {
              yes: function() {
                  $.get("{{ route($userActivate) }}", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#user-list-table').DataTable().ajax.reload();
                      } else {
                          toastr.error(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                      }
                  }, 'json');
              },
              no: function() {}
            }
        });
    });

    userListTable();
    function userListTable() {
      $('#user-list-table').DataTable().clear().destroy();

      $("#user-list-table").DataTable({
        serverSide: true,
        processing: true,
        searching: true,
        // dom: 'lfrtip',
        "aLengthMenu": [[25, 50, 100, 200, 300, 400, 500, 1000, -1], [25, 50, 100, 200, 300, 400, 500, 1000, "All"]],
        "iDisplayLength": 25,
        order: [],
        ajax: {
            url: "{{ route($userServerSideDataTable) }}",
            type: "GET",
            data: {}
        },
        "columns": [
          { data: 'id' },
          { data: 'user_type' },
          { data: 'full_name' },
          { data: 'username' },
          { data: 'email_id' },
          { data: 'credit' },
          { data: 'status' },
          { data: 'actions' },
        ]
      });
    }

  });
</script>

@endsection

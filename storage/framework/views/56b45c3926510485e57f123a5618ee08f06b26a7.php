<?php $__env->startSection('mytitle', 'New Associate'); ?>
<?php $__env->startSection('content'); ?>

<!-- BEGIN: Content-->
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
              <div class="card-header">
                <h4 class="h4">New Associate</h4>
                <div class="float-right">
                  <a href="<?php echo e(route('admin.associates')); ?>" class="btn btn-sm btn-primary"><i class="bx bx-left-arrow-alt"></i> Back</a>
                </div>
              </div>
              <div class="card-body">
                <form id="add-employee-form" method="post" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <div class="row">

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" autocomplete="off" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" autocomplete="off" required>
                      </div>
                    </div> 
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Profile Picture</label>
                        <div class="custom-file">
                          <input type="file" accept=".jpg, .png, .jpeg" class="custom-file-input" name="profile_pic" id="profile_pic">
                          <label class="custom-file-label" for="profile_pic">Choose file</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" autocomplete="off" required>
                      </div>
                    </div>                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Contact Number <span class="text-danger">*</span></label>
                        <input type="text" name="contact_no" id="contact_no" class="form-control" placeholder="Enter contact number" maxlength="10" autocomplete="off" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Aadhar Card Number</label>
                        <input type="text" name="aadhar_card_no" id="aadhar_card_no" class="form-control" placeholder="Enter aadhar card number" maxlength="12" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Aadhar Card (Front)</label>
                        <div class="custom-file">
                          <input type="file" accept=".jpg, .png, .jpeg" class="custom-file-input" name="aadhar_card_front" id="aadhar_card_front">
                          <label class="custom-file-label" for="aadhar_card_front">Choose file</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Aadhar Card (Back)</label>
                        <div class="custom-file">
                          <input type="file" accept=".jpg, .png, .jpeg" class="custom-file-input" name="aadhar_card_back" id="aadhar_card_back">
                          <label class="custom-file-label" for="aadhar_card_back">Choose file</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Pan Card Number</label>
                        <input type="text" name="pan_card_no" id="pan_card_no" class="form-control" placeholder="Enter pan card number" maxlength="12" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Pan Card Picture</label>
                        <div class="custom-file">
                          <input type="file" accept=".jpg, .png, .jpeg" class="custom-file-input" name="pan_card_pic" id="pan_card_pic">
                          <label class="custom-file-label" for="pan_card_pic">Choose file</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Experience in real state (Years)</label>
                        <input type="text" name="experience_year" id="experience_year" class="form-control" placeholder="Experience in real state (Years)" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Experience in real state (Category)</label>
                        <select name="experience_category" id="experience_category" class="form-control select2" data-placeholder="Experience in real state (Category)">
                          <option value="">--Select--</option>
                          <option value="Commercial">Commercial</option>
                          <option value="Recidential">Recidential</option>
                          <option value="Land">Land</option>
                          <option value="All">All of the Above</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Rera Registered ?</label>
                        <select name="is_rera_registered" id="is_rera_registered" class="form-control select2" data-placeholder="Rera Registered">
                          <option value="No">No</option>
                          <option value="Yes">Yes</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6" id="rera_reg_no_group" style="display: none;">
                      <div class="form-group">
                        <label class="form-control-label">Rera Registration Number</label>
                        <input type="text" name="rera_reg_no" id="rera_reg_no" class="form-control" placeholder="Rera Registration Number" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" autocomplete="off" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter confirm password" autocomplete="off" required>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">

  $(function() {

    $(document).on("change", "#is_rera_registered", function() {
      $("#rera_reg_no_group").toggle();
    });

    var employeeForm = $("#add-employee-form").validate({
      errorPlacement: function (error, element) {}
    });


    $("#add-employee-form").submit(function(event) {
      event.preventDefault();

      if (employeeForm.valid())
      {
        let password = $('#password').val();
        let confirmPassword = $('#confirm_password').val();
        let validatedPassword = validateConfirmPassword(password, confirmPassword);
        if (validatedPassword)
        {
          $("#submit-btn").prop("disabled", true);
          var formData = new FormData($(this)[0]);
          $.ajax({
            type: 'POST',
            url: "<?php echo e(route('admin.submitEmployeeData')); ?>",
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
            success: function(data) {
              // console.log(data);
              if (data.status) {
                toastr.success(data.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 500
                });
                setTimeout(function() {
                  $("#warning-msg").addClass('d-none');
                  location.reload();
                }, 500);
              }
              else
              {
                toastr.error(data.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 500
                });
                setTimeout(function() {
                  $("#warning-msg").addClass('d-none');
                }, 500);
              }
            }
            
          }); 
        }
        else
        {
          alert("Both password not matched");
        }
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/programmicsdev/public_html/emp/bhavesh/propertyBird/resources/views/admin/employee/new_employee.blade.php ENDPATH**/ ?>
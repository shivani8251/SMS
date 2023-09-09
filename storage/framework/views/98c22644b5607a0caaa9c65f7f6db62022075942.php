<?php
use App\Models\Country;
$countries = Country::select("id", "country_name")->where("is_active", "Active")->get();
?>



<?php $__env->startSection('mytitle', 'User Registration'); ?>
<?php $__env->startSection('content'); ?>

<!-- BEGIN: Content-->

<!-- =========================== Login/Signup =================================== -->
<section>
  <div class="container">
    
    <div class="row">
      
      <div class="col-lg-2 col-md-12 col-sm-12"></div>
      <div class="col-lg-8 col-md-12 col-sm-12">
        <div class="login_signup">
          <h3 class="login_sec_title">Create An Account</h3>
          <form action="<?php echo e(route('register')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
              <div class="col-12">
                <h6>Personal details</h6>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="text-bold-600" for="full_name"><?php echo e(__('Full Name')); ?> <span class="text-danger">*</span></label>
                  <input id="full_name" type="text" class="form-control <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="full_name" value="<?php echo e(old('full_name')); ?>" placeholder="Enter full name" required autocomplete="Enter full name" autofocus>
                  <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($message); ?></strong>
                    </span>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label  class="text-bold-600" for="phone_no"><?php echo e(__('Phone Number')); ?> <span class="text-danger">*</span></label>
                  <input type="text" name="phone_no" id="phone_no" class="form-control numberOnly <?php $__errorArgs = ['phone_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter phone number" maxlength="10" value="<?php echo e(old('phone_no')); ?>"  required autocomplete="phone_no" autofocus>
                  <?php $__errorArgs = ['phone_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($message); ?></strong>
                    </span>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">WhatsApp Number</label>
                  <input type="text" name="whatsapp_no" maxlength="10" id="whatsapp_no" class="form-control numberOnly" value="<?php echo e(old('whatsapp_no')); ?>" placeholder="Enter whatsapp number">
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group mb-50">
                  <label class="text-bold-600" for="email"><?php echo e(__('Email Address')); ?> <span class="text-danger">*</span></label>
                  <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email address" required autocomplete="email">
                  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($message); ?></strong>
                    </span>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">Country</label>
                  <select name="country" id="country" class="form-control" data-placeholder="Select Country">
                    <option value="">--Select--</option>
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($country->id); ?>"><?php echo e($country->country_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">State</label>
                  <select name="state" id="state" class="form-control select2" data-placeholder="Select State">
                    <option value="">--Select--</option>
                  </select>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">City</label>
                  <select name="city" id="city" class="form-control select2" data-placeholder="Select City">
                    <option value="">--Select--</option>
                  </select>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">Zip Code</label>
                  <input type="text" name="zip_code" id="zip_code" class="form-control numberOnly" placeholder="Enter zip code" value="<?php echo e(old('zip_code')); ?>">
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">Address</label>
                  <input type="text" name="address" id="address" class="form-control" placeholder="Enter address" value="<?php echo e(old('address')); ?>">
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label>Date of Birth </label>
                <fieldset class="form-group position-relative has-icon-left">
                  <input type="text" class="form-control pickadate" id="date_of_birth" name="date_of_birth" placeholder="Date of birth" value="<?php echo e(old('date_of_birth')); ?>">
                  <div class="form-control-position">
                    <i class='bx bx-calendar'></i>
                  </div>
                </fieldset>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">Aadhar Card Number</label>
                  <input type="text" name="aadhar_card_no" id="aadhar_card_no" class="form-control numberOnly" placeholder="Enter aadhar card number" maxlength="12" value="<?php echo e(old('aadhar_card_no')); ?>" />
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">Pan Card Number</label>
                  <input type="text" name="pan_card_no" id="pan_card_no" class="form-control" placeholder="Enter pan card number" maxlength="10" value="<?php echo e(old('pan_card_no')); ?>" />
                </div>
              </div>

              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">Customer Note</label>
                  <textarea type="text" name="customer_note" id="customer_note" class="form-control" placeholder="Enter customer note" rows="2" style="height: auto;"></textarea>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12"></div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group mb-2">
                  <label class="text-bold-600" for="password"><?php echo e(__('Password')); ?> <span class="text-danger">*</span></label>
                  <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Password" name="password" required autocomplete="new-password">
                  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($message); ?></strong>
                    </span>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group mb-2">
                  <label class="text-bold-600" for="password-confirm"><?php echo e(__('Confirm Password')); ?> <span class="text-danger">*</span></label>
                  <input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required autocomplete="new-password">
                </div>
              </div>

              <div class="col-lg-12">
                <hr>
                <h6>Business Details</h6>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">Business Name</label>
                  <input name="business_name" id="business_name" class="form-control" placeholder="Enter business name" value="<?php echo e(old('business_name')); ?>" />
                </div>
              </div> 
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                  <label class="form-control-label">GST Number</label>
                  <input name="gst_no" id="gst_no" class="form-control" placeholder="Enter GST Number" maxlength="15" value="<?php echo e(old('gst_no')); ?>" />
                </div>
              </div>

              <div class="col-lg-4 col-md-12 mt-3"></div>
              <div class="col-lg-4 col-md-12 mt-3">
                <div class="form-group mb-0">
                  <button type="submit" class="btn btn-md btn-theme btn-block glow w-100 position-relative">Sign Up</button>
                </div>
              </div>

              

            </div>
      
          
          </form>
        </div>
      </div>
      
    </div>
  </div>
</section>
<!-- =========================== Login/Signup =================================== -->


<!-- END: Content-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
  $(function() {

    $(".pickadate").pickadate({
      format: "dd-mm-yyyy",
      selectYears: 90,
      selectMonths: true,
      max: true
    });

    /*-------------------Select state of country---------------------------*/

      $(document).on("change", "#country", function() {
        let id = $(this).val();

        $.get("<?php echo e(route('customer.fetchStates')); ?>", {id}, function(data) {
          if (data != "")
          {
            var opt = '<option value="">--Select--</option>';
            $.each(data, function(index, value){
              opt += '<option value="'+value.id+'">'+value.state_name+'</option>';
            });
          }
          else
          {
            var opt = '<option value="">--Select--</option>';
          }
          $("#state").html(opt);
        }, "json");
      });

    /*-------------------Select city of state---------------------------*/

      $(document).on("change", "#state", function() {
        let id = $(this).val();

        $.get("<?php echo e(route('customer.fetchCities')); ?>", {id}, function(data) {
          if (data != "")
          {
            var opt = '<option value="">--Select--</option>';
            $.each(data, function(index, value){
              opt += '<option value="'+value.id+'">'+value.city_name+'</option>';
            });
          }
          else
          {
            var opt = '<option value="">--Select--</option>';
          }
          $("#city").html(opt);
        }, "json");
      });
    
    var loginForm = $("#login-with-otp-form").validate({
      errorPlacement: function (error, element) {}
    });

    $("#send-otp-btn").on("click", function(e) {
      e.preventDefault()
      // var form = $('#login-with-otp-form');
      // var formValue = form.serialize();
      var mobile_no = $("#mobile_no").val();
      if (loginForm.valid())
      {
        $.post("<?php echo e(route('user.auth.sendOTP')); ?>", {mobile_no:mobile_no, "_token": "<?php echo e(csrf_token()); ?>"}, function(data) {
          if (data.status) {
            toastr.success(data.message, '', {
              closeButton: !0,
              tapToDismiss: !1,
              progressBar: true,
              timeOut: 1000
            });

            $("#mobile-group").addClass("d-none");
            $("#otp-group").removeClass("d-none");
            $("#send-otp-btn-group").addClass("d-none");
            $("#verify-otp-btn-group").removeClass("d-none");
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

    $("#verify-otp-btn").on("click", function(e) {
      e.preventDefault()
      var mobile_no = $("#mobile_no").val();
      var otp = $("#user_otp").val();
      if (loginForm.valid())
      {
        $.post("<?php echo e(route('user.auth.verifyOTP')); ?>", {mobile_no:mobile_no, otp:otp, "_token": "<?php echo e(csrf_token()); ?>"}, function(data) {

          if (data.status) {
            toastr.success(data.message, '', {
              closeButton: !0,
              tapToDismiss: !1,
              progressBar: true,
              timeOut: 1000
            });
            location.reload();
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

  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom\resources\views/user/auth/register.blade.php ENDPATH**/ ?>
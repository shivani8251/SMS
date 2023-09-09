<?php $__env->startSection('content'); ?>
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
                        <h4 class="text-center mb-2"><?php echo e(__('Admin Login')); ?></h4>
                      </div>
                    </div>
                    <div class="card-body">
                      <?php if(session()->has('status')): ?>
                        <div class="alert alert-success">
                          <?php echo e(session('status')); ?>

                        </div>
                      <?php endif; ?>
                      <form action="<?php echo e(route('admin.auth')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-50">
                          <label class="text-bold-600" for="email"><?php echo e(__('Email address')); ?></label>
                          <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="Email address" required autocomplete="email" autofocus>
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
                        <div class="form-group">
                          <label class="text-bold-600" for="exampleInputPassword1"><?php echo e(__('Password')); ?></label>
                          <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" placeholder="Password" required autocomplete="current-password">
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
                        <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                          <div class="text-left">
                            <div class="checkbox checkbox-sm">
                              <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                              <label class="checkboxsmall" for="remember">
                                <small><?php echo e(__('Keep me logged in')); ?></small>
                              </label>
                            </div>
                          </div>
                          <!-- <?php if(Route::has('password.request')): ?>
                            <div class="text-right">
                              <a class="card-link" href="<?php echo e(route('password.request')); ?>">
                                <small><?php echo e(__('Forgot Your Password?')); ?></small>
                              </a>
                            </div>
                          <?php endif; ?> -->
                        </div>
                        <button type="submit" class="btn btn-primary glow w-100 position-relative"><?php echo e(__('Login')); ?><i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
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
                  <img class="img-fluid" src="<?php echo e(asset('public/assets/img/logo.png')); ?>" alt="branding logo">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shreeswastik\resources\views/admin/login.blade.php ENDPATH**/ ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
  small{
    font-size: 90% !important;
  }
</style>
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
                <div class="col-12 d-xl-none d-sm-block pt-1 text-center bg-white">
                  <img style="height: 90px; width: auto; margin-bottom: 5px;" src="<?php echo e(asset('assets/img/logo.png')); ?>">
                  <hr>
                </div>
                <!-- left section-login -->
                <div class="col-md-6 col-12 px-0">
                  <div class="card disable-rounded-right custom-padding mb-0 h-100 d-flex justify-content-center">
                    <div class="card-header pb-0">
                      <div class="card-title">
                        <h4 class="text-center mb-2">Associate Login</h4>
                      </div>
                    </div>
                    <div class="card-body">
                      <form action="<?php echo e(route('login')); ?>" method="POST">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-50">
                          <label class="text-bold-600" for="email"><?php echo e(__('Username or Email')); ?></label>
                          <input id="email" type="text" class="form-control <?php echo e($errors->has('username') || $errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('username') ?: old('email')); ?>" placeholder="Email address or username" required autocomplete="email" autofocus>
                          <?php if($errors->has('username') || $errors->has('email')): ?>
                            <span class="invalid-feedback" role="alert">
                              <strong><?php echo e($errors->first('username') ?: $errors->first('email')); ?></strong>
                            </span>
                          <?php endif; ?>
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
                                <span><?php echo e(__('Keep me logged in')); ?></span>
                              </label>
                            </div>
                          </div>
                          <?php if(Route::has('password.request')): ?>
                            <div class="text-right">
                              <a class="card-link" href="<?php echo e(route('password.request')); ?>">
                                <span><?php echo e(__('Forgot Your Password?')); ?></span>
                              </a>
                            </div>
                          <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary glow w-100 position-relative"><?php echo e(__('Login')); ?><i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                      </form>
                      <hr>
                      <div class="text-center">
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary glow w-100 position-relative">Don't have an account ?<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></a>
                        
                      </div>

                      <div class="text-center mt-2">
                        <label for="terms">
                        <span>By sumitting in you are aggreed to <a class="card-link" target="_BLANK" href="<?php echo e(asset('assets/others/t_and_c.pdf')); ?>">Terms and Conditions</a>.</span>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <!-- right section image -->
                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                  <img class="img-fluid" src="<?php echo e(asset('assets/img/logo.png')); ?>" alt="branding logo">
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\probird\resources\views/auth/login.blade.php ENDPATH**/ ?>
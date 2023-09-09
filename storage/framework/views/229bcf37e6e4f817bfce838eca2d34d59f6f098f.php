<?php $__env->startSection('content'); ?>
<?php $__env->startSection('mytitle', 'Dashboard'); ?>

 <!-- BEGIN: Content-->
    <div class="app-content content mt-2">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
          <section id="widgets-Statistics">
            <div class="row">
              <div class="col-12">
                <h4>Statistics</h4>
                <hr>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="card text-center">
                  <div class="card-body">
                    <div class="badge-circle badge-circle-lg badge-circle-light-info mx-auto my-1">
                      <i class="bx bx-paper-plane font-medium-5"></i>
                    </div>
                    <p class="text-muted mb-0 line-ellipsis">Total Requests</p>
                    <h2 class="mb-0">0</h2>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="card text-center">
                  <div class="card-body">
                    <div class="badge-circle badge-circle-lg badge-circle-light-warning mx-auto my-1">
                      <i class="bx bxs-buildings font-medium-5"></i>
                    </div>
                    <p class="text-muted mb-0 line-ellipsis">Total Properties</p>
                    <h2 class="mb-0">0</h2>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="card text-center">
                  <div class="card-body">
                    <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto my-1">
                      <i class="bx bx-user font-medium-5"></i>
                    </div>
                    <p class="text-muted mb-0 line-ellipsis">Total Users</p>
                    <h2 class="mb-0">0</h2>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="card text-center">
                  <div class="card-body">
                    <div class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                      <i class="bx bxs-user-badge font-medium-5"></i>
                    </div>
                    <p class="text-muted mb-0 line-ellipsis">Total Owners</p>
                    <h2 class="mb-0">0</h2>
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

<?php echo $__env->make('app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pbird\resources\views/home.blade.php ENDPATH**/ ?>
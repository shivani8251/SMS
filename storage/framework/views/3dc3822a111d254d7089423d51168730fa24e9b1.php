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
            <li class="nav-item d-none d-lg-block">
              <a class="nav-link" href="<?php echo e(route('home')); ?>">
                <h4><?php echo $__env->yieldContent('mytitle'); ?></h4>
              </a>
            </li>
          </ul>

          <ul class="nav navbar-nav bookmark-icons">
            <li class="nav-item d-xl-none d-sm-block mt-1">
              <img style="height: 35px; width: auto; margin-bottom: 5px;" src="<?php echo e(asset('public/assets/img/favicon.png')); ?>"><span class="h4"> India Post</span>
            </li>
          </ul>
          
        </div>
        <ul class="nav navbar-nav float-right">
         
          <li class="nav-item d-none d-lg-block">
            <a class="nav-link nav-link-expand">
              <i class="ficon bx bx-fullscreen"></i>
            </a>
          </li>
          
          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="javascript:void(0);" data-toggle="dropdown">
              <div class="user-nav d-sm-flex d-none">
                <span class="user-name"><?php echo e(Auth::user()->name); ?></span>
                <span class="user-status text-muted">Available</span>
              </div>
              <span>
                <img class="round" src="<?php echo e(asset('public/assets/img/user.png')); ?>" alt="avatar" height="40" width="40"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right pb-0">
                <!-- <div class="dropdown-divider mb-0"></div> -->
                <a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="bx bx-power-off mr-50"></i> <?php echo e(__('Logout')); ?>

                </a>

                <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
              </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav><?php /**PATH C:\xampp\htdocs\indiapost\resources\views/admin/layouts/header.blade.php ENDPATH**/ ?>
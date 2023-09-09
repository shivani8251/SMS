<?php
  use App\Models\Admin;
  if(isset(Auth::user()->business_logo))
  {
    $business_logo = asset('public/storage/users/business_logos/'.Auth::user()->business_logo);
  }
  else
  {
    if(isset(Auth::user()->parent_id))
    {
      $logo = Admin::where('id', Auth::user()->parent_id)->value('business_logo');
      if(isset($logo))
      {
        $business_logo = asset('public/storage/users/business_logos/'.$logo);
      }
      else
      {
        $business_logo = asset('public/assets/img/favicon.png');
      }
    }
    else
    {
      $business_logo = asset('public/assets/img/favicon.png');
    }
  }

  if(isset(Auth::user()->company))
  {
    $business_name = Auth::user()->company;
  }
  else
  {
    if(isset(Auth::user()->parent_id))
    {
      $businessName = Admin::where('id', Auth::user()->parent_id)->value('company');
      if(isset($businessName))
      {
        $business_name = $businessName;
      }
      else
      {
        $business_name = '';
      }
    }
    else
    {
      $business_name = '';
    }
  }
?>
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto">
        <a class="navbar-brand" href="">
          <div class="brand-logo">
            <img style="height: 25px; width: auto; margin-top: -10px; margin-bottom: 0px;" src="<?php echo e($business_logo); ?>">
          </div>
          <h5 class="brand-text mb-0 pl-0 text-white" style="font-size: 13px !important;"> <?php echo e(isset($business_name) ? $business_name : ''); ?></h5>
        </a>
      </li>
      <li class="nav-item nav-toggle">
        <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
          <i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i>
          <i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block text-white" data-ticon="bx-disc"></i>
        </a>
      </li>
    </ul>
  </div>
  <hr class="mt-0" />
  <div class="shadow-bottom"></div>
  <div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">

      <li class="nav-item" id="home-menu">
        <a href="<?php echo e(route('user.home')); ?>">
          <img height="25" width="auto" src="<?php echo e(asset('public/assets/img/sidebar/dashboard.png')); ?>" />
          <span class="menu-title text-truncate" data-i18n="Dashboard">&nbsp;&nbsp;Dashboard</span>
        </a>
      </li>

      <li class="nav-item" id="send-whatsapp-menu">
        <a href="<?php echo e(route('user.whatsapp.index')); ?>">
          <img height="25" width="auto" src="<?php echo e(asset('public/assets/img/sidebar/send_whatsapp.png')); ?>" />
          <span class="menu-title text-truncate" data-i18n="Send Whatsapp">&nbsp;&nbsp;Send Whatsapp</span>
        </a>
      </li>

      <li class="nav-item" id="credits-menu">
        <a href="<?php echo e(route('user.credits.index')); ?>">
          <img height="25" width="auto" src="<?php echo e(asset('public/assets/img/sidebar/credit_report.png')); ?>" />
          <span class="menu-title text-truncate" data-i18n="Credits">&nbsp;&nbsp;Credits</span>
        </a>
      </li>

      <?php if(Auth::user()->user_type=='reseller'): ?>

        <li class="navigation-header text-truncate mt-1 mb-0">
          <span data-i18n="Reseller & User">Resellers & Users</span>
        </li>

        <li class="nav-item" id="manage-reseller-menu">
          <a href="<?php echo e(route('user.reseller.index')); ?>">
            <img height="25" width="auto" src="<?php echo e(asset('public/assets/img/sidebar/reseller.png')); ?>" />
            <span class="menu-title text-truncate" data-i18n="Mange Reseller">&nbsp;&nbsp;Manage Reseller</span>
          </a>
        </li>

        <li class="nav-item" id="user-menu">
          <a href="<?php echo e(route('user.user.index')); ?>">
            <img height="25" width="auto" src="<?php echo e(asset('public/assets/img/sidebar/user.png')); ?>" />
            <span class="menu-title text-truncate" data-i18n="Manage Users">&nbsp;&nbsp;Manage Users</span>
          </a>
        </li>

      <?php endif; ?>

      <?php if(Auth::user()->user_type=='reseller'): ?>
        <li class="navigation-header text-truncate mt-1 mb-0">
          <span data-i18n="Reports">Reports</span>
        </li>

        <li class="nav-item">
          <a href="javascript:void(0);">
            <img height="25" width="auto" src="<?php echo e(asset('public/assets/img/sidebar/credit_report.png')); ?>" />
            <span class="menu-title text-truncate" data-i18n="Credit Report">&nbsp;&nbsp;Credit Reports</span>
          </a>
          <ul class="menu-content">

            <li id="reseller-report-menu">
              <a class="d-flex align-items-center" href="<?php echo e(route('user.reseller.report.index')); ?>">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item text-truncate" data-i18n="Reseller Report">Reseller Report</span>
              </a>
            </li>

            <li id="user-report-menu">
              <a class="d-flex align-items-center" href="<?php echo e(route('user.user.report.index')); ?>">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item text-truncate" data-i18n="User Report">User Report</span>
              </a>
            </li>

          </ul>
        </li>

      <?php endif; ?>

      <li class="nav-item">
        <a href="javascript:void(0);">
          <img height="25" width="auto" src="<?php echo e(asset('public/assets/img/sidebar/whatsapp_report.png')); ?>" />
          <span class="menu-title text-truncate" data-i18n="Admin Tools">&nbsp;&nbsp;WhatsApp Report</span>
        </a>
        <ul class="menu-content">

          <li id="whatsapp-report-menu">
            <a class="d-flex align-items-center" href="<?php echo e(route('user.whatsapp.report.index')); ?>">
              <i class="bx bx-right-arrow-alt"></i>
              <span class="menu-item text-truncate" data-i18n="Campaign Wise">Campaign Wise</span>
            </a>
          </li>

        </ul>
      </li>

      <li class="navigation-header text-truncate mt-1 mb-0">
        <span data-i18n="Others">Others</span>
      </li>

      <li class="nav-item" id="news-menu">
        <a href="<?php echo e(route('user.news.index')); ?>">
          <img height="25" width="auto" src="<?php echo e(asset('public/assets/img/sidebar/news.png')); ?>" />
          <span class="menu-title text-truncate" data-i18n="News">&nbsp;&nbsp;News</span>
        </a>
      </li>

      <?php if(Auth::user()->user_type=='reseller'): ?>
        <li class="nav-item" id="tree-view-menu">
          <a href="<?php echo e(route('user.treeview.index')); ?>">
            <img height="25" width="auto" src="<?php echo e(asset('public/assets/img/sidebar/tree_view.png')); ?>" />
            <span class="menu-title text-truncate" data-i18n="Tree View">&nbsp;&nbsp;Tree View</span>
          </a>
        </li>
      <?php endif; ?>

      <li class="nav-item" id="complaints-menu">
        <a href="<?php echo e(route('user.complaints.index')); ?>">
          <img height="25" width="auto" src="<?php echo e(asset('public/assets/img/sidebar/alert.png')); ?>" />
          <span class="menu-title text-truncate" data-i18n="Complaints">&nbsp;&nbsp;Complaints</span>
        </a>
      </li>

      <?php if(Auth::user()->user_type=='reseller'): ?>
        <li class="nav-item" id="business-menu">
          <a href="<?php echo e(route('user.business.edit')); ?>">
            <img height="25" width="auto" src="<?php echo e(asset('public/assets/img/sidebar/business.png')); ?>" />
            <span class="menu-title text-truncate" data-i18n="Manage Business">&nbsp;&nbsp;Manage Business</span>
          </a>
        </li>
      <?php endif; ?>
        
    </ul>
  </div>
</div>

<?php $__env->startSection('sidebarscript'); ?>

<script>
        
  $(function(){
    var url = $(location).attr('href').split("/").splice(0, 10).join("/");
    var segments = url.split( '/' );

    $(segments).each(function(index, el) {

      if(el == 'home'){
        $('#home-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'news'){
        $('#news-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'resellers' || el == 'add-reseller' || el == 'view-reseller' || el == 'add-reseller-credit' || el == 'remove-reseller-credit'){
        $('#manage-reseller-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'users' || el == 'add-user' || el == 'view-user' || el == 'add-user-credit' || el == 'remove-user-credit'){
        $('#user-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'send-whatsapp'){
        $('#send-whatsapp-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'business-details'){
        $('#business-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'reseller-report'){
        $('#reseller-report-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'user-report'){
        $('#user-report-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'whatsapp-report' || el == 'view-campaign'){
        $('#whatsapp-report-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'tree-view'){
        $('#tree-view-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'credits'){
        $('#credits-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'complaint-form'){
        $('#complaints-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

    });
  });

</script>

<?php $__env->stopSection(); ?>
<?php /**PATH /www/wwwroot/digitaltext.live/resources/views/user/layouts/sidebar.blade.php ENDPATH**/ ?>
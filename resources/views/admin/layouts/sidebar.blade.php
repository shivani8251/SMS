<style type="text/css">
  .main-menu .navbar-header {
    width: 260px;
    height: 4.4335rem;
    position: relative;
    padding: 0.35rem 1.45rem 0.3rem 1.3rem;
    -webkit-transition: 0.3s ease all, background 0s;
    transition: 0.3s ease all, background 0s;
    cursor: pointer;
    z-index: 3;
    background-color: #25D366;
    color: #fff;
  }
</style>

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto">
        <a class="navbar-brand" href="">
          <div class="brand-logo">
            <img style="height: 25px; width: auto; margin-top: -10px; margin-bottom: 0px;" src="{{ isset(Auth::user()->business_logo) ? asset('public/storage/users/business_logos/'.Auth::user()->business_logo) : asset('public/assets/img/favicon.png') }}">
          </div>
          <h5 class="brand-text mb-0 pl-0 text-white" style="font-size: 13px !important;"> {{isset(Auth::user()->company) ? Auth::user()->company : ''}}</h5>
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

      {{-- <li class="navigation-header text-truncate">
        <span data-i18n="Basic">Basic</span>
      </li> --}}

      <li class="nav-item" id="home-menu">
        <a href="{{route('home')}}">
          <img height="25" width="auto" src="{{ asset('public/assets/img/sidebar/dashboard.png') }}" />
          <span class="menu-title text-truncate" data-i18n="Dashboard">&nbsp;&nbsp;Dashboard</span>
        </a>
      </li>

      <li class="nav-item" id="send-whatsapp-menu">
        <a href="{{ route('admin.whatsapp.index') }}">
          <img height="25" width="auto" src="{{ asset('public/assets/img/sidebar/send_whatsapp.png') }}" />
          <span class="menu-title text-truncate" data-i18n="Send Whatsapp">&nbsp;&nbsp;Send Whatsapp</span>
        </a>
      </li>

      {{-- <li class="nav-item" id="credits-menu">
        <a href="{{ route('admin.credits.index') }}">
          <i class="bx bxs-chart" data-icon="desktop"></i>
          <span class="menu-title text-truncate" data-i18n="Credits">Credits</span>
        </a>
      </li> --}}

      <li class="navigation-header text-truncate mt-1 mb-0">
        <span data-i18n="Reseller & User">Resellers & Users</span>
      </li>

      <li class="nav-item" id="manage-reseller-menu">
        <a href="{{ route('admin.reseller.index') }}">
          <img height="25" width="auto" src="{{ asset('public/assets/img/sidebar/reseller.png') }}" />
          <span class="menu-title text-truncate" data-i18n="Mange Reseller">&nbsp;&nbsp;Manage Reseller</span>
        </a>
      </li>

      <li class="nav-item" id="user-menu">
        <a href="{{ route('admin.user.index') }}">
          <img height="25" width="auto" src="{{ asset('public/assets/img/sidebar/user.png') }}" />
          <span class="menu-title text-truncate" data-i18n="Manage Users">&nbsp;&nbsp;Manage Users</span>
        </a>
      </li>

      <li class="navigation-header text-truncate mt-1 mb-0">
        <span data-i18n="Reports">Reports</span>
      </li>

      <li class="nav-item">
        <a href="javascript:void(0);">
          <img height="25" width="auto" src="{{ asset('public/assets/img/sidebar/credit_report.png') }}" />
          <span class="menu-title text-truncate" data-i18n="Credit Report">&nbsp;&nbsp;Credit Reports</span>
        </a>
        <ul class="menu-content">

          <li id="reseller-report-menu">
            <a class="d-flex align-items-center" href="{{ route('admin.reseller.report.index') }}">
              <i class="bx bx-right-arrow-alt"></i>
              <span class="menu-item text-truncate" data-i18n="Reseller Report">Reseller Report</span>
            </a>
          </li>

          <li id="user-report-menu">
            <a class="d-flex align-items-center" href="{{ route('admin.user.report.index') }}">
              <i class="bx bx-right-arrow-alt"></i>
              <span class="menu-item text-truncate" data-i18n="User Report">User Report</span>
            </a>
          </li>

        </ul>
      </li>

      <li class="nav-item">
        <a href="javascript:void(0);">
          <img height="25" width="auto" src="{{ asset('public/assets/img/sidebar/whatsapp_report.png') }}" />
          <span class="menu-title text-truncate" data-i18n="Admin Tools">&nbsp;&nbsp;WhatsApp Report</span>
        </a>
        <ul class="menu-content">

          <li id="campaign-wise-menu">
            <a class="d-flex align-items-center" href="{{ route('admin.whatsapp.report.index') }}">
              <i class="bx bx-right-arrow-alt"></i>
              <span class="menu-item text-truncate" data-i18n="Campaign Wise">Campaign Wise</span>
            </a>
          </li>

          <li id="update-status-menu">
            <a class="d-flex align-items-center" href="{{ route('admin.status.campaign.update') }}">
              <i class="bx bx-right-arrow-alt"></i>
              <span class="menu-item text-truncate" data-i18n="Update Status">Update Status</span>
            </a>
          </li>

          <li id="search-mobileno-menu">
            <a class="d-flex align-items-center" href="{{ route('admin.mobile.number.search') }}">
              <i class="bx bx-right-arrow-alt"></i>
              <span class="menu-item text-truncate" data-i18n="Search Mobile Number">Search Mobile Number</span>
            </a>
          </li>

        </ul>
      </li>

      <li class="nav-item" id="complaints-menu">
        <a href="{{ route('admin.complaints.index') }}">
          <img height="25" width="auto" src="{{ asset('public/assets/img/sidebar/alert.png') }}" />
          <span class="menu-title text-truncate" data-i18n="Complaints">&nbsp;&nbsp;Complaints</span>
        </a>
      </li>

      <li class="navigation-header text-truncate mt-1 mb-0">
        <span data-i18n="Others">Others</span>
      </li>

      <li class="nav-item">
        <a href="javascript:void(0);">
          <img height="25" width="auto" src="{{ asset('public/assets/img/sidebar/setting.png') }}" />
          <span class="menu-title text-truncate" data-i18n="Admin Tools">&nbsp;&nbsp;Admin Tools</span>
        </a>
        <ul class="menu-content">

          <li id="news-menu">
            <a class="d-flex align-items-center" href="{{ route('admin.news.index') }}">
              <i class="bx bx-right-arrow-alt"></i>
              <span class="menu-item text-truncate" data-i18n="News">News</span>
            </a>
          </li>

          <li id="alert-menu">
            <a class="d-flex align-items-center" href="{{ route('admin.alert.index') }}">
              <i class="bx bx-right-arrow-alt"></i>
              <span class="menu-item text-truncate" data-i18n="Alerts">Alerts</span>
            </a>
          </li>

          <li id="tree-view-menu">
            <a class="d-flex align-items-center" href="{{ route('admin.treeview.index') }}">
              <i class="bx bx-right-arrow-alt"></i>
              <span class="menu-item text-truncate" data-i18n="Tree View">Tree View</span>
            </a>
          </li>

          <li id="setting-menu">
            <a class="d-flex align-items-center" href="{{ route('admin.setting.index') }}">
              <i class="bx bx-right-arrow-alt"></i>
              <span class="menu-item text-truncate" data-i18n="Website Setting">Website Setting</span>
            </a>
          </li>

        </ul>
      </li>

      <li class="nav-item" id="business-menu">
        <a href="{{ route('admin.business.edit') }}">
          <img height="25" width="auto" src="{{ asset('public/assets/img/sidebar/business.png') }}" />
          <span class="menu-title text-truncate" data-i18n="Manage Business">&nbsp;&nbsp;Manage Business</span>
        </a>
      </li>

      <li class="nav-item" id="backup-menu">
        <a href="{{ route('admin.backup.index') }}">
          <img height="25" width="auto" src="{{ asset('public/assets/img/sidebar/backup.png') }}" />
          <span class="menu-title text-truncate" data-i18n="Backup">&nbsp;&nbsp;Backup</span>
        </a>
      </li>
        
    </ul>
  </div>
</div>

@section('sidebarscript')

<script>
        
  $(function(){
    var url = $(location).attr('href').split("/").splice(0, 10).join("/");
    var segments = url.split( '/' );

    $(segments).each(function(index, el) {

      if(el == 'home'){
        $('#home-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'complaints'){
        $('#complaints-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
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

      if(el == 'news'){
        $('#news-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'credits'){
        $('#credits-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'alerts'){
        $('#alert-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'settings'){
        $('#setting-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'tree-view'){
        $('#tree-view-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
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

      if(el == 'reseller'){
        $('#add-reseller-credit-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'user-report'){
        $('#user-report-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'user'){
        $('#add-user-credit-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'whatsapp-report'){
        $('#campaign-wise-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'campaign-status-update'){
        $('#update-status-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'search-mobile-numbers'){
        $('#search-mobileno-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

      if(el == 'backup-campaigns'){
        $('#backup-menu').addClass('active').parent().siblings().children('.nav-item').removeClass('active');
        return false;
      }

    });
  });

</script>

@endsection

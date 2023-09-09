@php
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
@endphp
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto">
        <a class="navbar-brand" href="">
          <div class="brand-logo">
            <img style="height: 25px; width: auto; margin-top: -10px; margin-bottom: 0px;" src="{{$business_logo}}">
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

      <li class="nav-item" id="home-menu">
        <a href="{{route('user.home')}}">
          <i class="bx bx-home" data-icon="desktop"></i>
          <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
        </a>
      </li>

      <li class="nav-item" id="send-whatsapp-menu">
        <a href="{{ route('user.whatsapp.index') }}">
          <i class="bx bxl-whatsapp" data-icon="desktop"></i>
          <span class="menu-title text-truncate" data-i18n="Send Whatsapp">Send Whatsapp</span>
        </a>
      </li>

      <li class="nav-item" id="credits-menu">
        <a href="{{ route('user.credits.index') }}">
          <i class="bx bxs-chart" data-icon="desktop"></i>
          <span class="menu-title text-truncate" data-i18n="Credits">Credits</span>
        </a>
      </li>

      @if(Auth::user()->user_type=='reseller')

        <li class="navigation-header text-truncate mt-1 mb-0">
          <span data-i18n="Reseller & User">Resellers & Users</span>
        </li>

        <li class="nav-item" id="manage-reseller-menu">
          <a href="{{ route('user.reseller.index') }}">
            <i class="bx bxs-group" data-icon="desktop"></i>
            <span class="menu-title text-truncate" data-i18n="Mange Reseller">Mange Reseller</span>
          </a>
        </li>

        <li class="nav-item" id="user-menu">
          <a href="{{ route('user.user.index') }}">
            <i class="bx bx-group" data-icon="desktop"></i>
            <span class="menu-title text-truncate" data-i18n="Manage Users">Manage Users</span>
          </a>
        </li>

      @endif

      @if(Auth::user()->user_type=='reseller')
        <li class="navigation-header text-truncate mt-1 mb-0">
          <span data-i18n="Reports">Reports</span>
        </li>

        <li class="nav-item" id="news-menu">
          <a href="{{ route('user.news.index') }}">
            <i class="bx bx-bell" data-icon="desktop"></i>
            <span class="menu-title text-truncate" data-i18n="News">News</span>
          </a>
        </li>

        <li class="nav-item">
          <a href="javascript:void(0);">
            <i class="bx bxs-report" data-icon="desktop"></i>
            <span class="menu-title text-truncate" data-i18n="Credit Report">Credit Reports</span>
          </a>
          <ul class="menu-content">

            <li id="reseller-report-menu">
              <a class="d-flex align-items-center" href="{{ route('user.reseller.report.index') }}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item text-truncate" data-i18n="Reseller Report">Reseller Report</span>
              </a>
            </li>

            <li id="user-report-menu">
              <a class="d-flex align-items-center" href="{{ route('user.user.report.index') }}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item text-truncate" data-i18n="User Report">User Report</span>
              </a>
            </li>

          </ul>
        </li>

      @endif

      <li class="nav-item">
        <a href="javascript:void(0);">
          <i class="bx bxs-report" data-icon="desktop"></i>
          <span class="menu-title text-truncate" data-i18n="Admin Tools">WhatsApp Report</span>
        </a>
        <ul class="menu-content">

          <li id="whatsapp-report-menu">
            <a class="d-flex align-items-center" href="{{ route('user.whatsapp.report.index') }}">
              <i class="bx bx-right-arrow-alt"></i>
              <span class="menu-item text-truncate" data-i18n="Campaign Wise">Campaign Wise</span>
            </a>
          </li>

        </ul>
      </li>

      @if(Auth::user()->user_type=='reseller')
        <li class="nav-item" id="tree-view-menu">
          <a href="{{ route('user.treeview.index') }}">
            <i class="bx bx-spreadsheet" data-icon="desktop"></i>
            <span class="menu-title text-truncate" data-i18n="Tree View">Tree View</span>
          </a>
        </li>
      @endif

      <li class="navigation-header text-truncate mt-1 mb-0">
        <span data-i18n="Others">Others</span>
      </li>

      <li class="nav-item" id="complaints-menu">
        <a href="{{ route('user.complaints.index') }}">
          <i class="bx bx-file" data-icon="desktop"></i>
          <span class="menu-title text-truncate" data-i18n="Complaints">Complaints</span>
        </a>
      </li>

      @if(Auth::user()->user_type=='reseller')
        <li class="nav-item" id="business-menu">
          <a href="{{ route('user.business.edit') }}">
            <i class="bx bx-briefcase-alt-2" data-icon="desktop"></i>
            <span class="menu-title text-truncate" data-i18n="Manage Business">Manage Business</span>
          </a>
        </li>
      @endif
        
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

@endsection

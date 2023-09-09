<?php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';

  $resellerTreeView = (Auth::user()->user_type=="admin") ? 'admin.reseller.treeview.fetch' : 'user.reseller.treeview.fetch';
  $treeviewFetchChild = (Auth::user()->user_type=="admin") ? 'admin.treeview.fetchchild' : 'user.treeview.fetchchild';
  $transDatatableUrl = (Auth::user()->user_type=="admin") ? 'admin.reseller.credits.dataTable' : 'user.reseller.credits.dataTable';
  $campaignDatatableUrl = (Auth::user()->user_type=="admin") ? 'admin.reseller.campaigns.dataTable' : 'user.reseller.campaigns.dataTable';
?>



<?php $__env->startSection('mytitle', 'Resellers'); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('public/assets/css/pages/page-user-profile.min.css')); ?>">
<!-- BEGIN: Content-->
<style type="text/css">
  .select2-container {
    width: 100% !important;
  }
</style>

<style type="text/css">
  /*.list-group-item {
    display: inline-flex !important;
    padding: 15px;
    font-size: 17px;
  }*/

  .dt-buttons{
    float: left !important;
    padding-bottom: 10px;
  }

  /*.list-group .list-group-item i {
    font-size: 1.5rem !important;
  }*/

  table th {
    font-size: 12px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 13px !important;
    padding: 10px !important;
  }
</style>

<style>
  #widgets-Statistics .row .col-xl-2 .card:hover{
    box-shadow: -8px 12px 18px 0 rgba(25,42,70,.13);
  }
  #widgets-Statistics .row .col-xl-2 .card{
    cursor: pointer;
    box-shadow: 0px 0px 0px 0 rgba(25,42,70,.13);
    /*clip-path: polygon(0% 0%, 75% 0%, 100% 50%, 75% 100%, 0% 100%);*/
    clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 25% 50%, 0% 0%);
  }
  .active-label{
    box-shadow: -8px 12px 18px 0 rgb(25 42 70 / 38%) !important;
    background-color: #32557f;
    color: white !important;
  }
  .active-label p{
    color: #ffffffe0 !important;
  }
  .active-label h2{
    color: #ffffff !important;
  }

  .deal-add-label{
    cursor: pointer;
    background-color: #80808063;  
    clip-path: polygon(75% 0%, 93% 48%, 78% 100%, 0% 100%, 10% 49%, 0% 0%); 
    height:35px;
  }
  .deal-add-label-active{
    cursor: pointer;
    background-color: #32557f;
    clip-path: polygon(75% 0%, 93% 48%, 78% 100%, 0% 100%, 10% 49%, 0% 0%); 
    height:35px;
  }
  .deal-add-label p, .deal-add-label-active p{
    position: relative;
    top: 6px;
    color: white;
    text-align: center;
    font-size: 13px;
  }

  .page-user-profile .user-profile-text {
     bottom: 90px !important; 
  }

  li.fetch-child-opt{
    cursor: pointer;
  }

  @media (max-width: 767px) {
    .page-user-profile .user-profile-text {
        left: 30%;
    }

    .team-tabs{
      padding-top: 120px !important;
    }

}
</style>
<div class="app-content content mt-2">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <section class="page-user-profile">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <input type="hidden" id="user-id" value="<?php echo e(isset($user->id) ? $user->id : ''); ?>" />
              <div class="user-profile-images">
                <div style="min-height: 100px;max-height: 100px;">&nbsp;</div>
                <img src="<?php echo e(isset($user->profilepic) ? asset('public/storage/users/'.$user->profilepic) : url('public/assets/img/user.png')); ?>" class="user-profile-image rounded"
                  alt="user profile image" height="140" width="140">
              </div>
              <div class="user-profile-text mt-0">
                <h4 class="mb-0 text-bold-500 profile-text-color" style="color: black;font-family: 'Lato';letter-spacing: 0.5px; padding-bottom: 10px;"><?php echo e(isset($user->username) ? $user->username : ''); ?></h4>
                <small style="color: #000000b8;font-size: 14px;font-family: 'Lato';letter-spacing: 0.5px;">Total Credit</small>
                <br>
                <h5 class="mb-0 text-bold-500 profile-text-color" style="color: green;font-family: 'Lato';letter-spacing: 0.5px;"> <?php echo e(isset($user->credit) ? $user->credit : 0); ?></h5>
              </div>

              <div class="card-body px-0 team-tabs">
                <ul class="nav user-profile-nav justify-content-center justify-content-md-start nav-pills border-bottom-0 mb-0" role="tablist">

                  <li class="nav-item">
                    <a class="nav-link d-flex px-1 active" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="true"><i class="bx bxs-user-circle" style="margin-right: 5px!important;"></i><span class="d-none d-md-block">Profile</span></a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link d-flex px-1" id="treeview-tab" data-toggle="tab" href="#treeview" aria-controls="treeview" role="tab" aria-selected="false"><i class="ficon bx bx-chart" style="margin-right: 5px!important;"></i><span class="d-none d-md-block">Tree View</span></a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link d-flex px-1" id="transactions-tab" data-toggle="tab" href="#transactions" aria-controls="transactions" role="tab" aria-selected="false"><i class="ficon bx bx-chart" style="margin-right: 5px!important;"></i><span class="d-none d-md-block">Transactions</span></a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link d-flex px-1" id="campaigns-tab" data-toggle="tab" href="#campaigns" aria-controls="campaigns" role="tab" aria-selected="false"><i class="ficon bx bx-money" style="margin-right: 5px!important;"></i><span class="d-none d-md-block">My Campaigns</span></a>
                  </li>

                </ul>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <div class="tab-content">

                  <div class="tab-pane active" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12">
                            <h5 class="card-title">Basic details</h5>
                            <div class="row">
                              <?php if(isset($user->user_unique_id)): ?>
                                <div class="col-sm-6 col-12">
                                  <h6><small class="text-muted">Unique Id</small></h6>
                                  <p><?php echo e($user->user_unique_id); ?></p>
                                </div>
                              <?php endif; ?>
                              <?php if(isset($user->full_name)): ?>
                                <div class="col-sm-6 col-12">
                                  <h6><small class="text-muted">Full Name</small></h6>
                                  <p><?php echo e($user->full_name); ?></p>
                                </div>
                              <?php endif; ?>
                              <?php if(isset($user->username)): ?>
                                <div class="col-sm-6 col-12">
                                  <h6><small class="text-muted">User Name</small></h6>
                                  <p><?php echo e($user->username); ?></p>
                                </div>
                              <?php endif; ?>
                              <?php if(isset($user->email_id)): ?>
                                <div class="col-sm-6 col-12">
                                  <h6><small class="text-muted">Email ID</small></h6>
                                  <p><?php echo e($user->email_id); ?></p>
                                </div>
                              <?php endif; ?>
                              <?php if(isset($user->mobile)): ?>
                                <div class="col-sm-6 col-12">
                                  <h6><small class="text-muted">Mobile No.</small></h6>
                                  <p><?php echo e($user->mobile); ?></p>
                                </div>
                              <?php endif; ?>
                              <?php if(isset($user->company)): ?>
                                <div class="col-sm-6 col-12">
                                  <h6><small class="text-muted">Company</small></h6>
                                  <p><?php echo e($user->company); ?></p>
                                </div>
                              <?php endif; ?>
                              <?php if(isset($user->status)): ?>
                              <div class="col-sm-6 col-12">
                                <h6><small class="text-muted">Account Status</small></h6>
                                <p class="text-bold-600" style="<?php echo e($user->status=='Active' ? 'color: green' : 'color: red'); ?>"><?php echo e($user->status); ?></p>
                              </div>
                              <?php endif; ?>
                              <?php if(isset($user->created_by)): ?>
                                <div class="col-sm-6 col-12">
                                  <h6><small class="text-muted">Created By</small></h6>
                                  <p><?php echo e($user->created_by); ?></p>
                                </div>
                              <?php endif; ?>
                              <?php if(isset($user->created_at)): ?>
                                <div class="col-sm-6 col-12">
                                  <h6><small class="text-muted">Created At</small></h6>
                                  <p><?php echo e(date('d-M-Y h:i A', strtotime($user->created_at))); ?></p>
                                </div>
                              <?php endif; ?>
                              <?php if(isset($user->user_type)): ?>
                                <div class="col-sm-6 col-12">
                                  <h6><small class="text-muted">Role</small></h6>
                                  <p><?php echo e(ucfirst($user->user_type)); ?></p>
                                </div>
                              <?php endif; ?>
                            </div>
                          </div>                     
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="treeview" aria-labelledby="treeview-tab" role="tabpanel">
                    <div class="card">
                      <div class="card-header">
                        <h6 class="card-title mb-2">Tree View</h6>
                      </div>
                      <div class="card-body">
                        <div id="custom-treeview"></div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="transactions" aria-labelledby="transactions-tab" role="tabpanel">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12">
                            <h5 class="card-title">Transactions</h5>
                          </div>
                          <div class="col-12">
                            <div class="table-responsive">
                              <table class="table table-striped table-bordered w-100" id="transactions-table">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>User/Campaign</th>
                                    <th>Type</th>
                                    <th>No. of SMS</th>
                                    <th>Description</th>
                                    <th>Txn Type</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                  </tr>
                                </thead>                                   
                              </table>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="campaigns" aria-labelledby="campaigns-tab" role="tabpanel">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12">
                            <h5 class="card-title">My Campaigns</h5>
                          </div>
                          <div class="col-12">
                            <div class="table-responsive">
                              <table class="table table-striped table-bordered w-100" id="campaigns-table">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Unique Id</th>
                                    <th>Campaign Name</th>
                                    <th>Message</th>
                                    <th>Total Mob. No.</th>
                                    <th>Created At</th>
                                    <th>Status</th>
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

<script>

  $(function() {
    var id = $("#user-id").val();
    $.ajax({ 
      url: "<?php echo e(route($resellerTreeView)); ?>",
      method: "get",
      dataType: "json",
      data: {
        id: id
      },   
      success: function(data)  
      {
        if(data.status)
        {
          $("#custom-treeview").html(data.result);
        }
        else
        {
          var rowdata = '<ul class="list-group">'+
            '<li class="list-group-item node-tags-badge-treeview text-center" data-nodeid="0" style="color:undefined;background-color:undefined;">'+
              'No Tree View Found !'+
            '</li>'+
          '</ul>';
          $("#custom-treeview").html(rowdata);
        }
      }   
    });

    $(document).on('click', '.fetch-child-opt', function(event) {
      event.preventDefault();
      var node = $(this);
      var user_id = $(this).data('nodeid');

      if(node.parent().find('ul#loading-child-of-'+user_id).hasClass('d-none'))
      {
        node.parent().find('ul#loading-child-of-'+user_id).removeClass('d-none');
      }
      $.get("<?php echo e(route($treeviewFetchChild)); ?>", {user_id}, function(data) {
        if(data.status)
        {
          if(node.parent().find('div#child-of-'+user_id).hasClass('non-expanded'))
          {
            node.parent().find('div#child-of-'+user_id).removeClass('non-expanded');
            node.parent().find('div#child-of-'+user_id).addClass('expanded');
            node.parent().find('div#child-of-'+user_id).html(data.result);

            node.find('span.expand-icon').removeClass('bx-chevron-right');
            node.find('span.expand-icon').addClass('bx-chevron-down');
          }
          else
          {
            node.parent().find('div#child-of-'+user_id).removeClass('expanded');
            node.parent().find('div#child-of-'+user_id).addClass('non-expanded');
            node.parent().find('div#child-of-'+user_id).html('');

            node.find('span.expand-icon').removeClass('bx-chevron-down');
            node.find('span.expand-icon').addClass('bx-chevron-right');
          }
        }
      }, 'json');
    });
  });

  $(function() {

    var user_id = $("#user-id").val();
    transactionsTable(user_id);
    function transactionsTable(user_id) {
      $('#transactions-table').DataTable().clear().destroy();

      $("#transactions-table").DataTable({
        serverSide: true,
        processing: true,
        searching: true,
        dom: 'lBfrtip',
        "aLengthMenu": [[25, 50, 100, 200, 300, 400, 500, 1000, -1], [25, 50, 100, 200, 300, 400, 500, 1000, "All"]],
        "iDisplayLength": 25,
        buttons: [
          {
            text: '<i class="bx bx-file"></i> CSV',
            className: 'btn-success btn mb-0',
            attr: { id: 'csv' },
            extend : "csv",
            filename: 'Transactions-list',
          },
          {
            text: '<i class="bx bx-printer"></i> Print',
            className: 'btn-warning btn mb-0',
            extend : "print",
            attr: { id: 'print' },
            exportOptions: { columns: ":visible" },
          },
          {
            text: '<i class="bx bxs-file-pdf"></i> PDF',
            className: 'btn-danger btn mb-0',
            extend : "pdfHtml5",
            exportOptions: { columns: ":visible" },
            attr: { id: 'pdf' },
            filename: 'Transactions-list',
          },
          {
            text: '<i class="bx bx-copy-alt"></i> Copy',
            className: 'btn-info btn mb-0',
            extend : "copyHtml5",
            exportOptions: { columns: [0, ":visible"] },
            attr: { id: 'copy' },
          },
        ],
        order: [],
        ajax: {
            url: "<?php echo e(route($transDatatableUrl)); ?>",
            type: "GET",
            data: {
              user_id: user_id
            }
        },
        "columns": [
          { data: 'id' },
          { data: 'username' },
          { data: 'user_type' },          
          { data: 'no_of_sms' },
          { data: 'description' },
          { data: 'txn_type' },
          { data: 'created_by' },
          { data: 'created_at' }
        ]
      });
    }

    campaignsTable(user_id);
    function campaignsTable(user_id) {
      $('#campaigns-table').DataTable().clear().destroy();

      $("#campaigns-table").DataTable({
        serverSide: true,
        processing: true,
        searching: true,
        dom: 'lBfrtip',
        "aLengthMenu": [[25, 50, 100, 200, 300, 400, 500, 1000, -1], [25, 50, 100, 200, 300, 400, 500, 1000, "All"]],
        "iDisplayLength": 25,
        buttons: [
          {
            text: '<i class="bx bx-file"></i> CSV',
            className: 'btn-success btn mb-0',
            attr: { id: 'csv' },
            extend : "csv",
            filename: 'Campaigns-list',
          },
          {
            text: '<i class="bx bx-printer"></i> Print',
            className: 'btn-warning btn mb-0',
            extend : "print",
            attr: { id: 'print' },
            exportOptions: { columns: ":visible" },
          },
          {
            text: '<i class="bx bxs-file-pdf"></i> PDF',
            className: 'btn-danger btn mb-0',
            extend : "pdfHtml5",
            exportOptions: { columns: ":visible" },
            attr: { id: 'pdf' },
            filename: 'Campaigns-list',
          },
          {
            text: '<i class="bx bx-copy-alt"></i> Copy',
            className: 'btn-info btn mb-0',
            extend : "copyHtml5",
            exportOptions: { columns: [0, ":visible"] },
            attr: { id: 'copy' },
          },
        ],
        order: [],
        ajax: {
            url: "<?php echo e(route($campaignDatatableUrl)); ?>",
            type: "GET",
            data: {
              user_id: user_id
            }
        },
        "columns": [
          { data: 'id' },
          { data: 'unique_id' },
          { data: 'campaign_name' },          
          { data: 'message' },
          { data: 'total_mob_no' },
          { data: 'created_at' },
          { data: 'status' }
        ]
      });
    }

  });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($template, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/wwwroot/digitaltext.live/resources/views/admin/resellers/view.blade.php ENDPATH**/ ?>
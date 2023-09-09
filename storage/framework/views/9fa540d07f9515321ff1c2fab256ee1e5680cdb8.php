<?php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';

  $treeviewFetch = (Auth::user()->user_type=="admin") ? 'admin.treeview.fetch' : 'user.treeview.fetch';
  $treeviewFetchChild = (Auth::user()->user_type=="admin") ? 'admin.treeview.fetchchild' : 'user.treeview.fetchchild';
?>



<?php $__env->startSection('mytitle', 'Tree View'); ?>
<?php $__env->startSection('content'); ?>
<!-- BEGIN: Content-->
<style type="text/css">
  table th {
    font-size: 10px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 11px !important;
    padding: 10px !important;
  }

  .select2-container {
    width: 100% !important;
  }

  li.fetch-child-opt{
    cursor: pointer;
  }
</style>
<div class="app-content content mt-2">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <!-- Dashboard Ecommerce Starts --> 

      <section class="users-list-wrapper">    
        <div class="users-list-table">
          
          <div class="card">
            <div class="card-header">
              <h6 class="card-title">Tree View
              </h6>
            </div>
            <div class="card-body">
              <div id="custom-treeview"></div>
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

    $.ajax({ 
      url: "<?php echo e(route($treeviewFetch)); ?>",
      method: "get",
      dataType: "json",
      data: {},   
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

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($template, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/programmicsdev/public_html/emp/bhavesh/promotup/resources/views/admin/tools/treeview/index.blade.php ENDPATH**/ ?>
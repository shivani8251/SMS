<?php $__env->startSection('mytitle', 'Categories'); ?>
<?php $__env->startSection('content'); ?>
<!-- BEGIN: Content-->
<style type="text/css">
  .list-group-item {
    display: inline-flex !important;
    padding: 15px;
    font-size: 17px;
  }

  .list-group .list-group-item i {
    font-size: 1.5rem !important;
  }

  table th {
    font-size: 10px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 11px !important;
    padding: 10px !important;
  }

  .wizard .actions ul li {
    display: none !important;
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
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <h6 class="float-left">List of Categories</h6>
                  <div class="float-right">
                    <a href="javascript:void(0);" id="add-category-btn" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> Add</a>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100" id="category-list-table">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Exhibition Type</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>                                   
                    </table>
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

<?php echo $__env->make('admin.categories.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>   

<script>
  $(function() {

    /*---------------------Starting of query for Category----------------------*/

      $(document).on('click', '.deactivate-category-btn', function() {
        let id = $(this).data('id');
        $.confirm({
          title: 'Confirm!',
          type: 'red',
          content: 'Are you sure want to deactivate this category ?',
          buttons: {
            yes: function() {
              $.get("<?php echo e(route('category.deactivate')); ?>", {id}, function(data) {
                if (data.status)
                {
                  toastr.success(data.message, '', {
                    closeButton: !0,
                    tapToDismiss: !1,
                    progressBar: true,
                    timeOut: 2000
                  });
                  $('#category-list-table').DataTable().ajax.reload();
                }
                else
                {
                  toastr.error(data.message, '', {
                    closeButton: !0,
                    tapToDismiss: !1,
                    progressBar: true,
                    timeOut: 2000
                  });
                }
              }, 'json');
            },
            no: function() {}
          }
        });
      });

      $(document).on('click', '.activate-category-btn', function() {
        let id = $(this).data('id');
        $.confirm({
          title: 'Confirm!',
          type: 'red',
          content: 'Are you sure want to activate this category ?',
          buttons: {
            yes: function() {
              $.get("<?php echo e(route('category.activate')); ?>", {id}, function(data) {
                if (data.status)
                {
                  toastr.success(data.message, '', {
                    closeButton: !0,
                    tapToDismiss: !1,
                    progressBar: true,
                    timeOut: 2000
                  });
                  $('#category-list-table').DataTable().ajax.reload();
                }
                else
                {
                  toastr.error(data.message, '', {
                    closeButton: !0,
                    tapToDismiss: !1,
                    progressBar: true,
                    timeOut: 2000
                  });
                }
              }, 'json');
            },
            no: function() {}
          }
        });
      });

      categoryListTable();
      function categoryListTable() {
        $('#category-list-table').DataTable().clear().destroy();

        $("#category-list-table").DataTable({
          serverSide: true,
          processing: true,
          searching: true,
          order: [],
          ajax: {
              url: "<?php echo e(route('category.serverSideDataTable')); ?>",
              type: "GET",
              data: {}
          },
          "columns": [
            { data: 'id' },
            { data: 'name' },
            { data: 'exhibition_type' },
            { data: 'status' },
            { data: 'actions' },
          ]
        });
      }

    /*---------------------Ending of query for Category----------------------*/
  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\indiapost\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>
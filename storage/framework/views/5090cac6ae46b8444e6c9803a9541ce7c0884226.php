<?php $__env->startSection('mytitle', 'Brand Management'); ?>
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
     
    <section class="users-list-wrapper">    
      <div class="users-list-table">
        <div class="card">
          <div class="card-body">
            <form action="#" class="wizard-vertical">
              <h3 id="service_master_active">
                <span class="fonticon-wrap mr-1">
                  <i class="bx bx-radio-circle-marked" ></i>
                </span>
                <span class="icon-title">
                  <span class="d-block">Brands</span>
                  <small class="text-muted">Brand Managment.</small>
                </span>
              </h3>
              <fieldset class="pt-0">
                <div class="row">
                  <div class="col-12">
                    <h6 class="float-left">List of Brands</h6>
                    <div class="float-right">
                      <a href="javascript:void(0);" id="add-brand-btn" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> Add</a>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered w-100" id="brand-list-table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Logo</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>                                   
                      </table>
                    </div>
                  </div>
                </div>
              </fieldset>

              <h3 id="category_master_active">
                <span class="fonticon-wrap mr-1">
                  <i class="bx bx-radio-circle-marked" ></i>
                </span>
                <span class="icon-title">
                  <span class="d-block">Categories</span>
                  <small class="text-muted">Category Managment.</small>
                </span>
              </h3>
              <fieldset class="pt-0">
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
                            <th>Image</th>
                            <th>Position</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>                                   
                      </table>
                    </div>
                  </div>
                </div>
              </fieldset>

              <h3 id="product_master_active">
                <span class="fonticon-wrap mr-1">
                  <i class="bx bx-radio-circle-marked" ></i>
                </span>
                <span class="icon-title">
                  <span class="d-block">Products</span>
                  <small class="text-muted">Product Managment.</small>
                </span>
              </h3>
              <fieldset class="pt-0">
                <div class="row">
                  <div class="col-12">
                    <h6 class="float-left">List of Products</h6>
                    <div class="float-right">
                      <a href="<?php echo e(route('product.add')); ?>" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> Add</a>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered w-100" id="product-list-table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>MRP</th>
                            <th>SKU</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>                                   
                      </table>
                    </div>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </section>

    </div>
  </div>
</div>
<!-- END: Content-->

<?php echo $__env->make('admin.products.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
  $(function() {

    /*---------------------Starting of query for Brands----------------------*/

      $(document).on('click', '.deactivate-brand-btn', function() {
          let id = $(this).data('id');
          $.confirm({
              title: 'Confirm!',
              type: 'red',
              content: 'Are you sure want to deactivate this brand ?',
              buttons: {
                yes: function() {
                    $.get("<?php echo e(route('brand.deactivate')); ?>", {
                        id
                    }, function(data) {
                        if (data.status) {
                            toastr.success(data.message, '', {
                                closeButton: !0,
                                tapToDismiss: !1,
                                progressBar: true,
                                timeOut: 2000
                            });
                            $('#brand-list-table').DataTable().ajax.reload();
                        } else {
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

      $(document).on('click', '.activate-brand-btn', function() {
          let id = $(this).data('id');
          $.confirm({
              title: 'Confirm!',
              type: 'red',
              content: 'Are you sure want to activate this brand ?',
              buttons: {
                yes: function() {
                    $.get("<?php echo e(route('brand.activate')); ?>", {
                        id
                    }, function(data) {
                        if (data.status) {
                            toastr.success(data.message, '', {
                                closeButton: !0,
                                tapToDismiss: !1,
                                progressBar: true,
                                timeOut: 2000
                            });
                            $('#brand-list-table').DataTable().ajax.reload();
                        } else {
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

      brandListTable();
      function brandListTable() {
        $('#brand-list-table').DataTable().clear().destroy();

        $("#brand-list-table").DataTable({
          serverSide: true,
          processing: true,
          searching: true,
          order: [],
          ajax: {
              url: "<?php echo e(route('brand.serverSideDataTable')); ?>",
              type: "GET",
              data: {}
          },
          "columns": [
            { data: 'id' },
            { data: 'name' },
            { data: 'description' },
            { data: 'logo' },
            { data: 'status' },
            { data: 'actions' },
          ]
        });
      }

    /*---------------------Ending of query for Brands----------------------*/

    /*---------------------Starting of query for Categories----------------------*/

      $(document).on('click', '.deactivate-category-btn', function() {
          let id = $(this).data('id');
          $.confirm({
              title: 'Confirm!',
              type: 'red',
              content: 'Are you sure want to deactivate this category ?',
              buttons: {
                yes: function() {
                    $.get("<?php echo e(route('category.deactivate')); ?>", {
                        id
                    }, function(data) {
                        if (data.status) {
                            toastr.success(data.message, '', {
                                closeButton: !0,
                                tapToDismiss: !1,
                                progressBar: true,
                                timeOut: 2000
                            });
                            $('#category-list-table').DataTable().ajax.reload();
                        } else {
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
                    $.get("<?php echo e(route('category.activate')); ?>", {
                        id
                    }, function(data) {
                        if (data.status) {
                            toastr.success(data.message, '', {
                                closeButton: !0,
                                tapToDismiss: !1,
                                progressBar: true,
                                timeOut: 2000
                            });
                            $('#category-list-table').DataTable().ajax.reload();
                        } else {
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
            { data: 'image' },
            { data: 'position' },
            { data: 'description' },
            { data: 'status' },
            { data: 'actions' },
          ]
        });
      }

    /*---------------------Ending of query for Categories----------------------*/

    /*---------------------Starting of query for Products----------------------*/

      $(document).on('click', '.deactivate-product-btn', function() {
          let id = $(this).data('id');
          $.confirm({
              title: 'Confirm!',
              type: 'red',
              content: 'Are you sure want to deactivate this product ?',
              buttons: {
                yes: function() {
                    $.get("<?php echo e(route('product.deactivate')); ?>", {
                        id
                    }, function(data) {
                        if (data.status) {
                            toastr.success(data.message, '', {
                                closeButton: !0,
                                tapToDismiss: !1,
                                progressBar: true,
                                timeOut: 2000
                            });
                            $('#product-list-table').DataTable().ajax.reload();
                        } else {
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

      $(document).on('click', '.activate-product-btn', function() {
          let id = $(this).data('id');
          $.confirm({
              title: 'Confirm!',
              type: 'red',
              content: 'Are you sure want to activate this product ?',
              buttons: {
                yes: function() {
                    $.get("<?php echo e(route('product.activate')); ?>", {
                        id
                    }, function(data) {
                        if (data.status) {
                            toastr.success(data.message, '', {
                                closeButton: !0,
                                tapToDismiss: !1,
                                progressBar: true,
                                timeOut: 2000
                            });
                            $('#product-list-table').DataTable().ajax.reload();
                        } else {
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

      productListTable();
      function productListTable() {
        $('#product-list-table').DataTable().clear().destroy();

        $("#product-list-table").DataTable({
          serverSide: true,
          processing: true,
          searching: true,
          order: [],
          ajax: {
              url: "<?php echo e(route('product.serverSideDataTable')); ?>",
              type: "GET",
              data: {}
          },
          "columns": [
            { data: 'id' },
            { data: 'brand' },
            { data: 'category' },
            { data: 'name' },
            { data: 'description' },
            { data: 'mrp' },
            { data: 'sku' },
            { data: 'status' },
            { data: 'actions' },
          ]
        });
      }

    /*---------------------Ending of query for Products----------------------*/

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mobilla\resources\views/admin/products/index.blade.php ENDPATH**/ ?>
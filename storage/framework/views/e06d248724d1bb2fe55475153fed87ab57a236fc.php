<?php $__env->startSection('mytitle', 'Locations'); ?>
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
              <form action="#" class="wizard-vertical">

                <h3>
                  <span class="fonticon-wrap mr-1">
                     <i class="bx bx-radio-circle-marked"></i>
                  </span>
                  <span class="icon-title">
                    <span class="d-block">City</span>
                    <small class="text-muted">City Management.</small>
                  </span>
                </h3>
                <fieldset class="pt-0">
                  <div class="row">
                    <div class="col-12">
                      <h6 class="float-left">List of Cities</h6>
                      <div class="float-right">
                        <a href="javascript:void(0);" id="add-city-btn" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> Add</a>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="city-list-table">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Status</th>
                              <th>Actions</th>
                            </tr>
                          </thead>                                   
                        </table>
                      </div>
                    </div>
                  </div>
                </fieldset>

                <h3>
                  <span class="fonticon-wrap mr-1">
                    <i class="bx bx-radio-circle-marked" ></i>
                  </span>
                  <span class="icon-title">
                    <span class="d-block">Locality/Area</span>
                    <small class="text-muted">Locality/Area Managment.</small>
                  </span>
                </h3>
                <fieldset class="pt-0">
                   <div class="row">
                    <div class="col-12">
                      <h6 class="float-left">List of Locality/Area</h6>
                      <div class="float-right">
                        <a href="javascript:void(0);" id="add-area-btn" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> Add</a>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100" id="area-list-table">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>City</th>
                              <th>Locality/Area Name</th>
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

<?php echo $__env->make('admin.settings.locations.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>   

<script>
  $(function() {

    /*---------------------Starting of query for City----------------------*/

      $(document).on('click', '.deactivate-city-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to deactivate this city ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('city.deactivate')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#city-list-table').DataTable().ajax.reload();
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

      $(document).on('click', '.activate-city-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to activate this city ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('city.activate')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#city-list-table').DataTable().ajax.reload();
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

      cityListTable();
      function cityListTable() {
        $('#city-list-table').DataTable().clear().destroy();

        $("#city-list-table").DataTable({
          serverSide: true,
          processing: true,
          searching: true,
          order: [],
          ajax: {
              url: "<?php echo e(route('city.serverSideDataTable')); ?>",
              type: "GET",
              data: {}
          },
          "columns": [
            { data: 'id' },
            { data: 'name' },
            { data: 'status' },
            { data: 'actions' },
          ]
        });
      }

    /*---------------------Ending of query for City----------------------*/

    /*---------------------Starting of query for Area----------------------*/

      $(document).on('click', '.deactivate-area-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to deactivate this area ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('area.deactivate')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#area-list-table').DataTable().ajax.reload();
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

      $(document).on('click', '.activate-area-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to activate this area ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('area.activate')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#area-list-table').DataTable().ajax.reload();
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

      areaListTable();
      function areaListTable() {
        $('#area-list-table').DataTable().clear().destroy();

        $("#area-list-table").DataTable({
          serverSide: true,
          processing: true,
          searching: true,
          order: [],
          ajax: {
              url: "<?php echo e(route('area.serverSideDataTable')); ?>",
              type: "GET",
              data: {}
          },
          "columns": [
            { data: 'id' },
            { data: 'city' },
            { data: 'name' },
            { data: 'status' },
            { data: 'actions' },
          ]
        });
      }

    /*---------------------Ending of query for Area----------------------*/

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\agentian\resources\views/admin/settings/locations/index.blade.php ENDPATH**/ ?>
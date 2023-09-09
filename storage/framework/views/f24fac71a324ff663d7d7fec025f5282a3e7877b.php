<?php $__env->startSection('mytitle', 'Rent Properties'); ?>
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
</style>
<div class="app-content content mt-2">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      <!-- Dashboard Ecommerce Starts -->          
      <section class="list-group-navigation">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <h6 class="mb-2">List of Rent Properties</h6>

                    <form>
                      <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                          <div class="form-group">
                            <select class="form-control select2" id="city-filter" data-placeholder="Select city">
                              <option value="">--Select--</option>
                              <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                          <div class="form-group">
                            <select class="form-control select2" id="area-filter" data-placeholder="Select area">
                              <option value="">--Select--</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                          <div class="form-group">
                            <select class="form-control select2" id="type-filter" data-placeholder="Select type">
                              <option value="">--Select--</option>
                              <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                          <div class="form-group">
                            <select class="form-control select2" id="category-filter" data-placeholder="Select category">
                              <option value="">--Select--</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                          <div class="form-group">
                            <select class="form-control select2" id="user-filter" data-placeholder="Select user">
                              <option value="">--Select--</option>
                              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                          <div class="form-group">
                            <button type="button" class="btn btn-primary" id="search-btn">Search</button>
                            <button type="button" class="btn btn-secondary" id="reset-btn">Reset</button>
                          </div>
                        </div>
                        <div class="col-12"><hr class="mt-0 mb-0" /></div>
                      </div>
                    </form>
                  </div>
                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered w-100" id="rent-property-list-table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Full Address</th>
                            <th>Type</th>
                            <th>Categories</th>
                            <th>Rental Amount (INR)</th>
                            <th>Security Deposit (INR)</th>
                            
                            
                            <th>Description</th>
                            <th>User</th>
                            <th>Approved/Rejected</th>
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

    $(document).on('change', '#city-filter', function() {
      let id = this.value;
      $.get("<?php echo e(route('property.cityAreas')); ?>", {id}, function(data) {
        if (data!='')
        {
          var opts = '<option value="">--Select--</option>';
          $.each(data, function(i, val){
            opts += '<option value="'+val.id+'">'+val.name+'</option>';
          });
          $("#area-filter").html(opts);
        }
        else
        {
          var opts = '<option value="">--Select--</option>';
          $("#area-filter").html(opts);
        }
      }, 'json');
    });

    $(document).on('change', '#type-filter', function() {
      let id = this.value;
      $.get("<?php echo e(route('property.typeCategories')); ?>", {id}, function(data) {
        if (data!='')
        {
          var opts = '<option value="">--Select--</option>';
          $.each(data, function(i, val){
            opts += '<option value="'+val.id+'">'+val.name+'</option>';
          });
          $("#category-filter").html(opts);
        }
        else
        {
          var opts = '<option value="">--Select--</option>';
          $("#category-filter").html(opts);
        }
      }, 'json');
    });

    $(document).on('click', '.deactivate-property-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to deactivate this property ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('property.deactivate')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#rent-property-list-table').DataTable().ajax.reload();
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

    $(document).on('click', '.activate-property-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to activate this property ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('property.activate')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#rent-property-list-table').DataTable().ajax.reload();
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

    $(document).on('click', '.reject-property-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to reject this property ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('property.reject')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#rent-property-list-table').DataTable().ajax.reload();
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

    $(document).on('click', '.approve-property-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to approve this property ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('property.approve')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#rent-property-list-table').DataTable().ajax.reload();
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

    $(document).on('click', '#search-btn', function(e) {
      e.preventDefault();

      var city_id = $('#city-filter').val();
      var area_id = $('#area-filter').val();
      var type_id = $('#type-filter').val();
      var category_id = $('#category-filter').val();
      var user_id = $('#user-filter').val();
      rentPropertyListTable(city_id, area_id, type_id, category_id, user_id);
    });

    $(document).on('click', '#reset-btn', function(e) {
      e.preventDefault();

      $('#city-filter').val('').trigger('change');
      $('#area-filter').val('').trigger('change');
      $('#type-filter').val('').trigger('change');
      $('#category-filter').val('').trigger('change');
      $('#user-filter').val('').trigger('change');
    });

    var city_id = $('#city-filter').val();
    var area_id = $('#area-filter').val();
    var type_id = $('#type-filter').val();
    var category_id = $('#category-filter').val();
    var user_id = $('#user-filter').val();
    rentPropertyListTable(city_id, area_id, type_id, category_id, user_id);

    function rentPropertyListTable(city_id = '', area_id = '', type_id = '', category_id = '', user_id = '')
    {
      $('#rent-property-list-table').DataTable().clear().destroy();

      $("#rent-property-list-table").DataTable({
        serverSide: true,
        processing: true,
        searching: true,
        order: [],
        ajax: {
            url: "<?php echo e(route('property.rentPropertiesServerSideDataTable')); ?>",
            type: "GET",
            data: {
              city_id: city_id,
              area_id: area_id,
              type_id: type_id,
              category_id: category_id,
              user_id: user_id
            }
        },
        "columns": [
          { data: 'id' },
          { data: 'full_address' },
          { data: 'type' },
          { data: 'categories' },
          { data: 'rental_amount' },
          { data: 'security_deposit' },
          // { data: 'amount_negotiability' },
          // { data: 'latitude' },
          // { data: 'longitude' },
          { data: 'description' },
          { data: 'user' },
          { data: 'approve_or_reject' },
          { data: 'status' },
          { data: 'actions' },
        ]
      });
    }

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\agentian\resources\views/admin/properties/rent/index.blade.php ENDPATH**/ ?>
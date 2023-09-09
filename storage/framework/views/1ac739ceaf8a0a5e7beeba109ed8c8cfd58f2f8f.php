

<?php $__env->startSection('mytitle', 'Edit Service'); ?>
<?php $__env->startSection('content'); ?>
<!-- BEGIN: Content-->
<style type="text/css">
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
              <div class="card-header">
                <h4 class="h4">Edit Service</h4>
                <div class="float-right">
                  <a href="<?php echo e(route('service.index')); ?>" class="btn btn-primary"><i class="bx bx-arrow-back"></i> Back</a>
                </div>
              </div>
              <div class="card-body">
                <form id="add-service-form" method="post" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <div class="row">
                    <input type="hidden" name="service_id" value="<?php echo e($service->id); ?>">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Shop Name</label>
                        <input type="text" placeholder="Enter shop name" name="shop_name" id="shop_name" class="form-control" value="<?php echo e($service->shop_name); ?>">
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Mobile Number </label>
                        <input type="text" placeholder="Enter mobile no" name="mobile_no" id="mobile_no" value="<?php echo e($service->mobile_no); ?>" class="form-control numberOnly" maxlength="10">
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">State</label>
                        <input type="hidden" id="state_val" value="<?php echo e($service->state); ?>">
                        <select name="state" id="state" class="form-control select2" data-placeholder="Select state">
                          <option value="">--Select--</option>
                          <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($state->id); ?>" <?php echo e($service->state==$state->id ? 'selected' : ''); ?>><?php echo e($state->state_name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">City</label>
                        <input type="hidden" id="city_val" value="<?php echo e($service->city); ?>">
                        <select name="city" id="city" class="form-control select2" data-placeholder="Select city">
                          <option value="">--Select--</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Pin Code</label>
                        <input type="text" name="pincode" id="pincode" class="form-control numberOnly" placeholder="Enter pin code" maxlength="6" value="<?php echo e($service->pincode); ?>">
                      </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Address</label>
                        <textarea type="text" name="address" id="address" class="form-control" placeholder="Enter address"><?php echo e($service->address); ?></textarea>
                      </div>
                    </div>

                  </div>
                  <hr>
                  <div class="row group">
                    <div class="col-lg-12 mt-1">
                      <div class="form-group">
                        <button type="submit" id="submit-btn" class="btn btn-success">Save</button>
                      </div>
                    </div>
                  </div>
                </form>
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

    var state_val = $("#state_val").val();
    var city_val = $("#city_val").val();

    $.get("<?php echo e(route('team.fetchStatesCities')); ?>", {state_val}, function(data) {
      if(data!="")
      {
        var opts = '<option value="">--Select--</option>';
        $.each(data, function(index, value){
          if(value.id==city_val)
          {
            var selected = 'selected';
          }
          else
          {
            var selected = '';
          }

          opts += '<option value="'+value.id+'" '+selected+'>'+value.city_name+'</option>';
        });

        $("#city").html(opts);
      }
      else
      {
        var opts = '<option value="">--Select--</option>';
        $("#city").html(opts);
      }
    }, 'json');

    $(document).on("change", "#state", function(event) {
      event.preventDefault();
      var id = this.value;

      $.get("<?php echo e(route('team.fetchCities')); ?>", {id}, function(data) {
        if(data!="")
        {
          var opts = '<option value="">--Select--</option>';
          $.each(data, function(index, value){
            opts += '<option value="'+value.id+'">'+value.city_name+'</option>';
          });

          $("#city").html(opts);
        }
        else
        {
          var opts = '<option value="">--Select--</option>';
          $("#city").html(opts);
        }
      }, 'json');
    });

    var serviceForm = $("#add-service-form").validate({
      errorPlacement: function (error, element) {}
    });

    $("#add-service-form").submit(function(event) {
      event.preventDefault();

      var formData = new FormData($(this)[0]);

      if (serviceForm.valid())
      {
        $.ajax({
          type: 'POST',
          url: "<?php echo e(route('service.update')); ?>",
          data: formData,
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            if (data.status) {
              toastr.success(data.message, '', {
                closeButton: !0,
                tapToDismiss: !1,
                progressBar: true,
                timeOut: 1000
              });
              location.reload();
            }
            else
            {
              toastr.error(data.message, '', {
                closeButton: !0,
                tapToDismiss: !1,
                progressBar: true,
                timeOut: 1000
              });
            }
          }
        }); 
      }
    });

  });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mobilla\resources\views/admin/services/edit.blade.php ENDPATH**/ ?>
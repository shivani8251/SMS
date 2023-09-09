<?php $__env->startSection('mytitle', 'Requirements'); ?>
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
                    <h6 class="mb-2">Edit Requirement</h6>

                    <form id="requirement-form" method="post">
                      <?php echo csrf_field(); ?>
                      <div class="row">
                        <input type="hidden" name="id" value="<?php echo e($requirement->id ? $requirement->id : ''); ?>">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="form-group">
                            <label class="form-control-label">Property Type <span class="text-danger">*</span></label>
                            <input type="hidden" id="type_val" value="<?php echo e($requirement->type_id); ?>" />
                            <select class="form-control select2" id="type_id" name="type_id" data-placeholder="Select type" required>
                              <option value="">--Select--</option>
                              <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="<?php echo e($type->id); ?>" <?php echo e($type->id==$requirement->type_id ? 'selected' : ''); ?>><?php echo e($type->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="form-group">
                            <label class="form-control-label">Categories <span class="text-danger">*</span></label>
                            <input type="hidden" id="category_ids_val" value="<?php echo e($requirement->category_ids); ?>" />
                            <select class="form-control select2" id="category_ids" name="category_ids[]" data-placeholder="Select category" multiple required>
                              <option value="">--Select--</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="form-group">
                            <label class="form-control-label">Cities <span class="text-danger">*</span></label>
                            <input type="hidden" id="city_val" value="<?php echo e($requirement->city_id); ?>" />
                            <select class="form-control select2" id="city_ids" name="city_ids[]" data-placeholder="Select city" multiple required>
                              <option value="">--Select--</option>
                              <?php
                                $city_ids_array = explode(', ', $requirement->city_ids);
                              ?>
                              <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="<?php echo e($city->id); ?>" <?php echo e(in_array($city->id, $city_ids_array) ? 'selected' : ''); ?>><?php echo e($city->name); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="form-group">
                            <label class="form-control-label">Areas <span class="text-danger">*</span></label>
                            <input type="hidden" id="area_ids_val" value="<?php echo e($requirement->area_ids); ?>" />
                            <select class="form-control select2" id="area_ids" name="area_ids[]" data-placeholder="Select area" multiple required>
                              <option value="">--Select--</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="form-group">
                            <label class="form-control-label">From Amount <span class="text-danger">*</span></label>
                            <input type="text" class="form-control numberOnly" id="from_amount" name="from_amount" placeholder="Enter requirement from_amount" value="<?php echo e($requirement->from_amount ? $requirement->from_amount : ''); ?>" required />
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="form-group">
                            <label class="form-control-label">To Amount <span class="text-danger">*</span></label>
                            <input type="text" class="form-control numberOnly" id="to_amount" name="to_amount" placeholder="Enter requirement to_amount" value="<?php echo e($requirement->to_amount ? $requirement->to_amount : ''); ?>" required />
                          </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="form-group">
                            <label class="form-control-label">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter description"><?php echo e($requirement->description ? $requirement->description : ''); ?></textarea>
                          </div>
                        </div>
                        
                        <div class="col-12">
                          <hr />
                          <div class="form-group">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                          </div>
                        </div>
                      </div>
                    </form>
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

    $(document).on('change', '#city_ids', function() {
      var options = document.getElementById('city_ids').selectedOptions;
      var city_ids = Array.from(options).map(({ value }) => value);
      $.get("<?php echo e(route('property.citiesAreas')); ?>", {city_ids}, function(data) {
        if (data!='')
        {
          var opts = '<option value="">--Select--</option>';
          $.each(data, function(i, val){
            opts += '<option value="'+val.id+'">'+val.name+'</option>';
          });
          $("#area_ids").html(opts);
        }
        else
        {
          var opts = '<option value="">--Select--</option>';
          $("#area_ids").html(opts);
        }
      }, 'json');
    });

    var opts = document.getElementById('city_ids').selectedOptions;
    var city_ids_val = Array.from(opts).map(({ value }) => value);
    var area_ids_val = $('#area_ids_val').val();
    $.ajax({
      type: 'GET',
      url: "<?php echo e(route('property.citiesAreas')); ?>",
      data: {
        city_ids: city_ids_val
      },
      dataType: 'json',
      success: function(data) {
        if (data!='')
        {
          var opts = '<option value="">--Select--</option>';
          var abc;
          $.each(data, function(ind, value){
            if (area_ids_val.indexOf(value.id) != -1)
            {
              abc = '<option value="'+value.id+'" selected>'+value.name+'</option>';
            }
            else
            {
              abc = '<option value="'+value.id+'">'+value.name+'</option>';
            }
            opts += abc;
          });
          $("#area_ids").html(opts);
        }
        else
        {
          var opts = '<option value="">--Select--</option>';
          $("#area_ids").html(opts);
        }
      }
    });

    $(document).on('change', '#type_id', function() {
      let id = this.value;
      $.get("<?php echo e(route('property.typeCategories')); ?>", {id}, function(data) {
        if (data!='')
        {
          var opts = '<option value="">--Select--</option>';
          $.each(data, function(i, val){
            opts += '<option value="'+val.id+'">'+val.name+'</option>';
          });
          $("#category_id").html(opts);
        }
        else
        {
          var opts = '<option value="">--Select--</option>';
          $("#category_id").html(opts);
        }
      }, 'json');
    });

    var type_val = $('#type_val').val();
    var category_ids_val = $('#category_ids_val').val();
    $.ajax({
      type: 'GET',
      url: "<?php echo e(route('property.typeCategories')); ?>",
      data: {
        id: type_val
      },
      dataType: 'json',
      success: function(data) {
        if (data!='')
        {
          var opts = '<option value="">--Select--</option>';
          var abc;
          $.each(data, function(ind, value){
            if (category_ids_val.indexOf(value.id) != -1)
            {
              abc = '<option value="'+value.id+'" selected>'+value.name+'</option>';
            }
            else
            {
              abc = '<option value="'+value.id+'">'+value.name+'</option>';
            }
            opts += abc;
          });
          $("#category_ids").html(opts);
        }
        else
        {
          var opts = '<option value="">--Select--</option>';
          $("#category_ids").html(opts);
        }
      }
    });

    var rentForm = $("#requirement-form").validate({
      errorPlacement: function (error, element) {}
    });

    $("#requirement-form").submit(function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      if (rentForm.valid())
      {
        $.ajax({
          type: 'POST',
          url: "<?php echo e(route('requirement.update')); ?>",
          data: formData,
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {
            // console.log(data);
            if (data.status) {
              toastr.success(data.message, '', {
                closeButton: !0,
                tapToDismiss: !1,
                progressBar: true,
                timeOut: 1000
              });
              window.location.href = "<?php echo e(route('property.requirements')); ?>";
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

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\agentian\resources\views/admin/properties/requirement/edit.blade.php ENDPATH**/ ?>
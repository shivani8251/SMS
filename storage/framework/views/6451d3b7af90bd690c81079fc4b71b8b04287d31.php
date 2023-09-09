<?php $__env->startSection('mytitle', 'Events'); ?>
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

  table.picker__table td {
    padding: 0 !important;
    font-size: 12px;
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
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h6 class="float-left mb-1">Edit Event : Step 3</h6>
                <div class="float-right">
                  <a href="<?php echo e(route('admin.event.index')); ?>" class="btn btn-sm btn-primary"><i class="bx bx-left-arrow-alt"></i> Back</a>
                </div>
              </div>
              <div class="card-body">
                <form method="post" id="event-step-three-form" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>

                  <div class="row">
                    <input type="hidden" name="event_id" value="<?php echo e(isset($event->id) ? $event->id : ''); ?>" />

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label class="form-control-label">Scorecard <span class="text-danger">*</span></label>
                        <input type="hidden" value="<?php if(isset($event->scorecard)): ?><?php echo e($event->scorecard); ?><?php endif; ?>" name="scorecard" class="uploaded-scorecard-file" required />
                        
                        <?php
                          $dNone = "";
                          if(isset($event->scorecard)){
                            $dNone = "d-none";
                          }
                        ?>
                        <?php if(isset($event->scorecard)): ?>
                          <p class="alert alert-success scorecard-upload-status">
                            <a class="text-white" target="_blank" href='<?php echo e(asset("public/storage/scorecards/$event->scorecard")); ?>'><?php echo e($event->scorecard); ?></a>
                            <span class="float-right">
                              <a class="text-danger remove-scorecard-btn" href="javascript:void(0);">
                                <i class="bx bx-x-circle"></i>
                              </a>
                            </span>
                          </p>
                        <?php else: ?>
                          <p class="alert alert-success scorecard-upload-status d-none"></p>
                        <?php endif; ?>
                        <button type="button" name="scorecard_upload" id="scorecard_upload" class="btn btn-outline-primary btn-block <?php echo e($dNone); ?>"><i class="bx bx-upload"></i> Upload</button>
                      </div>
                    </div>

                    <div class="col-12">
                      <hr />
                      <h6>Top 4 Users</h6>
                    </div>
                  </div>
                  <div class="row">

                    <?php $__currentLoopData = $top_winners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $top_winner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <input type="hidden" name="top_winner_id[]" value="<?php echo e($top_winner->id); ?>" />

                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="form-control-label">(<?php echo e(++$key); ?>) User <span class="text-danger">*</span> </label>
                          <select data-placeholder="Select user *" name="user[]" class="form-control select2" required>
                            <option value="">--Select--</option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($user->id); ?>" <?php echo e($top_winner->user_id==$user->id ? 'selected' : ''); ?>><?php echo e($user->name.'-'.$user->phone); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="form-control-label">Position <span class="text-danger">*</span> </label>
                          <input type="text" placeholder="Enter position *" autocomplete="off" name="position[]" class="form-control numberOnly" value="<?php echo e($top_winner->position); ?>" required />
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="form-control-label">Points</label>
                          <input type="text" placeholder="Enter point" autocomplete="off" name="point[]" class="form-control numberOnly" value="<?php echo e($top_winner->point); ?>" />
                        </div>
                      </div>

                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                          <label class="form-control-label">Amount (&#8377;) <span class="text-danger">*</span> </label>
                          <input type="text" placeholder="Enter amount *" autocomplete="off" name="amount[]" class="form-control numberOnly" value="<?php echo e($top_winner->amount); ?>" required />
                        </div>
                      </div>
                      <div class="col-12">
                        <hr />
                      </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                  </div>
                  <div class="row group">
                    <label class="text-warning d-none col-12 mt-1 mb-1" id="warning-msg"></label>
                    <div class="col-lg-12 mt-1">
                      <div class="form-group">
                        <button type="submit" id="submit-btn" class="btn btn-success">Save Changes</button>
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

<div class="modal fade text-left w-100" id="upload-scorecard-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Scorecard</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <form id="choose-scorecard-form" method="post" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div class="file-loading">
                <input id="scorecard-file" name="file" accept=".jpg, .png, .jpeg" class="file doc_file_input" type="file">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>

  /*=====Scorecard upload======*/

    $("#scorecard-file").fileinput({
      theme: 'fas',
      uploadUrl: "<?php echo e(route('admin.event.scorecard.upload')); ?>",
      uploadAsync: false,
      fileActionSettings: {
        showUpload: false
      },
      uploadExtraData: function() {
        return {
          _token: $("input[name='_token']").val(),
        };
      },
      allowedFileExtensions: ['jpg', 'png', 'jpeg'],
      overwriteInitial: false,
      maxFileSize:5120,
      maxFilesNum: 1,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      }
    })
    .on('filebatchuploadsuccess', function(event, data, previewId, index) {
      let nearestInput = $("input.uploaded-scorecard-file");
      let nearestBtn = $("button#scorecard_upload");
      let nearestStatus = $("p.scorecard-upload-status");

      $("input.uploaded-scorecard-file").val(data.response.file);
      if (nearestInput.val())
      {
        $(nearestBtn).addClass("d-none");
        $(nearestStatus).html(data.response.file+'<span class="float-right">'+
          '<a class="text-danger remove-scorecard-btn" href="javascript:void(0);">'+
            '<i class="bx bx-x-circle"></i>'+
          '</a>'+
        '</span>');
        $(nearestStatus).removeClass("d-none");
      }
      else
      {
        $(nearestBtn).removeClass("d-none");
        $(nearestStatus).addClass("d-none");
      }
      $("#upload-scorecard-modal").modal('hide');
      $('#choose-scorecard-form')[0].reset();

    });

  /*=====Scorecard upload======*/

  $(function() {


    $("#scorecard_upload").on("click", function() {
      $("#upload-scorecard-modal").modal('show');
    });

    $(document).on("click", ".remove-scorecard-btn", function() {
      $(this).closest('div').find("p.scorecard-upload-status").addClass('d-none');
      $(this).closest("div").find("button#scorecard_upload").removeClass('d-none');
      $(this).closest("div").find("input.uploaded-scorecard-file").val("");
    });

    /*-------------------------------------------------------*/
    
    var eventForm = $("#event-step-three-form").validate({
      // errorPlacement: function (error, element) {}
    });

    $("#event-step-three-form").submit(function(event) {
      event.preventDefault();

      var formData = new FormData($(this)[0]);
      if (eventForm.valid())
      {
        $.ajax({
          type: 'POST',
          url: "<?php echo e(route('admin.event.updateStepThree')); ?>",
          data: formData,
          dataType: 'json',
          contentType: false,
          cache: false,
          processData: false,
          beforeSend: function() {
            $("#warning-msg").removeClass('d-none');
            $("#warning-msg").text('Data is being saved do not refresh or submit again');
            $('#submit-btn').prop('disabled', true);
          },
          success: function(data)
          {
            if (data.status) {
              toastr.success(data.message, '', {
                closeButton: !0,
                tapToDismiss: !1,
                progressBar: true,
                timeOut: 1000
              });
              window.location.href = "<?php echo e(route('admin.event.index')); ?>";
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
            setTimeout(function() {
              $("#warning-msg").addClass('d-none');
              $('#submit-btn').prop('disabled', false);
            }, 500);
          }
        });
      }
    });

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\bxagameapp\resources\views/admin/events/edit_step_three.blade.php ENDPATH**/ ?>
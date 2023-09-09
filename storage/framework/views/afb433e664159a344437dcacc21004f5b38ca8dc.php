<style type="text/css">
  .select2-container {
    width: 100% !important;
  }
</style>

<div class="modal fade text-left" id="status-modal" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel33" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="status-form-heading"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <form method="post" id="status-form" enctype="multipart/form-data">
        <div class="modal-body">
          <?php echo csrf_field(); ?>
          <input type="hidden" id="status_id" name="id" />

          <div class="form-group">
            <label class="form-control-label">Name <span class="text-danger">*</span></label>
            <input type="text" placeholder="Enter status name" name="name" id="name" class="form-control" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" id="submit-btn" class="btn btn-success ml-1">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Save</span>
          </button>
          <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
          </button>            
        </div>
        
      </form>
    </div>
  </div>
</div>

<?php $__env->startSection('modal_script'); ?>

<script>
  $(function() {

    /*---------------------Starting of query for Status----------------------*/

      $('#status-modal').on('hidden.bs.modal', function () {
        $('#status-form')[0].reset();
        $('#status_id').val("");
        $('#name').val("");
      });

      $("#add-status-btn").on("click", function(event) {
        event.preventDefault();
        $("#status-form-heading").text("Add New Status");
        $("#status-modal").modal("show");
      });

      $(document).on("click", ".edit-status-btn", function() {
        $("#status-form-heading").text("Edit Status");
        let id = $(this).data("id");

        $.get("<?php echo e(route('admin.status.fetch')); ?>", {id}, function(data) {
          if (data != "")
          {
            $("#status_id").val(data.id);
            $("#name").val(data.name);
          }
        }, "json");
        $("#status-modal").modal("show");
      });

      var statusForm = $("#status-form").validate({
        errorPlacement: function (error, element) {}
      });

      $("#status-form").submit(function(event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        if (statusForm.valid())
        {
          $.ajax({
            type: 'POST',
            url: "<?php echo e(route('admin.status.submitData')); ?>",
            data: formData,
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function()
            {
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
                $('#status-modal').modal("hide");
                $('#status-list-table').DataTable().ajax.reload();
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
                $('#submit-btn').prop('disabled', false);
              }, 500);
            }
          });

        }
      });
    /*---------------------Ending of query for Status----------------------*/

  });
</script>

<?php $__env->stopSection(); ?>
<?php /**PATH C:\xampp\htdocs\shreeswastik\resources\views/admin/masters/status/modals.blade.php ENDPATH**/ ?>
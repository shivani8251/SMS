<?php $__env->startSection('mytitle', 'List of Leads'); ?>
<?php $__env->startSection('content'); ?>
<!-- BEGIN: Content-->

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
                <h4 class="card-title mb-0">List of Leads</h4>
                <div class="float-right">
                  <a href="javascript:void(0);" data-toggle="modal" data-target="#lead-modal" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> Add</a>
                </div>
              </div>
              <div class="card-body">
                <input type="hidden" id="urlvalue" value="<?php echo e(isset($property_id) ? ($property_id ? $property_id : '') : ''); ?>" />
                <div class="table-responsive">
                  <table class="table table-striped table-bordered w-100" id="leads-table">
                    <thead>
                      <tr>
                        <th>Lead ID</th>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Comment</th>
                        <th>Actions</th>
                      </tr>
                    </thead>                                   
                  </table>
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

<?php echo $__env->make('admin.leads.leadmodals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
  $(function() {

    var urlvalue = $("#urlvalue").val();
    leadsTable(urlvalue);
    
    function leadsTable(urlvalue = '') {
      $('#leads-table').DataTable().clear().destroy();
      $("#leads-table").DataTable({
        serverSide: true,
        processing: true,
        searching: true,
        "order":[],
        ajax: {
          url: "<?php echo e(route('admin.leadServerSideTable')); ?>",
          type: "GET",
          data: { urlvalue: urlvalue }
        },
        "columns": [
          { data: 'lead_id' },
          { data: 'lead_name' },
          { data: 'mobile_no' },
          { data: 'address' },
          { data: 'comment' },
          { data: 'actions' },
        ],
      });
    }

    $(document).on('click', '.delete-lead-btn', function() {
      let id = $(this).data('id');
      $.confirm({
        title: 'Confirm!',
        type: 'red',
        content: 'Are you sure want to delete this lead ?',
        buttons: {
          yes: function() {
            $.get("<?php echo e(route('admin.deleteLead')); ?>", {id}, function(data){
              if (data.status)
              {
                toastr.success(data.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 2000
                });
                $('#leads-table').DataTable().ajax.reload();
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

    $(document).on('mouseenter','[data-toggle="tooltip"]', function(){
        $(this).tooltip('show');
    });

    $(document).on('mouseleave','[data-toggle="tooltip"]', function(){
        $(this).tooltip('hide');
    });
    
  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom\resources\views/admin/leads/leads.blade.php ENDPATH**/ ?>
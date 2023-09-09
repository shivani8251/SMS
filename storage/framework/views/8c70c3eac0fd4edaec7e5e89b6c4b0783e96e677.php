<?php $__env->startSection('mytitle', 'Coupon Details'); ?>
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
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 weather-card">
            <div class="row">
              <div class="col-xl-12 col-md-6 col-12 user-profile-card">
                <div class="card">
                  <div class="card-body text-center">
                    <h4><?php echo e(isset($coupon->coupon_title) ? $coupon->coupon_title : ''); ?></h4>

                    <p><?php echo e(isset($coupon->email) ? $coupon->email : ''); ?></p>

                    <?php if(isset($coupon->discount_by)): ?>
                      <div class="d-flex justify-content-around mb-0">
                        <div class="card-icons d-flex flex-column">
                          <p class="mb-1"><strong>Discount Type : </strong><?php echo e($coupon->discount_by); ?></p>
                        </div>
                      </div>
                    

                      <?php if($coupon->discount_by=="Percentage"): ?>
                        <div class="d-flex justify-content-around mb-0">
                          <div class="card-icons d-flex flex-column">
                            <p class="mb-1"><strong>Discount : </strong><strong>&#8377; <?php echo e(isset($coupon->discount_upto) ? number_format($coupon->discount_upto, 2) : '0.00'); ?></strong> <?php echo e(isset($coupon->discount) ? '('.$coupon->discount.'%)' : '0%'); ?> </p>
                          </div>
                        </div>
                      <?php else: ?>
                        <div class="d-flex justify-content-around mb-0">
                          <div class="card-icons d-flex flex-column">
                            <p class="mb-1"><strong>Discount : </strong>&#8377; <?php echo e(isset($coupon->discount) ? number_format($coupon->discount, 2) : '0.00'); ?></p>
                          </div>
                        </div>
                      <?php endif; ?>                      
                    <?php endif; ?>

                    <?php if(isset($coupon->no_of_usage)): ?>
                      <div class="d-flex justify-content-around mb-0">
                        <div class="card-icons d-flex flex-column">
                          <p class="mb-1"><strong>No. of Usages : </strong>
                            <?php echo e($coupon->no_of_usage); ?>

                          </p>
                        </div>
                      </div>
                    <?php endif; ?>

                    <?php if(isset($coupon->is_active)): ?>
                      <div class="d-flex justify-content-around mb-0">
                        <div class="card-icons d-flex flex-column">
                          <p class="mb-1"><strong>Status : </strong>
                            <?php if($coupon->is_active=="Active"): ?>
                              <span class="badge badge-pill badge-light-success">Active</span>
                            <?php else: ?>
                              <span class="badge badge-pill badge-light-danger">Expired</span>
                            <?php endif; ?>
                          </p>
                        </div>
                      </div>
                    <?php endif; ?>

                    <?php if(isset($coupon->coupon_start_date) && isset($coupon->coupon_expiry_date)): ?>
                      <div class="d-flex justify-content-around mb-0">
                        <div class="card-icons d-flex flex-column">
                          <p class="mb-1"><strong>Coupon Validity </strong><br /><?php echo e(date("d-M-Y", strtotime($coupon->coupon_start_date))); ?> To <?php echo e(date("d-M-Y", strtotime($coupon->coupon_expiry_date))); ?></p>
                        </div>
                      </div>
                    <?php endif; ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <h6 class="float-left">Orders List</h6>
                    <input type="hidden" id="coupon-id" value="<?php echo e($coupon->id); ?>">
                  </div>
                  <div class="col-12">                            
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered w-100" id="coupon-orders-list-table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Invoice No.</th>
                            <th>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th>Status</th>
                            <th>Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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

    var coupon_id = $("#coupon-id").val();
    couponOrdersList(coupon_id);

    function couponOrdersList(coupon_id = "") {
      $('#coupon-orders-list-table').DataTable().clear().destroy();
      $("#coupon-orders-list-table").DataTable({
        serverSide: true,
        processing: true,
        searching: true,
        order: [],
        ajax: {
            url: "<?php echo e(route('promotion.couponOrdersServerSideTable')); ?>",
            type: "GET",
            data: {coupon_id: coupon_id}
        },
        "columns": [
          { data: 'order_id' },
          { data: 'invoice_number' },
          { data: 'date' },
          { data: 'status' },
          { data: 'total' },
          { data: 'actions' }
        ]
      });
    }

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom\resources\views/admin/promotions/coupons/view.blade.php ENDPATH**/ ?>
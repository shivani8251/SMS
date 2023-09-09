<?php $__env->startSection('mytitle', 'Backup'); ?>
<?php $__env->startSection('content'); ?>
<!-- BEGIN: Content-->
<style type="text/css">
  table th {
    font-size: 15px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 14px !important;
    padding: 10px !important;
  }

  .select2-container {
    width: 100% !important;
  }

  table.picker__table td {
    padding: 0 !important;
  }

  .daterangepicker .calendar-table th, .daterangepicker .calendar-table td {
     line-height: 12px; 
   }

  .dt-buttons{
    float: left !important;
    padding-bottom: 10px;
  }

  .checkbox label:after {
    content: ' ';
    height: 20px;
    width: 20px;
    border: 1px solid #888;
    position: absolute;
    border-radius: 4px;
    top: 0;
    left: 0;
    -webkit-transition: .1s ease-in-out;
    transition: .1s ease-in-out;
  }

  .checkbox input:checked~label:before {
    background-color: #FFF;
    border: 1px solid #888;
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
                    <h6 class="mb-1">BACKUP CAMPAIGNS</h6>
                  </div>

                  <input type="hidden" id="ids" />
                  <input type="hidden" id="todays-date" value="<?php echo e(date('d-m-Y').' - '.date('d-m-Y')); ?>">
                  <div class="col-12">
                    <hr />
                    <form id="search-form">
                      <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <select id="user-filter" class="form-control select2 filter-select2" data-placeholder="Select User">
                              <option value="All">All Users</option>
                              <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e(ucfirst($user->username).' ('.$user->user_unique_id.')'); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                          <div class="form-group position-relative has-icon-left">
                            <input type="text" class="form-control daterange" id="date-range" placeholder="Select date range" autocomplete="off" /> 
                            <div class="form-control-position">
                              <i class='bx bx-calendar-check'></i>
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
                          <div class="form-group">
                            
                            <button type="button" id="reset-btn" class="btn btn-secondary">Reset</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-12">
                    <hr class="mb-0 pb-0" />
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered w-100" id="whatsapp-report-table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Unique Id</th>
                            <th>Caption</th>
                            <th>Total Mob. No.</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Created User Type</th>
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

<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.js"></script>

<script>
  $(function() {

    $(document).on('click', '.delete-campaign-btn', function() {
      let id = $(this).data('id');
      $.confirm({
        title: 'Confirm!',
        type: 'red',
        content: 'Are you sure you want to permanently delete this campaign data ?',
        buttons: {
          yes: function() {
            $.get("<?php echo e(route('admin.campaign.delete')); ?>", {id}, function(res) {
              if(res.status)
              {
                toastr.success(res.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 1000
                });
                location.reload();
              }
              else
              {
                toastr.error(res.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 1000
                });
              }
            }, 'json');
          },
          no: function() {}
        }
      });
    });

    $(".daterange").daterangepicker({
      locale: {
        format: 'DD-MM-YYYY'
      },
      minYear: 1901,
      maxYear: parseInt(moment().format("YYYY"), 10),
      showDropdowns: !0
    });

    var selectedRow = [];

    $('#reset-btn').on('click', function(evt) {
      evt.preventDefault();
      var today = $("#todays-date").val();
      $('#user-filter').val('All').trigger('change');
      $('#date-range').val(today);
      reportTable('All', today);
    });

    $('#user-filter').on('change', function(evt) {
      evt.preventDefault();

      var user = this.value;
      var date_range = $('#date-range').val();
      reportTable(user, date_range);
    });

    $('#date-range').on('change', function(evt) {
      evt.preventDefault();

      var date_range = this.value;
      var user = $('#user-filter').val();
      reportTable(user, date_range);
    });

    var user = 'All';
    var date_range = $('#date-range').val();
    reportTable(user, date_range);
    function reportTable(user = 'All', date_range) {
      $('#whatsapp-report-table').DataTable().clear().destroy();

      var whatsappTable = $("#whatsapp-report-table").DataTable({
        serverSide: true,
        processing: true,
        searching: true,
        dom: 'lBfrtip',
        "aLengthMenu": [[25, 50, 100, 200, 300, 400, 500, 1000, -1], [25, 50, 100, 200, 300, 400, 500, 1000, "All"]],
        "iDisplayLength": 25,
        buttons: [
          {
            text: '<i class="bx bx-printer"></i> Print',
            className: 'btn-warning btn mb-0',
            extend : "print",
            attr: { id: 'print' },
            exportOptions: { columns: ":visible" },
          },
          {
            text: '<i class="bx bx-file"></i> CSV',
            className: 'btn-success btn mb-0',
            attr: { id: 'csv' },
            extend : "csv",
            filename: 'Campaigns-list',
          },
          
        ],
        order: [],
        ajax: {
            url: "<?php echo e(route('admin.backup.serverSideDataTable')); ?>",
            type: "GET",
            data: {
              user: user,
              date_range: date_range
            }
        },
        "columns": [
          { data: 'id' },
          { data: 'unique_id' },
          { data: 'caption' },
          { data: 'total_mobile' },
          { data: 'created_at' },
          { data: 'created_by' },
          { data: 'created_usertype' },
          { data: 'status' },
          { data: 'actions' }
        ]
      });

    }

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/programmicsdev/public_html/emp/proj/digitaltext.sms/resources/views/admin/backup/index.blade.php ENDPATH**/ ?>
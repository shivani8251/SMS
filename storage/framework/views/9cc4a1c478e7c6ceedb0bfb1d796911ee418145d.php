<?php
  $template = (Auth::user()->user_type=="admin") ? 'admin/app' : 'user/app';

  $campaignStatusUpdate = (Auth::user()->user_type=="admin") ? 'admin.campaign.status.update' : 'user.campaign.status.update';
  $serverSideDataTable = (Auth::user()->user_type=="admin") ? 'admin.whatsapp.report.serverSideDataTable' : 'user.whatsapp.report.serverSideDataTable';
?>



<?php $__env->startSection('mytitle', 'Whatsapp Report'); ?>
<?php $__env->startSection('content'); ?>
<!-- BEGIN: Content-->
<style type="text/css">
  table th {
    font-size: 14px !important;
    padding: 10px !important;
  }
  table tbody td {
    font-size: 15px !important;
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
                    <h6 class="mb-1">LIST OF ALL CAMPAIGN WISE</h6>
                  </div>
                  <input type="hidden" id="current-user-type" value="<?php echo e(Auth::user()->user_type); ?>">
                  <input type="hidden" id="ids" />
                  <input type="hidden" id="todays-date" value="<?php echo e(date('d-m-Y').' - '.date('d-m-Y')); ?>">
                  <div class="col-12">
                    <hr />
                    <form id="search-form">
                      <div class="row">
                        <?php if(Auth::user()->user_type=="admin" || Auth::user()->user_type=="reseller"): ?>
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
                        <?php endif; ?>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <select id="status-filter" class="form-control select2 filter-select2" data-placeholder="Select Status">
                              <option value="All">All Status</option>
                              <?php
                                $statuses = ['pending', 'process', 'sent', 'discard'];
                              ?>
                              <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($status); ?>"><?php echo e(ucfirst($status)); ?></option>
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
                            <th>
                              <div class="checkbox">
                                <input type="checkbox" class="checkbox-input" id="select-all">
                                <label for="select-all">ID</label>
                              </div>
                            </th>
                            <th>Estimate Time</th>
                            <th>Unique Id</th>
                            
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

<div id="change-status-modal" class="modal fade" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal modal-dialog-scrollable" role="document">
    <div class="modal-content tx-size-sm">
      <div class="modal-header pd-x-20">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Change Status</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pd-20">
        <form id="change-status-form" method="post">
          <?php echo csrf_field(); ?>
          <div class="row mb-3">
            <input type="hidden" name="rows" id="selected-rows" value="" required />
            <div class="col-lg-12">
              <div class="form-group">
                <select class="form-control" id="selected-status" name="status" data-placeholder="Choose Status" required>
                  <?php
                    $nstatuses = ['pending', 'process', 'sent', 'discard'];
                  ?>
                  <?php $__currentLoopData = $nstatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nstatus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($nstatus); ?>"><?php echo e(ucfirst($nstatus)); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-layout-footer">
            <button type="submit" class="btn btn-info mg-r-5">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.js"></script>

<script>
  $(function() {

    var currentUserType = $("#current-user-type").val();

    $(".daterange").daterangepicker({
      locale: {
        format: 'DD-MM-YYYY'
      },
      minYear: 1901,
      maxYear: parseInt(moment().format("YYYY"), 10),
      showDropdowns: !0
    });

    var selectedRow = [];

    var statusForm = $("#change-status-form").validate({
      // errorPlacement: function (error, element) {}
    });

    $("#change-status-form").submit(function(event) {
      event.preventDefault();
      if (statusForm.valid())
      {
        // $.confirm({
        //   title: 'Confirm!',
        //   type: 'red',
        //   content: 'Are you sure want to update status for selected campaigns ?',
        //   buttons: {
        //     yes: function() {
              $.post("<?php echo e(route($campaignStatusUpdate)); ?>", $('#change-status-form').serialize(), function(data){
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
              }, 'json');
      //       },
      //       no: function() {}
      //     }
      //   });
      }
    });

    $(document).on('click', '#change-status-btn', function(event) {
      var selIDs = $("#ids").val();
      if(selIDs!="")
      {
        $("#selected-rows").val(selIDs);
        $("#change-status-modal").modal('show');
      }
      else
      {
        var message = 'Please select atleast one row from the table';
        toastr.error(message, '', {
          closeButton: !0,
          tapToDismiss: !1,
          progressBar: true,
          timeOut: 1000
        });
      }
    });

    $('#reset-btn').on('click', function(evt) {
      evt.preventDefault();
      var today = $("#todays-date").val();
      $('#user-filter').val('All').trigger('change');
      $('#status-filter').val('All').trigger('change');
      $('#date-range').val(today);
      reportTable('All', 'All', today);
    });

    $('#user-filter').on('change', function(evt) {
      evt.preventDefault();

      var user = this.value;
      var status = $('#status-filter').val();
      var date_range = $('#date-range').val();
      reportTable(user, status, date_range);
    });

    $('#status-filter').on('change', function(evt) {
      evt.preventDefault();

      var status = this.value;
      var user = $('#user-filter').val();
      var date_range = $('#date-range').val();
      reportTable(user, status, date_range);
    });

    $('#date-range').on('change', function(evt) {
      evt.preventDefault();

      var date_range = this.value;
      var user = $('#user-filter').val();
      var status = $('#status-filter').val();
      reportTable(user, status, date_range);
    });

    var user = 'All';
    var status = 'All';
    var date_range = $('#date-range').val();
    reportTable(user, status, date_range);
    function reportTable(user = 'All', status = 'All', date_range) {
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
            text: 'Change Status',
            className: 'btn-success btn-sm mr-0',
            attr: {
              id: 'change-status-btn'
            }
          },
          // {
          //   text: '<i class="bx bxs-file-pdf"></i> PDF',
          //   className: 'btn-danger btn mb-0',
          //   extend : "pdfHtml5",
          //   exportOptions: { columns: ":visible" },
          //   attr: { id: 'pdf' },
          //   filename: 'Campaigns-list',
          // },
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
            url: "<?php echo e(route($serverSideDataTable)); ?>",
            type: "GET",
            data: {
              user: user,
              status: status,
              date_range: date_range
            }
        },
        select: {
          style: 'multi',
          selector: 'td:not(:last-child)'
        },
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        "columns": [
          { data: 'id' },
          { data: 'estimate_time' },
          { data: 'unique_id' },
          // { data: 'caption' },
          { data: 'total_mobile' },
          { data: 'created_at' },
          { data: 'created_by' },
          { data: 'created_usertype' },
          { data: 'status' },
          { data: 'actions' }
        ],
        // "createdRow": function( row, data, dataIndex )
        // {
        //   var starttime = new Date();
        //   var endtime = new Date(data['estimated_time']);
        //   var seconds = (endtime - starttime) / 1000;
        //   timedCount(seconds, dataIndex);          
        // }
      });

      if(currentUserType!='admin')
      {
        $("#change-status-btn").addClass('d-none');
      }

      function timedCount(s, index)
      {
        // console.log(index+'-'+s);
        // var c = parseFloat(s);
        var t;
        var hours = parseInt( s / 3600 ) % 24;
        var minutes = parseInt( s / 60 ) % 60;
        var seconds = s % 60;
        if(s>=0)
        {
          var result = (parseInt(hours) < 10 ? "0" + parseInt(hours) : parseInt(hours)) + ":" + (parseInt(minutes) < 10 ? "0" + parseInt(minutes) : parseInt(minutes)) + ":" + (parseInt(seconds)  < 10 ? "0" + parseInt(seconds) : parseInt(seconds));
        }
        else
        {
          var result = '2 Hours Expired';
        }
              
        $('#timer'+index).html(result);
        s = s - 1;
        t = setTimeout(function(){
         timedCount(s, index);
        }, 1000);
      }

      $('#select-all').on('click', function(){
        var rows = whatsappTable.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
        updateSelectedRowValues();
      });

      $('#whatsapp-report-table tbody').on('change', 'input[type="checkbox"]', function(){
        if(!this.checked)
        {
          var el = $('#select-all').get(0);
          if(el && el.checked && ('indeterminate' in el))
          {
            el.indeterminate = true;
          }
        }
      });

    }

    function updateSelectedRowValues() {
      $('input.select-ids').each(function(){
        if (this.checked)
        {
          selectedRow.push($(this).val());
          var ids = selectedRow.join(',');
          $("#ids").val(ids);
        }
        else
        {
          selectedRow.splice($.inArray($(this).val(), selectedRow), 1);
          var ids = selectedRow.join(',');
          $("#ids").val(ids);
        }
      });
    }

    $(document).on('change', '.select-ids', function(){
      if(this.checked)
      {
        selectedRow.push($(this).val());
        var ids = selectedRow.join(',');
        $("#ids").val(ids);
      }
      else
      {
        selectedRow.splice($.inArray($(this).val(), selectedRow), 1);
        var ids = selectedRow.join(',');
        $("#ids").val(ids);
      }
    });

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($template, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/programmicsdev/public_html/emp/proj/digitaltext.sms/resources/views/admin/reports/index.blade.php ENDPATH**/ ?>
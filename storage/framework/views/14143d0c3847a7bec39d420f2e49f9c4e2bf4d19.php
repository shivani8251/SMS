<?php $__env->startSection('mytitle', 'Students'); ?>
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
                    <h6>List of Students</h6>
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered w-100" id="student-list-table">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Profile Pic</th>
                            <th>School Proof</th>
                            <th>Name</th>
                            <th>Mobile Number</th>
                            <th>Email</th>
                            <th>Date Of Birth</th>
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

    $(document).on('click', '.deactivate-student-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to deactivate this student ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('student.deactivate')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#student-list-table').DataTable().ajax.reload();
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

    $(document).on('click', '.activate-student-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to activate this student ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('student.activate')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#student-list-table').DataTable().ajax.reload();
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

    $(document).on('click', '.delete-student-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to delete this student data ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('student.delete')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#student-list-table').DataTable().ajax.reload();
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

    /*---------------------Starting of query for Category----------------------*/

      studentListTable();
      function studentListTable() {
        $('#student-list-table').DataTable().clear().destroy();

        $("#student-list-table").DataTable({
          serverSide: true,
          processing: true,
          searching: true,
          order: [],
          ajax: {
              url: "<?php echo e(route('student.serverSideDataTable')); ?>",
              type: "GET",
              data: {}
          },
          "columns": [
            { data: 'id' },
            { data: 'profile_pic' },
            { data: 'schoolid_proof' },
            { data: 'name' },
            { data: 'mobileno' },
            { data: 'email' },
            { data: 'date_of_birth' },
            { data: 'status' },
            { data: 'actions' },
          ]
        });
      }

    /*---------------------Ending of query for Categories----------------------*/

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shreeswastik\resources\views/admin/students/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('mytitle', 'List of Associates'); ?>
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
                <h4 class="card-title mb-0">List of Associates</h4>
                <div class="float-right">
                  <a href="<?php echo e(route('admin.newAssociate')); ?>" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> Add</a>
                </div>
              </div>
              <div class="card-body">

                <div class="table-responsive">
                  <table class="table table-striped table-bordered w-100" id="employee-list-table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Profile Pic</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Aadhar No.</th>
                        <th>Aadhar (Front)</th>
                        <th>Aadhar (Back)</th>
                        <th>PAN No.</th>
                        <th>PAN Pic</th>
                        <th>Experience (Years)</th>
                        <th>Experience (Category)</th>
                        <th>Is Reg. ?</th>
                        <th>Reg. No.</th>
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
      </section>

    </div>
  </div>
</div>
<!-- END: Content-->


<div class="modal fade text-left w-100" id="select-property-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel16">Select Property</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="select-property-form">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Property</label>
                <select id="select-property" class="form-control select2" data-placeholder="Select Property">
                  <option value="">--Select--</option>
                  <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($property->id); ?>"><?php echo e($property->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">Assigned Properties :-</label>
                <div id="assigned-properties-list" class="m-0 p-0"></div>
              </div>
            </div>

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="next-btn" class="btn btn-primary ml-1" data-dismiss="modal">
          <i class="bx bx-skip-next-circle d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Next</span>
        </button>
        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
          <i class="bx bx-x d-block d-sm-none"></i>
          <span class="d-none d-sm-block">Close</span>
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-left w-100" id="property-permissions-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel16">Property Permissions <span id="assignedPropertyName"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <form id="property-permissions-form">
          <?php echo csrf_field(); ?>
          <div class="row">
            <div class="col-12 mb-1">
              <input type="hidden" name="assign_id" id="assign_id">
              <input type="hidden" value="" name="property_id" id="propertyId">
              <input type="hidden" value="" name="user_id" id="userId">
              <input type="hidden" value="" class="form-control" name="module_ids" id="module_ids">
            </div>
          </div>
          <div class="row mb-0">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input checkAll" value="checkAll" name="checkAll" id="checkAll">
                  <label for="checkAll" class="text-success">Check All</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 mb-1"><hr /></div>
          </div>
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_name" name="propertyName" id="property_name">
                  <label for="property_name">Property Name</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_city" name="propertyCity" id="property_city">
                  <label for="property_city">City</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_location" name="propertyAddress" id="property_location">
                  <label for="property_location">Location</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_front" name="propertyFront" id="property_front">
                  <label for="property_front">Front</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_deep" name="propertyDeep" id="property_deep">
                  <label for="property_deep">Deep</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_area" name="propertyArea" id="property_area">
                  <label for="property_area">Area</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_price" name="propertyPrice" id="property_price">
                  <label for="property_price">Price</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="registry_price" name="registryPrice" id="registry_price">
                  <label for="registry_price">Registry Price</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="gmap_location" name="gmapLocation" id="gmap_location">
                  <label for="gmap_location">GMAP Location</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="land_type" name="landType" id="land_type">
                  <label for="land_type">Type of land</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_diverted" name="diverted" id="property_diverted">
                  <label for="property_diverted">Diverted</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="boundary_wall" name="boundaryWall" id="boundary_wall">
                  <label for="boundary_wall">Boundary Wall</label>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_bore" name="bore" id="property_bore">
                  <label for="property_bore">Bore</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="no_of_bores" name="noOfBores" id="no_of_bores">
                  <label for="no_of_bores">Number Of Bores</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="google_naksha" name="googleNaksha" id="google_naksha">
                  <label for="google_naksha">Google Naksha</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="plot_facing" name="plotFacing" id="plot_facing">
                  <label for="plot_facing">Plot Facing</label>
                </div>
              </div>
            </div>
             <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="source_of_property" name="propertySouce" id="source_of_property">
                  <label for="source_of_property">Source Of Property</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="verified_property" name="verifiedProperty" id="verified_property">
                  <label for="verified_property">Verified Property</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="extension_of_area" name="extensionOfArea" id="extension_of_area">
                  <label for="extension_of_area">Extension Of Area</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="depth_from_road" name="depthFromRoad" id="depth_from_road">
                  <label for="depth_from_road">Depth From Road</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="adiwasi_land" name="aadiwasiLand" id="adiwasi_land">
                  <label for="adiwasi_land">Aadiwasi Land</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="no_of_registry" name="noOfRegistry" id="no_of_registry">
                  <label for="no_of_registry">Number Of Registry</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="registry_papers" name="registryPapers" id="registry_papers">
                  <label for="registry_papers">Registry Papers</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="khasra_no" name="khasraNo" id="khasra_no">
                  <label for="khasra_no">Khasra Number</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="khasra_name" name="khasraName" id="khasra_name">
                  <label for="khasra_name">Khasra Name</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_b_one" name="bone" id="property_b_one">
                  <label for="property_b_one">B1</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_p_two" name="ptwo" id="property_p_two">
                  <label for="property_p_two">P2</label>
                </div>
              </div>
            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_chauhaddi" name="chauhaddi" id="property_chauhaddi">
                  <label for="property_chauhaddi">Chauhaddi</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="patwari_naksha" name="patwariNaksha" id="patwari_naksha">
                  <label for="patwari_naksha">Patwari Naksha</label>
                </div>
              </div>
            </div>
            
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_misal" name="misal" id="property_misal">
                  <label for="property_misal">Misal</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="adhikar_abhhilekh" name="adhikarAbhilekh" id="adhikar_abhhilekh">
                  <label for="adhikar_abhhilekh">Adhikar Abhilekh</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="bhu_upyogita" name="bhuUpyogita" id="bhu_upyogita">
                  <label for="bhu_upyogita">Bhu Upyogita</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="namantran_panji" name="namantranPanji" id="namantran_panji">
                  <label for="namantran_panji">Namantran Panji</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="nistar_patrak" name="nistarPatrak" id="nistar_patrak">
                  <label for="nistar_patrak">Nistar Patrak</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="rin_pustika" name="rinPustika" id="rin_pustika">
                  <label for="rin_pustika">Rin Pustika</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_mutation" name="propertyMutation" id="property_mutation">
                  <label for="property_mutation">Mutation</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="extra_documents" name="extraDocuments" id="extra_documents">
                  <label for="extra_documents">Extra Document</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_remark" name="propertyRemark" id="property_remark">
                  <label for="property_remark">Remark</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_photos" name="photos" id="property_photos">
                  <label for="property_photos">Photos</label>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="form-group">
                <div class="checkbox">
                  <input type="checkbox" class="checkbox-input properties_ckeck" value="property_videos" name="videos" id="property_videos">
                  <label for="property_videos">Videos</label>
                </div>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
            <button type="submit" id="search-btn" class="btn btn-primary ml-1">
              <i class="bx bx-skip-next-circle d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Submit</span>
            </button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>

  function handlechange() {
    var modules = [];
    $(".properties_ckeck").each(function() {
      if ($(this).prop("checked")) {
        modules.push($(this).val());
      }
    });
    $("#module_ids").val(modules.join(","));
  }
  $(function() {

    $("#checkAll").click(function(){
        $(".properties_ckeck").prop('checked', $(this).prop('checked'));
        handlechange();
    });

    var propertyForm = $("#property-permissions-form").validate({
      errorPlacement: function (error, element) {}
    });

    $("#property-permissions-form").submit(function(event) {
      event.preventDefault();

      if (propertyForm.valid())
      {
        $.post("<?php echo e(route('admin.savePermissionData')); ?>", $(this).serialize(), function(data) {
          // console.log(data);
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
      }
    });

    $(document).on("change", ".properties_ckeck", function() {
      handlechange();
    });

    $(document).on("click", ".assign-property-btn", function() {
      let userid = $(this).data("id");
      $("#userId").val(userid);
      $.get("<?php echo e(route('admin.loadAssignedProperties')); ?>", {userid}, function(data) {
        if (data!="")
        {
          let names = "";
          let opts = '<option value="">--Select--</option>';
          $.each(data.properties, function(ind, val) {
            names += '<p class="alert border-success alert-dismissible mt-1 mb-0">'+
            '<a class="update-assigned-property-btn" data-id="'+val.property_id+'" href="javascript:void(0);">'+
              val.name+'</a>'+
              '<span class="float-left">'+
              '<a class="text-danger remove-property-option" data-id="'+val.assign_id+'" href="javascript:void(0);">'+
                '<i class="bx bx-x-circle"></i>'+
              '</a>'+
            '</span></p>';
          });
          $.each(data.options, function(i, option) {
            opts += '<option value="'+option.id+'">'+option.name+'</option>';
          });
          $("#assigned-properties-list").html(names);
          $("#select-property").html(opts);
        }
        else
        {
          $("#assigned-properties-list").html('<p class="alert border-danger alert-dismissible mt-1 mb-0">No Properties Assigned</p>');
        }
      }, 'json');
      $("#select-property-modal").modal("show");
    });

    $('#select-property-modal').on('hidden.bs.modal', function () {
      $(".select2").val('').trigger("change");
      $('#select-property-form')[0].reset();
      $("#next-btn").attr("disabled", true);
    });

    $('#property-permissions-modal').on('hidden.bs.modal', function () {
      $(".select2").val('').trigger("change");
      $('#property-permissions-form')[0].reset();
    });


    $("#next-btn").attr("disabled", true);
    $("#select-property").on("change", function() {
      if (this.value!="") {
        $("#next-btn").attr("disabled", false);
      }
    });

    $(document).on("click", ".update-assigned-property-btn", function() {
      let id = $(this).data("id");
      let userid = $("#userId").val();
      $("#select-property-modal").modal("hide");
      $("#property-permissions-modal").modal("show");
      $("#propertyId").val(id);
      $.get("<?php echo e(route('admin.checkAssignedPropertiesAvailability')); ?>", {id, userid}, function(data) {
        if (data!="")
        {
          let moduleIds = data.module_ids;
          var stuffArray = moduleIds.split(","); 
          $("#module_ids").val(moduleIds);
          $("#assign_id").val(data.id);
          $("#assignedPropertyName").html(" For Property "+data.name);
          $("#checkAll").attr('checked', 'checked');
          $.each(stuffArray, function(index, argument) {
            $("#"+argument).attr('checked', 'checked');
          });
        }
      }, 'json');
    });

    $("#next-btn").on("click", function() {
      let id = $("#select-property").val();
      $("#select-property-modal").modal("hide");
      $("#property-permissions-modal").modal("show");
      $("#propertyId").val(id);
    });

    $("#employee-list-table").DataTable({
      serverSide: true,
      processing: true,
      searching: true,
      order: [],
      ajax: {
          url: "<?php echo e(route('admin.employeeServerSideTable')); ?>",
          type: "GET",
          data: {}
      },
      "columns": [
        { data: 'id' },
        { data: 'name' },
        { data: 'username' },
        { data: 'profile_pic' },
        { data: 'email' },
        { data: 'contact_no' },
        { data: 'aadhar_card_no' },
        { data: 'aadhar_card_front' },
        { data: 'aadhar_card_back' },
        { data: 'pan_card_no' },
        { data: 'pan_card_pic' },
        { data: 'experience_year' },
        { data: 'experience_category' },
        { data: 'is_rera_registered' },
        { data: 'rera_reg_no' },
        { data: 'status' },
        { data: 'actions' }
      ],
    });

    $(document).on('click', '.remove-property-option', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to remove this property ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('admin.removeAssignedProperty')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          location.reload();
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
    

    $(document).on('click', '.delete-employee-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to delete this employee ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('admin.deleteEmployee')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#employee-list-table').DataTable().ajax.reload();
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


    $(document).on('click', '.block-employee-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to block this employee ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('admin.blockEmployee')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#employee-list-table').DataTable().ajax.reload();
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

    $(document).on('click', '.unblock-employee-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to unblock this employee ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('admin.unblockEmployee')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#employee-list-table').DataTable().ajax.reload();
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

    $(document).on('mouseenter','[data-toggle="tooltip"]', function(){
        $(this).tooltip('show');
    });

    $(document).on('mouseleave','[data-toggle="tooltip"]', function(){
        $(this).tooltip('hide');
    });

  });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/propepjx/public_html/resources/views/admin/employee/employees.blade.php ENDPATH**/ ?>
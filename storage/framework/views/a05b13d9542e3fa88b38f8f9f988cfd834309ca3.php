<?php $__env->startSection('mytitle', 'List of Properties'); ?>
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
                <h4 class="card-title mb-0">List of Properties</h4>
              </div>
              <div class="card-body">
                <fieldset class="mb-1">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-success" name="searchCheck" id="searchCheck">
                    <label class="custom-control-label" for="searchCheck">Search Options</label>
                  </div>
                </fieldset>
                <div class="row filter-group d-none">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Property ID</label>
                      <input type="text" id="property_id" class="form-control" placeholder="Enter Property ID" />
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Property Name</label>
                      <input type="text" id="property_name" class="form-control" placeholder="Enter Property Name" />
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Khasra Number</label>
                      <input type="text" id="khasra_no" class="form-control" placeholder="Enter Khasra Number" />
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Khasra Name</label>
                      <input type="text" id="khasra_name" class="form-control" placeholder="Enter Khasra Name" />
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Diverted</label>
                      <select id="diverted" class="form-control">
                        <option value="">All</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Type of Land</label>
                      <select id="type_of_land" class="form-control">
                        <option value="">All</option>
                        <option value="Aggricultural">Aggricultural</option>
                        <option value="Commercial">Commercial</option>
                        <option value="Residential">Residential</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label">Area</label>
                      <div class="row">
                        <div class="col-lg-4">
                          <input type="text" id="from_area" class="form-control" placeholder="Enter From Area" />
                        </div>
                        <div class="col-lg-4">
                          <input type="text" id="to_area" class="form-control" placeholder="Enter To Area" />
                        </div>
                        <div class="col-lg-4">
                          <select id="area_unit" class="form-control">
                            <option value="">--Unit--</option>
                            <option value="Sqft">Sqft</option>
                            <option value="Acre">Acre</option>
                            <option value="Hectare">Hectare</option>
                            <option value="Dismil">Dismil</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label">Price</label>
                      <div class="row">
                        <div class="col-lg-6">
                          <input type="text" id="from_price" class="form-control" placeholder="Enter From Price" />
                        </div>
                        <div class="col-lg-6">
                          <input type="text" id="to_price" class="form-control" placeholder="Enter To Price" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Location</label>
                      <input type="text" id="location" class="form-control" placeholder="Enter Location" />
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Boundary Wall</label>
                      <select id="boundary_wall" class="form-control">
                        <option value="">All</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Bore</label>
                      <select id="bore" class="form-control">
                        <option value="">All</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Number of Registry</label>
                      <input type="text" id="no_of_registry" class="form-control" placeholder="Enter Number of Registry" />
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Aadiwasi Land</label>
                      <select id="aadiwasi_land" class="form-control">
                        <option value="">All</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label class="form-control-label">Verified Property</label>
                      <select id="verified_property" class="form-control">
                        <option value="">All</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <button type="button" id="search-btn" class="btn btn-primary">Search</button>
                    </div>
                  </div>

                </div>
                <!-- State table -->
                <!-- <div class="float-right">
                  <a href="" id="add-state-btn" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i> Add</a>
                </div> -->
                <div class="table-responsive">
                  <table class="table table-striped table-bordered w-100" id="property-list-table">
                    <thead>
                      <tr>
                        <th>Prperty ID</th>
                        <th>Name</th>
                        <th>Type of Land</th>
                        <th>Area</th>
                        <th>Price Range</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>                                   
                  </table>
                </div>
                <!--/ State table -->
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

    $("#searchCheck").on("change", function() {
      if (this.checked)
      {
        // $(this).attr("checked", true);
        $(".filter-group").removeClass("d-none");
      }
      else
      {
        $(".filter-group").addClass("d-none");
        // $(this).attr("checked", false);
      }
    });

    $("#search-btn").on("click", function() {
      let property_id = $("#property_id").val();
      let property_name = $("#property_name").val();
      let khasra_no = $("#khasra_no").val();
      let khasra_name = $("#khasra_name").val();
      let diverted = $("#diverted").val();
      let type_of_land = $("#type_of_land").val();
      let from_area = $("#from_area").val();
      let to_area = $("#to_area").val();
      let area_unit = $("#area_unit").val();
      let from_price = $("#from_price").val();
      let to_price = $("#to_price").val();
      let location = $("#location").val();
      let boundary_wall = $("#boundary_wall").val();
      let bore = $("#bore").val();
      let no_of_registry = $("#no_of_registry").val();
      let aadiwasi_land = $("#aadiwasi_land").val();
      let verified_property = $("#verified_property").val();

      propertyListTable(property_id, property_name, khasra_no, khasra_name, diverted, type_of_land, from_area, to_area, area_unit, from_price, to_price, location, boundary_wall, bore, no_of_registry, aadiwasi_land, verified_property);
    });

    let property_id = $("#property_id").val();
    let property_name = $("#property_name").val();
    let khasra_no = $("#khasra_no").val();
    let khasra_name = $("#khasra_name").val();
    let diverted = $("#diverted").val();
    let type_of_land = $("#type_of_land").val();
    let from_area = $("#from_area").val();
    let to_area = $("#to_area").val();
    let area_unit = $("#area_unit").val();
    let from_price = $("#from_price").val();
    let to_price = $("#to_price").val();
    let location = $("#location").val();
    let boundary_wall = $("#boundary_wall").val();
    let bore = $("#bore").val();
    let no_of_registry = $("#no_of_registry").val();
    let aadiwasi_land = $("#aadiwasi_land").val();
    let verified_property = $("#verified_property").val();
    propertyListTable(property_id, property_name, khasra_no, khasra_name, diverted, type_of_land, from_area, to_area, area_unit, from_price, to_price, location, boundary_wall, bore, no_of_registry, aadiwasi_land, verified_property);

    function propertyListTable(property_id = '', property_name = '', khasra_no = '', khasra_name = '', diverted = '', type_of_land = '', from_area = '', to_area = '', area_unit = '', from_price = '', to_price = '', location = '', boundary_wall = '', bore = '', no_of_registry = '', aadiwasi_land = '', verified_property = '') {
      $('#property-list-table').DataTable().clear().destroy();

      $("#property-list-table").DataTable({
        serverSide: true,
        processing: true,
        searching: true,
        ajax: {
            url: "<?php echo e(route('admin.propertyServerSideTable')); ?>",
            type: "GET",
            data: {
              property_id: property_id,
              property_name: property_name,
              khasra_no: khasra_no,
              khasra_name: khasra_name,
              diverted: diverted,
              type_of_land: type_of_land,
              from_area: from_area,
              to_area: to_area,
              area_unit: area_unit,
              from_price: from_price,
              to_price: to_price,
              location: location,
              boundary_wall: boundary_wall,
              bore: bore,
              no_of_registry: no_of_registry,
              aadiwasi_land: aadiwasi_land,
              verified_property: verified_property
            }
        },
        "columns": [
          { data: 'id' },
          { data: 'name' },
          { data: 'land_type' },
          { data: 'area' },
          { data: 'price' },
          { data: 'location' },
          { data: 'status' },
          { data: 'actions' },
        ]
      });
    }

    $(document).on('click', '.delete-property-btn', function() {
        let id = $(this).data('id');
        $.confirm({
            title: 'Confirm!',
            type: 'red',
            content: 'Are you sure want to delete this property ?',
            buttons: {
              yes: function() {
                  $.get("<?php echo e(route('admin.deleteProperty')); ?>", {
                      id
                  }, function(data) {
                      if (data.status) {
                          toastr.success(data.message, '', {
                              closeButton: !0,
                              tapToDismiss: !1,
                              progressBar: true,
                              timeOut: 2000
                          });
                          $('#property-list-table').DataTable().ajax.reload();
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

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pbird\resources\views/admin/properties.blade.php ENDPATH**/ ?>
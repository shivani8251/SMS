<?php $__env->startSection('mytitle', 'List of Properties (Map View)'); ?>
<?php $__env->startSection('content'); ?>
<!-- BEGIN: Content-->

<style type="text/css">
  .list-group-item {
    padding: .5rem .7rem;
    cursor: pointer;
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
              <div class="card-header">
                <h4 class="card-title mb-0">List of Properties (Map View)</h4>
              </div>
              <div class="card-body">
                <fieldset class="mb-1">
                  <div class="row">
                    <div class="col-2">
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input bg-success" name="searchCheck" id="searchCheck">
                        <label class="custom-control-label" for="searchCheck">Search Options</label>
                      </div>
                    </div>
                    <div class="col-10">
                      <form>
                        <div class="row float-right">
                          <div class="col-4">
                            <label class="form-control-label float-right mt-0">View Property&nbsp;:-</label>
                          </div>
                          <div class="col-8" id="view-filer-group">
                            <div class="form-group">
                              <select id="view-filer" class="form-control select2 float-right">
                                <option value="All">All</option>
                                <option value="ListedByMe">Listed by Me</option>
                                <option value="ListedByAssociate">Listed By Associate</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-4 d-none" id="user-filer-group">
                            <div class="form-group">
                              <select id="user-filer" class="form-control select2 float-right" data-placeholder="Select Associate">
                                <option value="">--Select Associate--</option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </fieldset>
                <form id="filter-form">
                  <div class="row filter-group d-none">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label">Property ID</label>
                        <select id="property_id" class="form-control select2" data-placeholder="Select Property Id">
                          <option value="">--Select--</option>
                          <?php $__currentLoopData = $propertyIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertyId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($propertyId); ?>"><?php echo e($propertyId); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label">Property Name</label>
                        <select id="property_name" class="form-control select2" data-placeholder="Select Property Name">
                          <option value="">--Select--</option>
                          <?php $__currentLoopData = $propertyNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertyName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($propertyName); ?>"><?php echo e($propertyName); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label">Khasra Number</label>
                        <select id="khasra_no" class="form-control select2" data-placeholder="Select Khasra No.">
                          <option value="">--Select--</option>
                          <?php $__currentLoopData = $khasraNos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $khasraNo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($khasraNo); ?>"><?php echo e($khasraNo); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label">Khasra Name</label>
                        <select id="khasra_name" class="form-control select2" data-placeholder="Select Khasra Name">
                          <option value="">--Select--</option>
                          <?php $__currentLoopData = $khasraNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $khasraName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($khasraName); ?>"><?php echo e($khasraName); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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
                      <label class="form-control-label">Front</label>
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select id="from_front" class="form-control select2" data-placeholder="Select Front" >
                              <option value="">--Select--</option>
                              <?php $__currentLoopData = $fronts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $front): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($front); ?>"><?php echo e($front); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select id="to_front" class="form-control select2" data-placeholder="Select Front" >
                              <option value="">--Select--</option>
                              <?php $__currentLoopData = $fronts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $front): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($front); ?>"><?php echo e($front); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select id="front_unit" class="form-control">
                              <option value="">--Unit--</option>
                              <option value="Metre">Metre</option>
                              <option value="Feet">Feet</option>
                              <option value="Yard">Yard</option>
                              <option value="KM">KM</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-control-label">Deep</label>
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select id="from_deep" class="form-control select2" data-placeholder="Select Deep" >
                              <option value="">--Select--</option>
                              <?php $__currentLoopData = $deeps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($deep); ?>"><?php echo e($deep); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select id="to_deep" class="form-control select2" data-placeholder="Select Deep" >
                              <option value="">--Select--</option>
                              <?php $__currentLoopData = $deeps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($deep); ?>"><?php echo e($deep); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select id="deep_unit" class="form-control">
                              <option value="">--Unit--</option>
                              <option value="Metre">Metre</option>
                              <option value="Feet">Feet</option>
                              <option value="Yard">Yard</option>
                              <option value="KM">KM</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-control-label">Area</label>
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select id="from_area" class="form-control select2" data-placeholder="From Area" >
                              <option value="">--Select--</option>
                              <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($area); ?>"><?php echo e($area); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select id="to_area" class="form-control select2" data-placeholder="To Area" >
                              <option value="">--Select--</option>
                              <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($area); ?>"><?php echo e($area); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select id="area_unit" class="form-control">
                              <option value="">--Unit--</option>
                              <option value="Sqft">Sqft</option>
                              <option value="Sqmt">Sqmt</option>
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
                            <select id="from_price" class="form-control select2" data-placeholder="From Price">
                              <option value="">All</option>
                              <?php
                              $fromPrices = ["1000", "2000", "5000", "10000", "20000", "50000", "100000", "500000", "1000000", "5000000", "10000000"];
                              ?>
                              <?php $__currentLoopData = $fromPrices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fromPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($fromPrice); ?>"><?php echo e($fromPrice); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                          <div class="col-lg-6">
                            <select id="to_price" class="form-control select2" data-placeholder="To Price">
                              <option value="">All</option>
                              <?php
                              $toPrices = ["1000", "2000", "5000", "10000", "20000", "50000", "100000", "500000", "1000000", "5000000", "10000000"];
                              ?>
                              <?php $__currentLoopData = $toPrices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toPrice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($toPrice); ?>"><?php echo e($toPrice); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label">Location</label>
                        <select id="location" class="form-control select2" data-placeholder="Location">
                          <option value="">--Select--</option>
                          <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($location); ?>"><?php echo e($location); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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
                        <select type="text" id="no_of_registry" class="form-control select2"data-placeholder="Number of Registry">
                          <option value="">--Select--</option>
                          <?php $__currentLoopData = $noOfRegs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noOfReg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($noOfReg); ?>"><?php echo e($noOfReg); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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
                        <label class="form-control-label">Source of Property</label>
                        <select id="source_of_property" class="form-control select2"data-placeholder="Source of Property">
                          <option value="">--Select--</option>
                          <?php $__currentLoopData = $propertySources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertySource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($propertySource); ?>"><?php echo e($propertySource); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label">Plot Facing</label>
                        <select id="plot_facing" class="form-control select2"data-placeholder="Plot Facing">
                          <option value="">--Select--</option>
                          <?php $__currentLoopData = $plotFacings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plotFacing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($plotFacing); ?>"><?php echo e($plotFacing); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6"></div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <button type="button" id="search-btn" class="btn btn-primary">Search</button>
                        <button type="button" id="reset-btn" class="btn btn-secondary">Reset</button>
                      </div>
                    </div>

                  </div>
                </form>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="leaflet-map" id="propertiesMap"></div>
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

    $("#user-filer").on("change", function() {
      let userfiler = $(this).val();
      let viewfiler = $("#view-filer").val();

      let property_id = $("#property_id").val();
      let property_name = $("#property_name").val();
      let khasra_no = $("#khasra_no").val();
      let khasra_name = $("#khasra_name").val();
      let diverted = $("#diverted").val();
      let type_of_land = $("#type_of_land").val();

      let from_area = $("#from_area").val();
      let to_area = $("#to_area").val();
      let area_unit = $("#area_unit").val();

      let from_front = $("#from_front").val();
      let to_front = $("#to_front").val();
      let front_unit = $("#front_unit").val();

      let from_deep = $("#from_deep").val();
      let to_deep = $("#to_deep").val();
      let deep_unit = $("#deep_unit").val();

      let from_price = $("#from_price").val();
      let to_price = $("#to_price").val();
      let location = $("#location").val();
      let boundary_wall = $("#boundary_wall").val();
      let bore = $("#bore").val();
      let no_of_registry = $("#no_of_registry").val();
      let aadiwasi_land = $("#aadiwasi_land").val();
      let verified_property = $("#verified_property").val();

      let source_of_property = $("#source_of_property").val();
      let plot_facing = $("#plot_facing").val();

      propertyListMap(userfiler, viewfiler, property_id, property_name, khasra_no, khasra_name, diverted, type_of_land, from_area, to_area, area_unit, from_front, to_front, front_unit, from_deep, to_deep, deep_unit, from_price, to_price, location, boundary_wall, bore, no_of_registry, aadiwasi_land, verified_property, source_of_property, plot_facing);
    });

    $("#view-filer").on("change", function() {
      let viewfiler = $(this).val();

      if(viewfiler=="ListedByAssociate")
      {
        $("#view-filer-group").removeClass("col-8");
        $("#view-filer-group").addClass("col-4");
        $("#user-filer-group").removeClass("d-none");
      }
      else
      {
        $("#view-filer-group").addClass("col-8");
        $("#view-filer-group").removeClass("col-4");
        $("#user-filer-group").addClass("d-none");
        $("#user-filer").val("").trigger("change");
      }

      let userfiler = $("#user-filer").val();
      let property_id = $("#property_id").val();
      let property_name = $("#property_name").val();
      let khasra_no = $("#khasra_no").val();
      let khasra_name = $("#khasra_name").val();
      let diverted = $("#diverted").val();
      let type_of_land = $("#type_of_land").val();

      let from_area = $("#from_area").val();
      let to_area = $("#to_area").val();
      let area_unit = $("#area_unit").val();

      let from_front = $("#from_front").val();
      let to_front = $("#to_front").val();
      let front_unit = $("#front_unit").val();

      let from_deep = $("#from_deep").val();
      let to_deep = $("#to_deep").val();
      let deep_unit = $("#deep_unit").val();

      let from_price = $("#from_price").val();
      let to_price = $("#to_price").val();
      let location = $("#location").val();
      let boundary_wall = $("#boundary_wall").val();
      let bore = $("#bore").val();
      let no_of_registry = $("#no_of_registry").val();
      let aadiwasi_land = $("#aadiwasi_land").val();
      let verified_property = $("#verified_property").val();

      let source_of_property = $("#source_of_property").val();
      let plot_facing = $("#plot_facing").val();

      propertyListMap(userfiler, viewfiler, property_id, property_name, khasra_no, khasra_name, diverted, type_of_land, from_area, to_area, area_unit, from_front, to_front, front_unit, from_deep, to_deep, deep_unit, from_price, to_price, location, boundary_wall, bore, no_of_registry, aadiwasi_land, verified_property, source_of_property, plot_facing);
    });

    $("#reset-btn").on("click", function() {
      $('#filter-form')[0].reset();
      $(".select2").val('').trigger("change");
      $("#view-filer").val('All').trigger("change");
    });

    $("#search-btn").on("click", function() {
      let userfiler = $("#user-filer").val();
      let property_id = $("#property_id").val();
      let property_name = $("#property_name").val();
      let khasra_no = $("#khasra_no").val();
      let khasra_name = $("#khasra_name").val();
      let diverted = $("#diverted").val();
      let type_of_land = $("#type_of_land").val();

      let from_area = $("#from_area").val();
      let to_area = $("#to_area").val();
      let area_unit = $("#area_unit").val();

      let from_front = $("#from_front").val();
      let to_front = $("#to_front").val();
      let front_unit = $("#front_unit").val();

      let from_deep = $("#from_deep").val();
      let to_deep = $("#to_deep").val();
      let deep_unit = $("#deep_unit").val();

      let from_price = $("#from_price").val();
      let to_price = $("#to_price").val();
      let location = $("#location").val();
      let boundary_wall = $("#boundary_wall").val();
      let bore = $("#bore").val();
      let no_of_registry = $("#no_of_registry").val();
      let aadiwasi_land = $("#aadiwasi_land").val();
      let verified_property = $("#verified_property").val();

      let source_of_property = $("#source_of_property").val();
      let plot_facing = $("#plot_facing").val();

      propertyListMap(userfiler, "All", property_id, property_name, khasra_no, khasra_name, diverted, type_of_land, from_area, to_area, area_unit, from_front, to_front, front_unit, from_deep, to_deep, deep_unit, from_price, to_price, location, boundary_wall, bore, no_of_registry, aadiwasi_land, verified_property, source_of_property, plot_facing);
    });

    let userfiler = $("#user-filer").val();
    let property_id = $("#property_id").val();
    let property_name = $("#property_name").val();
    let khasra_no = $("#khasra_no").val();
    let khasra_name = $("#khasra_name").val();
    let diverted = $("#diverted").val();
    let type_of_land = $("#type_of_land").val();

    let from_area = $("#from_area").val();
    let to_area = $("#to_area").val();
    let area_unit = $("#area_unit").val();

    let from_front = $("#from_front").val();
    let to_front = $("#to_front").val();
    let front_unit = $("#front_unit").val();

    let from_deep = $("#from_deep").val();
    let to_deep = $("#to_deep").val();
    let deep_unit = $("#deep_unit").val();

    let from_price = $("#from_price").val();
    let to_price = $("#to_price").val();
    let location = $("#location").val();
    let boundary_wall = $("#boundary_wall").val();
    let bore = $("#bore").val();
    let no_of_registry = $("#no_of_registry").val();
    let aadiwasi_land = $("#aadiwasi_land").val();
    let verified_property = $("#verified_property").val();

    let source_of_property = $("#source_of_property").val();
    let plot_facing = $("#plot_facing").val();

    propertyListMap(userfiler, "All", property_id, property_name, khasra_no, khasra_name, diverted, type_of_land, from_area, to_area, area_unit, from_front, to_front, front_unit, from_deep, to_deep, deep_unit, from_price, to_price, location, boundary_wall, bore, no_of_registry, aadiwasi_land, verified_property, source_of_property, plot_facing);

    

    function propertyListMap(userfiler = '', viewfiler = 'All', property_id = '', property_name = '', khasra_no = '', khasra_name = '', diverted = '', type_of_land = '', from_area = '', to_area = '', area_unit = '', from_front = '', to_front = '', front_unit = '', from_deep = '', to_deep = '', deep_unit = '', from_price = '', to_price = '', location = '', boundary_wall = '', bore = '', no_of_registry = '', aadiwasi_land = '', verified_property = '', source_of_property = '', plot_facing = '') {
      
      $.ajax({
          type: 'GET',
          url: '<?php echo e(route("admin.propertyServerSideMap")); ?>', //name of function in controller..
          dataType:'json',
          data: {
            userfiler: userfiler,
            viewfiler: viewfiler,
            property_id: property_id,
            property_name: property_name,
            khasra_no: khasra_no,
            khasra_name: khasra_name,
            diverted: diverted,
            type_of_land: type_of_land,
            from_area: from_area,
            to_area: to_area,
            area_unit: area_unit,
            from_front: from_front,
            to_front: to_front,
            front_unit: front_unit,
            from_deep: from_deep,
            to_deep: to_deep,
            deep_unit: deep_unit,
            from_price: from_price,
            to_price: to_price,
            location: location,
            boundary_wall: boundary_wall,
            bore: bore,
            no_of_registry: no_of_registry,
            aadiwasi_land: aadiwasi_land,
            verified_property: verified_property,
            source_of_property: source_of_property,
            plot_facing: plot_facing
          },
          success: function(response) 
          {
            if(response!="")
            {
              var map, markers;

              map = L.map('propertiesMap');
              
              markers = new L.LayerGroup().addTo(map);
              
              L.tileLayer( 'https://{s}.tile.osm.org/{z}/{x}/{y}.png',
              {
                  minZoom: 5,
                  maxZoom: 18,
                  attribution: 'Tiles by <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, Data by <a href="https://www.openstreetmap.org/">OpenStreetMap</a>'
              }).addTo(map);
              
              markers.clearLayers();
              $.each(response, function(i, val) {
                let price;
                if (val.from_price!=null && val.to_price!=null)
                {
                  price = val.from_price+"-"+val.to_price;
                }
                else if (val.from_price!=null && val.to_price==null)
                {
                  price = val.from_price;
                }
                else
                {
                  price = "Not mentioned";
                }

                let img;
                if (val.image)
                {
                  let imageUrl = "<?php echo e(asset('storage/photos')); ?>/"+val.image.image;
                  img = "<img src='"+imageUrl+"' class='mb-1' style='width:200px; height:auto;' />";
                }
                else
                {
                  let imageUrl = "<?php echo e(asset('assets/img/noimage.png')); ?>";
                  img = "<img src='"+imageUrl+"' class='mb-1' style='width:200px; height:auto;' />";
                }

                var address = "Not mentioned";

                if (val.location!=null)
                {
                  address = val.location;
                }

                var areaData = "Not mentioned";

                if (val.area!=null)
                {
                  areaData = val.area+' '+val.area_unit;
                }

                var frontData = "Not mentioned";

                if (val.front!=null)
                {
                  frontData = val.front+' '+val.front_units;
                }

                if (val.gmap_location_lat && val.gmap_location_long) {
                  map.setView([val.gmap_location_lat, val.gmap_location_long], 10)
                  var location = new L.LatLng(val.gmap_location_lat, val.gmap_location_long); 
                  var marker = new L.Marker(location).addTo(markers);

                  marker.bindPopup('<a href="viewProperty/'+val.id+'" target="_BLANK">'+img+'</a>'+
                  '<a href="viewProperty/'+val.id+'" target="_BLANK"><p class="m-0 p-0">Name : '+val.name+'  <i class="bx bx-link-external"></i></p></a>'+
                  '<a href="https://maps.google.com/?q='+val.gmap_location_lat+','+val.gmap_location_long+'" target="_BLANK"><p class="m-0 p-0">Address : '+address+' <i class="bx bx-link-external"></i></p></a>'+
                  '<p class="m-0 p-0">Front : '+frontData+'</p>'+
                  '<p class="m-0 p-0">Area : '+areaData+'</p>'+
                  '<p class="m-0 p-0">Price : '+price+'</p>').addTo(map);
                }
                
              });
            }
            else
            {
              $("#propertiesMap").html("<hr /><div class='text-center'>No Map Found !</div><hr />");
            }
          }
      });
    }

    $("#searchCheck").on("change", function() {
      if (this.checked)
      {
        $(".filter-group").removeClass("d-none");
      }
      else
      {
        $(".filter-group").addClass("d-none");
      }
    });

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/propepjx/public_html/resources/views/admin/property/properties_map_view.blade.php ENDPATH**/ ?>
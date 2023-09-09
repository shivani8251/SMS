<?php $__env->startSection('mytitle', 'View Property Details'); ?>
<?php $__env->startSection('content'); ?>
<!-- BEGIN: Content-->
<style type="text/css">
  img.pdf-icon{
    height: 30px !important;
    width: auto !important;
  }
</style>
<div class="app-content content mt-2">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
      
      <section class="invoice-view-wrapper">
        <div class="row">
          <!-- invoice view page -->
          <div class="col-xl-12 col-md-12 col-12">
            <div class="card invoice-print-area">
              <div class="card-body pb-0 mx-25">
                <!-- logo and title -->
                <div class="row">
                  <div class="col-sm-6 col-12 text-center text-sm-left mt-1 order-1 order-sm-1">
                    <h3 class="text-primary"><?php echo e($property->name); ?></h3>
                    <span><?php echo e($property->location); ?></span>
                  </div>
                  <div class="col-sm-6 col-12 text-center text-sm-right mt-1 order-2 order-sm-2">
                    <h5>Price</h5>
                    <h5 class="text-primary">Rs.<?php echo e($property->from_price); ?> - <?php echo e($property->to_price); ?></h5>
                  </div>
                </div>
                <hr>
                
                <!-- invoice address and contact -->
                <div class="row">
                  <div class="col-12">
                    <div class="swiper-autoplay swiper-container">
                      <div class="swiper-wrapper">
                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide">
                          <img class="img-fluid" src='<?php echo e(asset("storage/photos/$image->image")); ?>' alt="banner">
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                      <!-- Add Pagination -->
                      <div class="swiper-pagination"></div>
                      <!-- Add Arrows -->
                      <div class="swiper-button-next"></div>
                      <div class="swiper-button-prev"></div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row invoice-info mt-2">
                  <div class="col-12">
                    <h4 class="text-primary">Description</h4>
                  </div>

                  <div class="col-12 mt-1">
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Khasra Number :-</h6>
                      <p class="col-md-9"><?php echo e($property->khasra_no); ?></p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Khasra Name :-</h6>
                      <p class="col-md-9"><?php echo e($property->khasra_name); ?></p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Land Type :-</h6>
                      <p class="col-md-9"><?php echo e($property->land_type); ?></p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Area :-</h6>
                      <p class="col-md-9"><?php echo e($property->area); ?> <?php echo e($property->area_unit); ?></p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Depth From Road :-</h6>
                      <p class="col-md-9"><?php echo e($property->depth_from_road); ?> <?php echo e($property->depth_from_road_unit); ?></p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Front :-</h6>
                      <p class="col-md-9"><?php echo e($property->front); ?> <?php echo e($property->front_units); ?></p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Deep :-</h6>
                      <p class="col-md-9"><?php echo e($property->deep); ?> <?php echo e($property->deep_unit); ?></p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Plot Facing :-</h6>
                      <p class="col-md-9"><?php echo e($property->plot_facing); ?></p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Number Of Bores :-</h6>
                      <p class="col-md-9"><?php echo e($property->no_of_bores); ?></p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Number Of Registry :-</h6>
                      <p class="col-md-9"><?php echo e($property->no_of_registry); ?></p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Source Of Property :-</h6>
                      <p class="col-md-9"><?php echo e($property->source_of_property); ?></p>
                    </div>

                    
                  </div>
                </div>
                <hr>
                <!-- invoice address and contact -->
                <div class="row invoice-info">
                  <div class="col-12">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>Field</th>
                            <th class="text-center">
                              <div class="d-flex text-success align-items-center">
                                <i class="bx bx-check text-success" style="font-size: 24px !important;"></i>
                                <span> Yes</span>
                              </div>
                            </th>
                            <th class="text-center">
                              <div class="d-flex text-danger align-items-center">
                                <i class="bx bx-x text-danger" style="font-size: 24px !important;"></i>
                                <span> No</span>
                              </div>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th class="text-nowrap" scope="row">Diverted</th>
                            <td>
                              <?php if($property->diverted=='Yes'): ?>
                                <div class="d-flex text-success align-items-center">
                                  <i class="bx bx-check" style="font-size: 24px !important;"></i>
                                  <!-- <span> Yes</span> -->
                                </div>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if($property->diverted=='No'): ?>
                                <div class="d-flex text-danger align-items-center">
                                  <i class="bx bx-x" style="font-size: 24px !important;"></i>
                                  <!-- <span> No</span> -->
                                </div>
                              <?php endif; ?>
                            </td>
                          </tr>
                          <tr>
                            <th class="text-nowrap" scope="row">Boundary Wall</th>
                            <td>
                              <?php if($property->boundary_wall=='Yes'): ?>
                                <div class="d-flex text-success align-items-center">
                                  <i class="bx bx-check" style="font-size: 24px !important;"></i>
                                  <!-- <span> Yes</span> -->
                                </div>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if($property->boundary_wall=='No'): ?>
                                <div class="d-flex text-danger align-items-center">
                                  <i class="bx bx-x" style="font-size: 24px !important;"></i>
                                  <!-- <span> No</span> -->
                                </div>
                              <?php endif; ?>
                            </td>
                          </tr>
                          <tr>
                            <th class="text-nowrap" scope="row">Bore</th>
                            <td>
                              <?php if($property->bore=='Yes'): ?>
                                <div class="d-flex text-success align-items-center">
                                  <i class="bx bx-check" style="font-size: 24px !important;"></i>
                                  <!-- <span> Yes</span> -->
                                </div>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if($property->bore=='No'): ?>
                                <div class="d-flex text-danger align-items-center">
                                  <i class="bx bx-x" style="font-size: 24px !important;"></i>
                                  <!-- <span> No</span> -->
                                </div>
                              <?php endif; ?>
                            </td>
                          </tr>
                          <tr>
                            <th class="text-nowrap" scope="row">Aadiwasi Land</th>
                            <td>
                              <?php if($property->adiwasi_land=='Yes'): ?>
                                <div class="d-flex text-success align-items-center">
                                  <i class="bx bx-check" style="font-size: 24px !important;"></i>
                                  <!-- <span> Yes</span> -->
                                </div>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if($property->adiwasi_land=='No'): ?>
                                <div class="d-flex text-danger align-items-center">
                                  <i class="bx bx-x" style="font-size: 24px !important;"></i>
                                  <!-- <span> No</span> -->
                                </div>
                              <?php endif; ?>
                            </td>
                          </tr>
                          <tr>
                            <th class="text-nowrap" scope="row">Verified Property</th>
                            <td>
                              <?php if($property->verified_property=='Yes'): ?>
                                <div class="d-flex text-success align-items-center">
                                  <i class="bx bx-check" style="font-size: 24px !important;"></i>
                                  <!-- <span> Yes</span> -->
                                </div>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if($property->verified_property=='No'): ?>
                                <div class="d-flex text-danger align-items-center">
                                  <i class="bx bx-x" style="font-size: 24px !important;"></i>
                                  <!-- <span> No</span> -->
                                </div>
                              <?php endif; ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <hr>
                
                <div class="row invoice-info mt-2">
                  <div class="col-12">
                    <h4 class="text-primary">GMAP Location</h4>
                  </div>
                </div>
                <div class="row invoice-info mt-2">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input type="hidden" id="propertyMapLat" value="<?php echo e($property->gmap_location_lat); ?>">
                    <input type="hidden" id="propertyMapLong" value="<?php echo e($property->gmap_location_long); ?>">
                    <div class="leaflet-map" id="propertyMap"></div>
                  </div>
                </div>
                <hr />

                <div class="row invoice-info mt-2">
                  <div class="col-12">
                    <h4 class="text-primary">Documents</h4>
                  </div>
                </div>
                <div class="row invoice-info mt-2">
                  <div class="col-12">
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Patwari Naksha :-</h6>
                      <p class="col-md-9">
                        <a href='<?php echo e(asset("storage/$property->patwari_naksha")); ?>' target="_blank">
                          <img class="pdf-icon" src="<?php echo e(asset('assets/img/pdf-download.jpg')); ?>">
                        </a>
                      </p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Google Naksha :-</h6>
                      <p class="col-md-9">
                        <a href='<?php echo e(asset("storage/$property->google_naksha")); ?>' target="_blank">
                          <img class="pdf-icon" src="<?php echo e(asset('assets/img/pdf-download.jpg')); ?>">
                        </a>
                      </p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">B1 :-</h6>
                      <p class="col-md-9">
                        <a href='<?php echo e(asset("storage/$property->b_one")); ?>' target="_blank">
                          <img class="pdf-icon" src="<?php echo e(asset('assets/img/pdf-download.jpg')); ?>">
                        </a>
                      </p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">P2 :-</h6>
                      <p class="col-md-9">
                        <a href='<?php echo e(asset("storage/$property->p_two")); ?>' target="_blank">
                          <img class="pdf-icon" src="<?php echo e(asset('assets/img/pdf-download.jpg')); ?>">
                        </a>
                      </p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Misal :-</h6>
                      <p class="col-md-9">
                        <a href='<?php echo e(asset("storage/$property->misal")); ?>' target="_blank">
                          <img class="pdf-icon" src="<?php echo e(asset('assets/img/pdf-download.jpg')); ?>">
                        </a>
                      </p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Adhikar Abhilekh :-</h6>
                      <p class="col-md-9">
                        <a href='<?php echo e(asset("storage/$property->adhikar_abhhilekh")); ?>' target="_blank">
                          <img class="pdf-icon" src="<?php echo e(asset('assets/img/pdf-download.jpg')); ?>">
                        </a>
                      </p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Bhu Upyogita :-</h6>
                      <p class="col-md-9">
                        <a href='<?php echo e(asset("storage/$property->bhu_upyogita")); ?>' target="_blank">
                          <img class="pdf-icon" src="<?php echo e(asset('assets/img/pdf-download.jpg')); ?>">
                        </a>
                      </p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Namantran Panji :-</h6>
                      <p class="col-md-9">
                        <a href='<?php echo e(asset("storage/$property->namantran_panji")); ?>' target="_blank">
                          <img class="pdf-icon" src="<?php echo e(asset('assets/img/pdf-download.jpg')); ?>">
                        </a>
                      </p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Nistar Patrak :-</h6>
                      <p class="col-md-9">
                        <a href='<?php echo e(asset("storage/$property->nistar_patrak")); ?>' target="_blank">
                          <img class="pdf-icon" src="<?php echo e(asset('assets/img/pdf-download.jpg')); ?>">
                        </a>
                      </p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Chauhaddi :-</h6>
                      <p class="col-md-9">
                        <a href='<?php echo e(asset("storage/$property->chauhaddi")); ?>' target="_blank">
                          <img class="pdf-icon" src="<?php echo e(asset('assets/img/pdf-download.jpg')); ?>">
                        </a>
                      </p>
                    </div>
                    <div class="row">
                      <h6 class="invoice-from text-dark col-md-3">Rin Pustika :-</h6>
                      <p class="col-md-9">
                        <a href='<?php echo e(asset("storage/$property->rin_pustika")); ?>' target="_blank">
                          <img class="pdf-icon" src="<?php echo e(asset('assets/img/pdf-download.jpg')); ?>">
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
                <hr />

                <div class="row invoice-info mt-2">
                  <div class="col-12">
                    <h4 class="text-primary">Videos</h4>
                  </div>
                </div>                
                <div class="row invoice-info mt-2 mb-3">
                  <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="video-player" id="plyr-video-player">
                      <iframe style="width: 100%; height: auto;" src='<?php echo e($video->video_link); ?>' allowfullscreen allow="autoplay">
                      </iframe>
                    </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

    var propertyMapLat = $("#propertyMapLat").val();
    var propertyMapLong = $("#propertyMapLong").val();

    var map = L.map('propertyMap').setView([propertyMapLat,propertyMapLong], 10);
    
    L.tileLayer( 'https://{s}.tile.osm.org/{z}/{x}/{y}.png',
    {
        minZoom: 5,
        maxZoom: 18,
        attribution: 'Tiles by <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, Data by <a href="https://www.openstreetmap.org/">OpenStreetMap</a>'
    }).addTo(map);

    L.marker([propertyMapLat,propertyMapLong]).addTo(map);

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\pbird\resources\views/admin/property/view_property.blade.php ENDPATH**/ ?>
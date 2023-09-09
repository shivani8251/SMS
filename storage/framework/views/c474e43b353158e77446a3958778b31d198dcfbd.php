<?php $__env->startSection('mytitle', 'Products'); ?>
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
                <h4 class="h4">Edit Product</h4>
              </div>
              <div class="card-body">
                <form id="edit-product-form" method="post" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <div class="row">
                    <div class="col-lg-12">
                      <h6>Basic Details</h6>
                    </div>
                    <input type="hidden" name="product_id" id="product_id" value="<?php echo e(isset($product->id) ? $product->id : ''); ?>" />

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter product name" value="<?php echo e(isset($product->product_name) ? $product->product_name : ''); ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Category <span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-control select2" data-placeholder="Select Category" required>
                          <option value="">--Select--</option>
                          <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php echo e(isset($product->category) ? ($cat->id==$product->category ? 'selected' : '') : ''); ?>><?php echo e($cat->category_name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <input type="hidden" id="subcategory_val" value="<?php echo e(isset($product->subcategory) ? $product->subcategory : ''); ?>">
                        <label class="form-control-label">Subcategory <span class="text-danger">*</span></label>
                        <select name="subcategory" id="subcategory" class="form-control select2" data-placeholder="Select subcategory" required>
                          <option value="">--Select--</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Product Code/SKU <span class="text-danger">*</span></label>
                        <input type="text" name="product_code" id="product_code" class="form-control" placeholder="Enter product code" value="<?php echo e(isset($product->product_code) ? $product->product_code : ''); ?>" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Listed Price</label>
                        <input type="text" name="listed_price" id="listed_price" class="form-control" placeholder="Enter listed price" value="<?php echo e(isset($product->listed_price) ? $product->listed_price : ''); ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Sales Price <span class="text-danger">*</span></label>
                        <input type="text" name="sales_price" id="sales_price" class="form-control" placeholder="Enter sales price" value="<?php echo e(isset($product->sales_price) ? $product->sales_price : ''); ?>" required>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Short Description</label>
                        <input type="text" name="short_description" id="short_description" class="form-control" placeholder="Enter short description" value="<?php echo e(isset($product->short_description) ? $product->short_description : ''); ?>">
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Long Description</label>
                        <textarea type="text" name="long_description" id="long_description" class="form-control" placeholder="Enter long description"><?php echo e(isset($product->long_description) ? $product->long_description : ''); ?></textarea>
                      </div>
                    </div>
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Thumbnail Image</label>
                        <input type="hidden" value="<?php if(isset($product->thumbnail_image)): ?><?php echo e($product->thumbnail_image); ?><?php endif; ?>" name="thumbnail_image" class="uploaded-file" />
                        
                        <?php
                          $dNone = "";
                          if(isset($product->thumbnail_image)){
                            $dNone = "d-none";
                          }
                        ?>
                        <?php if(isset($product->thumbnail_image)): ?>
                          <p class="alert alert-success file-upload-status">
                            <a class="text-white" target="_blank" href='<?php echo e(asset("storage/products/thumbnail_image/$product->thumbnail_image")); ?>'><?php echo e($product->thumbnail_image); ?></a>
                            <span class="float-right">
                              <a class="text-danger remove-document-btn" href="javascript:void(0);">
                                <i class="bx bx-x-circle"></i>
                              </a>
                            </span>
                          </p>
                        <?php else: ?>
                          <p class="alert alert-success file-upload-status d-none"></p>
                        <?php endif; ?>
                        <button type="button" name="thumbnail_image_upload" id="thumbnail_image_upload" class="btn btn-outline-primary btn-block <?php echo e($dNone); ?>"><i class="bx bx-upload"></i> Upload</button>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Gallery Images</label>
                        <?php $__currentLoopData = $thumbnails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thumbnail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if(isset($thumbnail->image)): ?>
                            <div class="mb-1">
                              <p class="mb-0 alert alert-success multiple-file-upload-status">
                                <a class="text-white" target="_blank" href='<?php echo e(asset("storage/products/gallery_images/$thumbnail->image")); ?>'><?php echo e($thumbnail->image); ?></a>
                                <span class="float-right">
                                  <a class="text-danger delete-multiple-images-btn" data-id="<?php echo e($thumbnail->id); ?>" href="javascript:void(0);">
                                    <i class="bx bx-x-circle"></i>
                                  </a>
                                </span>
                              </p>
                            </div>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" id="images" class="btn btn-outline-primary btn-block"><i class="bx bx-upload"></i> Upload</button>
                      </div>
                    </div>

                    <div class="col-lg-12">
                      <h6>Additional Details</h6>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Featured Product</label>
                        <select name="featured_product" id="featured_product" class="form-control select2" data-placeholder="Select featured product">
                          <?php
                           $features = ["No", "Yes"];
                          ?>
                          <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($feature); ?>" <?php echo e(isset($product->featured_product) ? ($feature==$product->featured_product ? 'selected' : '') : ''); ?>><?php echo e($feature); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>  
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Product Nature</label>
                        <select name="product_nature" id="product_nature" class="form-control select2" data-placeholder="Enter product nature">
                          <option value="">--Select--</option>
                          <?php $__currentLoopData = $natures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($nature->id); ?>" <?php echo e(isset($product->product_nature) ? ($nature->id==$product->product_nature ? 'selected' : '') : ''); ?>><?php echo e($nature->product_nature); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Taxable</label>
                        <select name="taxable" id="taxable" class="form-control select2" data-placeholder="Select taxable">
                          <option value="No" <?php echo e(isset($product->taxable) ? ($product->taxable=='No' ? 'selected' : '') : ''); ?>>No</option>
                          <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class->id); ?>" <?php echo e(isset($product->tax_class) ? ($class->id==$product->tax_class ? 'selected' : '') : ''); ?>><?php echo e($class->tax_class); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Stock Status</label>
                        <select name="stock_status" id="stock_status" class="form-control select2" data-placeholder="Select stock status">
                          <option value="">--Select--</option>
                          <?php
                           $stocks = ["Stock Full", "Countable Stock", "Out of Stock"];
                          ?>
                          <?php $__currentLoopData = $stocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($stock); ?>" <?php echo e(isset($product->stock_status) ? ($stock==$product->stock_status ? 'selected' : '') : ''); ?>><?php echo e($stock); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6 <?php echo e(($product->stock_status!='Countable Stock') ? 'd-none' : ''); ?>" id="number_of_stock_group">
                      <div class="form-group">
                        <label class="form-control-label">Number of Stock</label>
                        <input type="text" name="number_of_stock" id="number_of_stock" class="form-control" placeholder="Enter number of stock" value="<?php echo e(isset($product->number_of_stock) ? $product->number_of_stock : ''); ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Product Type</label>
                        <select name="product_type" id="product_type" class="form-control select2" data-placeholder="Select product type">
                          <option value="">--Select--</option>
                          <?php
                           $types = ["Single Product", "Variant Product"];
                          ?>
                          <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type); ?>" <?php echo e(isset($product->product_type) ? ($type==$product->product_type ? 'selected' : '') : ''); ?>><?php echo e($type); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6 <?php echo e(($product->product_type!='Variant Product') ? 'd-none' : ''); ?>" id="variant-group">
                      <div class="form-group">
                        <label class="form-control-label">Variant</label>
                        <select name="variant" id="variant" class="form-control select2" data-placeholder="Select variant">
                          <option value="">--Select--</option>
                          <?php $__currentLoopData = $variants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($variant->id); ?>" <?php echo e(isset($product->variant) ? ($variant->id==$product->variant ? 'selected' : '') : ''); ?>><?php echo e($variant->product_name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label">Product Tag</label>
                        <select name="product_tag" id="product_tag" class="form-control select2" data-placeholder="Select product tag">
                          <option value="">--Select--</option>
                          <?php
                           $tags = ["Hot", "New", "Trending"];
                          ?>
                          <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tag); ?>" <?php echo e(isset($product->product_tag) ? ($tag==$product->product_tag ? 'selected' : '') : ''); ?>><?php echo e($tag); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                    </div>

                  </div>

                  <div class="row group">
                    <div class="col-lg-12 mt-1">
                      <div class="form-group">
                        <button type="submit" id="submit-btn" class="btn btn-success">Save Changes</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>
</div>
<!-- END: Content-->

<div class="modal fade text-left w-100" id="images-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Images</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <form id="images-form" method="post" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div class="file-loading">
                <input id="images-uploader" accept="*" name="file[]" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2" data-theme="fas">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-left w-100" id="upload-document-modal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel16" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Choose Thumbnail Image</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="bx bx-x"></i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <form id="choose-img-form" method="post" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              <div class="file-loading">
                <input id="file" name="file" accept=".jpg, .png, .jpeg" class="file doc_file_input" type="file">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>

  /*=====Single document upload======*/

    $("#file").fileinput({
      theme: 'fas',
      uploadUrl: "<?php echo e(route('product.uploadThumbnailImage')); ?>",
      uploadAsync: false,
      fileActionSettings: {
        showUpload: false
      },
      uploadExtraData: function() {
        return {
          _token: $("input[name='_token']").val(),
        };
      },
      allowedFileExtensions: ['jpg', 'png', 'jpeg'],
      overwriteInitial: false,
      maxFileSize:5120,
      maxFilesNum: 1,
      slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
      }
    })
    .on('filebatchuploadsuccess', function(event, data, previewId, index) {
      let nearestInput = $("input.uploaded-file");
      let nearestBtn = $("button#thumbnail_image_upload");
      let nearestStatus = $("p.file-upload-status");

      $("input.uploaded-file").val(data.response.file);
      if (nearestInput.val())
      {
        $(nearestBtn).addClass("d-none");
        $(nearestStatus).html(data.response.file+'<span class="float-right">'+
          '<a class="text-danger remove-document-btn" href="javascript:void(0);">'+
            '<i class="bx bx-x-circle"></i>'+
          '</a>'+
        '</span>');
        $(nearestStatus).removeClass("d-none");
      }
      else
      {
        $(nearestBtn).removeClass("d-none");
        $(nearestStatus).addClass("d-none");
      }
      $("#upload-document-modal").modal('hide');
      $('#choose-img-form')[0].reset();

    });


    /*-------------------Gallery Images Uploader-------------------------*/

      $("#images-uploader").fileinput({
        theme: 'fas',
        uploadUrl: "<?php echo e(route('product.uploadGalleryImages')); ?>",
        uploadAsync: false,
        fileActionSettings: {
          showUpload: false
        },
        uploadExtraData: function() {
          return {
            _token: $("input[name='_token']").val(),
          };
        },
        // allowedFileExtensions: ['jpeg', 'jpg', 'png'],
        overwriteInitial: false,
        maxFileSize:5120,
        maxFilesNum: 10,
        minFilesNum: 1,
        slugCallback: function (filename) {
          return filename.replace('(', '_').replace(']', '_');
        }
      })
      .on('filebatchuploadsuccess', function(event, data, previewId, index) {
        let status = '';
        $.each(data.response.files, function(i, res) {
          status += '<div class="mb-1">'+
          '<input type="hidden" name="images[]" class="uploaded-files-input" value="'+res+'" />'+
          '<p class="mb-0 alert alert-success multiple-file-upload-status">'+
            res+
            '<span class="float-right">'+
              '<a class="text-danger remove-multiple-images-btn" href="javascript:void(0);">'+
                '<i class="bx bx-x-circle"></i>'+
              '</a>'+
            '</span>'+
          '</p></div>';
        });
        $(status).insertBefore("button#images");
        $("#images-modal").modal('hide');
        $('#images-form')[0].reset();
      });


  $(function() {

    $("#product_type").on("change", function() {
      var product_type = this.value;
      if(product_type=="Variant Product")
      {
        $("#variant-group").removeClass("d-none");
      }
      else
      {
        $("#variant-group").addClass("d-none");
      }
    });

    $("#stock_status").on("change", function() {
      var stock_status = this.value;
      if(stock_status=="Countable Stock")
      {
        $("#number_of_stock_group").removeClass("d-none");
      }
      else
      {
        $("#number_of_stock_group").addClass("d-none");
      }
    });

    $(document).on('click', '.delete-multiple-images-btn', function() {
      let id = $(this).data('id');
      let delThis = $(this);
      $.confirm({
        title: 'Confirm!',
        type: 'red',
        content: 'Are you sure want to delete this gallery image ?',
        buttons: {
          yes: function() {
            $.get("<?php echo e(route('product.deleteGalleryImages')); ?>", {id}, function(data) {
              if (data.status) {
                toastr.success(data.message, '', {
                  closeButton: !0,
                  tapToDismiss: !1,
                  progressBar: true,
                  timeOut: 2000
                });
                delThis.closest('div').find("p.multiple-file-upload-status").addClass('d-none');
                delThis.closest("div").find("button#images").removeClass('d-none');
                delThis.closest("div").find("input.uploaded-files-input").remove();
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

    /*-------------------Thumbnail Image Uploader---------------------------*/

      $("#thumbnail_image_upload").on("click", function() {
        $("#upload-document-modal").modal('show');
      });

      $(document).on("click", ".remove-document-btn", function() {
        $(this).closest('div').find("p.file-upload-status").addClass('d-none');
        $(this).closest("div").find("button#thumbnail_image_upload").removeClass('d-none');
        $(this).closest("div").find("input.uploaded-file").val("");
      });

    /*-------------------Gallery Images Uploader-------------------------*/

      $("#images").on("click", function() {
        $("#images-modal").modal('show');
      });

      $(document).on("click", ".remove-multiple-images-btn", function() {
        $(this).closest('div').find("p.multiple-file-upload-status").addClass('d-none');
        $(this).closest("div").find("button#images").removeClass('d-none');
        $(this).closest("div").find("input.uploaded-files-input").remove();
      });

      $(document).on("change", "#category", function() {
        let id = $(this).val();

        $.get("<?php echo e(route('promotion.fetchSubCategories')); ?>", {id}, function(data) {
          if (data != "")
          {
            var opt = '<option value="">--Select--</option>';
            $.each(data, function(index, value){
              opt += '<option value="'+value.id+'">'+value.subcategory_name+'</option>';
            });
          }
          else
          {
            var opt = '<option value="">--Select--</option>';
          }
          $("#subcategory").html(opt);

        }, "json");
      });

      let category_id = $("#category").val();
      let subcategory_id = $("#subcategory_val").val();

      $.get("<?php echo e(route('product.fetchSubCategoriesOfCategories')); ?>", {category_id}, function(data) {
        if (data != "")
        {
          var selected;
          var opt = '<option value="">--Select--</option>';
          $.each(data, function(index, value){
            if(value.id==subcategory_id)
            {
              selected = "selected";
            }
            else
            {
              selected = "";
            }

            opt += '<option value="'+value.id+'" '+selected+'>'+value.subcategory_name+'</option>';
          });

          $("#subcategory").html(opt);
        }
      }, "json");

      var productForm = $("#edit-product-form").validate({
      errorPlacement: function (error, element) {}
    });

    $("#edit-product-form").submit(function(event) {
      event.preventDefault()

      var formData = new FormData(this);
      if (productForm.valid())
      {
        var productCode = $('#product_code').val();
        var productid = $('#product_id').val();
        $.get("<?php echo e(route('product.checkEditProductCodeAvailability')); ?>", {productCode, productid}, function(statusData) {
          if(statusData.status=="unavailable")
          {
            $.post("<?php echo e(route('product.updateProductData')); ?>", $("#edit-product-form").serialize(), function(data) {
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
          else
          {
            toastr.error('Product code already exists !', '', {
              closeButton: !0,
              tapToDismiss: !1,
              progressBar: true,
              timeOut: 1000
            });
          }
        });
      }
    });

  });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\ecom\resources\views/admin/products/edit_product.blade.php ENDPATH**/ ?>
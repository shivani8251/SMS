<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    
    <?php echo $__env->make('admin/layouts/head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
        <?php echo $__env->make('admin/layouts/header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <?php echo $__env->make('admin/layouts/sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->make('admin/layouts/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- BEGIN: Vendor JS-->
        <script src="<?php echo e(asset('public/assets/vendors/js/vendors.min.js')); ?>"></script>     
        <script src="<?php echo e(asset('public/assets/js/jquery-confirm.min.js')); ?>"></script>

        <script src="<?php echo e(asset('public/assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js')); ?>"></script>
        <!-- BEGIN Vendor JS-->

        <script src="<?php echo e(asset('public/assets/vendors/js/editors/quill/katex.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/editors/quill/highlight.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/editors/quill/quill.min.js')); ?>"></script>

        <script src="<?php echo e(asset('public/assets/vendors/js/pickers/pickadate/picker.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/pickers/pickadate/picker.date.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/pickers/pickadate/picker.time.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/pickers/pickadate/legacy.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/extensions/moment.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/pickers/daterange/daterangepicker.js')); ?>"></script>

        <!-- BEGIN: Page Vendor JS-->
        <script src="<?php echo e(asset('public/assets/vendors/js/ui/plyr.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/forms/select/select2.full.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/forms/validation/jquery.validate.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/charts/apexcharts.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/extensions/swiper.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/tables/datatable/jquery.dataTables.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/tables/datatable/dataTables.buttons.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/tables/datatable/buttons.html5.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/tables/datatable/buttons.print.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/tables/datatable/pdfmake.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/tables/datatable/vfs_fonts.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/vendors/js/extensions/toastr.min.js')); ?>"></script>
        <!-- END: Page Vendor JS-->

        <script src="<?php echo e(asset('public/assets/vendors/js/extensions/jquery.steps.min.js')); ?> "></script>
        <script src="<?php echo e(asset('public/assets/js/scripts/forms/wizard-steps.min.js')); ?> "></script>

        <!-- BEGIN: Theme JS-->
        <script src="<?php echo e(asset('public/assets/js/scripts/configs/vertical-menu-light.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/core/app-menu.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/core/app.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/scripts/components.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/scripts/footer.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/scripts/customizer.min.js')); ?>"></script>
        <!-- END: Theme JS-->

        <script src="<?php echo e(asset('public/assets/js/leaflet.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/scripts/maps/maps-leaflet.min.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/js/scripts/forms/validation/form-validation.js')); ?>"></script>
        <script src="<?php echo e(asset('public/assets/uploader/js/fileinput.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/assets/uploader/themes/fas/theme.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/assets/uploader/themes/explorer-fas/theme.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/assets/js/scripts/extensions/swiper.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('public/assets/js/custom.js')); ?>" type="text/javascript"></script>

        <?php echo $__env->yieldContent('sidebarscript'); ?>
        <?php echo $__env->yieldContent('leadscript'); ?>
        <?php echo $__env->yieldContent('script'); ?>
        <?php echo $__env->yieldContent('modal_script'); ?>

    </body>
</html><?php /**PATH C:\xampp\htdocs\pistin\resources\views/admin/app.blade.php ENDPATH**/ ?>
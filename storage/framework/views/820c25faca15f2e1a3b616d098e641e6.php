<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">

<head>


    <meta charset="utf-8" />
    <title>Dashboard | Air Ticketing System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Air Ticketing System<" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(!empty($siteSettings?->favicon) ? asset('storage/' . $siteSettings->favicon) : asset('') . 'assets/images/logo-favicon.png'); ?>">



    <!-- App css -->
    <link href="<?php echo e(asset('')); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('')); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('')); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />

   <?php echo $__env->yieldPushContent('styles'); ?>

</head>

<body>

    <!-- Top Bar Start -->
    <div class="topbar d-print-none">


        <?php echo $__env->make('admin.backend.parts.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <!-- Top Bar End -->

    <?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>


    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">
            <?php echo $__env->yieldContent('content'); ?>

            <!-- import footer section -->
            <?php echo $__env->make('admin.backend.parts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    <!-- Javascript  -->
    <!-- vendor js -->

    <script src="<?php echo e(asset('')); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/libs/simplebar/simplebar.min.js"></script>

    <script src="<?php echo e(asset('')); ?>assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="<?php echo e(asset('')); ?>https://apexcharts.com/samples/assets/stock-prices.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/js/pages/index.init.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/js/DynamicSelect.js"></script>
    <script src="<?php echo e(asset('')); ?>assets/js/app.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
<!--end body-->

</html>
<?php /**PATH C:\xampp\htdocs\Air_Ticketing_System\resources\views/admin/master.blade.php ENDPATH**/ ?>
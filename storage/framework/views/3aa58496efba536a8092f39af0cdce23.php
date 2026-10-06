<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e(app()->getLocale() == 'ar' ? 'rtl' : 'ltr'); ?>" class="light-style layout-menu-fixed">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> | <?php echo e(config('variables.templateName', 'RealEstate')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css"/>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Core CSS (Bootstrap Grid + Base Utilities) to fix layout overlapping -->
    <?php echo app('Illuminate\Foundation\Vite')([
        'resources/assets/vendor/scss/core.scss',
        'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.scss',
        'resources/css/app.css',  /* Custom Design System (Overrides Core) */
        'resources/js/app.js'
    ]); ?>

    <?php echo $__env->yieldContent('page-style'); ?>
</head>
<body class="app-body">

    <div class="app-wrapper">
        <!-- Sidebar -->
        <?php echo $__env->make('layouts.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="app-main">
            <!-- Header -->
            <?php echo $__env->make('layouts.partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Main Content -->
            <main class="app-content content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Core Scripts processed by Vite -->
    <?php echo app('Illuminate\Foundation\Vite')([
        'resources/assets/vendor/libs/jquery/jquery.js',
        'resources/assets/vendor/libs/popper/popper.js',
        'resources/assets/vendor/js/bootstrap.js',
        'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
        'resources/assets/vendor/js/helpers.js',
        'resources/assets/vendor/js/menu.js',
        'resources/assets/js/main.js'
    ]); ?>

    <?php echo $__env->yieldContent('page-script'); ?>
    
    <div id="toast-container" class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;"></div>
</body>
</html>
<?php /**PATH C:\laragon\www\RealEstate-Services-Platform\resources\views/layouts/app.blade.php ENDPATH**/ ?>
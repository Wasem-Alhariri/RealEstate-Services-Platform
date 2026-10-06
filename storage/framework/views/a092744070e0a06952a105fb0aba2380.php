<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Removed Search placeholder as requested -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <span class="text-muted fw-medium fs-5 d-none d-md-inline-block">
                    👋 <?php echo e(app()->getLocale() === 'ar' ? 'مرحباً بك،' : 'Welcome back,'); ?> <span class="text-primary fw-bold"><?php echo e(Auth::user()->name ?? 'Admin'); ?></span>
                </span>
            </div>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto gap-1 gap-md-2">
            <!-- Language Switcher -->
            <li class="nav-item dropdown-language dropdown me-2">
                <a class="nav-link dropdown-toggle hide-arrow d-flex align-items-center" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <?php if(app()->getLocale() === 'ar'): ?>
                        <img src="https://flagcdn.com/w40/sy.png" alt="Syria" class="rounded-circle border" style="width: 28px; height: 28px; object-fit: cover; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                    <?php else: ?>
                        <img src="https://flagcdn.com/w40/us.png" alt="USA" class="rounded-circle border" style="width: 28px; height: 28px; object-fit: cover; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                    <?php endif; ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end p-2 border-0 shadow-lg" style="border-radius: 14px; min-width: 160px;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-3 rounded p-2 <?php echo e(app()->getLocale() === 'en' ? 'bg-primary-light text-primary fw-bold' : 'text-secondary'); ?>" href="<?php echo e(route('locale', 'en')); ?>">
                            <img src="https://flagcdn.com/w40/us.png" alt="USA" class="rounded-circle" style="width: 22px; height: 22px; object-fit: cover;">
                            <span class="align-middle">English</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-3 rounded p-2 mt-1 <?php echo e(app()->getLocale() === 'ar' ? 'bg-primary-light text-primary fw-bold' : 'text-secondary'); ?>" href="<?php echo e(route('locale', 'ar')); ?>">
                            <img src="https://flagcdn.com/w40/sy.png" alt="Syria" class="rounded-circle" style="width: 22px; height: 22px; object-fit: cover;">
                            <span class="align-middle">العربية</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Notifications -->
            <?php
                $unreadCount = $unreadNotificationsCount ?? 0;
            ?>
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-2">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center justify-content-center bg-surface-hover rounded-circle position-relative" style="width: 40px; height: 40px; transition: all 0.2s ease;">
                        <i class="bx bx-bell fs-4 <?php echo e($unreadCount > 0 ? 'text-primary bx-tada' : 'text-secondary'); ?>"></i>
                        <?php if($unreadCount > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-2 border-white" style="font-size: 0.65rem; padding: 0.35em 0.5em;">
                                <?php echo e($unreadCount); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0 border-0 shadow-lg" style="width: 350px; border-radius: 16px; overflow: hidden;">
                    <li class="dropdown-menu-header border-bottom bg-light bg-opacity-25">
                        <div class="dropdown-header d-flex align-items-center py-3 px-4">
                            <h6 class="mb-0 fw-bold me-auto text-dark fs-6"><?php echo e(__('header.notifications') ?? 'Notifications'); ?></h6>
                            <form action="<?php echo e(route('notifications.readAll')); ?>" method="POST" class="m-0">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-sm p-1 rounded-circle d-flex align-items-center justify-content-center" title="<?php echo e(__('header.mark_all_read') ?? 'Mark all as read'); ?>" style="background: rgba(105, 108, 255, 0.1); width: 28px; height: 28px;">
                                    <i class='bx fs-5 bx-check-double text-primary'></i>
                                </button>
                            </form>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container" style="max-height: 300px; overflow-y: auto;">
                        <ul class="list-group list-group-flush">
                            <!-- Empty State -->
                            <li class="list-group-item border-0 p-4 text-center">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: #f1f5f9;">
                                        <i class="bx bx-bell-off fs-2 text-slate-400"></i>
                                    </div>
                                    <h6 class="mb-1 text-slate-700 fw-bold">No New Notifications</h6>
                                    <small class="text-slate-500">You have read all your messages</small>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top p-3 bg-white">
                        <a href="<?php echo e(route('notifications.index')); ?>" class="btn btn-primary w-100 fw-bold rounded-pill shadow-sm">
                            <?php echo e(__('header.view_all_activity') ?? 'View all notifications'); ?>

                        </a>
                    </li>
                </ul>
            </li>

            <!-- User Profile -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <?php if(auth('web')->user()->getFirstMediaUrl('admin_avatars')): ?>
                            <img src="<?php echo e(auth('web')->user()->getFirstMediaUrl('admin_avatars')); ?>" alt class="rounded-circle border border-2 border-white shadow-sm" style="width: 40px; height: 40px; object-fit: cover;" />
                        <?php else: ?>
                            <div class="avatar-initial rounded-circle bg-primary-light text-primary fw-bold d-flex align-items-center justify-content-center shadow-sm border border-2 border-white" style="font-size: 1.1rem; width: 40px; height: 40px;">
                                <?php echo e(Str::upper(Str::substr(auth('web')->user()->name, 0, 2))); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2" style="border-radius: 14px; min-width: 220px;">
                    <li class="px-2 py-2 mb-1">
                        <a class="dropdown-item rounded d-flex p-2" href="<?php echo e(route('profile.index')); ?>">
                            <div class="d-flex align-items-center gap-3">
                                <div class="flex-shrink-0">
                                    <div class="avatar avatar-online">
                                        <?php if(auth('web')->user()->getFirstMediaUrl('admin_avatars')): ?>
                                            <img src="<?php echo e(auth('web')->user()->getFirstMediaUrl('admin_avatars')); ?>" alt class="rounded-circle border border-2 border-white shadow-sm" style="width: 40px; height: 40px; object-fit: cover;" />
                                        <?php else: ?>
                                            <div class="avatar-initial rounded-circle bg-primary-light text-primary fw-bold d-flex align-items-center justify-content-center border border-2 border-white shadow-sm" style="width: 40px; height: 40px;">
                                                <?php echo e(Str::upper(Str::substr(auth('web')->user()->name, 0, 2))); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-bold d-block text-slate-800"><?php echo e(Auth::user()->name); ?></span>
                                    <small class="text-slate-500"><?php echo e(Auth::user()->email); ?></small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li><div class="dropdown-divider my-1"></div></li>
                    <li>
                        <a class="dropdown-item rounded d-flex align-items-center gap-2 p-2 text-slate-600" href="<?php echo e(route('profile.index')); ?>">
                            <i class="bx bx-user fs-5 text-slate-400"></i>
                            <span class="align-middle fw-medium"><?php echo e(__('header.my_profile') ?? 'My Profile'); ?></span>
                        </a>
                    </li>
                    <li><div class="dropdown-divider my-1"></div></li>
                    <li>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" class="m-0 p-0">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item rounded d-flex align-items-center gap-2 p-2 text-danger">
                                <i class="bx bx-power-off fs-5"></i>
                                <span class="align-middle fw-bold"><?php echo e(__('header.logout') ?? 'Log Out'); ?></span>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<?php /**PATH C:\laragon\www\RealEstate-Services-Platform\resources\views/layouts/partials/header.blade.php ENDPATH**/ ?>
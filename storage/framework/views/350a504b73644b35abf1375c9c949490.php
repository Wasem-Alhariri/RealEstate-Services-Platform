<?php $__env->startSection('title', __('profile.title') ?? 'Profile'); ?>

<?php $__env->startSection('page-style'); ?>
<style>
    .nav-pills .nav-link { transition: all 0.3s ease; border: 1px solid transparent; }
    .nav-pills .hover-bg-light:hover { background-color: #e7e7ff !important; color: #696cff !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.05) !important; border-color: rgba(105, 108, 255, 0.2); }
    .nav-pills .nav-link.active { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(105, 108, 255, 0.4) !important; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><?php echo e(__('profile.account') ?? 'Account'); ?> /</span> <?php echo e(__('profile.view') ?? 'Profile'); ?>

    </h4>

    <div class="row">
        <div class="col-md-12">
            <!-- Navigation Tabs -->
            <ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2">
                <li class="nav-item">
                    <a class="nav-link active shadow-sm px-4 rounded-pill" href="javascript:void(0);">
                        <i class="bx bx-user me-2"></i> <?php echo e(__('profile.tab_profile') ?? 'Profile Details'); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link bg-white text-muted shadow-sm px-4 rounded-pill hover-bg-light" href="<?php echo e(route('profile.security')); ?>">
                        <i class="bx bx-lock-alt me-2"></i> <?php echo e(__('profile.security') ?? 'Security'); ?>

                    </a>
                </li>
            </ul>

            <div class="card border-0 shadow-sm rounded-xl mb-4 overflow-hidden">
                <!-- Decorative Banner -->
                <div class="bg-primary bg-gradient" style="height: 120px; opacity: 0.85;"></div>
                
                <div class="card-body p-5 position-relative" style="margin-top: -60px;">
                    <!-- Avatar Section -->
                    <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-end gap-4 mb-5">
                        <div class="position-relative">
                            <?php if(auth('web')->user()->getFirstMediaUrl('admin_avatars')): ?>
                                <img src="<?php echo e(auth('web')->user()->getFirstMediaUrl('admin_avatars')); ?>" 
                                    alt="user-avatar" 
                                    class="d-block rounded-circle border border-5 border-white shadow" 
                                    style="width: 140px; height: 140px; object-fit: cover; background: white; cursor: pointer; transition: transform 0.2s;"
                                    id="uploadedAvatar" data-bs-toggle="modal" data-bs-target="#avatarModal" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" />
                                <div id="uploadedAvatarFallback" class="d-none rounded-circle border border-5 border-white shadow bg-primary-light text-primary d-flex align-items-center justify-content-center" style="width: 140px; height: 140px; font-size: 3rem; font-weight: bold; cursor: pointer; transition: transform 0.2s;" data-bs-toggle="modal" data-bs-target="#avatarModal" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <?php echo e(Str::upper(Str::substr(auth('web')->user()->name, 0, 2))); ?>

                                </div>
                            <?php else: ?>
                                <img src="" 
                                    alt="user-avatar" 
                                    class="d-none rounded-circle border border-5 border-white shadow" 
                                    style="width: 140px; height: 140px; object-fit: cover; background: white; cursor: pointer; transition: transform 0.2s;"
                                    id="uploadedAvatar" data-bs-toggle="modal" data-bs-target="#avatarModal" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" />
                                <div id="uploadedAvatarFallback" class="rounded-circle border border-5 border-white shadow bg-primary-light text-primary d-flex align-items-center justify-content-center" style="width: 140px; height: 140px; font-size: 3rem; font-weight: bold; cursor: pointer; transition: transform 0.2s;" data-bs-toggle="modal" data-bs-target="#avatarModal" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                    <?php echo e(Str::upper(Str::substr(auth('web')->user()->name, 0, 2))); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <form action="<?php echo e(route('profile.avatar.update')); ?>" method="POST" enctype="multipart/form-data" id="avatarForm" class="flex-grow-1 w-100 text-center text-sm-start">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="d-flex flex-column flex-sm-row gap-3 align-items-center">
                                <label for="upload" class="btn btn-primary rounded-pill px-4 shadow-sm" tabindex="0">
                                    <span class="d-none d-sm-block"><i class="bx bx-upload me-2"></i><?php echo e(__('profile.upload_new_photo') ?? 'Upload Photo'); ?></span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="avatar" class="account-file-input" hidden accept="image/png, image/jpeg" onchange="previewImage(this)" />
                                </label>
                                <button type="button" class="btn btn-outline-secondary rounded-pill px-4 account-image-reset" onclick="resetImage()">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block"><?php echo e(__('profile.reset') ?? 'Reset'); ?></span>
                                </button>
                                
                                <div id="saveAvatarBtn" style="display: none;" class="ms-sm-auto">
                                    <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm">
                                        <i class="bx bx-check me-2"></i><?php echo e(__('profile.save_image') ?? 'Save Changes'); ?>

                                    </button>
                                </div>
                            </div>
                            <p class="text-muted mb-0 mt-3 small"><i class="bx bx-info-circle me-1"></i><?php echo e(__('profile.upload_requirements') ?? 'Allowed JPG, GIF or PNG. Max size of 800K'); ?></p>
                        </form>
                    </div>
                </div>
                
                <hr class="my-0 border-light">

                <div class="card-body p-5">
                    <div class="row g-4">
                        
                        <div class="col-md-6">
                            <div class="p-4 rounded-xl h-100" style="background-color: #f8fafc;">
                                <label class="form-label text-uppercase text-primary fw-bold mb-2" style="font-size: 0.75rem; letter-spacing: 1px;"><?php echo e(__('profile.full_name') ?? 'Full Name'); ?></label>
                                <div class="d-flex align-items-center">
                                    <div class="bg-white p-2 rounded-circle shadow-sm me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="bx bx-user fs-4 text-primary"></i>
                                    </div>
                                    <div class="fw-bold fs-5 text-slate-800"><?php echo e(auth('web')->user()->name); ?></div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-md-6">
                            <div class="p-4 rounded-xl h-100" style="background-color: #f8fafc;">
                                <label class="form-label text-uppercase text-primary fw-bold mb-2" style="font-size: 0.75rem; letter-spacing: 1px;"><?php echo e(__('profile.email') ?? 'Email Address'); ?></label>
                                <div class="d-flex align-items-center">
                                    <div class="bg-white p-2 rounded-circle shadow-sm me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                        <i class="bx bx-envelope fs-4 text-primary"></i>
                                    </div>
                                    <div class="fw-bold fs-5 text-slate-800"><?php echo e(auth('web')->user()->email); ?></div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-md-12 mt-4">
                            <div class="p-4 rounded-xl" style="background-color: #f8fafc;">
                                <label class="form-label text-uppercase text-primary fw-bold mb-3" style="font-size: 0.75rem; letter-spacing: 1px;"><?php echo e(__('profile.user_roles') ?? 'Assigned Roles'); ?></label>
                                <div class="d-flex flex-wrap gap-3">
                                    <?php $__empty_1 = true; $__currentLoopData = auth('web')->user()->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <span class="badge bg-primary bg-gradient rounded-pill fs-6 px-4 py-2 shadow-sm d-flex align-items-center gap-2">
                                            <i class="bx bx-shield-quarter"></i> <?php echo e($role); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <span class="badge bg-secondary rounded-pill px-4 py-2"><?php echo e(__('general.no_roles') ?? 'No roles assigned'); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Avatar Modal -->
<div class="modal fade" id="avatarModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0 shadow-none">
            <div class="modal-body text-center position-relative p-0">
                <button type="button" class="btn-close position-absolute top-0 end-0 bg-white shadow-sm" data-bs-dismiss="modal" aria-label="Close" style="z-index: 10; margin: -10px;"></button>
                <?php if(auth('web')->user()->getFirstMediaUrl('admin_avatars')): ?>
                    <img src="<?php echo e(auth('web')->user()->getFirstMediaUrl('admin_avatars')); ?>" id="modalAvatarImage" class="rounded-circle border border-5 border-white shadow-lg mx-auto" style="width: 300px; height: 300px; object-fit: cover; background: white;" />
                    <div id="modalAvatarFallbackLarge" class="d-none rounded-circle border border-5 border-white shadow-lg bg-primary-light text-primary d-flex align-items-center justify-content-center mx-auto" style="width: 300px; height: 300px; font-size: 7rem; font-weight: bold;">
                        <?php echo e(Str::upper(Str::substr(auth('web')->user()->name, 0, 2))); ?>

                    </div>
                <?php else: ?>
                    <img src="" id="modalAvatarImage" class="d-none rounded-circle border border-5 border-white shadow-lg mx-auto" style="width: 300px; height: 300px; object-fit: cover; background: white;" />
                    <div id="modalAvatarFallbackLarge" class="rounded-circle border border-5 border-white shadow-lg bg-primary-light text-primary d-flex align-items-center justify-content-center mx-auto" style="width: 300px; height: 300px; font-size: 7rem; font-weight: bold;">
                        <?php echo e(Str::upper(Str::substr(auth('web')->user()->name, 0, 2))); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('page-script'); ?>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // Hide fallback initials and show image (Thumbnail)
                const fallback = document.getElementById('uploadedAvatarFallback');
                const avatar = document.getElementById('uploadedAvatar');
                if(fallback) fallback.classList.add('d-none');
                if(avatar) {
                    avatar.classList.remove('d-none');
                    avatar.classList.add('d-block');
                    avatar.src = e.target.result;
                }
                
                // Hide fallback initials and show image (Modal)
                const modalFallback = document.getElementById('modalAvatarFallbackLarge');
                const modalAvatar = document.getElementById('modalAvatarImage');
                if(modalFallback) modalFallback.classList.add('d-none');
                if(modalAvatar) {
                    modalAvatar.classList.remove('d-none');
                    modalAvatar.classList.add('d-block');
                    modalAvatar.src = e.target.result;
                }
                
                document.getElementById('saveAvatarBtn').style.display = 'block';
                document.getElementById('saveAvatarBtn').classList.add('animate__animated', 'animate__fadeIn');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetImage() {
        document.getElementById('upload').value = "";
        const fallback = document.getElementById('uploadedAvatarFallback');
        const avatar = document.getElementById('uploadedAvatar');
        const modalFallback = document.getElementById('modalAvatarFallbackLarge');
        const modalAvatar = document.getElementById('modalAvatarImage');
        
        const originalImage = "<?php echo e(auth('web')->user()->getFirstMediaUrl('admin_avatars')); ?>";
        if(originalImage) {
            avatar.src = originalImage;
            avatar.classList.remove('d-none');
            avatar.classList.add('d-block');
            if(fallback) fallback.classList.add('d-none');
            
            modalAvatar.src = originalImage;
            modalAvatar.classList.remove('d-none');
            modalAvatar.classList.add('d-block');
            if(modalFallback) modalFallback.classList.add('d-none');
        } else {
            avatar.src = "";
            avatar.classList.add('d-none');
            avatar.classList.remove('d-block');
            if(fallback) fallback.classList.remove('d-none');
            
            modalAvatar.src = "";
            modalAvatar.classList.add('d-none');
            modalAvatar.classList.remove('d-block');
            if(modalFallback) modalFallback.classList.remove('d-none');
        }
        
        document.getElementById('saveAvatarBtn').style.display = 'none';
    }
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\RealEstate-Services-Platform\resources\views/dashboard/profile/index.blade.php ENDPATH**/ ?>
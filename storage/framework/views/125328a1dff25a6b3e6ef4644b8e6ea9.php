<?php $__env->startSection('title', __('profile.security_title') ?? 'Security Settings'); ?>

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
        <span class="text-muted fw-light"><?php echo e(__('profile.account') ?? 'Account'); ?> /</span> <?php echo e(__('profile.security') ?? 'Security'); ?>

    </h4>

    <div class="row">
        <div class="col-md-12">
            <!-- Navigation Tabs -->
            <ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2">
                <li class="nav-item">
                    <a class="nav-link bg-white text-muted shadow-sm px-4 rounded-pill hover-bg-light" href="<?php echo e(route('profile.index')); ?>">
                        <i class="bx bx-user me-2"></i> <?php echo e(__('profile.tab_profile') ?? 'Profile Details'); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active shadow-sm px-4 rounded-pill" href="javascript:void(0);">
                        <i class="bx bx-lock-alt me-2"></i> <?php echo e(__('profile.security') ?? 'Security'); ?>

                    </a>
                </li>
            </ul>

            <div class="card border-0 shadow-sm rounded-xl mb-4 overflow-hidden">
                <!-- Decorative Banner -->
                <div class="bg-primary bg-gradient" style="height: 120px; opacity: 0.85;"></div>
                
                <div class="card-body p-5 position-relative" style="margin-top: -60px;">
                    <!-- Avatar Section (Read-only) -->
                    <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-end gap-4 mb-5">
                        <div class="position-relative">
                            <?php if(auth('web')->user()->getFirstMediaUrl('admin_avatars')): ?>
                                <img src="<?php echo e(auth('web')->user()->getFirstMediaUrl('admin_avatars')); ?>" 
                                    alt="user-avatar" 
                                    class="d-block rounded-circle border border-5 border-white shadow" 
                                    style="width: 140px; height: 140px; object-fit: cover; background: white;" />
                            <?php else: ?>
                                <div class="rounded-circle border border-5 border-white shadow bg-primary-light text-primary d-flex align-items-center justify-content-center" style="width: 140px; height: 140px; font-size: 3rem; font-weight: bold;">
                                    <?php echo e(Str::upper(Str::substr(auth('web')->user()->name, 0, 2))); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="text-center text-sm-start mb-3">
                            <h4 class="fw-bold mb-1 text-slate-800"><?php echo e(auth('web')->user()->name); ?></h4>
                            <p class="text-muted mb-0"><i class="bx bx-shield-quarter text-primary me-1"></i><?php echo e(__('profile.security_settings') ?? 'Security Settings'); ?></p>
                        </div>
                    </div>
                    
                    <hr class="my-4 border-light">
                    
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle d-flex align-items-center justify-content-center text-primary">
                            <i class="bx bx-lock-alt fs-3"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold text-slate-800"><?php echo e(__('profile.change_password_header') ?? 'Change Password'); ?></h5>
                            <p class="mb-0 text-muted small"><?php echo e(__('profile.password_requirements') ?? 'Ensure your account is using a long, random password to stay secure.'); ?></p>
                        </div>
                    </div>

                    <form action="<?php echo e(route('profile.password.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="row g-4">
                            <!-- Current Password -->
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-slate-700 mb-2" for="current_password"><?php echo e(__('profile.current_password') ?? 'Current Password'); ?></label>
                                <div class="position-relative">
                                    <input type="password" name="current_password" id="current_password" 
                                           class="form-control bg-light py-3 px-4 rounded-pill shadow-sm border <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           placeholder="&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;" required style="padding-inline-end: 3.5rem !important;">
                                    <button type="button" class="btn border-0 position-absolute bg-transparent" 
                                            onclick="var p=document.getElementById('current_password'); var i=this.querySelector('i'); if(p.type==='password'){p.type='text';i.className='bx bx-show fs-4 text-primary';}else{p.type='password';i.className='bx bx-hide fs-4 text-muted';}" 
                                            style="top: 50%; right: 10px; transform: translateY(-50%); z-index: 10;">
                                        <i class="bx bx-hide fs-4 text-muted"></i>
                                    </button>
                                </div>
                                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-2 ps-3 fw-medium"><i class="bx bx-error-circle me-1"></i><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            
                            <!-- New Password -->
                            <div class="col-md-6 mt-4">
                                <label class="form-label fw-bold text-slate-700 mb-2" for="new_password"><?php echo e(__('profile.new_password') ?? 'New Password'); ?></label>
                                <div class="position-relative">
                                    <input type="password" name="new_password" id="new_password" 
                                           class="form-control bg-light py-3 px-4 rounded-pill shadow-sm border <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           placeholder="&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;" required style="padding-inline-end: 3.5rem !important;">
                                    <button type="button" class="btn border-0 position-absolute bg-transparent" 
                                            onclick="var p=document.getElementById('new_password'); var i=this.querySelector('i'); if(p.type==='password'){p.type='text';i.className='bx bx-show fs-4 text-primary';}else{p.type='password';i.className='bx bx-hide fs-4 text-muted';}" 
                                            style="top: 50%; right: 10px; transform: translateY(-50%); z-index: 10;">
                                        <i class="bx bx-hide fs-4 text-muted"></i>
                                    </button>
                                </div>
                                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-2 ps-3 fw-medium"><i class="bx bx-error-circle me-1"></i><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Confirm New Password -->
                            <div class="col-md-6 mt-4">
                                <label class="form-label fw-bold text-slate-700 mb-2" for="new_password_confirmation"><?php echo e(__('profile.confirm_new_password') ?? 'Confirm New Password'); ?></label>
                                <div class="position-relative">
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                                           class="form-control bg-light py-3 px-4 rounded-pill shadow-sm border" 
                                           placeholder="&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;" required style="padding-inline-end: 3.5rem !important;">
                                    <button type="button" class="btn border-0 position-absolute bg-transparent" 
                                            onclick="var p=document.getElementById('new_password_confirmation'); var i=this.querySelector('i'); if(p.type==='password'){p.type='text';i.className='bx bx-show fs-4 text-primary';}else{p.type='password';i.className='bx bx-hide fs-4 text-muted';}" 
                                            style="top: 50%; right: 10px; transform: translateY(-50%); z-index: 10;">
                                        <i class="bx bx-hide fs-4 text-muted"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Password Requirements Info -->
                            <div class="col-12 mt-4">
                                <div class="p-4 bg-label-info rounded-xl d-flex gap-3 align-items-start">
                                    <i class="bx bx-info-circle fs-3 text-info mt-1"></i>
                                    <div>
                                        <h6 class="mb-1 fw-bold text-info">Password Requirements</h6>
                                        <p class="mb-0 small text-info opacity-75">Minimum 8 characters long, uppercase & lowercase, and at least one number or symbol.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-5 border-light">
                        
                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 shadow-sm fw-bold">
                                <i class="bx bx-save me-2"></i><?php echo e(__('general.save_changes') ?? 'Update Password'); ?>

                            </button>
                            <a href="<?php echo e(route('profile.index')); ?>" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <?php echo e(__('general.cancel') ?? 'Cancel'); ?>

                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\RealEstate-Services-Platform\resources\views/dashboard/profile/security.blade.php ENDPATH**/ ?>
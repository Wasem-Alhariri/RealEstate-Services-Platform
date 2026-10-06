<?php $__env->startSection('title', __('roles.create_role_title')); ?>

<?php $__env->startSection('page-style'); ?>
<style>
    .premium-form-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
        padding: 2.5rem;
        margin-top: 1rem;
    }

    .section-title {
        font-weight: 700;
        color: #1e293b;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title i {
        color: #696cff;
        background: rgba(105, 108, 255, 0.1);
        padding: 0.4rem;
        border-radius: 8px;
    }

    .form-label {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .modern-input {
        width: 100%;
        padding: 0.8rem 1rem 0.8rem 2.8rem;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        background: #f8fafc;
        font-size: 1rem;
        color: #1e293b;
        transition: all 0.2s;
    }
    html[dir="rtl"] .modern-input {
        padding: 0.8rem 2.8rem 0.8rem 1rem;
    }

    .modern-input:focus {
        background: #ffffff;
        border-color: #696cff;
        box-shadow: 0 0 0 4px rgba(105, 108, 255, 0.1);
        outline: none;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper .input-icon {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.2rem;
        pointer-events: none;
    }
    html[dir="rtl"] .input-wrapper .input-icon {
        left: auto;
        right: 1rem;
    }

    .modern-input:focus ~ .input-icon {
        color: #696cff;
    }

    /* Checkbox Grid Cards for Permissions */
    .permission-card {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        cursor: pointer;
        transition: all 0.2s;
        height: 100%;
        display: flex;
        align-items: center;
        background: #ffffff;
    }
    
    .permission-card:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
    }

    .permission-card input[type="checkbox"] {
        position: absolute;
        opacity: 0;
    }

    .permission-card .custom-check {
        width: 20px;
        height: 20px;
        border: 2px solid #cbd5e1;
        border-radius: 6px;
        margin-right: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        flex-shrink: 0;
    }
    html[dir="rtl"] .permission-card .custom-check {
        margin-right: 0;
        margin-left: 0.75rem;
    }

    .permission-card .custom-check i {
        color: white;
        font-size: 0.9rem;
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.2s;
    }

    .permission-card input[type="checkbox"]:checked ~ .custom-check {
        background: #696cff;
        border-color: #696cff;
    }
    .permission-card input[type="checkbox"]:checked ~ .custom-check i {
        opacity: 1;
        transform: scale(1);
    }
    .permission-card:has(input[type="checkbox"]:checked) {
        border-color: #696cff;
        background: rgba(105, 108, 255, 0.03);
    }

    .permissions-grid-wrapper {
        max-height: 400px;
        overflow-y: auto;
        padding-right: 10px;
        margin-right: -10px;
    }
    /* Scrollbar styling */
    .permissions-grid-wrapper::-webkit-scrollbar {
        width: 6px;
    }
    .permissions-grid-wrapper::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    .permissions-grid-wrapper::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    /* Buttons */
    .btn-save {
        background: #696cff;
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0.8rem 2rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s;
        box-shadow: 0 4px 10px rgba(105, 108, 255, 0.2);
    }
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(105, 108, 255, 0.3);
    }
    .btn-cancel {
        background: white;
        color: #475569;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.8rem 2rem;
        font-weight: 600;
        transition: all 0.2s;
    }
    .btn-cancel:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    .select-all-btn {
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: #475569;
        padding: 0.4rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s;
    }
    .select-all-btn:hover {
        background: #e2e8f0;
        color: #1e293b;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Header -->
<div class="mb-4">
    <a href="<?php echo e(route('roles.index')); ?>" class="text-muted text-decoration-none d-inline-flex align-items-center mb-2 fw-medium hover-primary">
        <i class="bx bx-arrow-back me-1"></i> Back to Roles
    </a>
    <h3 class="fw-bolder text-slate-800 mb-1"><?php echo e(__('roles.create_role_title') ?? 'Create New Role'); ?></h3>
    <p class="text-muted mb-0"><?php echo e(__('roles.step_define_perms') ?? 'Define role details and assign access permissions.'); ?></p>
</div>

<div class="premium-form-card">
    <form action="<?php echo e(route('roles.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        
        <!-- Role Info Section -->
        <div class="section-title">
            <i class="bx bx-id-card"></i> <?php echo e(__('roles.create_security_title') ?? 'Role Information'); ?>

        </div>
        <div class="row g-4 mb-5">
            <div class="col-md-12">
                <label class="form-label" for="role-name"><?php echo e(__('roles.role_name_label') ?? 'Role Name'); ?> <span class="text-danger">*</span></label>
                <div class="input-wrapper">
                    <input type="text" id="role-name" name="name" class="modern-input <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="<?php echo e(__('roles.role_name_placeholder') ?? 'e.g. Content Manager'); ?>" value="<?php echo e(old('name')); ?>" required>
                    <i class="bx bx-shield-quarter input-icon"></i>
                </div>
                <div class="text-muted small mt-2"><i class="bx bx-info-circle me-1"></i><?php echo e(__('roles.role_name_help') ?? 'Role names should be unique and descriptive.'); ?></div>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger small mt-1 d-block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <hr class="border-light my-5">

        <!-- Permissions Section -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="section-title mb-0">
                <i class="bx bx-check-shield"></i> <?php echo e(__('roles.assign_permissions') ?? 'Assign Permissions'); ?>

            </div>
            <button type="button" class="select-all-btn" id="selectAllBtn">
                Select All
            </button>
        </div>
        
        <p class="text-muted small mb-4"><?php echo e(__('roles.select_all_notice') ?? 'Choose the specific permissions this role will have.'); ?></p>
        
        <div class="permissions-grid-wrapper">
            <div class="row g-3">
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 col-sm-6">
                        <label class="permission-card">
                            <input type="checkbox" name="permissions[]" value="<?php echo e($permission->name); ?>" class="perm-checkbox" <?php echo e((collect(old('permissions'))->contains($permission->name)) ? 'checked':''); ?>>
                            <div class="custom-check">
                                <i class="bx bx-check"></i>
                            </div>
                            <div>
                                <span class="fw-bold d-block text-slate-700 small"><?php echo e(ucwords(str_replace('-', ' ', $permission->name))); ?></span>
                            </div>
                        </label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php $__errorArgs = ['permissions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="text-danger small mt-2"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        <div class="d-flex justify-content-end gap-3 mt-5 pt-4 border-top border-light">
            <a href="<?php echo e(route('roles.index')); ?>" class="btn-cancel text-decoration-none">
                <?php echo e(__('roles.cancel') ?? 'Cancel'); ?>

            </a>
            <button type="submit" class="btn-save">
                <i class="bx bx-check-shield me-1"></i> <?php echo e(__('roles.save_role_btn') ?? 'Create Role'); ?>

            </button>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllBtn = document.getElementById('selectAllBtn');
        const checkboxes = document.querySelectorAll('.perm-checkbox');
        let allSelected = false;

        if (selectAllBtn) {
            selectAllBtn.addEventListener('click', function() {
                allSelected = !allSelected;
                checkboxes.forEach(cb => {
                    cb.checked = allSelected;
                });
                selectAllBtn.innerText = allSelected ? 'Deselect All' : 'Select All';
                selectAllBtn.classList.toggle('bg-primary');
                selectAllBtn.classList.toggle('text-white');
                selectAllBtn.classList.toggle('border-primary');
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\RealEstate-Services-Platform\resources\views/dashboard/roles/create.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', __('admins.management_title')); ?>

<?php $__env->startSection('page-style'); ?>
<style>
    /* Premium Stats Cards */
    .stat-card-premium {
        background: #ffffff;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
        display: flex;
        align-items: center;
        gap: 1.25rem;
        transition: transform 0.3s ease;
    }
    .stat-card-premium:hover {
        transform: translateY(-5px);
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
    }
    .stat-info h3 {
        margin: 0;
        font-weight: 800;
        font-size: 1.5rem;
        color: #1e293b;
    }
    .stat-info p {
        margin: 0;
        color: #64748b;
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Premium Table Card */
    .premium-table-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
        padding: 2rem;
        margin-top: 2rem;
    }

    /* Modern Search Input */
    .modern-search {
        position: relative;
        max-width: 400px;
    }
    .modern-search input {
        width: 100%;
        padding: 1rem 1rem 1rem 3rem;
        border-radius: 16px;
        border: 2px solid #f1f5f9;
        background: #f8fafc;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .modern-search input:focus {
        background: #ffffff;
        border-color: #696cff;
        box-shadow: 0 0 0 4px rgba(105, 108, 255, 0.1);
        outline: none;
    }
    .modern-search i {
        position: absolute;
        top: 50%;
        left: 1.2rem;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1.2rem;
    }
    /* RTL Support for search */
    html[dir="rtl"] .modern-search input {
        padding: 1rem 3rem 1rem 1rem;
    }
    html[dir="rtl"] .modern-search i {
        left: auto;
        right: 1.2rem;
    }

    /* Table Styles */
    .premium-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }
    .premium-table th {
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 0 1.5rem 0.5rem;
        border-bottom: 2px solid #f1f5f9;
    }
    .premium-table td {
        padding: 1.25rem 1.5rem;
        background: #ffffff;
        border-top: 1px solid #f8fafc;
        border-bottom: 1px solid #f8fafc;
        vertical-align: middle;
    }
    .premium-table tr td:first-child {
        border-left: 1px solid #f8fafc;
        border-top-left-radius: 16px;
        border-bottom-left-radius: 16px;
    }
    .premium-table tr td:last-child {
        border-right: 1px solid #f8fafc;
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px;
    }
    .premium-table tbody tr {
        box-shadow: 0 4px 6px -4px rgba(0,0,0,0.02);
        transition: all 0.2s ease;
    }
    .premium-table tbody tr:hover {
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }

    /* Avatar and Badges */
    .admin-avatar {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        object-fit: cover;
    }
    .admin-avatar-fallback {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: rgba(105, 108, 255, 0.1);
        color: #696cff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
    }
    .role-badge {
        padding: 0.4rem 1rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.8rem;
        background: rgba(105, 108, 255, 0.08);
        color: #696cff;
        display: inline-block;
        margin-right: 0.25rem;
        margin-bottom: 0.25rem;
    }
    
    /* Action Buttons */
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        background: #f1f5f9;
        color: #64748b;
        transition: all 0.2s;
    }
    .btn-action:hover {
        background: #696cff;
        color: white;
    }
    .btn-action.btn-delete:hover {
        background: #ff3e1d;
        color: white;
    }

    /* Primary Add Button */
    .btn-premium-add {
        background: #696cff;
        color: white;
        border: none;
        border-radius: 14px;
        padding: 0.8rem 1.5rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 10px rgba(105, 108, 255, 0.2);
        transition: all 0.3s;
    }
    .btn-premium-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(105, 108, 255, 0.3);
        color: white;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Header & Title -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bolder text-slate-800 mb-1"><?php echo e(__('admins.management_title')); ?></h3>
        <p class="text-muted mb-0">Manage system administrators, roles, and access.</p>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-admins')): ?>
        <a href="<?php echo e(route('admins.create')); ?>" class="btn-premium-add">
            <i class="bx bx-plus fs-5"></i> <?php echo e(__('admins.add_new')); ?>

        </a>
    <?php endif; ?>
</div>

<!-- Stats Widgets -->
<div class="row g-4 mb-2">
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card-premium">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                <i class="bx bx-user"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo e($stats['total'] ?? 0); ?></h3>
                <p><?php echo e(__('admins.total_admins')); ?></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card-premium">
            <div class="stat-icon bg-success bg-opacity-10 text-success">
                <i class="bx bx-user-check"></i>
            </div>
            <div class="stat-info">
                <h3>+<?php echo e($stats['recent'] ?? 0); ?></h3>
                <p><?php echo e(__('admins.last_30_days')); ?></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="stat-card-premium">
            <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                <i class="bx bx-shield-quarter"></i>
            </div>
            <div class="stat-info">
                <h3><?php echo e($stats['roles_count'] ?? 0); ?></h3>
                <p><?php echo e(__('admins.role_assignments')); ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="premium-table-card">
    
    <!-- Filters / Search -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0 text-slate-800">Administrator List</h5>
        <form action="<?php echo e(route('admins.index')); ?>" method="GET" id="admins-filter-form">
            <div class="modern-search">
                <i class="bx bx-search"></i>
                <input type="text" name="search" id="search" placeholder="<?php echo e(__('admins.search_placeholder') ?? 'Search admins...'); ?>" value="<?php echo e(request('search')); ?>">
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="table-responsive text-nowrap">
        <table class="premium-table">
            <thead>
                <tr>
                    <th><?php echo e(__('admins.column_admin')); ?></th>
                    <th><?php echo e(__('admins.column_roles')); ?></th>
                    <th><?php echo e(__('admins.column_joined')); ?></th>
                    <th class="text-end"><?php echo e(__('admins.column_actions')); ?></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $__empty_1 = true; $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <?php if($admin->getFirstMediaUrl('admin_avatars')): ?>
                                        <img src="<?php echo e($admin->getFirstMediaUrl('admin_avatars')); ?>" alt="Avatar" class="admin-avatar shadow-sm">
                                    <?php else: ?>
                                        <div class="admin-avatar-fallback shadow-sm">
                                            <?php echo e(Str::upper(Str::substr($admin->name, 0, 2))); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <span class="fw-bold d-block text-slate-800 fs-6"><?php echo e($admin->name); ?></span>
                                    <small class="text-muted"><?php echo e($admin->email); ?></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php $__empty_2 = true; $__currentLoopData = $admin->roles->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                <span class="role-badge"><?php echo e($role->name); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                <span class="text-muted small fst-italic"><?php echo e(__('admins.no_role')); ?></span>
                            <?php endif; ?>
                            <?php if($admin->roles->count() > 2): ?>
                                <span class="role-badge bg-secondary bg-opacity-10 text-secondary">+<?php echo e($admin->roles->count() - 2); ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex align-items-center text-slate-600">
                                <i class="bx bx-calendar me-2 text-slate-400"></i>
                                <span class="small fw-medium"><?php echo e($admin->created_at->translatedFormat('M d, Y')); ?></span>
                            </div>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-admins')): ?>
                                    <a href="<?php echo e(route('admins.edit', $admin->id)); ?>" class="btn-action" title="Edit Admin">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-admins')): ?>
                                    <form action="<?php echo e(route('admins.destroy', $admin->id)); ?>" method="POST" class="delete-admin-form d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn-action btn-delete" title="Delete Admin">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 80px; height: 80px;">
                                <i class="bx bx-search text-muted" style="font-size: 2.5rem;"></i>
                            </div>
                            <h5 class="fw-bold text-slate-700"><?php echo e(__('admins.no_results') ?? 'No Administrators Found'); ?></h5>
                            <p class="text-muted mb-0"><?php echo e(request('search') ? __('admins.no_results_matching') : 'Get started by creating a new administrator.'); ?></p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if($admins->hasPages()): ?>
        <div class="d-flex justify-content-center mt-4 pt-3 border-top border-light">
            <?php echo e($admins->appends(request()->query())->links('pagination::bootstrap-5')); ?>

        </div>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search Auto-submit with debounce
        const searchInput = document.getElementById('search');
        let timeout = null;
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    document.getElementById('admins-filter-form').submit();
                }, 600);
            });
        }

        // Delete Confirmation with SweetAlert if available, fallback to confirm()
        document.querySelectorAll('.delete-admin-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const currentForm = this;
                
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "<?php echo e(__('admins.confirm_delete') ?? 'You will not be able to recover this administrator!'); ?>",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ff3e1d',
                        cancelButtonColor: '#8592a3',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            currentForm.submit();
                        }
                    });
                } else {
                    if(confirm("<?php echo e(__('admins.confirm_delete') ?? 'Are you sure you want to delete this administrator?'); ?>")) {
                        currentForm.submit();
                    }
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\RealEstate-Services-Platform\resources\views/dashboard/admins/index.blade.php ENDPATH**/ ?>
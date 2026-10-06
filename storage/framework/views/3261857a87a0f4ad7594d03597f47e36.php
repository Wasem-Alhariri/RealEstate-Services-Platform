<?php $__env->startSection('title', __('login.login_title') . ' - ' . __('sidebar.app_name')); ?>

<?php $__env->startSection('page-style'); ?>
<style>
    /* -----------------------------------------------------------------
       SENIOR UI/UX LOGIN DESIGN - REAL ESTATE SAAS
       ----------------------------------------------------------------- */
    
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --primary: #4f46e5;
        --primary-dark: #3730a3;
        --surface: #ffffff;
        --background: #f1f5f9;
        --text-main: #0f172a;
        --text-muted: #64748b;
        --border-color: #e2e8f0;
    }

    body {
        background-color: var(--background);
        font-family: 'Plus Jakarta Sans', sans-serif;
        margin: 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: 
            radial-gradient(at 100% 100%, rgba(79, 70, 229, 0.08) 0px, transparent 50%),
            radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.05) 0px, transparent 50%);
    }

    /* Main Container - The Split Card */
    .saas-auth-card {
        display: flex;
        width: 100%;
        max-width: 1100px;
        min-height: 650px;
        background: var(--surface);
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.15);
        overflow: hidden;
        margin: 2rem;
    }

    /* -------------------------------------------
       LEFT SIDE: BRANDING & IMAGE
       ------------------------------------------- */
    .saas-auth-cover {
        flex: 1.2;
        position: relative;
        background: linear-gradient(180deg, rgba(15, 23, 42, 0.2) 0%, rgba(15, 23, 42, 0.9) 100%), 
                    url('https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80') center/cover;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 4rem;
        color: white;
    }

    .cover-content {
        position: relative;
        z-index: 10;
        animation: fadeInUp 1s ease-out;
    }

    .cover-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 100px;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(255,255,255,0.3);
    }

    .cover-title {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1rem;
        letter-spacing: -1px;
    }

    .cover-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.6;
        max-width: 90%;
    }

    /* -------------------------------------------
       RIGHT SIDE: LOGIN FORM
       ------------------------------------------- */
    .saas-auth-form {
        flex: 1;
        padding: 4rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: var(--surface);
    }

    .brand-logo {
        width: 48px;
        height: 48px;
        background: var(--primary);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
    }

    .form-header {
        margin-bottom: 2.5rem;
    }

    .form-title {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: -0.5px;
        margin-bottom: 0.5rem;
    }

    .form-subtitle {
        color: var(--text-muted);
        font-size: 1rem;
    }

    /* Floating Label Inputs */
    .floating-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .floating-input {
        width: 100%;
        padding: 1.5rem 1.25rem 0.5rem;
        font-size: 1rem;
        font-family: inherit;
        color: var(--text-main);
        border: 2px solid var(--border-color);
        border-radius: 14px;
        background: transparent;
        transition: all 0.2s ease;
    }

    .floating-input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .floating-label {
        position: absolute;
        top: 50%;
        inset-inline-start: 1.25rem;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-weight: 500;
        transition: all 0.2s ease;
        pointer-events: none;
    }

    .floating-input:focus ~ .floating-label,
    .floating-input:not(:placeholder-shown) ~ .floating-label {
        top: 0.8rem;
        transform: translateY(0);
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--primary);
    }

    /* Password Specific */
    .password-toggle {
        position: absolute;
        top: 50%;
        inset-inline-end: 1rem;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .password-toggle:hover {
        background: rgba(79, 70, 229, 0.05);
        color: var(--primary);
    }

    /* Form Actions */
    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        font-size: 0.9rem;
    }

    .custom-checkbox {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
        cursor: pointer;
        font-weight: 500;
    }

    .custom-checkbox input {
        width: 18px;
        height: 18px;
        border-radius: 6px;
        border: 2px solid var(--border-color);
        accent-color: var(--primary);
        cursor: pointer;
    }

    .forgot-link {
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }

    .forgot-link:hover {
        color: var(--primary-dark);
    }

    /* Primary Button */
    .btn-submit {
        width: 100%;
        padding: 1.1rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 14px;
        font-size: 1.05rem;
        font-weight: 700;
        font-family: inherit;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2), 0 2px 4px -1px rgba(79, 70, 229, 0.1);
    }

    .btn-submit:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3), 0 4px 6px -2px rgba(79, 70, 229, 0.15);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* Error Alert */
    .premium-alert {
        background: #fef2f2;
        border: 1px solid #fee2e2;
        color: #b91c1c;
        padding: 1rem 1.25rem;
        border-radius: 14px;
        margin-bottom: 2rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* -------------------------------------------
       AURORA ANIMATED BACKGROUND
       ------------------------------------------- */
    .aurora-bg {
        position: fixed;
        top: 0; left: 0; width: 100vw; height: 100vh;
        overflow: hidden;
        z-index: -1;
        background-color: #f1f5f9;
    }
    .aurora-blob {
        position: absolute;
        border-radius: 50%;
        filter: blur(120px);
        opacity: 0.5;
        animation: drift infinite alternate ease-in-out;
    }
    .aurora-1 { width: 600px; height: 600px; background: rgba(79, 70, 229, 0.8); top: -10%; left: -10%; animation-duration: 25s; }
    .aurora-2 { width: 500px; height: 500px; background: rgba(56, 189, 248, 0.7); bottom: -10%; right: -10%; animation-duration: 22s; animation-delay: -5s; }
    .aurora-3 { width: 700px; height: 700px; background: rgba(129, 140, 248, 0.6); top: 30%; left: 40%; animation-duration: 28s; animation-delay: -10s; }

    @keyframes drift {
        0% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(80px, -60px) scale(1.1); }
        66% { transform: translate(-60px, 80px) scale(0.9); }
        100% { transform: translate(0, 0) scale(1); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 992px) {
        .saas-auth-cover { display: none; }
        .saas-auth-card { max-width: 500px; min-height: auto; }
        .saas-auth-form { padding: 3rem 2rem; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Interactive Aurora Background -->
<div class="aurora-bg">
    <div class="aurora-blob aurora-1"></div>
    <div class="aurora-blob aurora-2"></div>
    <div class="aurora-blob aurora-3"></div>
</div>

<div class="saas-auth-card">
    
    <!-- LEFT SIDE: Architectural Branding -->
    <div class="saas-auth-cover d-none d-lg-flex">
        <div class="cover-content">
            <div class="cover-badge">
                <i class="bx bx-buildings me-2"></i> Premium Dashboard
            </div>
            <h1 class="cover-title">Manage Your<br>Real Estate Empire.</h1>
            <p class="cover-subtitle">Experience a seamless workflow, powerful analytics, and complete control over your business services in one unified platform.</p>
        </div>
    </div>

    <!-- RIGHT SIDE: Modern Form -->
    <div class="saas-auth-form">
        <!-- Logo -->
        <div class="brand-logo">
            <i class="bx bx-home-alt-2 fs-2 text-white"></i>
        </div>

        <!-- Header -->
        <div class="form-header">
            <h2 class="form-title">Welcome Back</h2>
            <p class="form-subtitle">Please enter your details to sign in.</p>
        </div>

        <!-- Errors -->
        <?php if($errors->any()): ?>
            <div class="premium-alert">
                <i class="bx bx-error-circle fs-4 mt-1"></i>
                <ul class="mb-0 ps-0 list-unstyled">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form id="formAuthentication" action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <!-- Email (Floating Label) -->
            <div class="floating-group">
                <!-- placeholder=" " is required for pure CSS floating labels -->
                <input type="email" class="floating-input" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder=" " required autofocus autocomplete="username">
                <label for="email" class="floating-label"><?php echo e(__('login.email') ?? 'Email Address'); ?></label>
            </div>

            <!-- Password (Floating Label) -->
            <div class="floating-group mb-5">
                <input type="password" class="floating-input" id="password" name="password" placeholder=" " required autocomplete="current-password" style="padding-inline-end: 3rem;">
                <label for="password" class="floating-label"><?php echo e(__('login.password') ?? 'Password'); ?></label>
                
                <!-- Robust Toggle -->
                <button type="button" class="password-toggle" id="togglePasswordBtn" tabindex="-1" title="Toggle Password Visibility">
                    <i class="bx bx-hide fs-4" id="toggleIcon"></i>
                </button>
            </div>
            
            <!-- Submit -->
            <button class="btn-submit" type="submit">
                <?php echo e(__('login.sign_in') ?? 'Sign In'); ?> 
                <i class="bx bx-right-arrow-alt fs-4"></i>
            </button>
        </form>

        <div class="text-center mt-5">
            <p class="text-muted small fw-medium">&copy; <?php echo e(date('Y')); ?> <?php echo e(__('sidebar.app_name')); ?>. All rights reserved.</p>
        </div>
    </div>

</div>

<!-- Isolated JS for Password Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        
        if(toggleBtn && passwordInput && icon) {
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation(); // Prevents any wrapper clicks from firing
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('bx-hide');
                    icon.classList.add('bx-show');
                    icon.style.color = 'var(--primary)';
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('bx-show');
                    icon.classList.add('bx-hide');
                    icon.style.color = 'inherit';
                }
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/blankLayout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\RealEstate-Services-Platform\resources\views/dashboard/auth/login.blade.php ENDPATH**/ ?>
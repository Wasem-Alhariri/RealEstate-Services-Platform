@extends('layouts.app')

@section('title', __('admins.add_title'))

@section('page-style')
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

    /* Checkbox Grid Cards */
    .role-card {
        border: 2px solid #e2e8f0;
        border-radius: 14px;
        padding: 1rem;
        cursor: pointer;
        transition: all 0.2s;
        height: 100%;
        display: flex;
        align-items: center;
        background: #ffffff;
    }
    
    .role-card:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
    }

    /* Hide the actual checkbox but keep it accessible */
    .role-card input[type="checkbox"] {
        position: absolute;
        opacity: 0;
    }

    /* Custom Checkbox UI */
    .role-card .custom-check {
        width: 24px;
        height: 24px;
        border: 2px solid #cbd5e1;
        border-radius: 6px;
        margin-right: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    html[dir="rtl"] .role-card .custom-check {
        margin-right: 0;
        margin-left: 1rem;
    }

    .role-card .custom-check i {
        color: white;
        font-size: 1rem;
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.2s;
    }

    /* Checked State */
    .role-card input[type="checkbox"]:checked ~ .custom-check {
        background: #696cff;
        border-color: #696cff;
    }
    .role-card input[type="checkbox"]:checked ~ .custom-check i {
        opacity: 1;
        transform: scale(1);
    }
    .role-card:has(input[type="checkbox"]:checked) {
        border-color: #696cff;
        background: rgba(105, 108, 255, 0.03);
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
</style>
@endsection

@section('content')

<!-- Header -->
<div class="mb-4">
    <a href="{{ route('admins.index') }}" class="text-muted text-decoration-none d-inline-flex align-items-center mb-2 fw-medium hover-primary">
        <i class="bx bx-arrow-back me-1"></i> Back to Administrators
    </a>
    <h3 class="fw-bolder text-slate-800 mb-1">{{ __('admins.add_title') }}</h3>
    <p class="text-muted mb-0">{{ __('admins.system_subtitle') ?? 'Create a new administrator and assign roles.' }}</p>
</div>

<div class="premium-form-card">
    <form action="{{ route('admins.store') }}" method="POST">
        @csrf
        
        <!-- Basic Info Section -->
        <div class="section-title">
            <i class="bx bx-id-card"></i> Basic Information
        </div>
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <label class="form-label" for="name">{{ __('admins.full_name') }} <span class="text-danger">*</span></label>
                <div class="input-wrapper">
                    <input type="text" id="name" name="name" class="modern-input @error('name') border-danger @enderror" placeholder="{{ __('admins.placeholders.name') ?? 'e.g. John Doe' }}" value="{{ old('name') }}" required>
                    <i class="bx bx-user input-icon"></i>
                </div>
                @error('name') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label" for="email">{{ __('admins.email_address') }} <span class="text-danger">*</span></label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" class="modern-input @error('email') border-danger @enderror" placeholder="{{ __('admins.placeholders.email') ?? 'admin@example.com' }}" value="{{ old('email') }}" required>
                    <i class="bx bx-envelope input-icon"></i>
                </div>
                @error('email') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
            </div>
        </div>

        <hr class="border-light my-5">

        <!-- Roles Section -->
        <div class="section-title">
            <i class="bx bx-shield-quarter"></i> {{ __('admins.assign_roles') }}
        </div>
        <div class="row g-3 mb-5">
            @foreach($roles as $role)
                <div class="col-md-4">
                    <label class="role-card">
                        <input type="checkbox" name="roles[]" value="{{ $role->name }}" {{ (collect(old('roles'))->contains($role->name)) ? 'checked':'' }}>
                        <div class="custom-check">
                            <i class="bx bx-check"></i>
                        </div>
                        <div>
                            <span class="fw-bold d-block text-slate-800">{{ $role->name }}</span>
                        </div>
                    </label>
                </div>
            @endforeach
            @error('roles') <div class="col-12"><span class="text-danger small">{{ $message }}</span></div> @enderror
        </div>

        <hr class="border-light my-5">

        <!-- Security Section -->
        <div class="section-title">
            <i class="bx bx-lock-alt"></i> Security
        </div>
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <label class="form-label" for="password">{{ __('admins.password') }} <span class="text-danger">*</span></label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" class="modern-input @error('password') border-danger @enderror" placeholder="••••••••••••" required style="padding-inline-end: 3rem;">
                    <i class="bx bx-lock-alt input-icon"></i>
                    
                    <button type="button" class="btn border-0 position-absolute bg-transparent" 
                            onclick="var p=document.getElementById('password'); var i=this.querySelector('i'); if(p.type==='password'){p.type='text';i.className='bx bx-show text-primary';}else{p.type='password';i.className='bx bx-hide text-muted';}" 
                            style="top: 50%; right: 10px; transform: translateY(-50%); z-index: 10;">
                        <i class="bx bx-hide text-muted fs-5"></i>
                    </button>
                </div>
                @error('password') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label" for="password_confirmation">{{ __('admins.confirm_password') }} <span class="text-danger">*</span></label>
                <div class="input-wrapper">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="modern-input" placeholder="••••••••••••" required style="padding-inline-end: 3rem;">
                    <i class="bx bx-check-shield input-icon"></i>
                    
                    <button type="button" class="btn border-0 position-absolute bg-transparent" 
                            onclick="var p=document.getElementById('password_confirmation'); var i=this.querySelector('i'); if(p.type==='password'){p.type='text';i.className='bx bx-show text-primary';}else{p.type='password';i.className='bx bx-hide text-muted';}" 
                            style="top: 50%; right: 10px; transform: translateY(-50%); z-index: 10;">
                        <i class="bx bx-hide text-muted fs-5"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top border-light">
            <a href="{{ route('admins.index') }}" class="btn-cancel text-decoration-none">
                {{ __('admins.cancel') ?? 'Cancel' }}
            </a>
            <button type="submit" class="btn-save">
                <i class="bx bx-save me-1"></i> {{ __('admins.create_button') ?? 'Create Administrator' }}
            </button>
        </div>
    </form>
</div>

@endsection

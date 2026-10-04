@extends('layouts.app')

@section('title', __('profile.security_title') ?? 'Security Settings')

@section('page-style')
<style>
    .nav-pills .nav-link { transition: all 0.3s ease; border: 1px solid transparent; }
    .nav-pills .hover-bg-light:hover { background-color: #e7e7ff !important; color: #696cff !important; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.05) !important; border-color: rgba(105, 108, 255, 0.2); }
    .nav-pills .nav-link.active { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(105, 108, 255, 0.4) !important; }
</style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ __('profile.account') ?? 'Account' }} /</span> {{ __('profile.security') ?? 'Security' }}
    </h4>

    <div class="row">
        <div class="col-md-12">
            <!-- Navigation Tabs -->
            <ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2">
                <li class="nav-item">
                    <a class="nav-link bg-white text-muted shadow-sm px-4 rounded-pill hover-bg-light" href="{{ route('profile.index') }}">
                        <i class="bx bx-user me-2"></i> {{ __('profile.tab_profile') ?? 'Profile Details' }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active shadow-sm px-4 rounded-pill" href="javascript:void(0);">
                        <i class="bx bx-lock-alt me-2"></i> {{ __('profile.security') ?? 'Security' }}
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
                            @if(auth('web')->user()->getFirstMediaUrl('admin_avatars'))
                                <img src="{{ auth('web')->user()->getFirstMediaUrl('admin_avatars') }}" 
                                    alt="user-avatar" 
                                    class="d-block rounded-circle border border-5 border-white shadow" 
                                    style="width: 140px; height: 140px; object-fit: cover; background: white;" />
                            @else
                                <div class="rounded-circle border border-5 border-white shadow bg-primary-light text-primary d-flex align-items-center justify-content-center" style="width: 140px; height: 140px; font-size: 3rem; font-weight: bold;">
                                    {{ Str::upper(Str::substr(auth('web')->user()->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="text-center text-sm-start mb-3">
                            <h4 class="fw-bold mb-1 text-slate-800">{{ auth('web')->user()->name }}</h4>
                            <p class="text-muted mb-0"><i class="bx bx-shield-quarter text-primary me-1"></i>{{ __('profile.security_settings') ?? 'Security Settings' }}</p>
                        </div>
                    </div>
                    
                    <hr class="my-4 border-light">
                    
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle d-flex align-items-center justify-content-center text-primary">
                            <i class="bx bx-lock-alt fs-3"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold text-slate-800">{{ __('profile.change_password_header') ?? 'Change Password' }}</h5>
                            <p class="mb-0 text-muted small">{{ __('profile.password_requirements') ?? 'Ensure your account is using a long, random password to stay secure.' }}</p>
                        </div>
                    </div>

                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <!-- Current Password -->
                            <div class="col-md-12 form-password-toggle">
                                <label class="form-label fw-bold text-slate-700 mb-2" for="current_password">{{ __('profile.current_password') ?? 'Current Password' }}</label>
                                <div class="input-group input-group-merge rounded-pill shadow-sm border @error('current_password') border-danger @enderror">
                                    <input type="password" name="current_password" id="current_password" 
                                           class="form-control border-0 bg-light py-3 px-4 rounded-start-pill" 
                                           placeholder="&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;" required>
                                    <span class="input-group-text bg-light border-0 cursor-pointer pe-4 rounded-end-pill" onclick="const input = this.previousElementSibling; const icon = this.querySelector('i'); if(input.type === 'password'){ input.type = 'text'; icon.classList.replace('bx-hide', 'bx-show'); } else { input.type = 'password'; icon.classList.replace('bx-show', 'bx-hide'); }"><i class="bx bx-hide fs-4 text-muted pointer-events-none"></i></span>
                                </div>
                                @error('current_password') <div class="text-danger small mt-2 ps-3 fw-medium"><i class="bx bx-error-circle me-1"></i>{{ $message }}</div> @enderror
                            </div>
                            
                            <!-- New Password -->
                            <div class="col-md-6 form-password-toggle mt-4">
                                <label class="form-label fw-bold text-slate-700 mb-2" for="new_password">{{ __('profile.new_password') ?? 'New Password' }}</label>
                                <div class="input-group input-group-merge rounded-pill shadow-sm border @error('new_password') border-danger @enderror">
                                    <input type="password" name="new_password" id="new_password" 
                                           class="form-control border-0 bg-light py-3 px-4 rounded-start-pill" 
                                           placeholder="&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;" required>
                                    <span class="input-group-text bg-light border-0 cursor-pointer pe-4 rounded-end-pill" onclick="const input = this.previousElementSibling; const icon = this.querySelector('i'); if(input.type === 'password'){ input.type = 'text'; icon.classList.replace('bx-hide', 'bx-show'); } else { input.type = 'password'; icon.classList.replace('bx-show', 'bx-hide'); }"><i class="bx bx-hide fs-4 text-muted pointer-events-none"></i></span>
                                </div>
                                @error('new_password') <div class="text-danger small mt-2 ps-3 fw-medium"><i class="bx bx-error-circle me-1"></i>{{ $message }}</div> @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div class="col-md-6 form-password-toggle mt-4">
                                <label class="form-label fw-bold text-slate-700 mb-2" for="new_password_confirmation">{{ __('profile.confirm_new_password') ?? 'Confirm New Password' }}</label>
                                <div class="input-group input-group-merge rounded-pill shadow-sm border">
                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                                           class="form-control border-0 bg-light py-3 px-4 rounded-start-pill" 
                                           placeholder="&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;&middot;" required>
                                    <span class="input-group-text bg-light border-0 cursor-pointer pe-4 rounded-end-pill" onclick="const input = this.previousElementSibling; const icon = this.querySelector('i'); if(input.type === 'password'){ input.type = 'text'; icon.classList.replace('bx-hide', 'bx-show'); } else { input.type = 'password'; icon.classList.replace('bx-show', 'bx-hide'); }"><i class="bx bx-hide fs-4 text-muted pointer-events-none"></i></span>
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
                                <i class="bx bx-save me-2"></i>{{ __('general.save_changes') ?? 'Update Password' }}
                            </button>
                            <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                {{ __('general.cancel') ?? 'Cancel' }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

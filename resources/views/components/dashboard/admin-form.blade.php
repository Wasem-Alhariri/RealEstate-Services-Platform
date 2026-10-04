@props([
    'admin' => null,
    'roles',
    'action',
    'method' => 'POST',
    'title',
    'subtitle',
    'submitLabel',
    'submitIcon' => 'bx bx-save',
    'adminRoles' => [],
])

@php
    $selectedRoles = collect(old('roles', $adminRoles));
    $isEditing = (bool) $admin;
@endphp

@if ($isEditing)
    <x-dashboard.page-header :title="$title" :description="$subtitle" eyebrow="{{ __('admins.edit_title') }}">
        <a href="{{ route('admins.index') }}" class="btn btn-outline-secondary"><i class="bx bx-arrow-back"></i>{{ __('admins.cancel') }}</a>
    </x-dashboard.page-header>
@else
    <x-dashboard.page-header :title="$title" :description="$subtitle" eyebrow="{{ __('admins.add_title') }}" />
@endif

<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="app-form-shell">
        <section class="app-form-panel">
            <header class="app-form-panel__header">
                <span class="app-form-panel__icon"><i class="bx bx-user"></i></span>
                <div>
                    <h2 class="app-form-panel__title">{{ __('admins.full_name') }}</h2>
                    <p class="app-form-panel__subtitle">{{ __('admins.email_address') }}</p>
                </div>
            </header>
            <div class="app-form-panel__body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="app-form-field">
                            <label class="app-form-field__label" for="full-name">{{ __('admins.full_name') }}</label>
                            <div class="input-group input-group-merge"><span class="input-group-text"><i class="bx bx-user"></i></span><input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="full-name" placeholder="{{ __('admins.placeholders.name') }}" value="{{ old('name', $admin?->name) }}" required></div>
                            @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="app-form-field">
                            <label class="app-form-field__label" for="email">{{ __('admins.email_address') }}</label>
                            <div class="input-group input-group-merge"><span class="input-group-text"><i class="bx bx-envelope"></i></span><input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('admins.placeholders.email') }}" value="{{ old('email', $admin?->email) }}" required></div>
                            @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="border-top mt-3 pt-4">
                    <div class="d-flex align-items-center gap-2 mb-3"><span class="app-form-panel__icon"><i class="bx bx-lock-alt"></i></span><div><h3 class="app-form-panel__title">{{ $isEditing ? __('admins.new_password') : __('admins.password') }}</h3>@if ($isEditing)<p class="app-form-panel__subtitle">{{ __('admins.password_help') }}</p>@endif</div></div>
                    <div class="row g-3">
                        <div class="col-md-6 form-password-toggle">
                            <div class="app-form-field">
                                <label class="app-form-field__label" for="password">{{ $isEditing ? __('admins.new_password') : __('admins.password') }}</label>
                                <div class="input-group input-group-merge"><span class="input-group-text"><i class="bx bx-lock"></i></span><input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••••••"><button type="button" class="input-group-text password-toggle border-0" data-password-toggle aria-label="{{ __('admins.password') }}"><i class="bx bx-hide"></i></button></div>
                                @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6 form-password-toggle">
                            <div class="app-form-field">
                                <label class="app-form-field__label" for="password_confirmation">{{ __('admins.confirm_password') }}</label>
                                <div class="input-group input-group-merge"><span class="input-group-text"><i class="bx bx-check-shield"></i></span><input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••••••"><button type="button" class="input-group-text password-toggle border-0" data-password-toggle aria-label="{{ __('admins.confirm_password') }}"><i class="bx bx-hide"></i></button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <aside class="app-aside-panel">
            <header class="app-aside-panel__header">
                <span class="app-aside-panel__icon"><i class="bx bx-shield-quarter"></i></span>
                <div>
                    <h2 class="app-aside-panel__title">{{ __('admins.assign_roles') }}</h2>
                    <p class="app-aside-panel__subtitle">{{ count($roles) }} {{ __('admins.assign_roles') }}</p>
                </div>
            </header>
            <div class="app-aside-panel__body">
                <p class="text-muted small mb-0">{{ __('admins.system_subtitle') }}</p>
            </div>
        </aside>
    </div>

    <section class="app-form-panel mt-4">
        <header class="app-form-panel__header">
            <span class="app-form-panel__icon"><i class="bx bx-shield"></i></span>
            <div>
                <h2 class="app-form-panel__title">{{ __('admins.assign_roles') }}</h2>
                <p class="app-form-panel__subtitle">{{ __('admins.system_subtitle') }}</p>
            </div>
        </header>
        <div class="app-form-panel__body">
            <div class="permission-grid">
                @foreach ($roles as $role)
                    <label class="permission-card" for="role_{{ $role->id }}">
                        <span class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_{{ $role->id }}" @checked($selectedRoles->contains($role->name))><span class="form-check-label fw-bold"><i class="bx bx-shield-quarter me-1"></i>{{ $role->name }}</span></span>
                    </label>
                @endforeach
            </div>
            @error('roles')<div class="invalid-feedback d-block mt-3">{{ $message }}</div>@enderror
            <div class="app-form-actions">
                <button type="submit" class="btn btn-primary"><i class="{{ $submitIcon }}"></i>{{ $submitLabel }}</button>
                @if ($isEditing)<a href="{{ route('admins.index') }}" class="btn btn-outline-secondary">{{ __('admins.cancel') }}</a>@endif
            </div>
        </div>
    </section>
</form>

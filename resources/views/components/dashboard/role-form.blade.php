@props([
    'role' => null,
    'rolePermissions' => [],
    'permissions',
    'action',
    'method' => 'POST',
    'title',
    'description' => null,
    'submitLabel',
    'submitIcon' => 'bx bx-check-shield',
])

@php($selectedPermissions = collect(old('permissions', $rolePermissions)))

<x-dashboard.page-header :title="$title" :description="$description" eyebrow="{{ __('roles.create_security_title') }}">
    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary"><i class="bx bx-arrow-back"></i>{{ __('roles.cancel') }}</a>
</x-dashboard.page-header>

<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="app-form-shell">
        <section class="app-form-panel">
            <header class="app-form-panel__header">
                <span class="app-form-panel__icon"><i class="bx bx-shield-quarter"></i></span>
                <div>
                    <h2 class="app-form-panel__title">{{ __('roles.role_name_label') }}</h2>
                    <p class="app-form-panel__subtitle">{{ __('roles.role_name_help') }}</p>
                </div>
            </header>
            <div class="app-form-panel__body">
                <div class="app-form-field">
                    <label class="app-form-field__label" for="role-name">{{ __('roles.role_name_label') }}</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-shield"></i></span>
                        <input type="text" name="name" id="role-name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('roles.role_name_placeholder') }}" value="{{ old('name', $role?->name) }}" required>
                    </div>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </section>

        <aside class="app-aside-panel">
            <header class="app-aside-panel__header">
                <span class="app-aside-panel__icon"><i class="bx bx-lock-alt"></i></span>
                <div>
                    <h2 class="app-aside-panel__title">{{ __('roles.assign_permissions') }}</h2>
                    <p class="app-aside-panel__subtitle">{{ __('roles.select_all_notice') }}</p>
                </div>
            </header>
            <div class="app-aside-panel__body">
                <span class="badge bg-label-primary rounded-pill">{{ $permissions->count() }}</span>
            </div>
        </aside>
    </div>

    <section class="app-form-panel mt-4">
        <header class="app-form-panel__header">
            <span class="app-form-panel__icon"><i class="bx bx-key"></i></span>
            <div>
                <h2 class="app-form-panel__title">{{ __('roles.assign_permissions') }}</h2>
                <p class="app-form-panel__subtitle">{{ __('roles.select_all_notice') }}</p>
            </div>
        </header>
        <div class="app-form-panel__body">
            <div class="permission-grid">
                @foreach ($permissions as $permission)
                    <label class="permission-card" for="perm_{{ $permission->id }}">
                        <span class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}" @checked($selectedPermissions->contains($permission->name))>
                            <span class="form-check-label">{{ ucwords(str_replace('-', ' ', $permission->name)) }}</span>
                        </span>
                    </label>
                @endforeach
            </div>
            @error('permissions')
                <div class="invalid-feedback d-block mt-3">{{ $message }}</div>
            @enderror

            <div class="app-form-actions">
                <button type="submit" class="btn btn-primary"><i class="{{ $submitIcon }}"></i>{{ $submitLabel }}</button>
                <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">{{ __('roles.cancel') }}</a>
            </div>
        </div>
    </section>
</form>

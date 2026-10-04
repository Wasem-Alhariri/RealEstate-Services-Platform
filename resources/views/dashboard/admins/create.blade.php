@extends('layouts.app')

@section('title', __('admins.add_title'))

@section('content')
<x-ui.card>
    <x-slot name="title">{{ __('admins.add_title') }}</x-slot>
    <x-slot name="header">
        <small class="text-muted">{{ __('admins.system_subtitle') }}</small>
    </x-slot>

    <form action="{{ route('admins.store') }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-6">
                <x-ui.form.input 
                    name="name" 
                    label="{{ __('admins.full_name') }}" 
                    icon="bx bx-user" 
                    placeholder="{{ __('admins.placeholders.name') }}" 
                    required="true" />
            </div>
            <div class="col-md-6">
                <x-ui.form.input 
                    name="email" 
                    type="email"
                    label="{{ __('admins.email_address') }}" 
                    icon="bx bx-envelope" 
                    placeholder="{{ __('admins.placeholders.email') }}" 
                    required="true" />
            </div>
        </div>

        <hr class="my-4">

        <h6 class="form-label mb-3">{{ __('admins.assign_roles') }}</h6>
        <div class="row mb-4">
            @foreach($roles as $role)
                <div class="col-md-4 mb-3">
                    <div class="p-3 border rounded-md transition-fast hover-bg-surface-hover">
                        <div class="form-check form-switch mb-0">
                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="role_{{ $role->id }}" {{ (collect(old('roles'))->contains($role->name)) ? 'checked':'' }}>
                            <label class="form-check-label fw-bold cursor-pointer w-100" for="role_{{ $role->id }}">
                                <i class="bx bx-shield-quarter me-1 text-primary"></i> {{ $role->name }}
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
            @error('roles') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <hr class="my-4">

        <div class="row">
            <div class="col-md-6">
                <x-ui.form.input 
                    name="password" 
                    type="password"
                    label="{{ __('admins.password') }}" 
                    icon="bx bx-lock-alt" 
                    placeholder="Â·Â·Â·Â·Â·Â·Â·Â·Â·Â·Â·Â·" 
                    required="true" />
            </div>
            <div class="col-md-6">
                <x-ui.form.input 
                    name="password_confirmation" 
                    type="password"
                    label="{{ __('admins.confirm_password') }}" 
                    icon="bx bx-check-shield" 
                    placeholder="Â·Â·Â·Â·Â·Â·Â·Â·Â·Â·Â·Â·" 
                    required="true" />
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <x-ui.button href="{{ route('admins.index') }}" variant="outline-secondary" class="me-2">
                {{ __('admins.cancel') ?? 'Cancel' }}
            </x-ui.button>
            <x-ui.button type="submit" variant="primary" icon="bx bx-save">
                {{ __('admins.create_button') }}
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
@endsection

@extends('layouts.app')

@section('title', __('admins.management_title'))

@section('content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <x-ui.stat-card 
            label="{{ __('admins.total_admins') }}" 
            value="{{ $stats['total'] }}" 
            icon="bx bx-user" 
            color="primary" />
    </div>
    <div class="col-sm-6 col-xl-4">
        <x-ui.stat-card 
            label="{{ __('admins.last_30_days') }}" 
            value="+{{ $stats['recent'] }}" 
            icon="bx bx-user-check" 
            color="success" />
    </div>
    <div class="col-sm-6 col-xl-4">
        <x-ui.stat-card 
            label="{{ __('admins.role_assignments') }}" 
            value="{{ $stats['roles_count'] }}" 
            icon="bx bx-shield-quarter" 
            color="danger" />
    </div>
</div>

<x-ui.card>
    <x-slot name="title">{{ __('admins.management_title') }}</x-slot>
    <x-slot name="header">
        @can('create-admins')
            <x-ui.button href="{{ route('admins.create') }}" icon="bx bx-user-plus">
                {{ __('admins.add_new') }}
            </x-ui.button>
        @endcan
    </x-slot>

    <!-- Search Form -->
    <form action="{{ route('admins.index') }}" method="GET" id="admins-filter-form" class="mb-4">
        <div class="row">
            <div class="col-12 col-md-6">
                <x-ui.form.input 
                    name="search" 
                    placeholder="{{ __('admins.search_placeholder') }}" 
                    value="{{ request('search') }}" 
                    icon="bx bx-search" />
            </div>
        </div>
    </form>

    <x-ui.table :columns="[__('admins.column_admin'), __('admins.column_roles'), __('admins.column_joined'), __('admins.column_actions')]">
        @forelse($admins as $admin)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            @if($admin->getFirstMediaUrl('admin_avatars'))
                                <img src="{{ $admin->getFirstMediaUrl('admin_avatars') }}" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <span class="bg-primary-light text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px;">
                                    {{ Str::upper(Str::substr($admin->name, 0, 2)) }}
                                </span>
                            @endif
                        </div>
                        <div>
                            <span class="fw-bold d-block">{{ $admin->name }}</span>
                            <small class="text-muted">{{ $admin->email }}</small>
                        </div>
                    </div>
                </td>
                <td>
                    @forelse($admin->roles->take(2) as $role)
                        <span class="badge bg-primary-light text-primary rounded-pill mb-1 px-3 py-2">{{ $role->name }}</span>
                    @empty
                        <span class="text-muted small fst-italic">{{ __('admins.no_role') }}</span>
                    @endforelse
                </td>
                <td>
                    <span class="text-muted small">{{ $admin->created_at->translatedFormat('M d, Y') }}</span>
                </td>
                <td>
                    <div class="table-row-actions">
                        @can('edit-admins')
                            <x-ui.button href="{{ route('admins.edit', $admin->id) }}" variant="outline-primary" size="sm" icon="bx bx-edit-alt" />
                        @endcan
                        @can('delete-admins')
                            <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" class="delete-admin-form d-inline">
                                @csrf
                                @method('DELETE')
                                <x-ui.button type="submit" variant="danger" size="sm" icon="bx bx-trash" />
                            </form>
                        @endcan
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center py-5">
                    <i class="bx bx-search text-muted mb-3 d-block" style="font-size: 3rem;"></i>
                    <p class="mb-0 text-muted">{{ request('search') ? __('admins.no_results_matching') : __('admins.no_results') }}</p>
                </td>
            </tr>
        @endforelse
    </x-ui.table>

    @if($admins->hasPages())
        <div class="mt-4">
            {{ $admins->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @endif
</x-ui.card>
@endsection

@section('page-script')
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
                }, 500);
            });
        }

        // Delete Confirmation
        document.querySelectorAll('.delete-admin-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if(!confirm("{{ __('admins.confirm_delete') }}")) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection

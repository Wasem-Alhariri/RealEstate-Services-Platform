@extends('layouts.app')

@section('title', __('roles.management_title'))

@section('content')

{{-- Ø¨Ø·Ø§Ù‚Ø§Øª Ø§Ù„Ø¥Ø­ØµØ§Ø¦ÙŠØ§Øª Ø§Ù„Ù…Ù„ÙˆÙ†Ø© --}}
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card shadow-none border-0 rounded-4" style="background-color: #dbdee0">
            <div class="card-body p-3 text-nowrap">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="content-left">
                        <h6 class="mb-1 fw-bold ">{{ __('roles.total_roles') }}</h6>
                        <h4 class="mb-0 fw-black">{{ $stats['total_roles'] }}</h4>
                    </div>
                    <span class="badge bg-primary rounded-circle p-2">
                        <i class="bx bx-key fs-3"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card shadow-none border-0 rounded-4" style="background-color: #dbdee0">
            <div class="card-body p-3 text-nowrap">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="content-left">
                        <h6 class="mb-1 fw-bold">{{ __('roles.system_permissions') }}</h6>
                        <h4 class="mb-0 fw-black">{{ $stats['total_perms'] }}</h4>
                    </div>
                    <span class="badge bg-warning rounded-circle p-2">
                        <i class="bx bx-lock-alt fs-3"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card shadow-none border-0 rounded-4" style="background-color: #dbdee0">
            <div class="card-body p-3 text-nowrap">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="content-left">
                        <h6 class="mb-1 fw-bold">{{ __('roles.authorized_admins') }}</h6>
                        <h4 class="mb-0 fw-black">{{ $stats['assigned_admins'] }}</h4>
                    </div>
                    <span class="badge bg-info rounded-circle p-2">
                        <i class="bx bx-user-check fs-3"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Ø¬Ø¯ÙˆÙ„ Ø¹Ø±Ø¶ Ø§Ù„Ø¨ÙŠØ§Ù†Ø§Øª ÙˆØ¬Ø¯ÙˆÙ„ Ø§Ù„Ø¥Ø¯Ø§Ø±Ø© --}}
<div class="card rounded-4 overflow-hidden">
    <div class="card-header border-bottom">
        {{-- Ø§Ù„Ø³Ø·Ø± Ø§Ù„Ø¹Ù„ÙˆÙŠ: Ø§Ù„Ø¹Ù†ÙˆØ§Ù† ÙˆØ²Ø± Ø§Ù„Ø¥Ø¶Ø§ÙØ© ÙÙŠ Ø§Ù„Ø²Ø§ÙˆÙŠØ© Ø§Ù„Ù…Ù‚Ø§Ø¨Ù„Ø© --}}
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title mb-0">{{ __('roles.management_title') }}</h5>
            @can('create-roles')
                <a href="{{ route('roles.create') }}" class="btn btn-primary text-nowrap rounded-pill">
                    <i class="bx bx-plus-circle me-1"></i> {{ __('roles.add_new') }}
                </a>
            @endcan
        </div>
        
        {{-- Ø§Ù„Ø³Ø·Ø± Ø§Ù„Ø³ÙÙ„ÙŠ: Ø­Ù‚Ù„ Ø§Ù„Ø¨Ø­Ø« Ù…Ù…ØªØ¯ Ø¨Ø§Ù„ÙƒØ§Ù…Ù„ Ø¹Ù„Ù‰ Ø³Ø·Ø± Ù…Ø³ØªÙ‚Ù„ --}}
        <form action="{{ route('roles.index') }}" method="GET" id="roles-filter-form">
            <div class="row">
                <div class="col-12">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text text-muted"><i class="bx bx-search"></i></span>
                        <input type="text" name="search" id="search-role-input" value="{{ request('search') }}" class="form-control" placeholder="{{ __('roles.search_placeholder') }}" autocomplete="off">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover mb-0">
            <thead class="table-light text-uppercase">
                <tr>
                    <th style="width: 25%">{{ __('roles.role_name') }}</th>
                    <th style="width: 40%">{{ __('roles.permissions') }}</th>
                    <th style="width: 15%">{{ __('roles.users_count') }}</th>
                    <th style="width: 10%">{{ __('roles.created_at') }}</th>
                    @if(auth()->user()->can('edit-roles') || auth()->user()->can('delete-roles'))
                        <th style="width: 10%" class="text-center">{{ __('roles.actions') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($roles as $role)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-xs me-2">
                                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-shield"></i></span>
                            </div>
                            <span class="fw-bold text-heading">{{ strtoupper($role->name) }}</span>
                        </div>
                    </td>

                    <td>
                        @php $mainPerms = $role->permissions->take(3); @endphp
                        @forelse($mainPerms as $perm)
                            <span class="badge bg-label-secondary rounded-pill me-1" style="text-transform: none;">
                                {{ str_replace('-', ' ', $perm->name) }}
                            </span>
                        @empty
                            <small class="text-muted small">{{ __('roles.no_perms') }}</small>
                        @endforelse

                        @if($role->permissions->count() > 3)
                            <small class="text-muted cursor-pointer ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $role->permissions->skip(3)->pluck('name')->implode(', ') }}">
                                +{{ $role->permissions->count() - 3 }} {{ __('roles.more') }}
                            </small>
                        @endif
                    </td>

                    <td>
                        <div class="d-flex align-items-center">
                            <div class="user-list d-flex align-items-center">
                                <i class="bx bx-group me-2 text-muted"></i>
                                <span class="badge bg-label-info rounded-pill">{{ $role->users_count }} {{ __('roles.users') }}</span>
                            </div>
                        </div>
                    </td>

                    <td>
                        <span class="text-muted small">{{ $role->created_at->translatedFormat('M d, Y') }}</span>
                    </td>
                    @if(auth()->user()->can('edit-roles') || auth()->user()->can('delete-roles'))
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="icon-base bx bx-dots-vertical-rounded fs-4"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    @can('edit-roles')
                                        <a class="dropdown-item" href="{{ route('roles.edit', $role->id) }}">
                                            <i class="icon-base bx bx-edit-alt me-1"></i> {{ __('roles.edit') }}
                                        </a>
                                    @endcan
                                    @can('delete-roles')
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="delete-role-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="icon-base bx bx-trash me-1"></i> {{ __('roles.delete') }}
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="text-muted">
                            <i class="bx bx-search mb-2" style="font-size: 3rem;"></i>
                            <p class="mb-0">{{ __('roles.no_results') }} {{ request('search') ? __('roles.matching_search') : __('roles.in_database') }}</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($roles->hasPages() || $roles->total() > 0)
        <div class="card-footer border-top d-flex flex-column flex-md-row align-items-center justify-content-between py-3">
            <div class="text-muted small mb-3 mb-md-0">
                {{ __('roles.showing') }} <strong>{{ $roles->firstItem() ?? 0 }}</strong> {{ __('roles.to') }} <strong>{{ $roles->lastItem() ?? 0 }}</strong> {{ __('roles.of') }} <strong>{{ $roles->total() }}</strong> {{ __('roles.results') }}
            </div>

            <div class="pagination-wrapper">
                {{ $roles->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection

@section('page-script')
<script>
    window.onload = function() {
        if (window.jQuery) {
            $(function() {
                const $form = $('#roles-filter-form');
                let searchRolesTimeout;

                // 1. Ø§Ù„Ø¨Ø­Ø« Ø§Ù„ØªÙ„Ù‚Ø§Ø¦ÙŠ Ø§Ù„ÙÙˆØ±ÙŠ Ø§Ù„Ù…ÙˆØ²ÙˆÙ† (Debounce 500ms)
                $(document).on('input', '#search-role-input', function() {
                    clearTimeout(searchRolesTimeout);
                    
                    searchRolesTimeout = setTimeout(function() {
                        $form.submit();
                    }, 500);
                });

                // 2. Ù…Ù†Ø¹ Ø§Ù„Ù€ Submit Ø§Ù„ØªÙ„Ù‚Ø§Ø¦ÙŠ ØºÙŠØ± Ø§Ù„Ù…Ù‚ØµÙˆØ¯ Ø¹Ù†Ø¯ Ø¶ØºØ· Ù…ÙØªØ§Ø­ Enter Ø¯Ø§Ø®Ù„ Ø­Ù‚Ù„ Ø§Ù„Ø¨Ø­Ø«
                $form.on('submit', function(e) {
                    if (e.originalEvent && e.originalEvent.submitter === undefined) {
                        e.preventDefault();
                    }
                });

                // 3. ØªØ£ÙƒÙŠØ¯ Ø¹Ù…Ù„ÙŠØ© Ø§Ù„Ø­Ø°Ù
                $(document).on('submit', '.delete-role-form', function(e) {
                    if(!confirm("{{ __('roles.delete_confirm') }}")) {
                        e.preventDefault();
                    }
                });
            });
        }
    };
</script>
@endsection

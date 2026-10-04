@extends('layouts.app')

@section('title', __('business.requests_title'))

@section('content')

{{-- Stats Summary --}}
<div class="row g-4 mb-4">
    {{-- Pending Card --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-none border-0 rounded-4" style="background-color: #dbdee0">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1 fw-bold">{{ __('business.pending_req') }}</h6>
                        <h4 class="mb-0 fw-black">{{ $stats['pending'] }}</h4>
                    </div>
                    <span class="badge bg-warning rounded-circle p-2">
                        <i class="bx bx-time-five fs-3"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Approved Card --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-none border-0 rounded-4" style="background-color: #dbdee0">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1 fw-bold">{{ __('business.approved_acc') }}</h6>
                        <h4 class="mb-0 fw-black">{{ $stats['approved'] }}</h4>
                    </div>
                    <span class="badge bg-success rounded-circle p-2">
                        <i class="bx bx-check-double fs-3"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Inactive Card --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-none border-0 rounded-4" style="background-color: #dbdee0">
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1 fw-bold">{{ __('status.inactive') }}</h6>
                        <h4 class="mb-0 fw-black">{{ $stats['inactive'] ?? 0 }}</h4>
                    </div>
                    <span class="badge bg-secondary rounded-circle p-2">
                        <i class="bx bx-power-off fs-3"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Rejected Card --}}
    <div class="col-sm-6 col-xl-3">
        <div class="card shadow-none border-0 rounded-4" style="background-color: #dbdee0"> 
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="mb-1 fw-bold">{{ __('business.rejected_acc') }}</h6> 
                        <h4 class="mb-0 fw-black">{{ $stats['rejected'] }}</h4>
                    </div>
                    <span class="badge bg-danger rounded-circle p-2"> <i class="bx bx-x-circle fs-3"></i> </span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Main Management Card --}}
<div class="card rounded-4 overflow-hidden">
    <div class="card-header border-bottom">
        <h5 class="card-title mb-3">{{ __('business.management_card') }}</h5>
        
        {{-- ØªÙ… Ø¥Ø¶Ø§ÙØ© id="filter-form" Ù„Ù„ÙÙˆØ±Ù… ÙˆÙƒÙ„Ø§Ø³Ø§Øª Ø§Ù„Ø¬Ø±ÙŠØ¯ ØªÙ… ØªØ­Ø³ÙŠÙ†Ù‡Ø§ Ù„ØªÙˆØ²ÙŠØ¹ Ø§Ù„Ù…Ø³Ø§Ø­Ø© Ø¨Ø¹Ø¯ Ø­Ø°Ù Ø§Ù„Ø²Ø± --}}
        <form action="{{ route('business-accounts.index') }}" method="GET" id="filter-form">
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-search"></i></span>
                        <input type="text" name="search" id="search-input" value="{{ request('search') }}" class="form-control" placeholder="{{ __('business.search_placeholder') }}" autocomplete="off">
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <select name="status" class="form-select text-capitalize filter-select">
                        <option value="">{{ __('business.all_statuses') }}</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('status.pending') }}</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>{{ __('status.approved') }}</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>{{ __('status.inactive') }}</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>{{ __('status.rejected') }}</option>
                    </select>
                </div>
                <div class="col-6 col-md-4">
                    <select name="city_id" class="form-select filter-select">
                        <option value="">{{ __('business.all_cities') }}</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover mb-0">
            <thead class="table-light text-uppercase">
                <tr>
                    <th>{{ __('business.acc_name') }}</th>
                    <th>{{ __('business.owner') }}</th>
                    <th>{{ __('business.activity_city') }}</th>
                    <th>{{ __('business.status') }}</th>
                    <th>{{ __('business.date_applied') }}</th>
                    <th class="text-center">{{ __('business.actions') }}</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($business_accounts as $account)
                <tr>
                    <td>
                        <div class="d-flex flex-column">
                            <span class="fw-bold text-heading">{{ $account->getTranslation('name', 'en')}}</span>
                            <small class="text-muted">{{ $account->getTranslation('name', 'ar')}}</small>
                        </div>
                    </td>

                    <td>
                        <div class="d-flex align-items-center">
                            <i class="bx bx-user me-2 text-primary"></i>
                            <span class="small">{{ $account->user->name ?? __('business.unknown') }}</span>
                        </div>
                    </td>

                    <td>
                        <div class="d-flex flex-column small">
                            <span><i class="bx bx-briefcase me-1 text-secondary"></i> {{ $account->activity->name ?? __('business.na') }}</span>
                            <span class="text-muted"><i class="bx bx-map me-1"></i> {{ $account->city->name ?? __('business.na') }}</span>
                        </div>
                    </td>

                    <td>
                        <span class="badge {{ $account->status->badge() }} rounded-pill">
                            {{ $account->status->label() }}
                        </span>
                    </td>

                    <td>
                        <span class="text-muted small">{{ $account->created_at->format('d M, Y') }}</span>
                    </td>

                    <td class="text-center">
                        <a href="{{ route('business-accounts.show', $account->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bx bx-show me-1"></i> {{ __('business.view_details') }}
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="text-muted">
                            <i class="bx bx-search-alt-2 mb-2 fs-1"></i>
                            <p>{{ __('business.no_results') }}</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($business_accounts->hasPages() || $business_accounts->total() > 0)
    <div class="card-footer border-top d-flex flex-column flex-md-row align-items-center justify-content-between py-3">
        <div class="text-muted small">
            {{ __('business.showing') }} <strong>{{ $business_accounts->firstItem() ?? 0 }}</strong> {{ __('business.to') }} <strong>{{ $business_accounts->lastItem() ?? 0 }}</strong> {{ __('business.of') }} <strong>{{ $business_accounts->total() }}</strong> {{ __('business.requests') }}
        </div>
        <div class="pagination-wrapper">
            {{ $business_accounts->links('pagination::bootstrap-5') }}
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
                const $form = $('#filter-form');
                let searchTimeout;

                // 1. Ø§Ù„ÙÙ„ØªØ±Ø© Ø§Ù„ÙÙˆØ±ÙŠØ© Ø¹Ù†Ø¯ ØªØºÙŠÙŠØ± Ø§Ù„Ù‚ÙˆØ§Ø¦Ù… Ø§Ù„Ù…Ù†Ø³Ø¯Ù„Ø© (Ø§Ù„Ø­Ø§Ù„Ø© Ø£Ùˆ Ø§Ù„Ù…Ø¯ÙŠÙ†Ø©)
                $(document).on('change', '.filter-select', function() {
                    $form.submit();
                });

                // 2. Ø§Ù„ÙÙ„ØªØ±Ø© Ø§Ù„ÙÙˆØ±ÙŠØ© Ø§Ù„Ø°ÙƒÙŠØ© Ø¹Ù†Ø¯ Ø§Ù„ÙƒØªØ§Ø¨Ø© Ø¯Ø§Ø®Ù„ Ø­Ù‚Ù„ Ø§Ù„Ø¨Ø­Ø« (Debounce 500ms)
                $(document).on('input', '#search-input', function() {
                    clearTimeout(searchTimeout);
                    
                    // Ù†Ù†ØªØ¸Ø± 500 Ù…Ù„ÙŠ Ø«Ø§Ù†ÙŠØ© Ø¨Ø¹Ø¯ ØªÙˆÙ‚Ù Ø§Ù„Ù…Ø³ØªØ®Ø¯Ù… Ø¹Ù† Ø§Ù„Ø¶ØºØ· Ø¹Ù„Ù‰ Ø§Ù„Ø£Ø²Ø±Ø§Ø± Ù‚Ø¨Ù„ Ø¥Ø±Ø³Ø§Ù„ Ø§Ù„ÙÙˆØ±Ù…
                    searchTimeout = setTimeout(function() {
                        $form.submit();
                    }, 500); 
                });
            });
        }
    };
</script>
@endsection

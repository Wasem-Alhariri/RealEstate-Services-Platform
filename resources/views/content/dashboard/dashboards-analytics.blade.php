@extends('layouts.app')

@section('title', __('dashboard.title'))

@section('page-style')
<style>
    /* Clean, Comfortable Dashboard Styles */
    .dashboard-welcome-bg {
        background: linear-gradient(135deg, var(--color-primary) 0%, #312E81 100%);
        border: none;
        border-radius: var(--radius-xl);
        box-shadow: 0 10px 30px -10px rgba(79, 70, 229, 0.4);
    }
    
    .dashboard-welcome-text {
        color: #ffffff;
    }

    .stat-card-clean {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-xl);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card-clean:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
        border-color: var(--border-color-focus);
    }

    .icon-box-soft {
        width: 48px;
        height: 48px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .list-hover-clean .list-group-item {
        transition: background-color 0.15s ease;
        border-bottom: 1px solid var(--border-color);
    }
    .list-hover-clean .list-group-item:last-child {
        border-bottom: none;
    }
    .list-hover-clean .list-group-item:hover {
        background-color: var(--bg-surface-hover);
    }
    
    .chart-wrapper {
        min-height: 320px;
        position: relative;
    }
</style>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <!-- Clean Welcome Card -->
    <div class="col-12 col-xl-8">
        <div class="dashboard-welcome-bg p-4 p-md-5 h-100 d-flex align-items-center position-relative overflow-hidden">
            <!-- Decorative SVG Pattern -->
            <div class="position-absolute top-0 end-0 w-100 h-100" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); opacity: 0.6;"></div>
            
            <div class="position-relative z-1 w-100">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="dashboard-welcome-text fw-bold mb-2">
                            {{ __('dashboard.welcome_back', ['name' => Auth::user()->name]) }}
                        </h2>
                        <p class="text-white-50 mb-4" style="max-width: 500px; font-size: 1.05rem;">
                            {{ __('dashboard.welcome_desc') }}
                        </p>
                        
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('business-accounts.index') }}" class="btn btn-light fw-bold px-4 d-flex align-items-center gap-2 text-primary">
                                {{ __('dashboard.business_accounts') }}
                                @if($stats['pending_business_accounts'] > 0)
                                    <span class="badge bg-primary text-white rounded-pill">{{ $stats['pending_business_accounts'] }}</span>
                                @endif
                            </a>
                            <a href="{{ route('reports.index') }}" class="btn btn-outline-light fw-medium px-4 d-flex align-items-center gap-2" style="border-color: rgba(255,255,255,0.4);">
                                {{ __('dashboard.view_reports') }}
                                @if($stats['pending_reports'] > 0)
                                    <span class="badge bg-danger text-white rounded-pill">{{ $stats['pending_reports'] }}</span>
                                @endif
                            </a>
                        </div>
                    </div>
                    
                    <div class="d-none d-lg-block opacity-25">
                        <i class='bx bxs-dashboard text-white' style="font-size: 9rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Requests & Services Stats -->
    <div class="col-12 col-xl-4 d-flex flex-column gap-4">
        <div class="stat-card-clean p-4 d-flex align-items-center justify-content-between flex-grow-1">
            <div>
                <h6 class="text-muted fw-semibold mb-1">{{ __('dashboard.active_services') }}</h6>
                <h2 class="fw-bold mb-0 text-heading">{{ number_format($stats['total_services']) }}</h2>
                @if($stats['pending_services'] > 0)
                    <small class="text-warning fw-medium"><i class='bx bx-time-five'></i> {{ $stats['pending_services'] }} {{ __('dashboard.pending') }}</small>
                @endif
            </div>
            <div class="icon-box-soft bg-success-light text-success">
                <i class='bx bx-briefcase-alt-2'></i>
            </div>
        </div>
            
        <div class="stat-card-clean p-4 d-flex align-items-center justify-content-between flex-grow-1">
            <div>
                <h6 class="text-muted fw-semibold mb-1">{{ __('dashboard.total_requests') }}</h6>
                <h2 class="fw-bold mb-0 text-heading">{{ number_format($stats['total_service_requests']) }}</h2>
            </div>
            <div class="icon-box-soft bg-primary-light text-primary">
                <i class='bx bx-git-pull-request'></i>
            </div>
        </div>
    </div>
</div>

<!-- System Data Counts Row (Including Sliders) -->
<div class="row g-4 mb-4">
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card-clean p-3 text-center">
            <i class='bx bx-store text-info fs-2 mb-2'></i>
            <h4 class="fw-bold mb-0">{{ number_format($stats['total_business_accounts']) }}</h4>
            <span class="text-muted small">{{ __('dashboard.total_accounts') }}</span>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card-clean p-3 text-center">
            <i class='bx bx-category text-primary fs-2 mb-2'></i>
            <h4 class="fw-bold mb-0">{{ number_format($stats['total_categories']) }}</h4>
            <span class="text-muted small">{{ __('dashboard.categories') }}</span>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card-clean p-3 text-center">
            <i class='bx bx-map text-warning fs-2 mb-2'></i>
            <h4 class="fw-bold mb-0">{{ number_format($stats['total_cities']) }}</h4>
            <span class="text-muted small">{{ __('dashboard.cities') }}</span>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card-clean p-3 text-center">
            <i class='bx bx-run text-danger fs-2 mb-2'></i>
            <h4 class="fw-bold mb-0">{{ number_format($stats['total_activities']) }}</h4>
            <span class="text-muted small">{{ __('dashboard.activities') }}</span>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card-clean p-3 text-center">
            <i class='bx bx-images text-success fs-2 mb-2'></i>
            <h4 class="fw-bold mb-0">{{ number_format($stats['total_sliders']) }}</h4>
            <span class="text-muted small">{{ __('dashboard.sliders') }}</span>
        </div>
    </div>
    <div class="col-6 col-md-4 col-xl-2">
        <div class="stat-card-clean p-3 text-center">
            <i class='bx bx-flag text-danger fs-2 mb-2'></i>
            <h4 class="fw-bold mb-0">{{ number_format($stats['pending_reports']) }}</h4>
            <span class="text-muted small">{{ __('dashboard.pending_reports') }}</span>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Main Area Chart -->
    <div class="col-12 col-xl-8">
        <div class="card border-0 shadow-sm rounded-xl h-100">
            <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1 fw-bold text-heading">{{ __('dashboard.weekly_requests') }}</h5>
                    <small class="text-muted">{{ __('dashboard.last_7_days') }}</small>
                </div>
                <span class="badge rounded-pill px-3 py-2" style="background-color: var(--color-primary-light); color: var(--color-primary); font-weight: 600; letter-spacing: 0.5px;">
                    <i class='bx bx-pulse me-1 bx-burst'></i> {{ __('dashboard.live') }}
                </span>
            </div>
            <div class="card-body p-4">
                <div id="weeklyRequestsChart" class="chart-wrapper"></div>
            </div>
        </div>
    </div>

    <!-- Doughnut Chart -->
    <div class="col-12 col-xl-4">
        <div class="card border-0 shadow-sm rounded-xl h-100">
            <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4 text-center text-xl-start">
                <h5 class="card-title mb-1 fw-bold text-heading">{{ __('dashboard.service_distribution') }}</h5>
                <small class="text-muted">{{ __('dashboard.rent_vs_sale') }}</small>
            </div>
            <div class="card-body p-4 d-flex flex-column justify-content-center">
                <div id="servicesTypeChart" style="min-height: 280px;"></div>
                
                <div class="d-flex justify-content-around mt-4 pt-3 border-top">
                    <div class="text-center">
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <span class="badge bg-primary rounded-circle p-1 me-2" style="width: 10px; height: 10px;"></span>
                            <span class="text-muted small fw-medium">{{ __('dashboard.sale') }}</span>
                        </div>
                        <h5 class="fw-bold mb-0 text-heading">{{ $stats['charts']['services_type']['sale'] }}</h5>
                    </div>
                    <div class="text-center">
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <span class="badge bg-info rounded-circle p-1 me-2" style="width: 10px; height: 10px;"></span>
                            <span class="text-muted small fw-medium">{{ __('dashboard.rent') }}</span>
                        </div>
                        <h5 class="fw-bold mb-0 text-heading">{{ $stats['charts']['services_type']['rent'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Actions Row -->
@if(count($stats['latest_pending_accounts']) > 0 || count($stats['latest_pending_services']) > 0)
<div class="row g-4 mt-1">
    @if(count($stats['latest_pending_accounts']) > 0)
    <div class="col-12 col-lg-6">
        <div class="card border-0 shadow-sm rounded-xl h-100">
            <div class="card-header bg-transparent border-bottom p-4 d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0 fw-bold text-heading">
                    <i class='bx bx-store text-warning me-2'></i>{{ __('dashboard.pending_accounts') }}
                </h6>
                <a href="{{ route('business-accounts.index') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-medium">{{ __('dashboard.view_all') }}</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush list-hover-clean">
                    @foreach($stats['latest_pending_accounts'] as $account)
                    <li class="list-group-item list-group-item-action px-4 py-3 d-flex justify-content-between align-items-center border-0 border-bottom" style="cursor: pointer; transition: background-color 0.2s ease;" onclick="window.location.href='{{ route('business-accounts.show', $account->id) }}'">
                        <div class="d-flex align-items-center">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded-circle bg-warning-light text-warning fw-bold d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    {{ Str::upper(Str::substr($account->name, 0, 2)) }}
                                </span>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="fw-semibold text-heading">{{ $account->name }}</span>
                                <small class="text-muted">{{ $account->activity->name ?? __('dashboard.na') }} &bull; {{ $account->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <span class="badge bg-label-warning rounded-pill px-3">{{ __('dashboard.pending') }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    @if(count($stats['latest_pending_services']) > 0)
    <div class="col-12 col-lg-6">
        <div class="card border-0 shadow-sm rounded-xl h-100">
            <div class="card-header bg-transparent border-bottom p-4 d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0 fw-bold text-heading">
                    <i class='bx bx-briefcase text-info me-2'></i>{{ __('dashboard.pending_services') }}
                </h6>
                <a href="{{ route('services.index') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-medium">{{ __('dashboard.view_all') }}</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush list-hover-clean">
                    @foreach($stats['latest_pending_services'] as $service)
                    <li class="list-group-item list-group-item-action px-4 py-3 d-flex justify-content-between align-items-center border-0 border-bottom" style="cursor: pointer; transition: background-color 0.2s ease;" onclick="window.location.href='{{ route('services.show', $service->id) }}'">
                        <div class="d-flex align-items-center">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded-circle bg-info-light text-info fw-bold d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class='bx bx-image'></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column">
                                <span class="fw-semibold text-heading">{{ Str::limit($service->title, 30) }}</span>
                                <small class="text-muted">{{ $service->businessAccount->name ?? __('dashboard.user') }} &bull; {{ $service->category->name ?? __('dashboard.na') }}</small>
                            </div>
                        </div>
                        <span class="badge bg-label-info rounded-pill px-3">{{ __('dashboard.pending') }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
</div>
@endif

@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const isRtl = document.documentElement.getAttribute('dir') === 'rtl';
    const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--color-primary').trim() || '#4F46E5';
    const infoColor = getComputedStyle(document.documentElement).getPropertyValue('--color-info').trim() || '#0ea5e9';
    const textColor = getComputedStyle(document.documentElement).getPropertyValue('--text-secondary').trim() || '#64748b';
    const borderColor = getComputedStyle(document.documentElement).getPropertyValue('--border-color').trim() || '#e2e8f0';
    
    const weeklyDates = {!! json_encode($stats['charts']['weekly_requests']['labels']) !!};
    const weeklyData = {!! json_encode($stats['charts']['weekly_requests']['data']) !!};

    // Calculate max to ensure empty charts still show a nice grid
    const maxValue = Math.max(...weeklyData);
    const yAxisMax = maxValue === 0 ? 5 : undefined;

    const areaChartOptions = {
        series: [{
            name: "{{ __('dashboard.service_requests') }}",
            data: weeklyData
        }],
        chart: {
            height: 320,
            type: 'area',
            fontFamily: 'Public Sans, sans-serif',
            toolbar: { show: false },
            zoom: { enabled: false }
        },
        dataLabels: { enabled: false },
        stroke: {
            curve: 'smooth',
            width: 3,
            colors: [primaryColor]
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.25,
                opacityTo: 0.05,
                stops: [0, 90, 100]
            }
        },
        colors: [primaryColor],
        xaxis: {
            categories: weeklyDates,
            axisBorder: { show: false },
            axisTicks: { show: false },
            labels: { style: { colors: textColor, fontSize: '13px' } }
        },
        yaxis: {
            min: 0,
            max: yAxisMax,
            tickAmount: 5,
            labels: { 
                style: { colors: textColor, fontSize: '13px' },
                formatter: function(val) { return Math.round(val); }
            }
        },
        grid: {
            borderColor: borderColor,
            strokeDashArray: 4,
            padding: { top: 0, bottom: 0, left: 20, right: 20 }
        },
        tooltip: {
            theme: 'light',
            y: { formatter: function (val) { return val } }
        }
    };

    if(document.querySelector("#weeklyRequestsChart")) {
        new ApexCharts(document.querySelector("#weeklyRequestsChart"), areaChartOptions).render();
    }

    const saleCount = {{ $stats['charts']['services_type']['sale'] }};
    const rentCount = {{ $stats['charts']['services_type']['rent'] }};
    
    const donutChartOptions = {
        series: [saleCount, rentCount],
        labels: ["{{ __('dashboard.sale') }}", "{{ __('dashboard.rent') }}"],
        chart: {
            height: 280,
            type: 'donut',
            fontFamily: 'Public Sans, sans-serif',
        },
        colors: [primaryColor, infoColor],
        plotOptions: {
            pie: {
                donut: {
                    size: '78%',
                    labels: {
                        show: true,
                        name: { 
                            offsetY: -10, 
                            fontFamily: 'Public Sans',
                            color: textColor 
                        },
                        value: {
                            offsetY: 10,
                            fontSize: '1.75rem',
                            fontFamily: 'Public Sans',
                            color: getComputedStyle(document.documentElement).getPropertyValue('--text-primary').trim(),
                            fontWeight: 700,
                            formatter: function (val) { return val }
                        },
                        total: {
                            show: true,
                            showAlways: true,
                            label: 'Total',
                            fontSize: '0.875rem',
                            color: textColor,
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce((a, b) => { return a + b }, 0)
                            }
                        }
                    }
                }
            }
        },
        dataLabels: { enabled: false },
        stroke: { width: 5, colors: ['var(--bg-surface)'] },
        legend: { show: false },
        tooltip: { theme: 'light' }
    };

    if(document.querySelector("#servicesTypeChart")) {
        new ApexCharts(document.querySelector("#servicesTypeChart"), donutChartOptions).render();
    }
});
</script>
@endsection

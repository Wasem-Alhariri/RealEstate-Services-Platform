@props([
    'label',
    'value' => 0,
    'icon' => 'bx bx-chart',
    'color' => 'primary',
    'trend' => null // ex: '+5%'
])

<div class="card shadow-custom h-100">
    <div class="card-body p-4 text-nowrap">
        <div class="d-flex align-items-center justify-content-between">
            <div class="content-left">
                <h6 class="mb-2 fw-semibold text-muted">{{ $label }}</h6>
                <h4 class="mb-0 fw-bold">{{ $value }}</h4>
                @if($trend)
                    <small class="text-success mt-1 d-block fw-medium">{{ $trend }}</small>
                @endif
            </div>
            <span class="btn-icon bg-{{ $color }}-light text-{{ $color }} rounded-xl p-3 d-flex align-items-center justify-content-center">
                <i class="{{ $icon }} fs-3"></i>
            </span>
        </div>
    </div>
</div>

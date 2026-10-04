@props([
    'label',
    'value' => 0,
    'icon' => 'bx bx-chart',
    'tone' => 'primary',
])

<div {{ $attributes->class(['dashboard-stat-card', 'dashboard-stat-card--' . $tone]) }}>
    <div class="card-body d-flex align-items-center justify-content-between gap-3">
        <div class="min-w-0">
            <p class="dashboard-stat-card__label">{{ $label }}</p>
            <p class="dashboard-stat-card__value">{{ $value }}</p>
        </div>

        <span class="dashboard-stat-card__icon" aria-hidden="true">
            <i class="{{ $icon }}"></i>
        </span>
    </div>
</div>

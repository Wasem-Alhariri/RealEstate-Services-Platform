@props([
    'icon' => 'bx bx-search-alt-2',
    'title',
    'description' => null,
])

<div {{ $attributes->class('dashboard-empty-state') }}>
    <div class="dashboard-empty-state__icon" aria-hidden="true">
        <i class="{{ $icon }}"></i>
    </div>

    <h5 class="mb-2 text-heading fw-bold">{{ $title }}</h5>

    @if ($description)
        <p class="mb-0 small">{{ $description }}</p>
    @endif

    @if (trim($slot) !== '')
        <div class="mt-3">
            {{ $slot }}
        </div>
    @endif
</div>

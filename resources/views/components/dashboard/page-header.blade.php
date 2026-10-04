@props([
    'eyebrow' => null,
    'title',
    'description' => null,
    'compact' => false,
])

<header {{ $attributes->class(['app-page-header', 'app-page-header--compact' => $compact]) }}>
    <div class="app-page-header__content">
        @if ($eyebrow)
            <p class="app-page-header__eyebrow">{{ $eyebrow }}</p>
        @endif

        <h1 class="app-page-header__title">{{ $title }}</h1>

        @if ($description)
            <p class="app-page-header__description">{{ $description }}</p>
        @endif
    </div>

    @if (trim($slot) !== '')
        <div class="app-page-header__actions">
            {{ $slot }}
        </div>
    @endif
</header>

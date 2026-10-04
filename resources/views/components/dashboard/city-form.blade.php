@props([
    'city' => null,
    'action',
    'method' => 'POST',
    'title',
    'subtitle',
    'mapInstruction',
    'mapSearchPlaceholder',
    'submitLabel',
    'submitIcon' => 'bx bx-check-circle',
    'submitTone' => 'primary',
])

@php
    $defaultLatitude = $city?->latitude ?? 33.5138;
    $defaultLongitude = $city?->longitude ?? 36.2765;
    $defaultRadius = $city?->radius ?? 15;
    $isActive = old('is_active', $city?->is_active ?? true) == '1';
@endphp

<x-dashboard.page-header :title="$title" :description="$subtitle" eyebrow="{{ __('cities.service_zones') }}">
    <a href="{{ route('cities.index') }}" class="btn btn-outline-secondary"><i class="bx bx-arrow-back"></i>{{ __('cities.cancel') }}</a>
</x-dashboard.page-header>

<form action="{{ $action }}" method="POST">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="app-form-shell">
        <section class="app-form-panel">
            <header class="app-form-panel__header">
                <span class="app-form-panel__icon"><i class="bx bx-map-pin"></i></span>
                <div>
                    <h2 class="app-form-panel__title">{{ $mapInstruction }}</h2>
                    <p class="app-form-panel__subtitle">{{ $mapSearchPlaceholder }}</p>
                </div>
            </header>
            <div class="app-form-panel__body">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="app-form-field">
                            <label class="app-form-field__label" for="name_en">{{ __('cities.th_city_name') }} (EN)</label>
                            <input type="text" id="name_en" name="name[en]" class="form-control @error('name.en') is-invalid @enderror" placeholder="{{ __('cities.placeholder_en') }}" value="{{ old('name.en', $city?->getTranslation('name', 'en')) }}" required>
                            @error('name.en')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="app-form-field">
                            <label class="app-form-field__label" for="name_ar">{{ __('cities.th_city_name') }} (AR)</label>
                            <input type="text" id="name_ar" name="name[ar]" class="form-control @error('name.ar') is-invalid @enderror" placeholder="{{ __('cities.placeholder_ar') }}" value="{{ old('name.ar', $city?->getTranslation('name', 'ar')) }}" dir="rtl" required>
                            @error('name.ar')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="app-form-field">
                    <label class="app-form-field__label" for="map-search">{{ $mapInstruction }}</label>
                    <div class="input-group mb-3">
                        <input type="search" id="map-search" class="form-control" placeholder="{{ $mapSearchPlaceholder }}" autocomplete="off">
                        <button type="button" class="btn btn-outline-primary" data-city-map-search><i class="bx bx-search"></i>{{ __('cities.map_search_btn') }}</button>
                    </div>
                    <div class="app-map city-map" data-city-map data-latitude="{{ old('latitude', $defaultLatitude) }}" data-longitude="{{ old('longitude', $defaultLongitude) }}" data-radius="{{ old('radius', $defaultRadius) }}" data-min-query-message="{{ __('cities.js_min_chars') }}" data-not-found-message="{{ __('cities.js_not_found') }}" data-error-message="{{ __('cities.js_error') }}"></div>
                </div>
            </div>
        </section>

        <aside class="d-flex flex-column gap-3">
            <section class="app-aside-panel">
                <header class="app-aside-panel__header">
                    <span class="app-aside-panel__icon"><i class="bx bx-current-location"></i></span>
                    <div>
                        <h2 class="app-aside-panel__title">{{ __('cities.service_zones') }}</h2>
                        <p class="app-aside-panel__subtitle">{{ __('cities.radius_label') }}</p>
                    </div>
                </header>
                <div class="app-aside-panel__body">
                    <div class="app-form-field">
                        <label class="app-form-field__label" for="lat_input">{{ __('cities.latitude') }}</label>
                        <input type="text" id="lat_input" name="latitude" class="form-control detail-surface" value="{{ old('latitude', $defaultLatitude) }}" readonly required>
                    </div>
                    <div class="app-form-field">
                        <label class="app-form-field__label" for="lng_input">{{ __('cities.longitude') }}</label>
                        <input type="text" id="lng_input" name="longitude" class="form-control detail-surface" value="{{ old('longitude', $defaultLongitude) }}" readonly required>
                    </div>
                    <div class="app-form-field">
                        <label class="app-form-field__label" for="radius_input">{{ __('cities.radius_label') }}</label>
                        <div class="input-group"><input type="number" id="radius_input" name="radius" class="form-control" value="{{ old('radius', $defaultRadius) }}" step="0.5" min="1" required><span class="input-group-text">{{ __('cities.km') }}</span></div>
                    </div>
                </div>
            </section>

            <section class="app-status-card">
                <div class="form-check form-switch mb-0">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input @error('is_active') is-invalid @enderror" type="checkbox" name="is_active" id="is_active" value="1" @checked($isActive)>
                    <label class="form-check-label" for="is_active">{{ __('cities.status_active') }}</label>
                </div>
                @error('is_active')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </section>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-{{ $submitTone }}"><i class="{{ $submitIcon }}"></i>{{ $submitLabel }}</button>
                <a href="{{ route('cities.index') }}" class="btn btn-outline-secondary">{{ __('cities.cancel') }}</a>
            </div>
        </aside>
    </div>
</form>

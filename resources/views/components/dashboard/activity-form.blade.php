@props([
    'activity' => null,
    'action',
    'method' => 'POST',
    'title',
    'description' => null,
    'submitLabel',
    'submitIcon' => 'bx bx-check-circle',
])

@php
    $isEditing = (bool) $activity;
    $currentImage = $activity?->hasMedia('Activities') ? $activity->getFirstMediaUrl('Activities') : null;
@endphp

<x-dashboard.page-header :title="$title" :description="$description" eyebrow="{{ __('activities.add_title') }}">
    <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary"><i class="bx bx-arrow-back"></i>{{ __('activities.cancel_button') }}</a>
</x-dashboard.page-header>

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="app-form-shell">
        <section class="app-form-panel">
            <header class="app-form-panel__header">
                <span class="app-form-panel__icon"><i class="bx bx-briefcase"></i></span>
                <div>
                    <h2 class="app-form-panel__title">{{ __('activities.add_title') }}</h2>
                    <p class="app-form-panel__subtitle">{{ __('activities.label_name_en') }} · {{ __('activities.label_name_ar') }}</p>
                </div>
            </header>
            <div class="app-form-panel__body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="app-form-field">
                            <label class="app-form-field__label" for="name_en">{{ __('activities.label_name_en') }}</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-text"></i></span>
                                <input type="text" name="name[en]" id="name_en" class="form-control @error('name.en') is-invalid @enderror" placeholder="{{ __('activities.placeholder_en') }}" value="{{ old('name.en', $activity?->getTranslation('name', 'en')) }}" required>
                            </div>
                            @error('name.en')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="app-form-field">
                            <label class="app-form-field__label" for="name_ar">{{ __('activities.label_name_ar') }}</label>
                            <div class="input-group input-group-merge" dir="rtl">
                                <span class="input-group-text"><i class="bx bx-text"></i></span>
                                <input type="text" name="name[ar]" id="name_ar" class="form-control @error('name.ar') is-invalid @enderror" placeholder="{{ __('activities.placeholder_ar') }}" value="{{ old('name.ar', $activity?->getTranslation('name', 'ar')) }}" required>
                            </div>
                            @error('name.ar')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="app-form-actions">
                    <button type="submit" class="btn btn-primary"><i class="{{ $submitIcon }}"></i>{{ $submitLabel }}</button>
                    <a href="{{ route('activities.index') }}" class="btn btn-outline-secondary">{{ __('activities.cancel_button') }}</a>
                </div>
            </div>
        </section>

        <aside class="d-flex flex-column gap-3">
            <section class="app-aside-panel">
                <header class="app-aside-panel__header">
                    <span class="app-aside-panel__icon"><i class="bx bx-image-alt"></i></span>
                    <div>
                        <h2 class="app-aside-panel__title">{{ __('activities.label_image') }}</h2>
                        <p class="app-aside-panel__subtitle">{{ __('activities.image_help') }}</p>
                    </div>
                </header>
                <div class="app-aside-panel__body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="app-upload-preview">
                            @if ($currentImage)
                                <img src="{{ $currentImage }}" alt="{{ $activity?->getTranslation('name', app()->getLocale()) }}">
                            @else
                                <i class="bx bx-image-alt fs-2"></i>
                            @endif
                        </div>
                        <small class="text-muted">{{ $isEditing ? __('activities.image_constraints') : __('activities.image_help') }}</small>
                    </div>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="activity_image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </section>

            <section class="app-status-card">
                <div class="form-check form-switch mb-0">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input @error('is_active') is-invalid @enderror" type="checkbox" name="is_active" id="is_active" value="1" @checked(old('is_active', $activity?->is_active ?? true))>
                    <label class="form-check-label" for="is_active">{{ __('activities.status_active') }}</label>
                </div>
                @error('is_active')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </section>
        </aside>
    </div>
</form>

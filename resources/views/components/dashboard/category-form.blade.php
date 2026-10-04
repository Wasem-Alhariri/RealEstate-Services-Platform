@props([
    'category' => null,
    'mainCategories' => [],
    'showParent' => false,
    'defaultActive' => false,
    'action',
    'method' => 'POST',
    'title',
    'description' => null,
    'returnUrl',
    'submitLabel',
    'submitIcon' => 'bx bx-check-circle',
])

@php
    $isEditing = (bool) $category;
    $currentIcon = $category?->getFirstMediaUrl('Categories');
    $nameEnLabel = $showParent ? __('categories.sub_name_en') : __('categories.name_en');
    $nameArLabel = $showParent ? __('categories.sub_name_ar') : __('categories.name_ar');
    $activeValue = old('isActive', $category?->isActive ?? $defaultActive);
@endphp

<x-dashboard.page-header :title="$title" :description="$description" eyebrow="{{ __('categories.add_title') }}">
    <a href="{{ $returnUrl }}" class="btn btn-outline-secondary"><i class="bx bx-arrow-back"></i>{{ __('categories.cancel') }}</a>
</x-dashboard.page-header>

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif
    <input type="hidden" name="return_url" value="{{ $returnUrl }}">

    <div class="app-form-shell">
        <section class="app-form-panel">
            <header class="app-form-panel__header">
                <span class="app-form-panel__icon"><i class="bx bx-category"></i></span>
                <div>
                    <h2 class="app-form-panel__title">{{ $title }}</h2>
                    <p class="app-form-panel__subtitle">{{ __('categories.name_en') }} · {{ __('categories.name_ar') }}</p>
                </div>
            </header>
            <div class="app-form-panel__body">
                @if ($showParent)
                    <div class="app-form-field">
                        <label class="app-form-field__label" for="parent_id">{{ __('categories.column_parent') }}</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-layer"></i></span>
                            <select name="parent_id" id="parent_id" class="form-select @error('parent_id') is-invalid @enderror" required>
                                <option value="">{{ __('categories.choose_main') }}</option>
                                @foreach ($mainCategories as $main)
                                    <option value="{{ $main->id }}" @selected(old('parent_id', $category?->parent_id) == $main->id)>{{ $main->getTranslation('name', app()->getLocale()) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('parent_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="app-form-field">
                            <label class="app-form-field__label" for="name_en">{{ $nameEnLabel }}</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-text"></i></span>
                                <input type="text" name="name[en]" id="name_en" class="form-control @error('name.en') is-invalid @enderror" placeholder="{{ __('categories.placeholder_en') }}" value="{{ old('name.en', $category?->getTranslation('name', 'en')) }}" required>
                            </div>
                            @error('name.en')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="app-form-field">
                            <label class="app-form-field__label" for="name_ar">{{ $nameArLabel }}</label>
                            <div class="input-group input-group-merge" dir="rtl">
                                <span class="input-group-text"><i class="bx bx-text"></i></span>
                                <input type="text" name="name[ar]" id="name_ar" class="form-control @error('name.ar') is-invalid @enderror" placeholder="{{ __('categories.placeholder_ar') }}" value="{{ old('name.ar', $category?->getTranslation('name', 'ar')) }}" required>
                            </div>
                            @error('name.ar')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="app-form-actions">
                    <button type="submit" class="btn btn-primary"><i class="{{ $submitIcon }}"></i>{{ $submitLabel }}</button>
                    <a href="{{ $returnUrl }}" class="btn btn-outline-secondary">{{ __('categories.cancel') }}</a>
                </div>
            </div>
        </section>

        <aside class="d-flex flex-column gap-3">
            <section class="app-aside-panel">
                <header class="app-aside-panel__header">
                    <span class="app-aside-panel__icon"><i class="bx bx-image"></i></span>
                    <div>
                        <h2 class="app-aside-panel__title">{{ __('categories.icon_label') }}</h2>
                        <p class="app-aside-panel__subtitle">{{ __('categories.icon_help') }}</p>
                    </div>
                </header>
                <div class="app-aside-panel__body">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="app-upload-preview">
                            @if ($currentIcon)
                                <img src="{{ $currentIcon }}" alt="{{ $category?->getTranslation('name', app()->getLocale()) }}">
                            @else
                                <i class="bx bx-image-alt fs-2"></i>
                            @endif
                        </div>
                        <small class="text-muted">{{ $isEditing ? __('categories.allowed_types') : __('categories.icon_help') }}</small>
                    </div>
                    <input type="file" name="icon" id="category_icon" class="form-control @error('icon') is-invalid @enderror" accept="image/*">
                    @error('icon')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </section>

            <section class="app-status-card">
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="isActive" name="isActive" value="1" @checked($activeValue)>
                    <label class="form-check-label" for="isActive">{{ __('categories.active_help') }}</label>
                </div>
            </section>
        </aside>
    </div>
</form>

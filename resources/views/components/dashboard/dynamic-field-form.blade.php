@props([
    'category',
    'fieldTypes',
    'dynamicField' => null,
    'optionsString' => '',
    'action',
    'method' => 'POST',
    'title',
    'subtitle' => null,
    'submitLabel',
    'submitIcon' => 'bx bx-save',
])

@php
    $selectedType = old('type', $dynamicField?->type);
    $optionText = old('options_input', $optionsString);
    if ($optionText === '' && is_array(old('options'))) {
        $optionText = implode(', ', old('options'));
    }
@endphp

<x-dashboard.page-header :title="$title" :description="$subtitle" eyebrow="{{ __('fields.input_type') }}">
    <a href="{{ route('categories.fields.index', $category->id) }}" class="btn btn-outline-secondary"><i class="bx bx-arrow-back"></i>{{ __('categories.cancel') }}</a>
</x-dashboard.page-header>

<form action="{{ $action }}" method="POST" data-dynamic-field-form>
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="app-form-shell">
        <section class="app-form-panel">
            <header class="app-form-panel__header">
                <span class="app-form-panel__icon"><i class="bx bx-list-check"></i></span>
                <div>
                    <h2 class="app-form-panel__title">{{ __('fields.field_label_en') }} · {{ __('fields.field_label_ar') }}</h2>
                    <p class="app-form-panel__subtitle">{{ __('fields.input_type') }}</p>
                </div>
            </header>
            <div class="app-form-panel__body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="app-form-field">
                            <label class="app-form-field__label" for="label_en">{{ __('fields.field_label_en') }}</label>
                            <div class="input-group input-group-merge"><span class="input-group-text"><i class="bx bx-text"></i></span><input type="text" id="label_en" name="label[en]" class="form-control @error('label.en') is-invalid @enderror" placeholder="e.g. Number of Rooms" value="{{ old('label.en', $dynamicField?->getTranslation('label', 'en')) }}" required></div>
                            @error('label.en')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="app-form-field">
                            <label class="app-form-field__label" for="label_ar">{{ __('fields.field_label_ar') }}</label>
                            <div class="input-group input-group-merge" dir="rtl"><span class="input-group-text"><i class="bx bx-text"></i></span><input type="text" id="label_ar" name="label[ar]" class="form-control @error('label.ar') is-invalid @enderror" placeholder="مثلاً: عدد الغرف" value="{{ old('label.ar', $dynamicField?->getTranslation('label', 'ar')) }}" required></div>
                            @error('label.ar')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="app-form-field">
                    <label class="app-form-field__label" for="typeSelect">{{ __('fields.input_type') }}</label>
                    <div class="input-group input-group-merge"><span class="input-group-text"><i class="bx bx-category"></i></span><select name="type" id="typeSelect" class="form-select @error('type') is-invalid @enderror" data-dynamic-field-type required>@foreach ($fieldTypes as $value => $label)<option value="{{ $value }}" @selected($selectedType == $value)>{{ $label }}</option>@endforeach</select></div>
                    @error('type')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>

                <div class="app-form-field {{ $selectedType === 'select' ? '' : 'd-none' }}" data-dynamic-field-options>
                    <label class="app-form-field__label" for="options_input">{{ __('fields.selection_options') }}</label>
                    <textarea name="options_input" id="options_input" class="form-control" rows="4" placeholder="{{ __('fields.options_help') }}">{{ $optionText }}</textarea>
                    <p class="app-form-field__help">{{ __('fields.options_help') }}</p>
                </div>

                <div class="app-form-actions">
                    <button type="submit" class="btn btn-primary"><i class="{{ $submitIcon }}"></i>{{ $submitLabel }}</button>
                    <a href="{{ route('categories.fields.index', $category->id) }}" class="btn btn-outline-secondary">{{ __('categories.cancel') }}</a>
                </div>
            </div>
        </section>

        <aside class="d-flex flex-column gap-3">
            <section class="app-aside-panel">
                <header class="app-aside-panel__header">
                    <span class="app-aside-panel__icon"><i class="bx bx-cog"></i></span>
                    <div><h2 class="app-aside-panel__title">{{ __('fields.is_required') }}</h2><p class="app-aside-panel__subtitle">{{ __('fields.mark_as_mandatory') }}</p></div>
                </header>
                <div class="app-aside-panel__body">
                    <div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" name="is_required" value="1" id="reqCheck" @checked(old('is_required', $dynamicField?->is_required))><label class="form-check-label fw-semibold" for="reqCheck">{{ __('fields.mark_as_mandatory') }}</label></div>
                </div>
            </section>
        </aside>
    </div>
</form>

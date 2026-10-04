@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'icon' => null,
    'required' => false
])

<div class="form-group mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required) <span class="text-danger">*</span> @endif
        </label>
    @endif
    
    @if($icon)
        <div class="input-group">
            <span class="input-group-text"><i class="{{ $icon }}"></i></span>
            <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" 
                   class="form-control @error($name) is-invalid @enderror" 
                   placeholder="{{ $placeholder }}" 
                   value="{{ old($name, $value) }}"
                   {{ $required ? 'required' : '' }}>
        </div>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" 
               class="form-control @error($name) is-invalid @enderror" 
               placeholder="{{ $placeholder }}" 
               value="{{ old($name, $value) }}"
               {{ $required ? 'required' : '' }}>
    @endif

    @error($name)
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div {{ $attributes->merge(['class' => 'card']) }}>
    @if(isset($header) || isset($title))
        <div class="card-header">
            @if(isset($title))
                <h5 class="card-title">{{ $title }}</h5>
            @endif
            
            @if(isset($header))
                <div class="card-header-actions">
                    {{ $header }}
                </div>
            @endif
        </div>
    @endif

    <div class="card-body">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>

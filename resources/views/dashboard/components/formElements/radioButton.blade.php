<label class="selectgroup-item mb-0">
    <input type="radio" name="{{ $name ?? '' }}" value="{{ $value ?? '' }}"
        class="selectgroup-input {{ $class ?? '' }}" data-label="{{ $label ?? '' }}" {{ $checked ?? '' }}>
    <span class="selectgroup-button selectgroup-button-icon is-invalid">{!! $icon !!}
        {{ $label }}</span>
</label>

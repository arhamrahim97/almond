<label for="TextInput" class="form-label">{{ $label }} {!! $wajib ?? '' !!}{!! $optional ?? '' !!}</label>
<input type="{{ $type ?? 'text' }}" id="{{ $id ?? '' }}" name="{{ $name ?? '' }}"
    class="form-control {{ $class ?? '' }}" value="{{ $value ?? '' }}" {!! $attribute ?? '' !!}
    placeholder="{{ $placeholder ?? '' }}" data-label="{{ $label ?? '' }}">
<span class="text-danger error-text {{ $name }}-error"></span>

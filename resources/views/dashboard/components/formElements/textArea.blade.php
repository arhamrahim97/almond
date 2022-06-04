<label for="TextInput" class="form-label my-2">{{ $label }} {!! $wajib ?? '' !!}</label>
<textarea id="{{ $id ?? '' }}" name="{{ $name ?? '' }}" class="form-control {{ $class ?? '' }}"
    value="{{ $value ?? '' }}" {{ $attribute ?? '' }} placeholder="{{ $placeholder ?? '' }}"
    data-label="{{ $label ?? '' }}" rows="3">{{ $value ?? '' }}</textarea>
<span class="text-danger error-text {{ $name }}-error"></span>

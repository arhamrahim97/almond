<label class="form-label">{{ $label ?? '' }} {!! $wajib ?? '' !!}</label>
<select class="form-select {{ $class ?? '' }}" id="{{ $id ?? '' }}" aria-hidden="true" {{ $attribute ?? '' }}
    name="{{ $name ?? '' }}" style="width:100%" data-label="{{ $label ?? '' }}">
    @if ($class == 'filter')
        <option value="">Semua</option>
    @elseif($class == 'select2 filter')
        <option value="" selected>Semua</option>
    @else
        <option value="" selected hidden>- Pilih Salah Satu -</option>
    @endif
    {{ $options ?? '' }}
</select>
<span class="text-danger error-text {{ $name }}-error"></span>

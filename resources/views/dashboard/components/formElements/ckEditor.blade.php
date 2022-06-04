<label for="TextInput" class="form-label my-2">{{ $label }} {!! $wajib ?? '' !!}</label>
<textarea name="{{ $name }}" class="deskripsi form-control {{ $class ?? '' }}" id="{{ $id ?? '' }}"
    cols="30" rows="10" {{ $attribute ?? '' }}>{!! $value ?? '' !!}</textarea>
<span class="text-danger error-text {{ $name }}-error"></span>

@push('script')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            height: 400,
        };
    </script>

    <script>
        CKEDITOR.replace('{{ $id ?? '' }}', options);
    </script>
@endpush

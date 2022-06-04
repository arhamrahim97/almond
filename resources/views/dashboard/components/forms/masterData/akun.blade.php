<form id="{{ $form_id }}" action="#" method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($method) && $method == 'PUT')
        @method('PUT')
    @endif
    <div class="row g-4">
        <div class="col-sm-12 col-lg-6">
            @component('dashboard.components.formElements.input',
                [
                    'label' => 'Email',
                    'type' => 'text',
                    'id' => 'email',
                    'name' => 'email',
                    'wajib' => '<sup class="text-danger">*</sup>',
                    'placeholder' => 'Masukkan Alamat Email',
                ])
            @endcomponent
        </div>
        <div class="col-sm-12 col-lg-6">
            @component('dashboard.components.formElements.input',
                [
                    'label' => 'Password',
                    'type' => 'text',
                    'id' => 'password',
                    'name' => 'password',
                    'wajib' => '<sup class="text-danger">*</sup>',
                    'placeholder' => 'Masukkan Password',
                ])
            @endcomponent
        </div>
        <div class="col-sm-12 col-lg-6">
            @component('dashboard.components.formElements.select',
                [
                    'label' => 'Role',
                    'id' => 'role',
                    'name' => 'role',
                    'class' => 'select2',
                    'wajib' => '<sup class="text-danger">*</sup>',
                ])
                @slot('options')
                    <option value="Admin">Admin</option>
                    <option value="OPD">OPD</option>
                @endslot
            @endcomponent
        </div>
        <div class="col-sm-12 col-lg-6">
            @component('dashboard.components.formElements.select',
                [
                    'label' => 'OPD',
                    'id' => 'opd',
                    'name' => 'opd',
                    'class' => 'select2',
                    'wajib' => '<sup class="text-danger">*</sup>',
                ])
                @slot('options')
                    @foreach ($opd as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                @endslot
            @endcomponent
        </div>
        <div class="col-12 text-right mt-2">
            @component('dashboard.components.buttons.submit',
                [
                    'label' => 'Simpan',
                ])
            @endcomponent
        </div>
    </div>
</form>


@push('script')
    @if (isset($method) && $method == 'PUT')
        <script>
            $(document).ready(function() {});
        </script>
    @endif
    <script>
        $('#{{ $form_id }}').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ $action }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 'success') {
                        swal("Berhasil", "Data Berhasil Disimpan", {
                            icon: "success",
                            buttons: false,
                            timer: 1000,
                        }).then(function() {
                            window.location.href =
                                "{{ $back_url }}";
                        })
                    } else {
                        printErrorMsg(response.error);
                    }
                },
                error: function(response) {
                    alert(response.responseJSON.message)
                },
            });
        });

        $(function() {
            $('.modal').modal({
                backdrop: 'static',
                keyboard: false
            })
        })

        const printErrorMsg = (msg) => {
            $.each(msg, function(key, value) {
                $('.' + key + '-error').text(value);
            });
        }
    </script>

    <script>
        $("#foto").change(function(event) {
            RecurFadeIn();
            readURLFoto(this);
        });
        $("#foto").on('click', function(event) {
            RecurFadeIn();
        });

        function readURLFoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#foto").val();
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                reader.onload = function(e) {
                    debugger;
                    $('#preview-foto').attr('src', e.target.result);
                    $('#preview-foto').hide();
                    $('#preview-foto').fadeIn(500);
                    $('#label-foto').text(filename);
                }
                reader.readAsDataURL(input.files[0]);
            }
            $(".alert").removeClass("loading").hide();
        }

        function RecurFadeIn() {
            FadeInAlert("Wait for it...");
        }

        function FadeInAlert(text) {
            $(".alert").show();
            $(".alert").text(text).addClass("loading");
        }

        $("#tanda-tangan").change(function(event) {
            RecurFadeIn();
            readURLTandaTangan(this);
        });
        $("#tanda-tangan").on('click', function(event) {
            RecurFadeIn();
        });

        function readURLTandaTangan(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#tanda-tangan").val();
                filename = filename.substring(filename.lastIndexOf('\\') + 1);
                reader.onload = function(e) {
                    debugger;
                    $('#preview-tanda-tangan').attr('src', e.target.result);
                    $('#preview-tanda-tangan').hide();
                    $('#preview-tanda-tangan').fadeIn(500);
                    $('#label-tanda-tangan').text(filename);
                }
                reader.readAsDataURL(input.files[0]);
            }
            $(".alert").removeClass("loading").hide();
        }

        function RecurFadeIn() {
            FadeInAlert("Wait for it...");
        }

        function FadeInAlert(text) {
            $(".alert").show();
            $(".alert").text(text).addClass("loading");
        }
    </script>
@endpush

<form action="#" id="{{ $form ?? 'form' }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @if (isset($method) && $method == 'PUT')
        @method('PUT')
    @endif
    <div class="card-body pt-3">
        <div class="row justify-content-center">
            <div class="col px-2 text-left">
                <div class="form-group py-0">
                    <span class="text-danger">*</span><i class="text-muted">= bersifat wajib</i>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Nama Lengkap', 'name' => 'nama_lengkap', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Nama Lengkap', 'value' => isset($user) ? $user->nama_lengkap : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Username', 'name' => 'username', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Username', 'value' => isset($user) ? $user->username : ''])
                    @endcomponent
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Password', 'name' => 'password', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Password'])
                        @if ($method == 'POST')
                            @slot('class', 'req')
                        @endif
                    @endcomponent
                    @if ($method == 'PUT')
                        <span class="text-muted" style="font-style: italic">Kosongkan saja apabila tidak ingin mengubah
                            password</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    <label class="form-label">Role <sup class="text-danger">*</sup></label>
                    <div class="selectgroup w-100">
                        @if ($method == 'POST')
                            <input type="hidden" name="role" value="" class="req" data-label="Role"
                                id="role-hidden">
                        @endif
                        @if (Auth::user()->id == '5gf9ba91-4778-404c-aa7f-5fd327e87e80')
                            @component('dashboard.components.formElements.radioButton', ['label' => 'Admin', 'value' => 'Admin', 'name' => 'role', 'class' => 'role req', 'icon' => '<i class="fas fa-user-shield"></i>', 'checked' => isset($user) && $user->role == 'Admin' ? 'checked' : ''])
                            @endcomponent
                        @endif
                        @component('dashboard.components.formElements.radioButton', ['label' => 'Staf', 'value' => 'Staf', 'name' => 'role', 'class' => 'role req', 'icon' => '<i class="fas fa-users"></i>', 'checked' => isset($user) && $user->role == 'Staf' ? 'checked' : ''])
                        @endcomponent
                    </div>
                    <span class="text-danger error-text role-error"></span>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    <label class="form-label">Status <sup class="text-danger">*</sup></label>
                    <div class="selectgroup w-100">
                        @if ($method == 'POST')
                            <input type="hidden" name="status" value="" class="req" data-label="Status"
                                id="status-hidden">
                        @endif
                        @component('dashboard.components.formElements.radioButton', ['label' => 'Aktif', 'value' => 1, 'name' => 'status', 'class' => 'status req', 'icon' => '<i class="fas fa-check-circle"></i>', 'checked' => isset($user) && $user->status == 1 ? 'checked' : ''])
                        @endcomponent
                        @component('dashboard.components.formElements.radioButton', ['label' => 'Tidak Aktif', 'value' => 2, 'name' => 'status', 'class' => 'status req', 'icon' => '<i class="fas fa-times-circle"></i>', 'checked' => isset($user) && $user->status == 2 ? 'checked' : ''])
                        @endcomponent
                    </div>
                    <span class="text-danger error-text status-error"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-action">
        <div class="row justify-content-end">
            <div class="col-md-12 text-right">
                @component('dashboard.components.buttons.submit', ['label' => $labelSubmit])
                @endcomponent
            </div>
        </div>
    </div>
</form>

@push('script')
    <script>
        $('.role').click(function() {
            $('#role-hidden').val($(this).val());
        });

        $('.status').click(function() {
            $('#status-hidden').val($(this).val());
        });

        $('#form').submit(function(e) {
            e.preventDefault()
            $('.error-text').html('')
            var formData = $('#form .req').serializeArray()
            var data = new FormData(this)
            validation(formData)
            if ('{{ $method }}' == 'POST') {
                var title = 'Simpan Data?'
                var text = 'Apakah anda yakin ingin menyimpan data ini?'
            } else {
                var title = 'Perbarui Data?'
                var text = 'Apakah anda yakin ingin perbarui data ini?'
            }
            swal({
                title: title,
                text: text,
                icon: "info",
                buttons: ["Batal", "Ya"],
            }).then((result) => {
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "{{ $action }}",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: data,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if ($.isEmptyObject(response.error)) {
                                swal({
                                    title: "Berhasil!",
                                    text: "Data berhasil disimpan!",
                                    icon: "success",
                                }).then((value) => {
                                    location.href = "{{ url()->previous() }}";
                                });
                            } else {
                                swal({
                                    title: "Gagal!",
                                    text: "Terjadi kesalahan, mohon periksa kembali data yang diinputkan.",
                                    icon: "error",
                                    button: "Ok",
                                });
                                printErrorMsg(response.error);
                            }
                        },
                        error: function(response) {
                            overlay.hide();
                            swal({
                                title: "Coba kembali",
                                text: "Maaf, terjadi kesalahan pengiriman data, silahkan coba kembali.",
                                icon: "error",
                                button: "Ok",
                            });
                        },
                    });
                } else {
                    swal("Data batal disimpan.", {
                        icon: "error",
                    });
                }
            });
        });

        const printErrorMsg = (msg) => {
            $.each(msg, function(key, value) {
                $('.' + key + '-error').text(value);
            });
        }
    </script>
@endpush

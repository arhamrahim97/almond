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
                    @component('dashboard.components.formElements.input', ['label' => 'Nama Lengkap', 'name' => 'nama_lengkap', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Nama Lengkap', 'value' => isset($pegawai) ? $pegawai->nama_lengkap : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin <sup class="text-danger">*</sup></label>
                    <div class="selectgroup w-100">
                        @if ($method == 'POST')
                            <input type="hidden" name="jenis_kelamin" value="" data-label="Jenis Kelamin"
                                id="jenis-kelamin-hidden">
                        @endif
                        @component('dashboard.components.formElements.radioButton', ['label' => 'Laki-laki', 'value' => 'Laki-laki', 'name' => 'jenis_kelamin', 'class' => 'jenis-kelamin req', 'icon' => '<i class="fas fa-mars"></i>', 'checked' => isset($pegawai) && $pegawai->jenis_kelamin == 'Laki-laki' ? 'checked' : ''])
                        @endcomponent
                        @component('dashboard.components.formElements.radioButton', ['label' => 'Perempuan', 'value' => 'Perempuan', 'name' => 'jenis_kelamin', 'class' => 'jenis-kelamin req', 'icon' => '<i class="fas fa-venus"></i>', 'checked' => isset($pegawai) && $pegawai->jenis_kelamin == 'Perempuan' ? 'checked' : ''])
                        @endcomponent
                    </div>
                    <span class="text-danger error-text jenis_kelamin-error"></span>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Tempat Lahir', 'name' => 'tempat_lahir', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Tempat Lahir', 'value' => isset($pegawai) ? $pegawai->tempat_lahir : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Tanggal Lahir', 'name' => 'tanggal_lahir', 'class' => 'tanggal req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Tanggal Lahir (DD-MM-YYYY)', 'value' => isset($pegawai) ? Carbon\Carbon::parse($pegawai->tanggal_lahir)->isoFormat('DD-MM-YYYY') : ''])
                    @endcomponent
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Nomor HP', 'name' => 'nomor_hp', 'class' => 'angka req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Nomor HP', 'value' => isset($pegawai) ? $pegawai->nomor_hp : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Email', 'name' => 'email', 'optional' => '<span class="text-muted"><i>(Optional)</i></span>', 'placeholder' => 'Masukkan Email', 'value' => isset($pegawai) ? $pegawai->email : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-12 col-lg-12 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.textArea', ['label' => 'Alamat', 'name' => 'alamat', 'class' => 'req', 'id' => 'alamat', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Alamat', 'value' => isset($pegawai) ? $pegawai->alamat : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'NIP', 'name' => 'nip', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan NIP', 'attribute' => 'onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" maxlength="16"', 'value' => isset($pegawai) ? $pegawai->nip : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.select',
                        [
                            'label' => 'Golongan - Jabatan - Pangkat',
                            'id' => 'golongan',
                            'name' => 'jabatan_struktural_id',
                            'class' => 'select2 req',
                            'wajib' => '<sup class="text-danger">*</sup>',
                        ])
                        @slot('options')
                            @foreach ($jabatanStruktural as $item)
                                @if (isset($pegawai) && $pegawai->jabatan_struktural_id == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->golongan }} -
                                        {{ $item->jabatan }} -
                                        {{ $item->pangkat }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->golongan }} - {{ $item->jabatan }} -
                                        {{ $item->pangkat }}</option>
                                @endif
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Unit Kerja / Tempat Tugas', 'name' => 'unit_kerja', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Unit Kerja / Tempat Tugas', 'value' => isset($pegawai) ? $pegawai->unit_kerja : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group @error('foto_ttd') has-error @enderror">
                    <label>Foto Profil <span style="color: red">(Max: 3MB)</span> <span
                            class="text-muted"><i>(Optional)</i></span> : </label>
                    <div class="input-file input-file-image">
                        <img class="img-upload-preview img-circle"
                            src="{{ isset($pegawai) && $pegawai->foto_profil != null && Storage::exists('upload/foto_profil/pegawai/' . $pegawai->foto_profil) ? Storage::url('upload/foto_profil/pegawai/' . $pegawai->foto_profil) : asset('assets/img/no-profile4.png') }}"
                            alt="preview" width="150" height="150">
                        <input type="file" class="form-control form-control-file" id="foto" name="foto_profil"
                            accept="image/*" value="" data-label="Foto Profil">
                        <label for="foto" class="btn btn-primary btn-sm btn-round btn-lg"><i
                                class="fa fa-file-image"></i>
                            Pilih Gambar</label>
                        <span class="text-danger d-block error-text foto_profil-error"></span>

                    </div>
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
        $('.jenis-kelamin').click(function() {
            $('#jenis-kelamin-hidden').val($(this).val());
        });

        $('#foto').change(function() {
            let size = $(this)[0].files[0].size / 1024
            if (size > 3072) {
                swal({
                    title: "Gagal!",
                    text: "Ukuran gambar terlalu besar! Maksimal 3MB",
                    icon: "error",
                }).then((value) => {
                    $(this).val('');
                    $('.img-upload-preview').attr('src',
                        '{{ isset($pegawai) && $pegawai->foto_profil != null && Storage::exists('upload/foto_profil/pegawai/' . $pegawai->foto_profil) ? Storage::url('upload/foto_profil/pegawai/' . $pegawai->foto_profil) : asset('assets/img/blank_photo.png') }}'
                    )
                });
            }
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
                                    location.href = "{{ url('pegawai') }}";
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

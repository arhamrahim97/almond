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

            <div class="col-md-12 col-lg-12 col-xl-12 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Nama Ruangan', 'name' => 'nama_ruangan', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Nama Ruangan', 'value' => isset($ruangan) ? $ruangan->nama_lengkap : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-12 col-lg-12 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.textArea', ['label' => 'Deskripsi', 'name' => 'deskripsi', 'class' => '', 'id' => 'deskripsi', 'placeholder' => 'Masukkan Deskripsi', 'value' => isset($ruangan) ? $ruangan->deskripsi : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-12 col-lg-12 px-2">
                <div class="form-group">
                    <label for="">Foto Ruangan <sup class="text-danger">*</sup></label>
                    <div class="row" id="gambar-aset">
                        <div class="col-md-4 col-lg-4 col-xl-3 text-center" id="col-image-1">
                            <div class="card mb-1">
                                <div class="p-2 text-center">
                                    <img class="card-img-top rounded text-center"
                                        src="{{ asset('assets/img/blank_photo.png') }}" alt="image" data-iter="1"
                                        id="preview-image-1" style="height: 180px">
                                </div>
                                @if ($method == 'POST')
                                    <input type="hidden" name="file_gambar" value="" class="req"
                                        data-label="Foto Ruangan (Sampul)" id="foto_ruangan-hidden">
                                @endif
                                <input type="file" class="form-control form-control-file file-gambar req"
                                    id="file-gambar-1" data-iter="1" name="file_gambar[]" accept="image/*">
                                @if ($method == 'PUT')
                                    <button type="button"
                                        class="btn btn-danger fw-bold card-footer bg-danger text-center p-0"
                                        onclick="deleteImage(1)"><i class="fas fa-trash-alt"></i>
                                        Hapus</button>
                                @endif
                            </div>
                            <span class="text-muted text-center d-block">Ini akan dijadikan <b>foto sampul</b>
                            </span>
                            <span class="text-danger error-text file_gambar-error my-0"></span>
                        </div>
                        <div class="col-md-2 col-lg-2 col-xl-1 align-self-center col-add-image">
                            <div class="text-center text-muted" onclick="addImage()" style="cursor: pointer">
                                <h1><i class="fas fa-plus-circle"></i></h1>
                                <h6>Tambah Foto</h6>
                            </div>
                        </div>
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
        let itemImage = 2;
        $(document).on('change', '.file-gambar', function() {

            let size = $(this)[0].files[0].size / 1024
            if (size > 3072) {
                swal({
                    title: "Gagal!",
                    text: "Ukuran gambar terlalu besar! Maksimal 3MB",
                    icon: "error",
                }).then((value) => {
                    $(this).val('');
                    $('#preview-image-' + $(this).data('iter')).attr('src',
                        '{{ isset($ruangan) && $ruangan->foto_profil != null && Storage::exists('upload/foto_profil/ruangan/' . $ruangan->foto_profil) ? Storage::url('upload/foto_profil/ruangan/' . $ruangan->foto_profil) : asset('assets/img/blank_photo.png') }}'
                    );
                });
            }

            let iter = $(this).data('iter')
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-image-' + iter).attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        function addImage() {
            if ($('#file-gambar-1').val() == '') {
                swal({
                    title: "Gagal!",
                    text: "Silahkan masukkan foto sampul terlebih dahulu untuk dapat menambahkan foto lainnya!",
                    icon: "error",
                });
            } else {
                $('.col-add-image').remove();
                $('#gambar-aset').append(`
                    <div class="col-md-4 col-lg-4 col-xl-3" id="col-image-` + itemImage + `">
                        <div class="card mb-1">
                            <div class="p-2 text-center">
                                <img class="card-img-top rounded text-center"
                                    src="{{ asset('assets/img/blank_photo.png') }}" alt="image" data-iter="` +
                    itemImage +
                    `" id="preview-image-` + itemImage + `"  style="height: 180px">
                            </div>
                            <input type="file" class="form-control form-control-file file-gambar" id="file-gambar-` +
                    itemImage + `"
                                data-iter="` + itemImage + `" name="file_gambar[]" accept="image/*">
                            <span class="text-danger error-text file-gambar-error my-0"></span>
                            <button type="button"
                                class="btn btn-danger fw-bold card-footer bg-danger text-center p-0"
                                onclick="deleteImage(` + itemImage + `)"><i class="fas fa-trash-alt"></i>
                                Hapus</button>
                        </div>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-1 align-self-center col-add-image">
                        <div class="text-center text-muted" onclick="addImage()" style="cursor: pointer">
                            <h1><i class="fas fa-plus-circle"></i></h1>
                            <h6>Tambah Foto</h6>
                        </div>
                    </div>                  
                    `);
                itemImage++;
            }
        }

        function deleteImage(iter) {
            $('#col-image-' + iter).fadeOut(function() {
                $('#col-image-' + iter).remove();
            });
        }

        $('#file-gambar-1').change(function() {
            $('#foto_ruangan-hidden').remove()
        });


        $('#form').submit(function(e) {
            e.preventDefault()
            $('.error-text').html('')
            var formData = $(this).serializeArray()
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
                                console.log(response)
                                if (response == 'tidak_ada_gambar') {
                                    $('.file_gambar-error').text(
                                        'Silahkan masukkan setidaknya 1 Foto Ruangan.'
                                    )
                                    swal({
                                        title: "Gagal!",
                                        text: "Silahkan masukkan setidaknya 1 Foto Ruangan.",
                                        icon: "error",
                                    })
                                } else if (response == 'success') {
                                    swal({
                                        title: "Berhasil!",
                                        text: "Data berhasil disimpan!",
                                        icon: "success",
                                    }).then((value) => {
                                        location.href = "{{ url()->previous() }}";
                                    });
                                }
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
                            alert(response.responseJSON.message)
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

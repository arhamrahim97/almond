@push('style')
    <style>
        .selectgroup-input:checked+.selectgroup-button {
            border-color: rgba(185, 221, 248, 0.467) !important
        }
    </style>
@endpush
<form action="#" id="{{ $form ?? 'form' }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @if (isset($method) && $method == 'PUT')
        @method('PUT')
    @endif
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col px-2 text-left">
                <div class="form-group py-0">
                    <span class="text-danger">*</span><i class="text-muted">= bersifat wajib</i>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-6 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Nama Aset', 'name' => 'nama_aset', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Nama Aset', 'value' => isset($aset) ? $aset->nama_aset : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Merek (Brand)', 'name' => 'merek', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Merek', 'value' => isset($aset) ? $aset->merek : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Model', 'name' => 'model', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Model', 'value' => isset($aset) ? $aset->model : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Kode Inventaris', 'name' => 'kode_inventaris', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Kode Inventaris', 'value' => isset($aset) ? $aset->kode_inventaris : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-12 col-lg-12 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.textArea', ['label' => 'Deskripsi', 'name' => 'deskripsi', 'placeholder' => 'Masukkan Deskripsi', 'value' => isset($aset) ? $aset->deskripsi : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-12 col-lg-12 px-2">
                <div class="form-group">
                    <label for="">Foto Aset</label>
                    <div class="row" id="gambar-aset">
                        @if ($method == 'POST')
                            <div class="col-md-4 col-lg-4 col-xl-3 text-center" id="col-image-1">
                                <div class="card mb-1">
                                    <div class="p-2 text-center">
                                        <img class="card-img-top rounded text-center"
                                            src="{{ asset('assets/img/blank_photo.png') }}" alt="image" data-iter="1"
                                            id="preview-image-1" style="height: 180px">
                                    </div>
                                    {{-- start validation --}}
                                    <input type="hidden" name="file_gambar_1" value="" class="req file_gambar"
                                        data-label="Foto Aset" data-iter="1" id="file_gambar-hidden-1">
                                    {{-- start validation --}}

                                    <input type="file" class="form-control form-control-file file-gambar"
                                        id="file-gambar-1" data-iter="1" name="file_gambar[]" accept="image/*"
                                        onchange="rmValFileGambar(1)">
                                    <label class="selectgroup-item mb-0">
                                        <input type="radio" value="" class="selectgroup-input foto_sampul"
                                            id="foto-sampul" checked='checked'>
                                        <span class="selectgroup-button selectgroup-button-icon py-1"><i
                                                class="fas fa-images"></i><span class="foto-sampul-text"
                                                id="foto-sampul-text"> Foto Sampul</span>
                                        </span>
                                    </label>
                                </div>
                                {{-- start validation --}}
                                <p class="text-danger error-text file_gambar_1-error my-0" id="file_gambar-error-1">
                                </p>
                                {{-- end validation --}}

                                <span class="text-danger error-text file_gambar-error d-block my-0"></span>
                            </div>
                        @else
                            @if ($aset->fileUploadGambar->count() > 0)
                                @foreach ($aset->fileUploadGambar as $item)
                                    <div class="col-md-4 col-lg-4 col-xl-3 text-center"
                                        id="col-image-old-{{ $loop->iteration }}">
                                        <div class="card mb-1">
                                            <div class="p-2 text-center">
                                                <img class="card-img-top rounded text-center preview-image"
                                                    src="{{ Storage::exists('upload/foto_aset_bergerak/' . $item->nama_file) ? Storage::url('upload/foto_aset_bergerak/' . $item->nama_file) : asset('assets/img/blank_photo.png') }}"
                                                    alt="image" data-iter="{{ $loop->iteration }}"
                                                    id="preview-image-{{ $loop->iteration }}" style="height: 180px">
                                            </div>
                                            <label class="selectgroup-item mb-0">
                                                <input type="radio" value="{{ $item->id }}" name="foto_sampul"
                                                    class="selectgroup-input foto_sampul"
                                                    id="foto-sampul-{{ $loop->iteration }}"
                                                    {{ $item->is_sampul == 1 ? 'checked=checked' : '' }}
                                                    data-iter={{ $loop->iteration }}>
                                                <span class="selectgroup-button selectgroup-button-icon py-2"><i
                                                        class="fas fa-images"></i><span class="foto-sampul-text"
                                                        id="foto-sampul-text-{{ $loop->iteration }}">
                                                        {{ $item->is_sampul == 1 ? ' Foto Sampul' : ' Jadikan Foto Sampul' }}</span>
                                                </span>
                                            </label>
                                            <button type="button"
                                                class="btn btn-danger fw-bold card-footer bg-danger text-center delete-image p-0 {{ $item->is_sampul == 1 ? 'd-none' : '' }}"
                                                onclick="deleteImageOld({{ $loop->iteration }})"
                                                id="delete-image-old-{{ $loop->iteration }}"
                                                value="{{ $item->id }}"><i class="fas fa-trash-alt"></i>
                                                Hapus</button>
                                        </div>
                                        <span class="text-danger error-text file_gambar-error my-0"></span>

                                    </div>
                                @endforeach
                            @endif
                        @endif
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
                @component('dashboard.components.buttons.submit', ['label' => $labelSubmit ?? 'Simpan'])
                @endcomponent
            </div>
        </div>
    </div>
</form>

@push('script')
    <script>
        $('.foto_sampul').change(function() {
            var iter = $(this).data('iter');
            var val = $(this).val();
            $('.foto-sampul-text').text(' Jadikan Foto Sampul');
            $('#foto-sampul-' + iter).prop('checked', 'checked');
            $('#foto-sampul-text-' + iter).text(' Foto Sampul');
            $('.delete-image').removeClass('d-none');
            $('#delete-image-old-' + iter).addClass('d-none');
        });

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

        let itemImageOld = [];

        function deleteImageOld(iter) {
            let val = $('#delete-image-old-' + iter).val();
            itemImageOld.push(val);
            $('#col-image-old-' + iter).fadeOut(function() {
                $('#col-image-old-' + iter).remove();
            });
        }

        let itemImage = 2;

        function addImage() {
            if (('{{ $method }}' == 'PUT') && (itemImage == 2)) {
                let count = {{ $maxImage ?? '' }} + 1;
                itemImage = count + 1;
            }
            if (($('#file-gambar-1').val() == '') && ('{{ $method }}' == 'POST')) {
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
                            <input type="hidden" name="file_gambar_` + itemImage + `" value="" class="req file_gambar"
                                        data-label="Foto Aset" data-iter="` + itemImage + `" id="file_gambar-hidden-` +
                    itemImage + `">
                            <input type="file" class="form-control form-control-file file-gambar" id="file-gambar-` +
                    itemImage + `"
                                data-iter="` + itemImage +
                    `" name="file_gambar[]" accept="image/*" onchange="rmValFileGambar(` + itemImage + `)">
                            <span class="text-danger error-text file-gambar-error my-0"></span>
                            <button type="button"
                                class="btn btn-danger fw-bold card-footer bg-danger text-center p-0"
                                onclick="deleteImage(` + itemImage + `)"><i class="fas fa-trash-alt"></i>
                                Hapus</button>
                        </div>
                        <p class="text-danger error-text file_gambar_` + itemImage +
                    `-error my-0" id="file_gambar-error-` + itemImage + `">
                                </p>
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

        function rmValFileGambar(iter) {
            if ($('#file-gambar-' + iter).val() != '') {
                $('#file_gambar-hidden-' + iter).removeClass('req');
            } else {
                $('#file_gambar-hidden-' + iter).addClass('req');
            }
        }

        $('#form').submit(function(e) {
            e.preventDefault();
            $('.error-text').html('')
            var formData = $('.req').serializeArray()
            var data = new FormData(this)
            if ('{{ $method }}' == 'PUT') {
                data.append('deleteImageOld', itemImageOld)
            }
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
                                if (response == 'tidak_ada_gambar') {
                                    $('.file_gambar-error').text(
                                        'Silahkan masukkan setidaknya 1 Foto Aset.'
                                    )
                                    swal({
                                        title: "Gagal!",
                                        text: "Silahkan masukkan setidaknya 1 Foto Aset.",
                                        icon: "error",
                                    })
                                }

                                if (response == 'success') {
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

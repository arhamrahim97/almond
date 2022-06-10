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
            <div class="col-md-12 col-lg-3 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.select',
                        [
                            'label' => 'Pegawai',
                            'id' => 'pegawai',
                            'name' => 'pegawai_id',
                            'class' => 'select2 req',
                            'wajib' => '<sup class="text-danger">*</sup>',
                        ])
                        @slot('options')
                            @foreach ($pegawai as $item)
                                @if ($aset->pegawai_id == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->nama_lengkap }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endif
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
            </div>
            <div class="col-md-12 col-lg-9 px-2">
                <div class="form-group">
                    <label for="">Dokumen (Surat-surat Kendaraan, Berita Acara, dan Lainnya)</label>
                    <div class="row" id="dokumen-aset">
                        @if ($aset->pegawai)
                            @if ($aset->fileUpload->count() > 0)
                                @foreach ($aset->fileUploadDokumen as $item)
                                    <div class="col-md-6 col-lg-6 col-xl-4 col-document"
                                        id="col-document-old-{{ $loop->iteration }}">
                                        <div class="card box-upload mb-3 pegawai"
                                            id="box-upload-{{ $loop->iteration }}" class="box-upload">
                                            <div class="card-body pb-2">
                                                <div class="row">
                                                    <div class="col-3 d-flex align-items-center justify-content-center">
                                                        <img src="{{ asset('assets/img/pdf.png') }}" alt=""
                                                            width="70px">
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="mb-3 mt-2">
                                                            <input type="text" class="form-control nama-dokumen"
                                                                id="nama-dokumen-{{ $loop->iteration }}"
                                                                name="nama_dokumen[]"
                                                                placeholder="Masukkan Nama Dokumen"
                                                                value="{{ $item->deskripsi }}"
                                                                data-iter="{{ $loop->iteration }}" disabled>
                                                            <p class="text-danger error-text nama_dokumen-error my-0"
                                                                id="nama_dokumen-error-{{ $loop->iteration }}"></p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <a type="button"
                                                                href="{{ Storage::exists('upload/dokumen_aset_bergerak/' . $item->nama_file) ? Storage::url('upload/dokumen_aset_bergerak/' . $item->nama_file) : 'tidak-ditemukan' }}"
                                                                target="_blank"
                                                                class="btn btn-primary shadow-sm w-100"><i
                                                                    class="fas fa-eye"></i> Lihat
                                                                Dokumen</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button"
                                                class="btn btn-danger fw-bold card-footer bg-danger text-center delete-document p-0"
                                                onclick="deleteDocumentOld({{ $loop->iteration }})"
                                                id="delete-document-old-{{ $loop->iteration }}"
                                                value="{{ $item->id }}"><i class="fas fa-trash-alt"></i>
                                                Hapus</button>
                                        </div>
                                        <p class="text-danger error-text dokumen-error my-0" id="dokumen-error-1"></p>
                                    </div>
                                @endforeach

                            @endif
                        @else
                            <div class="col-md-6 col-lg-6 col-xl-4 col-document" id="col-dokumen-1">
                                <div class="card box-upload mb-3 pegawai" id="box-upload-1" class="box-upload">
                                    <div class="card-body pb-2">
                                        <div class="row">
                                            <div class="col-3 d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('assets/img/pdf.png') }}" alt="" width="70px">
                                            </div>
                                            <div class="col-9">
                                                <div class="mb-3 mt-2">
                                                    {{-- start validation --}}
                                                    <input type="hidden" name="nama_dokumen_1" value=""
                                                        class="req nama_dokumen" data-label="Nama Dokumen" data-iter="1"
                                                        id="nama_dokumen-hidden-1">
                                                    {{-- end validation --}}

                                                    <input type="text" class="form-control nama-dokumen"
                                                        id="nama-dokumen-1" name="nama_dokumen[]"
                                                        placeholder="Masukkan Nama Dokumen" value="" data-iter="1"
                                                        onkeyup="rmValNamaDokumen(1)">

                                                    {{-- start validation --}}
                                                    <p class="text-danger error-text nama_dokumen_1-error my-0"
                                                        id="nama_dokumen-error-1"></p>
                                                    {{-- end validation --}}

                                                    <p class="text-danger error-text nama_dokumen-error my-0"
                                                        id="nama_dokumen-error-1"></p>
                                                </div>
                                                <div class="mb-3">
                                                    {{-- start validation --}}
                                                    <input type="hidden" name="file_dokumen_1" value=""
                                                        class="req file_dokumen" data-label="File Dokumen" data-iter="1"
                                                        id="file_dokumen-hidden-1">
                                                    {{-- end validation --}}

                                                    <input name="file_dokumen[]" class="form-control file-dokumen"
                                                        id="file-dokumen-1" type="file" multiple="true" data-iter="1"
                                                        accept="application/pdf" onchange="rmValFileDokumen(1)">

                                                    {{-- start validation --}}
                                                    <p class="text-danger error-text file_dokumen_1-error my-0"
                                                        id="file_dokumen-error-1"></p>
                                                    {{-- end validation --}}

                                                    <p class="text-danger error-text file_dokumen-error my-0"
                                                        id="file_dokumen-error-1"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <p class="text-danger error-text dokumen-error my-0" id="dokumen-error-1"></p>
                            </div>

                        @endif
                        <div class="col-md-2 col-lg-2 col-xl-1 align-self-center col-add-dokumen">
                            <div class="text-center text-muted" onclick="addDokumen()" style="cursor: pointer">
                                <h1><i class="fas fa-plus-circle"></i></h1>
                                <h6>Tambah Dokumen</h6>
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
                @component('dashboard.components.buttons.submit', ['label' => $aset->pegawai ? 'Perbarui' : 'Simpan'])
                @endcomponent
            </div>
        </div>
    </div>
</form>

@push('script')
    <script>
        $(document).on('change', '.file-dokumen', function() {
            let size = $(this)[0].files[0].size / 1024
            if (size > 3072) {
                swal({
                    title: "Gagal!",
                    text: "Ukuran dokumen terlalu besar! Maksimal 3MB",
                    icon: "error",
                }).then((value) => {
                    $(this).val('');
                });
            }
        });

        let itemDocumentOld = [];

        var countColDocument = $('.col-document').length;

        function deleteDocumentOld(iter) {
            let val = $('#delete-document-old-' + iter).val();
            itemDocumentOld.push(val);
            $('#col-document-old-' + iter).fadeOut(function() {
                $('#col-document-old-' + iter).remove();
            });
            countColDocument = $('.col-document').length - 1;
            if (countColDocument == 0) {
                addDokumen();
                swal({
                    title: "Gagal!",
                    text: "Tambahkan minimal 1 dokumen",
                    icon: "error",
                });
                return false;
            }
        }

        function deleteDokumen(iter) {
            $('#col-dokumen-' + iter).fadeOut(function() {
                $('#col-dokumen-' + iter).remove();
            });
            countColDocument = $('.col-document').length - 1;
            if (countColDocument == 0) {
                addDokumen();
                swal({
                    title: "Gagal!",
                    text: "Tambahkan minimal 1 dokumen",
                    icon: "error",
                });
                return false;
            }
        }

        function rmValNamaDokumen(iter) {
            console.log(iter);
            if ($('#nama-dokumen-' + iter).val() != '') {
                $('#nama_dokumen-hidden-' + iter).removeClass('req');
            } else {
                $('#nama_dokumen-hidden-' + iter).addClass('req');
            }
        }

        function rmValFileDokumen(iter) {
            console.log(iter);
            if ($('#file-dokumen-' + iter).val() != '') {
                $('#file_dokumen-hidden-' + iter).removeClass('req');
            } else {
                $('#file_dokumen-hidden-' + iter).addClass('req');
            }
        }

        // $('.nama-dokumen').change(function() {
        //     $('#nama_dokumen-hidden-' + $(this).data('iter')).remove();
        //     nama_dokumen - hidden - 2
        // });

        $('.file-dokumen').change(function() {
            $('#file_dokumen-hidden-' + $(this).data('iter')).remove();
        });

        let iterDokumen = 2;

        function addDokumen() {
            if (('{{ $aset->pegawai }}') && (iterDokumen == 2)) {
                let count = {{ $maxDocument ?? '' }} + 1;
                iterDokumen = count + 1;
            }
            $('.col-add-dokumen').remove();
            $('#dokumen-aset').append(`
            <div class="col-md-6 col-lg-6 col-xl-4 col-document" id="col-dokumen-` + iterDokumen + `">
                <div class="card box-upload mb-3" id="box-upload-` +
                iterDokumen + `" class="box-upload">
                    <div class="card-body pb-2">
                        <div class="row">
                            <div class="col-3 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/img/pdf.png') }}" alt="" width="70px">
                            </div>
                            <div class="col-9">
                                <div class="mb-3 mt-2">
                                    <input type="hidden" name="nama_dokumen_` + iterDokumen +
                `" value=""
                                                        class="req nama_dokumen" data-label="Nama Dokumen" data-iter="` +
                iterDokumen + `"
                                                        id="nama_dokumen-hidden-` + iterDokumen +
                `">
                                                        <input type="text" class="form-control nama-dokumen" id="nama-dokumen-` +
                iterDokumen +
                `"
                                                        name="nama_dokumen[]" placeholder="Masukkan Nama Dokumen" value="" data-iter="` +
                iterDokumen +
                `"  onkeyup="rmValNamaDokumen(` + iterDokumen +
                `)">
                                                        <p class="text-danger error-text nama_dokumen-error my-0" id="nama_dokumen-error-` +
                iterDokumen +
                `"></p>
                                                        <p class="text-danger error-text nama_dokumen_` + iterDokumen + `-error my-0"
                                                                            id="nama_dokumen-error-` + iterDokumen +
                `"></p>
                                </div>

                                <div class="mb-3">
                                    <input type="hidden" name="file_dokumen_` + iterDokumen +
                `" value=""
                                                        class="req file_dokumen" data-label="File Dokumen" data-iter="` +
                iterDokumen + `"
                                                        id="file_dokumen-hidden-` + iterDokumen +
                `">
                                    <input name="file_dokumen[]" class="form-control file-dokumen" type="file" id="file-dokumen-` +
                iterDokumen + `"
                                        multiple="true" data-iter="` + iterDokumen +
                `" accept="application/pdf" onchange="rmValFileDokumen(` + iterDokumen + `)">
                <p class="text-danger error-text file_dokumen_` + iterDokumen + `-error my-0"
                                                        id="file_dokumen-error-` + iterDokumen +
                `"></p>
                                    <p class="text-danger error-text file_dokumen-error my-0" id="file_dokumen-error-` +
                iterDokumen + `"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button"
                        class="btn btn-danger fw-bold card-footer bg-danger text-center p-0 delete-document"
                        onclick="deleteDokumen(` + iterDokumen + `)"><i class="fas fa-trash-alt"></i>
                        Hapus</button>
                </div>
                <p class="text-danger error-text dokumen-error my-0" id="dokumen-error-1"></p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-1 align-self-center col-add-dokumen">
                <div class="text-center text-muted" onclick="addDokumen()" style="cursor: pointer">
                    <h1><i class="fas fa-plus-circle"></i></h1>
                    <h6>Tambah Dokumen</h6>
                </div>

            </div>
                
            `);
            iterDokumen++;
        }

        $('#form').submit(function(e) {
            e.preventDefault();
            if (countColDocument == 0) {

            }
            $('.error-text').html('')
            $('.nama-dokumen').removeClass('is-invalid')
            $('.file-dokumen').removeClass('is-invalid')
            var formData = $('.req').serializeArray()
            var data = new FormData(this)

            if ('{{ $aset->pegawai }}') {
                data.append('deleteDocumentOld', itemDocumentOld)
            }
            validation(formData)
            /// Remove TIPE HIDDEN INPUT after Validation
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
                            console.log(response)
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

                                if (response == 'tidak_ada_dokumen') {
                                    $('.dokumen-error').text(
                                        'Silahkan masukkan setidaknya 1 Dokumen.'
                                    )
                                    swal({
                                        title: "Gagal!",
                                        text: "Silahkan masukkan setidaknya 1 Dokumen.",
                                        icon: "error",
                                    })
                                    $
                                }

                                if (response == 'nama_dokumen_kosong') {
                                    swal({
                                        title: "Gagal!",
                                        text: "Terdapat Nama Dokumen yang kosong.",
                                        icon: "error",
                                    })
                                    $.each($('.nama-dokumen'), function(index, value) {
                                        if ($(value).val() == '') {
                                            $(value).addClass('is-invalid');
                                            $('#nama_dokumen-error-' + $(value).data(
                                                'iter')).text(
                                                'Nama Dokumen tidak boleh kosong.'
                                            )
                                        }
                                    });
                                }

                                if (response == 'nama_dokumen_kosong_dan_file_dokumen_kosong') {
                                    swal({
                                        title: "Gagal!",
                                        text: "Terdapat Nama Dokumen dan File Dokumen yang kosong.",
                                        icon: "error",
                                    })
                                    $.each($('.nama-dokumen'), function(index, value) {
                                        if ($(value).val() == '') {
                                            $(value).addClass('is-invalid');
                                            $('#nama_dokumen-error-' + $(value).data(
                                                'iter')).text(
                                                'Nama Dokumen tidak boleh kosong.'
                                            )
                                        }
                                    });
                                    $.each($('.file-dokumen'), function(index, value) {
                                        if ($(value).val() == '') {
                                            $(value).addClass('is-invalid');
                                            $('#file_dokumen-error-' + $(value).data(
                                                'iter')).text(
                                                'File Dokumen tidak boleh kosong.'
                                            )
                                        }
                                    });
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

                                console.log(response);
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

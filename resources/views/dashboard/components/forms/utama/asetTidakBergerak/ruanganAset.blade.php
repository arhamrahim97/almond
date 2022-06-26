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
            <div class="col-md-12 col-lg-6 col-xl-6 px-2">
                <div class="form-group">
                    <label for="" class="mb-2">List Dokumen</label>
                    <ul class="list-group list-group-bordered list">
                        @forelse ($aset->fileUploadDokumen as $item)
                            <li class="list-group-item justify-content-between align-items-center">
                                <div class="float-left">
                                    <span class="name">{{ $item->deskripsi }}
                                    </span>
                                    <span class="d-block">
                                        {{ $item->ruangan ? '(' . $item->ruangan->nama_ruangan . ')' : '' }}
                                    </span>
                                </div>
                                <div class="float-right ml-0">
                                    <a href="{{ Storage::url('upload/dokumen_aset_tidak_bergerak/' . $item->nama_file) }}"
                                        target="_blank" class="badge badge-primary">Lihat</a>
                                </div>

                            </li>
                        @empty
                            <li class="list-group-item justify-content-between align-items-center">
                                <div class="float-left">
                                    <span class="name">
                                        Belum ada dokumen
                                    </span>
                                </div>
                            </li>
                        @endforelse

                    </ul>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-6 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.select',
                        [
                            'label' => 'Ruangan',
                            'id' => 'ruangan',
                            'name' => 'ruangan_id',
                            'class' => 'select2 req',
                            'wajib' => '<sup class="text-danger">*</sup>',
                        ])
                        @slot('options')
                            @foreach ($ruangan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_ruangan }}</option>
                            @endforeach
                        @endslot
                    @endcomponent
                    <small
                        class="text-danger d-block">{{ $aset->ruangan ? 'Memindahkan aset ke ruangan lain akan mengubah ' : 'Menentukan ruangan pada aset yang dipilih akan mengubah' }}
                        status aset menjadi "<span class="fw-bold">Digunakan</span>".</small>
                </div>
                <div class="form-group">
                    <label for="" class="mb-2">Dokumen <span class="text-muted"
                            style="font-style: italic">(Optional)</span></label>
                    {{-- <label for="">(Surat-surat Kendaraan, Berita Acara, dan Lainnya)</label> --}}
                    <div class="row" id="dokumen-aset">
                        {{-- <div class="col-md-6 col-lg-12 col-xl-12 col-document" id="col-dokumen-1">
                            <div class="card box-upload mb-3 ruangan" id="box-upload-1" class="box-upload">
                                <div class="card-body py-3">
                                    <div class="row">
                                        <div class="col-3 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('assets/img/pdf.png') }}" alt=""
                                                width="70px">
                                        </div>
                                        <div class="col-9">
                                            <div class="mb-3 mt-2">
                                                <input type="hidden" name="nama_dokumen_1" value=""
                                                    class="nama_dokumen" data-label="Nama Dokumen" data-iter="1"
                                                    id="nama_dokumen-hidden-1">

                                                <input type="text" class="form-control nama-dokumen"
                                                    id="nama-dokumen-1" name="nama_dokumen[]"
                                                    placeholder="Masukkan Nama Dokumen"
                                                    value="Berita Acara Penanggung Jawab Aset" data-iter="1"
                                                    onkeyup="rmValNamaDokumen(1)" readonly>

                                                <p class="text-danger error-text nama_dokumen_1-error my-0"
                                                    id="nama_dokumen-error-1"></p>

                                                <p class="text-danger error-text nama_dokumen-error my-0"
                                                    id="nama_dokumen-error-1"></p>
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="file_dokumen_1" value=""
                                                    class="req file_dokumen" data-label="File Dokumen" data-iter="1"
                                                    id="file_dokumen-hidden-1">

                                                <input name="file_dokumen[]" class="form-control file-dokumen"
                                                    id="file-dokumen-1" type="file" multiple="true" data-iter="1"
                                                    accept="application/pdf" onchange="rmValFileDokumen(1)">

                                                <p class="text-danger error-text file_dokumen_1-error my-0"
                                                    id="file_dokumen-error-1"></p>

                                                <p class="text-danger error-text file_dokumen-error my-0"
                                                    id="file_dokumen-error-1"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <p class="text-danger error-text dokumen-error my-0" id="dokumen-error-1"></p>
                        </div> --}}
                        <div class="col-md-2 col-lg-3 col-xl-12 align-self-center col-add-dokumen">
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
                @component('dashboard.components.buttons.submit', ['label' => $aset->ruangan ? 'Perbarui' : 'Simpan'])
                @endcomponent
            </div>
        </div>
    </div>
</form>

@push('script')
    <script>
        $(document).on('change', '.file-dokumen-old', function() {
            let size = $(this)[0].files[0].size / 1024
            let id = $(this).data('id')
            let iter = $(this).data('iter');
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

        function deleteDocumentOld(iter) {
            let val = $('#delete-document-old-' + iter).val();
            itemDocumentOld.push(val);
            $('#col-document-old-' + iter).fadeOut(function() {
                $('#col-document-old-' + iter).remove();
            });
        }

        function deleteDokumen(iter) {
            $('#col-dokumen-' + iter).fadeOut(function() {
                $('#col-dokumen-' + iter).remove();
            });
        }

        function rmValNamaDokumen(iter) {
            if ($('#nama-dokumen-' + iter).val() != '') {
                $('#nama_dokumen-hidden-' + iter).removeClass('req');
            } else {
                $('#nama_dokumen-hidden-' + iter).addClass('req');
            }
        }

        function rmValFileDokumen(iter) {
            if ($('#file-dokumen-' + iter).val() != '') {
                $('#file_dokumen-hidden-' + iter).removeClass('req');
            } else {
                $('#file_dokumen-hidden-' + iter).addClass('req');
            }
        }


        let iterDokumen = 0;

        function addDokumen() {
            if ((iterDokumen == 0)) {
                let count = {{ isset($maxDocument) ? $maxDocument : 0 }};
                iterDokumen = count + 2;
            }
            $('.col-add-dokumen').remove();
            $('#dokumen-aset').append(`
            <div class="col-md-6 col-lg-12 col-xl-12 col-document" id="col-dokumen-` + iterDokumen + `">
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
            <div class="col-md-2 col-lg-2 col-xl-12 align-self-center col-add-dokumen">
                <div class="text-center text-muted" onclick="addDokumen()" style="cursor: pointer">
                    <h1><i class="fas fa-plus-circle"></i></h1>
                    <h6>Tambah Dokumen</h6>
                </div>

            </div>
                
            `);
            iterDokumen++;
        }

        $('.nama-dokumen-old').keyup(function() {
            let iter = $(this).data('iter');
            $(`#nama_dokumen-hidden-${iter}`).val($(this).val())
        })

        $('#form').submit(function(e) {
            e.preventDefault();
            $('.error-text').html('')
            $('.nama-dokumen').removeClass('is-invalid')
            $('.file-dokumen').removeClass('is-invalid')
            var formData = $('#form .req').serializeArray()
            var data = new FormData(this)

            if ('{{ $aset->ruangan }}') {
                data.append('deleteDocumentOld', itemDocumentOld)
            }
            validation(formData)
            /// Remove TIPE HIDDEN INPUT after Validation
            if ('{{ !$aset->ruangan }}') {
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

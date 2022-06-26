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
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.select',
                        [
                            'label' => 'Kategori',
                            'id' => 'kategori',
                            'name' => 'kategori',
                            'class' => 'select2 req',
                            'wajib' => '<sup class="text-danger">*</sup>',
                        ])
                        @slot('options')
                            @if ($jenis_aset == 'aset_tidak_bergerak')
                                <option value="Tanah (KIB A)"
                                    {{ isset($aset) && $aset->kategori == 'Tanah (KIB A)' ? 'selected' : '' }}>
                                    Tanah (KIB A)</option>
                            @endif
                            @if (in_array($jenis_aset, ['aset_bergerak', 'aset_tidak_bergerak']))
                                <option value="Peralatan dan Mesin (KIB B)"
                                    {{ (isset($aset) && $aset->kategori == 'Peralatan dan Mesin (KIB B)') || $jenis_aset == 'aset_bergerak' ? 'selected' : '' }}>
                                    Peralatan dan Mesin (KIB B)</option>
                            @endif
                            @if ($jenis_aset == 'aset_tidak_bergerak')
                                <option value="Gedung dan Bangunan (KIB C)"
                                    {{ isset($aset) && $aset->kategori == 'Gedung dan Bangunan (KIB C)' ? 'selected' : '' }}>
                                    Gedung dan Bangunan (KIB C)</option>
                                <option value="Jalan, Indera dan Jaringan (KIB D)"
                                    {{ isset($aset) && $aset->kategori == 'Jalan, Indera dan Jaringan (KIB D)' ? 'selected' : '' }}>
                                    Jalan, Irigasi dan Jaringan (KIB D)</option>
                                <option value="Aset Tetap Lainnya (KIB E)"
                                    {{ isset($aset) && $aset->kategori == 'Aset Tetap Lainnya (KIB E)' ? 'selected' : '' }}>
                                    Aset Tetap Lainnya (KIB E)</option>
                                <option value="Konstruksi Dalam Pengerjaan (KIB F)"
                                    {{ isset($aset) && $aset->kategori == 'Konstruksi Dalam Pengerjaan (KIB F)' ? 'selected' : '' }}>
                                    Konstruksi Dalam Pengerjaan (KIB F)</option>
                            @endif
                        @endslot
                    @endcomponent

                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Kode Barang', 'name' => 'kode_barang', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Kode Barang', 'value' => isset($aset) ? $aset->kode_barang : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Register', 'name' => 'register', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Nomor Register', 'value' => isset($aset) && $method == 'PUT' ? $aset->register : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Nama/Jenis Barang', 'name' => 'nama_barang', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Nama Aset', 'value' => isset($aset) ? $aset->nama_barang : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Merek/Tipe', 'name' => 'merek_tipe', 'class' => 'req garis datar', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Merek/Tipe', 'value' => isset($aset) ? $aset->merek_tipe : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Nomor Sertifikat/Pabrik/Chasis/Mesin', 'name' => 'nomor_sertifikat_pabrik_chasis_mesin', 'class' => 'req garis datar', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Nomor Sertifikat/Pabrik/Chasis/Mesin', 'value' => isset($aset) && $method == 'PUT' ? $aset->nomor_sertifikat_pabrik_chasis_mesin : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Bahan', 'name' => 'bahan', 'class' => 'req garis datar', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Bahan', 'value' => isset($aset) ? $aset->bahan : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Asal/Cara Perolehan Barang', 'name' => 'asal_barang', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Asal/Cara Perolehan Barang', 'value' => isset($aset) ? $aset->asal_barang : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Tahun Pembelian', 'name' => 'tahun_pembelian', 'class' => 'angka req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Tahun Pembelian', 'value' => isset($aset) ? $aset->tahun_pembelian : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Ukuran Barang/Kontruksi (P, S, D)', 'name' => 'ukuran_barang_kontruksi', 'class' => 'req garis datar', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Ukuran Barang/Kontruksi (P, S, D)', 'value' => isset($aset) ? $aset->ukuran_barang_kontruksi : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Satuan', 'name' => 'satuan', 'class' => 'req garis datar', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Satuan', 'value' => isset($aset) ? $aset->satuan : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.select',
                        [
                            'label' => 'Keadaan Barang',
                            'id' => 'keadaan-barang',
                            'name' => 'keadaan_barang',
                            'class' => 'select2 req',
                            'wajib' => '<sup class="text-danger">*</sup>',
                        ])
                        @slot('options')
                            <option value="Baik"
                                {{ isset($aset) && $method == 'PUT' && $aset->keadaan_barang == 'Baik' ? 'selected' : '' }}>
                                Baik</option>
                            <option value="Kurang Baik"
                                {{ isset($aset) && $method == 'PUT' && $aset->keadaan_barang == 'Kurang Baik' ? 'selected' : '' }}>
                                Kurang Baik</option>
                            <option value="Rusak Berat"
                                {{ isset($aset) && $method == 'PUT' && $aset->keadaan_barang == 'Rusak Berat' ? 'selected' : '' }}>
                                Rusak Berat</option>
                        @endslot
                    @endcomponent

                    {{-- @component('dashboard.components.formElements.input', ['label' => 'Keadaan Barang (Baik / Kurang Baik/ Rusak Berat)', 'name' => 'keadaan_barang', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Keadaan Barang (Baik / Kurang Baik/ Rusak Berat)', 'value' => isset($aset) ? $aset->keadaan_barang : ''])
                    @endcomponent --}}
                </div>
            </div>
            {{-- <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Jumlah Barang', 'name' => 'jumlah_barang', 'class' => 'req angka', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Jumlah Barang', 'value' => isset($aset) ? $aset->jumlah_barang : ''])
                    @endcomponent
                </div>
            </div> --}}
            <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Harga Barang', 'name' => 'harga_barang', 'class' => 'rupiah req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Harga Barang', 'value' => isset($aset) ? $aset->harga_barang : ''])
                    @endcomponent
                </div>
            </div>
            @if ($jenis_aset == 'aset_bergerak')
                <div class="col-md-6 col-lg-6 col-xl-4 px-2">
                    <div class="form-group">
                        @component('dashboard.components.formElements.input', ['label' => 'Nomor Polisi', 'name' => 'nomor_polisi', 'class' => 'req', 'wajib' => '<sup class="text-danger">*</sup>', 'placeholder' => 'Masukkan Nomor Polisi', 'value' => isset($aset) && $method == 'PUT' ? $aset->nomor_polisi : ''])
                        @endcomponent
                    </div>
                </div>
            @endif
            <div class="col-md-12 col-lg-12 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.textArea', ['label' => 'Keterangan', 'name' => 'keterangan', 'placeholder' => 'Masukkan Keterangan', 'value' => isset($aset) ? $aset->keterangan : ''])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-12 col-lg-12 px-2">
                <div class="form-group">
                    <label for="">Foto Aset</label>
                    <div class="row" id="gambar-aset">
                        @if (isset($aset) && $aset->fileUploadGambar && $method == 'PUT')
                            @foreach ($aset->fileUploadGambar as $item)
                                <div class="col-md-4 col-lg-4 col-xl-3 text-center"
                                    id="col-image-old-{{ $loop->iteration }}">
                                    <div class="card mb-1">
                                        <div class="p-2 text-center">
                                            <img class="card-img-top rounded text-center preview-image"
                                                src="{{ Storage::exists('upload/foto_' . $jenis_aset . '/' . $item->nama_file) ? Storage::url('upload/foto_' . $jenis_aset . '/' . $item->nama_file) : asset('assets/img/blank_photo.png') }}"
                                                alt="image" data-iter="{{ $loop->iteration }}"
                                                id="preview-image-{{ $loop->iteration }}" style="height: 180px">
                                        </div>
                                        <label class="selectgroup-item mb-0">
                                            <input type="radio" value="{{ $item->id }}" name="foto_sampul"
                                                class="selectgroup-input foto_sampul"
                                                id="foto-sampul-{{ $loop->iteration }}"
                                                {{ $item->is_sampul == 1 ? 'checked=checked' : '' }}
                                                data-iter={{ $loop->iteration }}>
                                            {{-- <span class="selectgroup-button selectgroup-button-icon py-2"><i
                                                        class="fas fa-images"></i><span class="foto-sampul-text"
                                                        id="foto-sampul-text-{{ $loop->iteration }}">
                                                        {{ $item->is_sampul == 1 ? ' Foto Sampul' : ' Jadikan Foto Sampul' }}</span> --}}
                                            </span>
                                        </label>
                                        <button type="button"
                                            class="btn btn-danger fw-bold card-footer bg-danger text-center delete-image p-0"
                                            onclick="deleteImageOld({{ $loop->iteration }})"
                                            id="delete-image-old-{{ $loop->iteration }}"
                                            value="{{ $item->id }}"><i class="fas fa-trash-alt"></i>
                                            Hapus</button>
                                    </div>
                                    <span class="text-danger error-text file_gambar-error my-0"></span>

                                </div>
                            @endforeach
                        @endif
                        <div class="col-md-2 col-lg-3 col-xl-2 align-self-center col-add-image">
                            <div class="text-center text-muted" onclick="addImage()" style="cursor: pointer">
                                <h1><i class="fas fa-plus-circle"></i></h1>
                                <h6>Tambah Foto</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 px-2 mt-3">
                <div class="form-group">
                    <label for="" class="mb-2">Dokumen <sup class="text-danger">*</sup></label>
                    {{-- <label for="">(Surat-surat Kendaraan, Berita Acara, dan Lainnya)</label> --}}
                    <div class="row" id="dokumen-aset">
                        @if (isset($aset) && $aset->fileUploadDokumen && $method == 'PUT')
                            @foreach ($aset->fileUploadDokumen as $item)
                                <div class="col-md-6 col-lg-6 col-xl-6 col-document"
                                    id="col-document-old-{{ $loop->iteration }}">
                                    <div class="card box-upload mb-3 pegawai" id="box-upload-{{ $loop->iteration }}"
                                        class="box-upload">
                                        <div class="card-body py-3">
                                            <div class="row">
                                                <div class="col-3 d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('assets/img/pdf.png') }}" alt=""
                                                        width="70px">
                                                </div>
                                                <div class="col-9">
                                                    @if ($item->pegawai)
                                                        <span class="text-secondary"
                                                            style="font-style: italic">Dokumen
                                                            Pegawai: {{ $item->pegawai->nama_lengkap }}</span>
                                                    @elseif($item->ruangan)
                                                        <span class="text-secondary"
                                                            style="font-style: italic">Dokumen
                                                            Ruangan: {{ $item->ruangan->nama_ruangan }}</span>
                                                    @else
                                                        <span class="text-danger" style="font-style: italic">Dokumen
                                                            Aset</span>
                                                    @endif
                                                    <div class="mb-3 mt-2">
                                                        {{-- start validation --}}
                                                        <input type="hidden"
                                                            name="nama_dokumen_{{ $loop->iteration }}"
                                                            value="{{ $item->deskripsi }}"
                                                            class="nama_dokumen {{ $loop->iteration > 2 ? 'req' : '' }}"
                                                            data-label="Nama Dokumen"
                                                            data-iter="{{ $loop->iteration }}"
                                                            id="nama_dokumen-hidden-{{ $loop->iteration }}">
                                                        {{-- end validation --}}
                                                        <input type="text" class="form-control nama-dokumen-old"
                                                            id="nama-dokumen-{{ $loop->iteration }}"
                                                            name="nama_dokumen_old[]"
                                                            placeholder="Masukkan Nama Dokumen"
                                                            value="{{ $item->deskripsi }}"
                                                            data-iter="{{ $loop->iteration }}"
                                                            {{ $jenis_aset == 'aset_bergerak' && $loop->iteration <= 2 ? 'readonly' : '' }}>
                                                        {{-- start validation --}}
                                                        <p class="text-danger error-text nama_dokumen_{{ $loop->iteration }}-error my-0"
                                                            id="nama_dokumen-error-{{ $loop->iteration }}"></p>
                                                        {{-- end validation --}}
                                                        <p class="text-danger error-text nama_dokumen-error my-0"
                                                            id="nama_dokumen-error-{{ $loop->iteration }}"></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        <a type="button"
                                                            href="{{ Storage::exists('upload/dokumen_' . $jenis_aset . '/' . $item->nama_file) ? Storage::url('upload/dokumen_' . $jenis_aset . '/' . $item->nama_file) : 'tidak-ditemukan' }}"
                                                            target="_blank" class="btn btn-primary shadow-sm w-100"><i
                                                                class="fas fa-eye"></i> Lihat
                                                            Dokumen</a>
                                                    </div>
                                                    <input name="file_dokumen_old[]"
                                                        class="form-control file-dokumen-old"
                                                        id="file-dokumen-{{ $loop->iteration }}" type="file"
                                                        multiple="true" data-iter="{{ $loop->iteration }}"
                                                        data-id="{{ $item->id }}" accept="application/pdf">
                                                    <small class="text-muted" style="font-style: italic">Kosongkan
                                                        jika tidak ingin
                                                        mengubah
                                                        dokumen</small>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($jenis_aset == 'aset_bergerak' && $loop->iteration > 2)
                                            <button type="button"
                                                class="btn btn-danger fw-bold card-footer bg-danger text-center delete-document p-0"
                                                onclick="deleteDocumentOld({{ $loop->iteration }})"
                                                id="delete-document-old-{{ $loop->iteration }}"
                                                value="{{ $item->id }}"><i class="fas fa-trash-alt"></i>
                                                Hapus</button>
                                        @elseif ($jenis_aset == 'aset_tidak_bergerak' && $loop->iteration > 0)
                                            <button type="button"
                                                class="btn btn-danger fw-bold card-footer bg-danger text-center delete-document p-0"
                                                onclick="deleteDocumentOld({{ $loop->iteration }})"
                                                id="delete-document-old-{{ $loop->iteration }}"
                                                value="{{ $item->id }}"><i class="fas fa-trash-alt"></i>
                                                Hapus</button>
                                        @endif
                                    </div>
                                    <p class="text-danger error-text dokumen-error my-0" id="dokumen-error-1"></p>
                                </div>
                            @endforeach
                        @else
                            @if ($jenis_aset == 'aset_bergerak')
                                <div class="col-md-6 col-lg-6 col-xl-6 col-document" id="col-dokumen-1">
                                    <div class="card box-upload mb-3 pegawai" id="box-upload-1" class="box-upload">
                                        <div class="card-body pb-3">
                                            <div class="row">
                                                <div class="col-3 d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('assets/img/pdf.png') }}" alt=""
                                                        width="70px">
                                                </div>
                                                <div class="col-9">
                                                    <div class="mb-3 mt-2">
                                                        {{-- start validation --}}
                                                        <input type="hidden" name="nama_dokumen_1" value=""
                                                            class="nama_dokumen" data-label="Nama Dokumen"
                                                            data-iter="1" id="nama_dokumen-hidden-1">
                                                        {{-- end validation --}}

                                                        <input type="text" class="form-control nama-dokumen"
                                                            id="nama-dokumen-1" name="nama_dokumen[]"
                                                            placeholder="Masukkan Nama Dokumen" value="BPKB"
                                                            data-iter="1" onkeyup="rmValNamaDokumen(1)" readonly>

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
                                                            class="req file_dokumen" data-label="File Dokumen"
                                                            data-iter="1" id="file_dokumen-hidden-1">
                                                        {{-- end validation --}}

                                                        <input name="file_dokumen[]" class="form-control file-dokumen"
                                                            id="file-dokumen-1" type="file" multiple="true"
                                                            data-iter="1" accept="application/pdf"
                                                            onchange="rmValFileDokumen(1)">

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
                                <div class="col-md-6 col-lg-6 col-xl-6 col-document" id="col-dokumen-2">
                                    <div class="card box-upload mb-3 pegawai" id="box-upload-2" class="box-upload">
                                        <div class="card-body pb-2">
                                            <div class="row">
                                                <div class="col-3 d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('assets/img/pdf.png') }}" alt=""
                                                        width="70px">
                                                </div>
                                                <div class="col-9">
                                                    <div class="mb-3 mt-2">
                                                        {{-- start validation --}}
                                                        <input type="hidden" name="nama_dokumen_2" value=""
                                                            class="nama_dokumen" data-label="Nama Dokumen"
                                                            data-iter="2" id="nama_dokumen-hidden-2">
                                                        {{-- end validation --}}

                                                        <input type="text" class="form-control nama-dokumen"
                                                            id="nama-dokumen-2" name="nama_dokumen[]"
                                                            placeholder="Masukkan Nama Dokumen" value="STNK"
                                                            data-iter="2" onkeyup="rmValNamaDokumen(2)" readonly>

                                                        {{-- start validation --}}
                                                        <p class="text-danger error-text nama_dokumen_2-error my-0"
                                                            id="nama_dokumen-error-2"></p>
                                                        {{-- end validation --}}

                                                        <p class="text-danger error-text nama_dokumen-error my-0"
                                                            id="nama_dokumen-error-2"></p>
                                                    </div>
                                                    <div class="mb-3">
                                                        {{-- start validation --}}
                                                        <input type="hidden" name="file_dokumen_2" value=""
                                                            class="req file_dokumen" data-label="File Dokumen"
                                                            data-iter="2" id="file_dokumen-hidden-2">
                                                        {{-- end validation --}}

                                                        <input name="file_dokumen[]" class="form-control file-dokumen"
                                                            id="file-dokumen-2" type="file" multiple="true"
                                                            data-iter="2" accept="application/pdf"
                                                            onchange="rmValFileDokumen(2)">

                                                        {{-- start validation --}}
                                                        <p class="text-danger error-text file_dokumen_2-error my-0"
                                                            id="file_dokumen-error-2"></p>
                                                        {{-- end validation --}}

                                                        <p class="text-danger error-text file_dokumen-error my-0"
                                                            id="file_dokumen-error-2"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <p class="text-danger error-text dokumen-error my-0" id="dokumen-error-2"></p>
                                </div>
                            @endif
                        @endif
                        <div class="col-md-2 col-lg-3 col-xl-2 align-self-center col-add-dokumen">
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
                @component('dashboard.components.buttons.submit', ['label' => $labelSubmit ?? 'Simpan'])
                @endcomponent
            </div>
        </div>
    </div>
</form>

@push('script')
    <script>
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
            } else {
                $('#file_gambar-hidden-' + $(this).data('iter')).remove();
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

        let itemImage = 1;

        function addImage() {
            if (('{{ $method }}' == 'PUT') && (itemImage == 1)) {
                let count = {{ $maxImage ?? '' }} + 1;
                itemImage = count + 1;
            }
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
                        <span class="text-danger error-text file_gambar-error my-0"></span>
                        <p class="text-danger error-text  file_gambar_` + itemImage +
                `-error my-0" id="file_gambar-error-` + itemImage + `">
                                </p>
                    </div>
                    <div class="col-md-2 col-lg-3 col-xl-2 align-self-center col-add-image">
                        <div class="text-center text-muted" onclick="addImage()" style="cursor: pointer">
                            <h1><i class="fas fa-plus-circle"></i></h1>
                            <h6>Tambah Foto</h6>
                        </div>
                    </div>                  
                    `);
            itemImage++;
            // }
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

        let iterDokumen = {{ $jenis_aset == 'aset_bergerak' ? 3 : 1 }};

        function addDokumen() {
            let count = 0;
            if ((('{{ isset($asset) }}') || ('{{ $method }}' == 'PUT')) && (iterDokumen ==
                    {{ $jenis_aset == 'aset_bergerak' ? 3 : 1 }})) {
                if ('{{ isset($maxDocument) }}') {
                    count = {{ $maxDocument ?? 0 }}
                } else {
                    if (`{{ $jenis_aset == 'aset_bergerak' }}`) {
                        count = 3
                    } else {
                        count = 1
                    }

                }
                iterDokumen = count + 1;
            }
            $('.col-add-dokumen').remove();
            $('#dokumen-aset').append(`
            <div class="col-md-6 col-lg-6 col-xl-6 col-document" id="col-dokumen-` + iterDokumen + `">
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
            <div class="col-md-2 col-lg-3 col-xl-2 align-self-center col-add-dokumen">
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
            $('.rupiah').unmask();
            $('.error-text').html('')
            $('.nama-dokumen').removeClass('is-invalid')
            $('.file-dokumen').removeClass('is-invalid')
            var formData = $('#form .req').serializeArray()
            var data = new FormData(this)
            // console.log(data)
            if ('{{ $method }}' == 'PUT') {
                data.append('deleteImageOld', itemImageOld)
                data.append('deleteDocumentOld', itemDocumentOld)
            }

            if ('{{ isset($aset) }}') {
                data.append('id', '{{ isset($aset) ?? $aset->id }}')
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
                            console.log(response)
                            $('.rupiah').mask('000.000.000.000.000', {
                                reverse: true
                            })
                            if ($.isEmptyObject(response.error)) {
                                if (response.status == 'tidak_ada_gambar') {
                                    $.each(response.data, function(key, value) {
                                        $('.' + value + '-error').text(response.mes)
                                    })
                                    swal({
                                        title: "Gagal!",
                                        text: "Terdapat foto yang kosong. Silahkan masukkan foto terlebih dahulu atau hapus jika tidak ingin menambahkan foto",
                                        icon: "error",
                                    })
                                }

                                if (response == 'nama_dokumen_kosong_old') {
                                    swal({
                                        title: "Gagal!",
                                        text: "Terdapat Nama Dokumen yang kosong.",
                                        icon: "error",
                                    })
                                    $.each($('.nama-dokumen-old'), function(index, value) {
                                        if ($(value).val() == '') {
                                            $(value).addClass('is-invalid');
                                            $('#nama_dokumen-error-' + $(value)
                                                .data(
                                                    'iter')).text(
                                                'Nama Dokumen tidak boleh kosong.'
                                            )
                                        }
                                    });
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
                                            $('#nama_dokumen-error-' + $(value)
                                                .data(
                                                    'iter')).text(
                                                'Nama Dokumen tidak boleh kosong.'
                                            )
                                        }
                                    });
                                }

                                if (response ==
                                    'nama_dokumen_kosong_dan_file_dokumen_kosong') {
                                    swal({
                                        title: "Gagal!",
                                        text: "Terdapat Nama Dokumen dan File Dokumen yang kosong.",
                                        icon: "error",
                                    })
                                    $.each($('.nama-dokumen'), function(index, value) {
                                        if ($(value).val() == '') {
                                            $(value).addClass('is-invalid');
                                            $('#nama_dokumen-error-' + $(value)
                                                .data(
                                                    'iter')).text(
                                                'Nama Dokumen tidak boleh kosong.'
                                            )
                                        }
                                    });
                                    $.each($('.file-dokumen'), function(index, value) {
                                        if ($(value).val() == '') {
                                            $(value).addClass('is-invalid');
                                            $('#file_dokumen-error-' + $(value)
                                                .data(
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
                                        location.href =
                                            "{{ url()->previous() }}";
                                    });
                                }
                            } else {
                                swal({
                                    title: "Gagal!",
                                    text: "Terjadi kesalahan, mohon periksa kembali data yang diinputkan.",
                                    icon: "error",
                                    button: "Ok",
                                })
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

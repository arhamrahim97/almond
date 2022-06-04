<form action="#" id="{{ $form ?? 'form' }}" method="POST" enctype="multipart/form-data" autocomplete="off">
    @csrf
    @if (isset($method) && $method == 'PUT')
        @method('PUT')
    @endif
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 col-lg-6 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Nama Aset', 'name' => 'nama_aset'])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Merek (Brand)', 'name' => 'merek'])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Model', 'name' => 'model'])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-6 col-lg-6 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.input', ['label' => 'Kode Inventaris', 'name' => 'kode_inventaris'])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-12 col-lg-12 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.textArea', ['label' => 'Deskripsi', 'name' => 'deskripsi'])
                    @endcomponent
                </div>
            </div>
            <div class="col-md-12 col-lg-12 px-2">
                <div class="form-group">
                    <label for="">Foto Aset</label>
                    <div class="row" id="gambar-aset">
                        <div class="col-md-4 col-lg-4 col-xl-3" id="col-image-1">
                            <div class="card">
                                <div class="p-2 text-center">
                                    <img class="card-img-top rounded text-center"
                                        src="{{ asset('assets/img/add-image.png') }}" alt="image" data-iter="1"
                                        id="preview-image-1" style="height: 180px">
                                </div>
                                <input type="file" class="form-control form-control-file file-gambar" id="file-gambar-1"
                                    data-iter="1" name="file_gambar[]" accept="image/*">
                                <span class="text-danger error-text file-gambar-error my-0"></span>
                                @if ($method == 'PUT')
                                    <button type="button"
                                        class="btn btn-danger fw-bold card-footer bg-danger text-center p-0"
                                        onclick="deleteImage(1)"><i class="fas fa-trash-alt"></i>
                                        Hapus</button>
                                @endif
                            </div>
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
            <div class="col-md-12 col-lg-12 px-2">
                <div class="form-group">
                    <label for="">Dokumen (Surat-surat Kendaraan, Berita Acara, dan Lainnya)</label>
                    <div class="row" id="dokumen-aset">
                        <div class="col-md-6 col-lg-6 col-xl-3" id="col-dokumen-1">
                            <div class="card box-upload mb-3pegawai" id="box-upload-1" class="box-upload">
                                <div class="card-body pb-2">
                                    <div class="row">
                                        <div class="col-3 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('assets/img/pdf.png') }}" alt="" width="70px">
                                        </div>
                                        <div class="col-9">
                                            <div class="mb-3 mt-2">
                                                <input type="text" class="form-control nama-dokumen" id="nama-dokumen-1"
                                                    name="nama_dokumen[]" placeholder="Masukkan Nama File" value=""
                                                    data-iter="1">
                                                <p class="text-danger error-text nama-dokumen-error my-0"></p>
                                            </div>
                                            <div class="mb-3">
                                                <input name="file_dokumen[]" class="form-control file-dokumen"
                                                    id="file-dokumen-1" type="file" multiple="true" data-iter="1"
                                                    accept="application/pdf">
                                                <p class="text-danger error-text file-dokumen-error my-0"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($method == 'PUT')
                                    <button type="button"
                                        class="btn btn-danger fw-bold card-footer bg-danger text-center p-0"
                                        onclick="deleteDokumen(1)"><i class="fas fa-trash-alt"></i>
                                        Hapus</button>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-2 col-lg-2 col-xl-1 align-self-center col-add-dokumen">
                            <div class="text-center text-muted" onclick="addDokumen()" style="cursor: pointer">
                                <h1><i class="fas fa-plus-circle"></i></h1>
                                <h6>Tambah Dokumen</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 px-2">
                <div class="form-group">
                    @component('dashboard.components.formElements.select',
                        [
                            'label' => 'Pegawai',
                            'id' => 'pegawai',
                            'name' => 'pegawai',
                            'class' => 'select2',
                            'wajib' => '<sup class="text-danger">*</sup>',
                        ])
                        @slot('options')
                            {{-- @foreach ($indikator as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach --}}
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
    <div class="card-action">
        <div class="row justify-content-end">
            <div class="col-md-12 text-right">
                @component('dashboard.components.buttons.submit', ['label' => 'Simpan'])
                @endcomponent
            </div>
        </div>
    </div>
</form>

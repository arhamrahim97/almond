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
                        <div class="col-md-4 col-lg-4 col-xl-3">
                            <div class="card mb-0">
                                <div class="p-2 text-center">
                                    <img class="card-img-top rounded text-center"
                                        src="{{ asset('assets/img/add-image.png') }}" alt="image" data-iter="1"
                                        id="preview-image1" style="height: 200px">
                                </div>
                                <input type="file" class="form-control form-control-file file-gambar" id="uploadImg1"
                                    data-iter="1" name="gambar[]" accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3 col-xl-2 align-self-center col-add-image">
                            <button class="add-image btn btn-warning btn-sm" onclick="addImage()"><i
                                    class="fas fa-plus-circle"></i> Tambah Gambar</button>
                        </div>
                    </div>
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

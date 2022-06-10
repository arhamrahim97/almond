@extends('dashboard.layouts.main')

@section('title')
    Manajemen Aset Bergerak
@endsection

@push('style')
@endpush

@section('breadcrumb')
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{ url('dashboard') }}">
                <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <span>Aset Bergerak</span>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="{{ url('aset-bergerak') }}">Manajemen Aset</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <span>Tambah</span>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Tambah Aset Bergerak</div>
                        <div class="card-tools">
                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                                <li class="nav-item submenu">
                                    @component('dashboard.components.buttons.back',
                                        [
                                            'url' => url()->previous(),
                                        ])
                                    @endcomponent
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @component('dashboard.components.forms.utama.asetBergerak.manajemenAset')
                    @slot('action', route('manajemen-aset-bergerak.store'))
                    @slot('method', 'POST')
                @endcomponent

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.nav-item').removeClass('active');
            $('#nav-aset-bergerak').addClass('active submenu');
            $('#aset-bergerak').addClass('show')
            $('#li-manajemen-aset-bergerak').addClass('active');
        })
    </script>
    {{-- <script>
        let itemImage = 2;
        let iterDokumen = 2;
        $(document).on('change', '.file-gambar', function() {
            // console.log(this.files)
            console.log($(this).data('iter'))
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
            $('.col-add-image').remove();
            $('#gambar-aset').append(`
                <div class="col-md-4 col-lg-4 col-xl-3" id="col-image-` + itemImage + `">
                    <div class="card">
                        <div class="p-2 text-center">
                            <img class="card-img-top rounded text-center"
                                src="{{ asset('assets/img/add-image.png') }}" alt="image" data-iter="` + itemImage +
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

        function deleteImage(iter) {
            $('#col-image-' + iter).fadeOut(function() {
                $('#col-image-' + iter).remove();
            });
        }

        function addDokumen() {
            $('.col-add-dokumen').remove();
            $('#dokumen-aset').append(`
            <div class="col-md-6 col-lg-6 col-xl-3" id="col-dokumen-` + iterDokumen + `">
                <div class="card box-upload mb-3" id="box-upload-` +
                iterDokumen + `" class="box-upload">
                    <div class="card-body pb-2">
                        <div class="row">
                            <div class="col-3 d-flex align-items-center justify-content-center">
                                <img src="{{ asset('assets/img/pdf.png') }}" alt="" width="70px">
                            </div>
                            <div class="col-9">
                                <div class="mb-3 mt-2">
                                    <input type="text" class="form-control nama-dokumen" id="nama-dokumen-` +
                iterDokumen + `"
                                        name="nama_dokumen[]" placeholder="Masukkan Nama File" value="" data-iter="` +
                iterDokumen +
                `">
                                </div>
                                <div class="mb-3">
                                    <input name="file_dokumen[]" class="form-control file-dokumen" type="file" id="file-dokumen-` +
                iterDokumen + `"
                                        multiple="true" data-iter="` + iterDokumen + `" accept="application/pdf">
                                    <p class="text-danger error-text file-dokumen-error my-0"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button"
                        class="btn btn-danger fw-bold card-footer bg-danger text-center p-0"
                        onclick="deleteDokumen(` + iterDokumen + `)"><i class="fas fa-trash-alt"></i>
                        Hapus</button>
                </div>
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

        function deleteDokumen(iter) {
            $('#col-dokumen-' + iter).fadeOut(function() {
                $('#col-dokumen-' + iter).remove();
            });
        }



        $('#form').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            // formData.append('images', sources);
            $.ajax({
                type: "POST",
                url: "{{ url('aset-bergerak') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                },
                error: function(response) {
                    alert(response.responseJSON.message)
                },
            });
        });

        $(document).ready(function() {
            $('.nav-item').removeClass('active');
            $('#nav-aset-bergerak').addClass('active submenu');
            $('#aset-bergerak').addClass('show')
            $('#li-manajemen-aset-bergerak').addClass('active');
        })
    </script> --}}
@endpush

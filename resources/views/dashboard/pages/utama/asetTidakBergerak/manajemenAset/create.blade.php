@extends('dashboard.layouts.main')

@section('title')
    Manajemen Aset Tidak Bergerak
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
            <a href="{{ url('dashboard') }}">Aset Tidak Bergerak</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="{{ url('dashboard') }}">Manajemen Aset</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="{{ url('dashboard') }}">Tambah</a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Tambah Aset</div>
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
                @component('dashboard.components.forms.utama.asetTidakBergerak.manajemenAset')
                    @slot('action', route('aset-tidak-bergerak.store'))
                    @slot('method', 'POST')
                @endcomponent

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function test() {
            alert('test')
            $('.file-gambar').click();
        }

        let itemImage = 2;
        $(document).on('change', '.file-gambar', function() {
            // console.log(this.files)
            console.log($(this).data('iter'))
            let iter = $(this).data('iter')
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview-image' + iter).attr('src', e.target.result);
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
                                <img class="card-img-top rounded image-trigger" src="{{ asset('assets/img/add-image.png') }}" alt="image"
                                    data-iter="` + itemImage + `" id="preview-image` + itemImage + `"  style="height: 200px">
                            </div>
                            <input type="file" class="form-control form-control-file file-gambar"
                                id="uploadImg` + itemImage + `" data-iter="` + itemImage + `" name="gambar[]" accept="image/*">
                            <button class="btn btn-danger btn-sm mt-1" onclick="deleteImage(` + itemImage + `)">Hapus</button>

                        </div>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-2 align-self-center col-add-image">
                        <button class="add-image btn btn-warning btn-sm" onclick="addImage()"><i class="fas fa-plus-circle"></i> Tambah Gambar</button>
                    </div>
                `);
            itemImage++;
        }

        function deleteImage(iter) {
            $('#col-image-' + iter).remove();
        }


        $('#form').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            // formData.append('images', sources);
            $.ajax({
                type: "POST",
                url: "{{ url('aset-tidak-bergerak') }}",
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


            // $('.input-images').imageUploader();
            $('.nav-item').removeClass('active');
            $('#nav-aset-tidak-bergerak').addClass('active submenu');
            $('#aset-tidak-bergerak').addClass('show')
            $('#li-manajemen-aset-tidak-bergerak').addClass('active');
        })
    </script>
@endpush

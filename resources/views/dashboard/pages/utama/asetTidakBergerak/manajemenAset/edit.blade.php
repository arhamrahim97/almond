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
            <span>Ubah</span>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Ubah Aset Tidak Bergerak</div>
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
                @component('dashboard.components.forms.utama.manajemenAset')
                    @slot('method', 'PUT')
                    @slot('jenis_aset', 'aset_tidak_bergerak')
                    @slot('labelSubmit', 'Perbarui')
                    @slot('maxImage', $aset->fileUploadGambar->max('urutan'))
                    @slot('maxDocument', $aset->fileUploadDokumen->max('urutan'))
                    @slot('action', route('manajemen-aset-tidak-bergerak.update', $aset->id))
                    @slot('aset', $aset)
                @endcomponent

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.nav-item').removeClass('active');
            $('#nav-aset-tidak-bergerak').addClass('active submenu');
            $('#aset-tidak-bergerak').addClass('show')
            $('#li-manajemen-aset-tidak-bergerak').addClass('active');
        })
    </script>
@endpush

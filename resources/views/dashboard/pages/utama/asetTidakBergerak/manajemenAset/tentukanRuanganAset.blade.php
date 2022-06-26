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
            <span>Aset Tidak Bergerak</span>
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
            <span>{{ $aset->ruangan ? 'Pindahkan Aset' : 'Tentukan Ruangan' }}</span>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">
                            {{ $aset->ruangan ? 'Pindahkan Aset' : 'Tentukan Ruangan' }} | <span class="fw-bold">
                                {{ $aset->nama_barang }}</span>
                        </div>
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
                @if ($metode == 'satu_aset')
                    @component('dashboard.components.forms.utama.asetTidakBergerak.ruanganAset')
                        @slot('action', url('tentukan-ruangan-aset/' . $aset->id))
                        @slot('method', 'POST')
                        @slot('aset', $aset)
                        @slot('ruangan', $ruangan)
                        @slot('maxDocument', $aset->fileUploadDokumen->max('urutan'))
                    @endcomponent
                @else
                @endif
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

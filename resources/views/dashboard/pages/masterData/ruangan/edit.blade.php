@extends('dashboard.layouts.main')

@section('title')
    Ruangan
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
            <span>Ruangan</span>
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
                        <div class="card-title">Ubah Ruangan</div>
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
                @component('dashboard.components.forms.masterData.ruangan')
                    @slot('method', 'PUT')
                    @slot('labelSubmit', 'Perbarui')
                    @slot('maxImage', $ruangan->fileUpload->max('urutan'))
                    @slot('action', route('ruangan.update', $ruangan->id))
                    @slot('ruangan', $ruangan)
                @endcomponent

            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.nav-item').removeClass('active');
            $('#nav-ruangan').addClass('active');
        })
    </script>
@endpush

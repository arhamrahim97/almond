@extends('dashboard.layouts.main')

@section('title')
    Akun
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
            <span>Akun</span>
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
                        <div class="card-title">Ubah Akun</div>
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
                @component('dashboard.components.forms.masterData.akun')
                    @slot('method', 'PUT')
                    @slot('user', $akun)
                    @slot('action', route('akun.update', $akun->id))
                    @slot('labelSubmit', 'Simpan')
                @endcomponent

            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush

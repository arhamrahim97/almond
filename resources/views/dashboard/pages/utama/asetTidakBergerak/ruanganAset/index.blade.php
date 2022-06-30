@extends('dashboard.layouts.main')

@section('title')
    Ruangan Aset
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
            <span>Ruangan Aset</span>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <div class="card-head-row">
                        <div class="card-title">Ruangan Aset</div>
                        <div class="row card-tools">
                            <div class="col">
                                <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm float-right" id="pills-tab"
                                    role="tablist">
                                    <label for="" class="d-inline mt-1">Cari
                                        Ruangan :
                                    </label>
                                    <li class="nav-item submenu mr-1">
                                        <div class="form-group p-0">
                                            <select class="form-control select2" id="cari-ruangan" autocomplete="off">
                                                <option value="">Semua</option>
                                                @foreach ($ruanganAsetAll as $ruangan)
                                                    <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                    <a href="{{ url('ruangan-aset') }}" class="btn btn-sm btn-secondary d-none"
                                        id="btn-refresh"><i class="fas fa-undo mt-1"></i></a>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($ruanganAset) > 0)
                        <div class="row" id="content-card">
                            @component('dashboard.components.cards.asetTidakBergerak.ruanganAset',
                                [
                                    'ruanganAset' => $ruanganAset,
                                ])
                            @endcomponent

                        </div>
                    @else
                        <div class="row justify-content-center">
                            <div class="col">
                                <h4 class="text-center text-muted py-3">Tidak ada data</h4>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="d-flex justify-content-center d-none" id="pagination-aset">
                    {!! $ruanganAset->links() !!}
                </div>
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
            $('#li-ruangan-aset').addClass('active');
        })

        $('#cari-ruangan').change(function() {
            $('#btn-refresh').removeClass('d-none');
            var id = $(this).val();
            $.ajax({
                url: "{{ url('/ruangan-aset/cari-ruangan') }}" + "/" + id,
                type: "GET",
                success: function(data) {
                    $('#pagination-aset').remove();
                    $('#content-card').html('');
                    $('#content-card').html(data);
                }
            });
        })
    </script>
@endpush

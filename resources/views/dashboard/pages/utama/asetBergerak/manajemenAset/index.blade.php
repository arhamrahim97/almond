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
            <span>Manajemen Aset</span>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Data Aset Bergerak</div>
                        <div class="card-tools">
                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                                <li class="nav-item submenu">
                                    @component('dashboard.components.buttons.add',
                                        [
                                            'url' => url('manajemen-aset-bergerak/create'),
                                        ])
                                    @endcomponent
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="{{ $id ?? 'dataTables' }}" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr class="text-center fw-bold">
                                        {{-- <th><input type="checkbox" id="checkAllData" autocomplete="off" /> Tetapkan Lokasi
                                        </th> --}}
                                        <th>No</th>
                                        <th>Nama Aset</th>
                                        <th>Merek</th>
                                        <th>Model</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th>Pegawai</th>

                                        {{-- <th>Dibuat Tanggal</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Diperbarui Tanggal</th>
                                        <th>Diperbarui Oleh</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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

        var table = $('#dataTables').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            ordering: false,
            buttons: [{
                    extend: 'excel',
                    className: 'btn btn-sm btn-light-success px-2 btn-export-table d-inline ml-3 font-weight',
                    text: '<i class="bi bi-file-earmark-arrow-down"></i> Ekspor Data',
                    exportOptions: {
                        modifier: {
                            order: 'index', // 'current', 'applied', 'index',  'original'
                            page: 'all', // 'all',     'current'
                            search: 'applied' // 'none',    'applied', 'removed'
                        },
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    className: 'btn btn-sm btn-light-success px-2 btn-export-table d-inline ml-3 font-weight',
                    text: '<i class="bi bi-eye-fill"></i> Tampil/Sembunyi Kolom',
                }
            ],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            ajax: {
                url: "{{ route('manajemen-aset-bergerak.index') }}",
            },
            columns: [
                // {
                //     data: 'checkData',
                //     render: function(data, row, type) {
                //         return '<input type="checkbox" class="checkData" value="' + data +
                //             '">';
                //     },
                //     className: 'text-center',
                // },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_aset',
                    name: 'nama_aset',
                },
                {
                    data: 'merek',
                    name: 'merek',
                },
                {
                    data: 'model',
                    name: 'model',
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi',
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'text-center',
                },
                {
                    data: 'pegawai',
                    name: 'pegawai',
                    className: 'text-center',
                },
                // {
                //     data: 'created_at',
                //     name: 'created_at',
                // },
                // {
                //     data: 'created_by',
                //     name: 'created_by',
                // },
                // {
                //     data: 'updated_at',
                //     name: 'updated_at',
                // },
                // {
                //     data: 'updated_by',
                //     name: 'updated_by',
                // },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
            ],
            // columnDefs: [{
            //         targets: [5, 6, 7, 8],
            //         visible: false,
            //     },
            //     {
            //         targets: [5, 7],
            //         render: function(data) {
            //             return moment(data).format('LL');
            //         }
            //     },
            // ],
        });
    </script>
@endpush

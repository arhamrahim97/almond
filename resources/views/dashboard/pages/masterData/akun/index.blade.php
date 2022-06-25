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
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Data Akun</div>
                        <div class="card-tools">
                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                                <li class="nav-item submenu">
                                    @component('dashboard.components.buttons.add',
                                        [
                                            'url' => url('akun/create'),
                                        ])
                                    @endcomponent
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Table -->
                        <div class="table-responsive">
                            @component('dashboard.components.dataTables.index',
                                [
                                    'th' => ['No', 'Nama Lengkap', 'Username', 'Role', 'Status', 'Aksi'],
                                ])
                            @endcomponent
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
            $('#nav-akun').addClass('active');
        })

        var table = $('#dataTables').removeAttr('width').DataTable({
            processing: true,
            serverSide: true,
            dom: 'lBfrtip',
            buttons: [{
                extend: 'excel',
                className: 'btn btn-sm btn-light-success px-2 btn-export-table d-inline ml-3 font-weight',
                text: '<i class="far fa-file-excel mr-1"></i> Ekspor Data',
                exportOptions: {
                    modifier: {
                        order: 'index', // 'current', 'applied', 'index',  'original'
                        page: 'all', // 'all',     'current'
                        search: 'applied' // 'none',    'applied', 'removed'
                    },
                    columns: ':visible'
                }
            }],
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            ajax: {
                url: "{{ route('akun.index') }}",
                // data: function(d) {
                //     d.lokasiTugas = $('#lokasi-tugas').val();
                //     d.search = $('input[type="search"]').val();
                // }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap',
                },
                {
                    data: 'username',
                    name: 'username',
                },
                {
                    data: 'role',
                    name: 'role',
                    className: 'text-center',
                },
                {
                    data: 'status',
                    name: 'status',
                    className: 'text-center',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },



            ],
            // columnDefs: [{
            //         targets: [3, 4, 5, 6, 7, 9, 10, 11, 12, 13, 14, 15],
            //         visible: false,
            //     },
            //     {
            //         targets: [5, 15],
            //         visible: false,
            //         render: function(data) {
            //             return moment(data).format('LL');
            //         }
            //     },
            //     {
            //         targets: 16,
            //         className: 'text-center',
            //     },
            // ],
        });

        $(document).on('click', '.btn-delete', function() {
            let id = $(this).val();
            var _token = "{{ csrf_token() }}";
            swal({
                title: 'Apakah Anda yakin?',
                text: "Data yang dipilih akan dihapus!",
                icon: "warning",
                dangerMode: true,
                buttons: ["Batal", "Ya"],
            }).then((result) => {
                if (result) {
                    $.ajax({
                        type: 'DELETE',
                        url: "{{ url('akun') }}" + '/' + id,
                        data: {
                            _token: _token
                        },
                        success: function(data) {
                            swal({
                                title: "Berhasil!",
                                text: "Data yang dipilih berhasil dihapus.",
                                icon: "success",
                            }).then(function() {
                                table.ajax.reload();
                                $('#checkAllData').prop('checked', false);
                            });
                        }
                    })
                } else {
                    swal("Data batal dihapus.", {
                        icon: "error",
                    });
                }
            })
        })
    </script>
@endpush

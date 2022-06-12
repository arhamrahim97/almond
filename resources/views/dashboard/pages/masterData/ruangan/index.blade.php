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
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Data Ruangan</div>
                        <div class="card-tools">
                            <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                                <li class="nav-item submenu">
                                    @component('dashboard.components.buttons.deletedSelected',
                                        [
                                            'id' => 'deleteSelected',
                                        ])
                                    @endcomponent
                                    @component('dashboard.components.buttons.add',
                                        [
                                            'url' => url('ruangan/create'),
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
                                        <th><input type="checkbox" id="checkAllData" autocomplete="off" /></th>
                                        <th>No</th>
                                        <th>Nama Ruangan</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah Foto</th>
                                        <th>Dibuat Tanggal</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Diperbarui Tanggal</th>
                                        <th>Diperbarui Oleh</th>
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
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="modal-lihat" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Lihat Detail</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Nama Ruangan:</td>
                                            <td class="text-right td-modal fw-bold" id="td-nama-ruangan">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi:</td>
                                            <td class="text-right td-modal fw-bold" id="td-deskripsi">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dibuat Tanggal:</td>
                                            <td class="text-right td-modal fw-bold" id="td-dibuat-tanggal">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Dibuat Oleh:</td>
                                            <td class="text-right fw-bold" id="td-dibuat-oleh">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Diperbarui Tanggal:</td>
                                            <td class="text-right td-modal fw-bold" id="td-diperbarui-tanggal">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Diperbarui Oleh:</td>
                                            <td class="text-right td-modal fw-bold" id="td-diperbarui-oleh">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Foto</td>
                                            <td class="text-right td-modal fw-bold" id="td-jumlah-foto">
                                                -
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="foto-ruangan" class="row p-4">

                </div>
                <div class="modal-footer py-4">
                    <div class="col-6">
                        <a href="" class="btn btn-md btn-warning w-100" id="btn-ubah-modal"><i class="fas fa-edit"></i>
                            Ubah</a>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-md btn-secondary w-100" data-dismiss="modal"><i
                                class="fas fa-times"></i>
                            Tutup</button>
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
            $('#nav-ruangan').addClass('active');
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
                url: "{{ route('ruangan.index') }}",
            },
            columns: [{
                    data: 'checkData',
                    render: function(data, row, type) {
                        return '<input type="checkbox" class="checkData" value="' + data +
                            '">';
                    },
                    className: 'text-center',
                },
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    className: 'text-center',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_ruangan',
                    name: 'nama_ruangan',
                },
                {
                    data: 'deskripsi',
                    name: 'deskripsi',
                },
                {
                    data: 'jumlah_foto',
                    name: 'jumlah_foto',
                    className: 'text-center',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'created_by',
                    name: 'created_by',
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                },
                {
                    data: 'updated_by',
                    name: 'updated_by',
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                },
            ],
            columnDefs: [{
                    targets: [5, 6, 7, 8],
                    visible: false,
                },
                {
                    targets: [5, 7],
                    render: function(data) {
                        return moment(data).format('LL');
                    }
                },
            ],
        });

        $(document).on('click', '.btn-lihat', function() {
            $('.td-modal').text('-')
            let id = $(this).val();
            disabledCloseModal()
            $.ajax({
                type: "GET",
                url: "{{ url('ruangan') }}" + '/' + id,
                success: function(data) {
                    $('#modal-lihat').modal('show');
                    $('#td-nama-ruangan').text(data.nama_ruangan)
                    $('#td-deskripsi').text(data.deskripsi)
                    $('#td-dibuat-tanggal').text(data.created_at_)
                    $('#td-dibuat-oleh').text(data.created_by_)
                    if (data.created_at_ != data.updated_at_) {
                        $('#td-diperbarui-tanggal').text(data.updated_at_)
                        $('#td-diperbarui-oleh').text(data.updated_by_ ?? '-')
                    }

                    $('#td-jumlah-foto').text(data.jumlah_foto_)

                    $('#foto-ruangan').html('')
                    $.each(data.foto_ruangan_, function(index, value) {
                        $('#foto-ruangan').append(`
                        <div class="col-lg-6">
                            <img src="${value}" class="img-fluid card-img-top rounded mb-3" alt="">
                            </div>
                        `)
                    })
                    $('#btn-ubah-modal').attr('href', "{{ url('ruangan') }}" + '/' + id + '/edit')
                }
            });

        });



        $('#checkAllData').click(function() {
            if ($(this).is(':checked')) {
                $('.checkData').prop('checked', true);
            } else {
                $('.checkData').prop('checked', false);
            }
        });

        $('#deleteSelected').click(function() {
            var id = [];
            var _token = "{{ csrf_token() }}";

            $('.checkData:checked').each(function() {
                id.push($(this).val());
            });

            if (id == '') {
                swal({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Belum ada data yang dipilih!',
                })
            } else {
                swal({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dipilih akan dihapus!",
                    icon: "warning",
                    dangerMode: true,
                    buttons: ["Batal", "Ya"],
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('ruangan/delete-selected') }}",
                            data: {
                                id: id,
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
            }

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
                        url: "{{ url('ruangan') }}" + '/' + id,
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

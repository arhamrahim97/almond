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
                                    @component('dashboard.components.buttons.deletedSelected',
                                        [
                                            'id' => 'deleteSelected',
                                        ])
                                    @endcomponent
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
                                        <th><input type="checkbox" id="checkAllData" autocomplete="off" />
                                        </th>
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

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="modal-lihat" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="title-modal">-</h3>
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
                                            <td>Nama Aset:</td>
                                            <td class="text-right td-modal fw-bold" id="td-nama-aset">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Merek (Brand):</td>
                                            <td class="text-right td-modal fw-bold" id="td-merek">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Model:</td>
                                            <td class="text-right td-modal fw-bold" id="td-model">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kode Inventaris:</td>
                                            <td class="text-right td-modal fw-bold" id="td-kode-inventaris">
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
                    <div id="foto-aset-bergerak" class="row p-4">

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table mb-0">
                                    <tbody id="dokumen-aset-bergerak">


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <form method="POST" class="px-3 mb-3" id="duplikat-form" data-id="">
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-md-8 col-lg-8 px-2">
                                <div class="form-group">
                                    <label for="TextInput" class="form-label">Jumlah Duplikat</label>
                                    <input type="text" id="jumlah-duplikat" name="jumlah_duplikat"
                                        class="form-control req angka" value="" placeholder="Masukkan Jumlah Duplikat"
                                        data-label="Jumlah Duplikat">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 text-right align-items-end pl-md-0">
                                <div class="form-group px-0">
                                    <button type="submit" class="btn btn-success w-100" id="btn-submit" value=""><i
                                            class="fas fa-copy"></i>
                                        Proses</button>
                                </div>
                            </div>
                            <span class="text-danger mx-3 error-text jumlah_duplikat-error"></span>
                        </div>

                    </form>
                </div>
                <div class="modal-footer py-4 justify-content-center">
                    <div class="row w-100">
                        <div class="col-lg col-sm-12 mb-1" id="col-tentukan-aset-pegawai">
                            <a href="" class="btn btn-md btn-success w-100" id="btn-tentukan-pegawai-modal"><i
                                    class="fas fa-user-plus"></i>
                                Tentukan Pegawai</a>
                        </div>
                        <div class="col-lg col-sm-12 mb-1" id="col-ubah-aset-pegawai">
                            <a href="" class="btn btn-md btn-secondary w-100" id="btn-ubah-pegawai-modal"><i
                                    class="fas fa-user-edit"></i>
                                Ubah Pegawai</a>
                        </div>
                        <div class="col-lg col-sm-12 mb-1" id="col-ubah-aset">
                            <a href="" class="btn btn-md btn-warning w-100" id="btn-ubah-aset-modal"><i
                                    class="fas fa-edit"></i>
                                Ubah Aset</a>
                        </div>
                        <div class="col-lg col-sm-12 mb-1">
                            <button type="button" class="btn btn-md btn-dark w-100" data-dismiss="modal"><i
                                    class="fas fa-times"></i>
                                Tutup</button>
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

        $(document).on('click', '.btn-lihat', function() {
            $('.td-modal').text('-')
            let id = $(this).val();
            let button = $(this).data('button');
            disabledCloseModal()
            $.ajax({
                type: "GET",
                url: "{{ url('manajemen-aset-bergerak') }}" + '/' + id,
                success: function(data) {
                    $('#modal-lihat').modal('show');
                    $('#td-nama-aset').text(data.nama_aset)
                    $('#td-merek').text(data.merek)
                    $('#td-model').text(data.model)
                    $('#td-kode-inventaris').text(data.kode_inventaris)
                    $('#td-deskripsi').text(data.deskripsi)
                    $('#td-dibuat-tanggal').text(data.created_at_)
                    $('#td-dibuat-oleh').text(data.created_by_)
                    if (data.created_at_ != data.updated_at_) {
                        $('#td-diperbarui-tanggal').text(data.updated_at_)
                        $('#td-diperbarui-oleh').text(data.updated_by_ ?? '-')
                    }

                    $('#td-jumlah-foto').text(data.jumlah_foto_)

                    $('#foto-aset-bergerak').html('')
                    $.each(data.foto_aset_bergerak_, function(index, value) {
                        $('#foto-aset-bergerak').append(`
                        <div class="col-lg-6">
                            <img src="${value}" class="img-fluid card-img-top rounded mb-3" alt="">
                        </div>
                    `)
                    })

                    if (button == 'lihat') {
                        $('#title-modal').text('Lihat Detail')
                        $('#duplikat-form').addClass('d-none')
                        $('#btn-submit').val(id)
                        $('#tr-pegawai').remove()
                        if (data.pegawai_) {
                            $('#dokumen-aset-bergerak').append(`
                            <tr id="tr-pegawai">
                                <td>Pegawai</td>
                                <td class="text-right">` + data.pegawai_ + `</td>
                            </tr>
                        `)
                        }

                        $('#tr-jumlah-dokumen').remove()
                        if (data.jumlah_dokumen_) {
                            $('#dokumen-aset-bergerak').append(`
                        <tr id="tr-jumlah-dokumen">
                            <td>Jumlah Dokumen:</td>
                            <td class="text-right td-modal fw-bold" id="td-jumlah-dokumen">
                                ` + data.jumlah_dokumen_ + `
                            </td>
                        </tr>
    
                        `)
                        }

                        $('.tr-aset-dokumen').remove()
                        $.each(data.dokumen_aset_bergerak_, function(index, value) {
                            $('#dokumen-aset-bergerak').append(`
                            <tr class="tr-aset-dokumen">
                                <td>` + value.deskripsi + `</td>
                                <td class="text-right td-modal fw-bold" id="td-jumlah-dokumen">
                                    <a href="` + value.nama_file + `" target="_blank" class="badge badge-primary shadow">Lihat</a>
                                </td>
                            </tr>
                            `)
                        })

                        if (data.status == 'Baru') {
                            $('#col-ubah-aset-pegawai').addClass('d-none')
                            $('#col-tentukan-aset-pegawai').removeClass('d-none')
                            $('#btn-tentukan-pegawai-modal').attr('href',
                                "{{ url('tentukan-aset-pegawai') }}" + '/' + id)
                        } else {
                            $('#col-ubah-aset-pegawai').removeClass('d-none')
                            $('#col-tentukan-aset-pegawai').addClass('d-none')
                            $('#btn-ubah-pegawai-modal').attr('href',
                                "{{ url('ubah-aset-pegawai') }}" +
                                '/' +
                                id)
                        }
                        $('#col-ubah-aset').removeClass('d-none')

                    } else { // button duplikat
                        $('#title-modal').text('Duplikat Data')
                        $('#duplikat-form').removeClass('d-none')
                        $('#btn-submit').val(id)
                        $('#jumlah-duplikat').val('')
                        $('#tr-pegawai').remove()
                        $('#tr-jumlah-dokumen').remove()
                        $('.tr-aset-dokumen').remove()
                        $('#col-ubah-aset-pegawai').addClass('d-none')
                        $('#col-tentukan-aset-pegawai').addClass('d-none')
                        $('#col-ubah-aset').addClass('d-none')
                    }

                    $('#btn-ubah-aset-modal').attr('href',
                        "{{ url('manajemen-aset-bergerak') }}" + '/' + id + '/edit')

                }
            });


        });

        $('#duplikat-form').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('')
            var data = new FormData(this)
            data.append('id', $('#btn-submit').val())
            swal({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan di duplikat sebanyak " + $('#jumlah-duplikat').val() + " kali.",
                icon: "warning",
                dangerMode: true,
                buttons: ["Batal", "Ya"],
            }).then((result) => {
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('duplikatAsetBergerak') }}",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: data,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if ($.isEmptyObject(response.error)) {
                                swal({
                                    title: "Berhasil!",
                                    text: "Data berhasil di duplikat.",
                                    icon: "success",
                                }).then(function() {
                                    table.ajax.reload();
                                    $('#modal-lihat').modal('hide');
                                });
                            } else {
                                swal({
                                    title: "Gagal!",
                                    text: "Terjadi kesalahan, mohon periksa kembali data yang diinputkan.",
                                    icon: "error",
                                    button: "Ok",
                                });
                                printErrorMsg(response.error);
                            }
                        },
                        error: function(response) {
                            alert(response.responseJSON.message)
                        },
                    });
                } else {
                    swal("Data batal dihapus.", {
                        icon: "error",
                    });
                }
            })
        })

        const printErrorMsg = (msg) => {
            $.each(msg, function(key, value) {
                $('.' + key + '-error').text(value);
            });
        }

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
                        url: "{{ url('manajemen-aset-bergerak') }}" + '/' + id,
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
                            url: "{{ url('manajemen-aset-bergerak/delete-selected') }}",
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
    </script>
@endpush

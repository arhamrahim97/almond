@extends('dashboard.layouts.main')

@section('title')
    Status Aset
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
            <span>Status Aset</span>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Status Aset</div>
                        <div class="card-tools">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-3 col-md-4">
                            <div class="nav flex-column nav-pills nav-primary nav-pills-no-bd nav-pills-icons"
                                id="v-pills-tab-with-icon" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active show" shadow-sm id="v-pills-baru-tab-icons" data-toggle="pill"
                                    href="#v-pills-baru-icons" role="tab" aria-controls="v-pills-baru-icons"
                                    aria-selected="true">
                                    <i class="flaticon-star"></i>
                                    Baru
                                </a>
                                <a class="nav-link shadow-sm" id="v-pills-home-tab-icons" data-toggle="pill"
                                    href="#v-pills-home-icons" role="tab" aria-controls="v-pills-home-icons"
                                    aria-selected="true">
                                    <i class="flaticon-interface-1"></i>
                                    Digunakan
                                </a>
                                <a class="nav-link shadow-sm" id="v-pills-profile-tab-icons" data-toggle="pill"
                                    href="#v-pills-profile-icons" role="tab" aria-controls="v-pills-profile-icons"
                                    aria-selected="false">
                                    <i class="flaticon-settings"></i>
                                    Diperbaiki
                                </a>
                                <a class="nav-link shadow-sm" id="v-pills-profile-tab-icons" data-toggle="pill"
                                    href="#v-pills-profile-icons" role="tab" aria-controls="v-pills-profile-icons"
                                    aria-selected="false">
                                    <i class="flaticon-close"></i>
                                    Rusak
                                </a>
                                <a class="nav-link shadow-sm" id="v-pills-profile-tab-icons" data-toggle="pill"
                                    href="#v-pills-profile-icons" role="tab" aria-controls="v-pills-profile-icons"
                                    aria-selected="false">
                                    <i class="flaticon-interface-5"></i>
                                    Dibuang
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-9 col-md-8">
                            <div class="tab-content" id="v-pills-with-icon-tabContent">
                                <div class="tab-pane fade active show" id="v-pills-baru-icons" role="tabpanel"
                                    aria-labelledby="v-pills-baru-tab-icons">

                                </div>
                                <div class="tab-pane fade" id="v-pills-profile-icons" role="tabpanel"
                                    aria-labelledby="v-pills-profile-tab-icons">
                                    <p>Even the all-powerful Pointing has no control about the blind texts it is an almost
                                        unorthographic life One day however a small line of blind text by the name of Lorem
                                        Ipsum decided to leave for the far World of Grammar.</p>
                                    <p>The Big Oxmox advised her not to do so, because there were thousands of bad Commas,
                                        wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen.
                                        She packed her seven versalia, put her initial into the belt and made herself on the
                                        way.
                                    </p>
                                </div>
                            </div>
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
                        <div class="col-lg col-sm-12 mb-1" id="col-ubah-aset-pegawai">
                            <a href="" class="btn btn-md btn-secondary w-100" id="btn-ubah-pegawai-modal"><i
                                    class="fas fa-share"></i>
                                Pindahkan Aset</a>
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
            $('#li-status-aset-bergerak').addClass('active');
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

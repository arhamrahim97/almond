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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Detail</h3>
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
                                            <td class="text-right td-modal fw-bold" id="td-nama-lengkap">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi:</td>
                                            <td class="text-right td-modal fw-bold" id="td-jenis-kelamin">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Foto Profil</td>
                                            <td class="text-right td-modal fw-bold" id="td-foto-profil">
                                                -
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

        $(document).on('click', '.btn-lihat', function() {
            $('.td-modal').text('-')
            let id = $(this).val();
            disabledCloseModal()
            $.ajax({
                type: "GET",
                url: "{{ url('pegawai') }}" + '/' + id,
                success: function(data) {
                    $('#modal-lihat').modal('show');
                    console.log(data)
                    $('#td-nama-lengkap').text(data.nama_lengkap)
                    $('#td-jenis-kelamin').text(data.jenis_kelamin)
                    $('#td-tempat-lahir').text(data.tempat_lahir)
                    $('#td-tanggal-lahir').text(data.tanggal_lahir)
                    $('#td-nomor-hp').text(data.nomor_hp)
                    $('#td-email').text(data.email ?? '-')
                    $('#td-alamat').text(data.alamat)
                    $('#td-nip').text(data.nip)
                    $('#td-golongan-jabatan-pangkat').text(data.golongan_jabatan_pangkat)

                    $('#td-unit-kerja').text(data.unit_kerja)
                    $('#td-dibuat-tanggal').text(data.created_at_)
                    $('#td-dibuat-oleh').text(data.created_by_)
                    if (data.created_at_ != data.updated_at_) {
                        $('#td-diperbarui-tanggal').text(data.updated_at_)
                        $('#td-diperbarui-oleh').text(data.updated_by_ ?? '-')
                    }
                    if ((data.foto_profil != null) && (data.cek_foto_profil)) {
                        $('#td-foto-profil').html(
                            '<img src="' + data.foto_profil_ +
                            '" class="img-thumbnail" style="width: 140px; height: 140px;">'
                        )
                    } else {
                        $('#td-foto-profil').text('-')
                    }

                    $('#btn-ubah-modal').attr('href', "{{ url('pegawai') }}" + '/' + id + '/edit')
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
                            url: "{{ url('pegawai/delete-selected') }}",
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
                        url: "{{ url('pegawai') }}" + '/' + id,
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
            // Swal.fire({
            //     title: 'Apakah anda yakin?',
            //     text: "Data bidan yang dipilih akan dihapus!",
            //     icon: 'warning',
            //     showCancelButton: true,
            //     confirmButtonColor: '#3085d6',
            //     cancelButtonColor: '#d33',
            //     cancelButtonText: 'Batal',
            //     confirmButtonText: 'Ya, hapus!'
            // }).then((result) => {
            //     if (result.value) {
            //         $.ajax({
            //             type: "DELETE",
            //             url: "",
            //             data: {
            //                 _token: _token
            //             },
            //             success: function(response) {
            //                 if (response.res == 'success') {
            //                     Swal.fire(
            //                         'Terhapus!',
            //                         'Data berhasil dihapus.',
            //                         'success'
            //                     ).then(function() {
            //                         table.draw();
            //                     })
            //                 } else {
            //                     Swal.fire(
            //                         'Gagal!',
            //                         'Data gagal dihapus.',
            //                         'error'
            //                     )
            //                 }
            //             }
            //         })
            //     }
            // })
        })
    </script>
@endpush

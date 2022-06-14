@extends('dashboard.layouts.main')

@section('title')
    Aset Pegawai
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
            <span>Aset Pegawai</span>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <div class="card-head-row">
                        <div class="card-title">Aset Pegawai</div>
                        <div class="row card-tools">
                            <div class="col">
                                <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm float-right" id="pills-tab"
                                    role="tablist">
                                    <label for="" class="d-inline mt-1">Cari
                                        Pegawai :
                                    </label>
                                    <li class="nav-item submenu mr-1">
                                        <div class="form-group p-0">
                                            <select class="form-control select2" id="cari-pegawai" autocomplete="off">
                                                <option value="">Semua</option>
                                                @foreach ($asetPegawaiAll as $pegawai)
                                                    <option value="{{ $pegawai->id }}">{{ $pegawai->nama_lengkap }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </li>
                                    <a href="{{ url('aset-pegawai') }}" class="btn btn-sm btn-secondary d-none"
                                        id="btn-refresh"><i class="fas fa-undo mt-1"></i></a>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (count($asetPegawai) > 0)
                        <div class="row" id="content-card">
                            <div class="col-12 mb-3">
                                <h5>Status: <i class="fas fa-circle text-secondary ml-2"></i> Digunakan, <i
                                        class="fas fa-circle text-warning ml-2"></i> Diperbaiki, <i
                                        class="fas fa-circle text-danger ml-2"></i> Rusak</h5>
                            </div>
                            @component('dashboard.components.cards.asetBergerak.asetPegawai',
                                [
                                    'asetPegawai' => $asetPegawai,
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
                    {!! $asetPegawai->links() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Info -->
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
                </div>
                <div class="modal-footer py-4 justify-content-center">
                    <div class="row w-100">
                        {{-- <div class="col-lg col-sm-12 mb-1" id="col-ubah-aset-pegawai">
                            <a href="" class="btn btn-md btn-secondary w-100" id="btn-ubah-pegawai-modal"><i
                                    class="fas fa-share"></i>
                                Pindahkan Aset</a>
                        </div> --}}
                        {{-- <div class="col-lg col-sm-12 mb-1" id="col-ubah-aset-pegawai">
                            <a href="" class="btn btn-md btn-secondary w-100" id="btn-ubah-pegawai-modal"><i
                                    class="fas fa-share"></i>
                                Pindahkan Aset</a>
                        </div> --}}
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

    <!-- Modal Ubah Status Aset-->
    <div class="modal fade" id="modal-ubah-status-aset" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalLongTitle">Ubah Status Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form-ubah-status-aset">
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-md-8 col-lg-8 px-2 w-100">
                                <div class="form-group pt-0 w-100">
                                    <label for="exampleFormControlSelect1">Pilih Status</label>
                                    <select class="form-select select2 w-100 req" id="status-aset" name="status"
                                        data-label="Status" style="width:100%">
                                        <option value="">Pilih Salah Satu</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 text-right align-items-end pl-md-0">
                                <div class="form-group px-0">
                                    <button type="submit" class="btn btn-warning w-100" id="btn-submit" value="">
                                        <i class="fas fa-cogs"></i>
                                        Ubah Status</button>
                                </div>
                            </div>
                            <span class="text-danger mx-4 error-text status-error"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-lg col-sm-12 mb-1">
                        <button type="button" class="btn btn-md btn-dark w-100" data-dismiss="modal"><i
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
            $('#nav-aset-bergerak').addClass('active submenu');
            $('#aset-bergerak').addClass('show')
            $('#li-aset-pegawai').addClass('active');
        })

        $('#cari-pegawai').change(function() {
            $('#btn-refresh').removeClass('d-none');
            var id = $(this).val();
            $.ajax({
                url: "{{ url('/aset-pegawai/cari-pegawai') }}" + "/" + id,
                type: "GET",
                success: function(data) {
                    $('#pagination-aset').remove();
                    $('#content-card').html('');
                    $('#content-card').html(data);
                }
            });
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

        $(document).on('click', '.ubah-status-aset', function() {
            let id = $(this).data('id');
            let status_aset = $(this).data('status_aset'); // status aset bergerak

            $('#status-aset').removeClass('is-invalid')
            $('.error-text').text('')

            $("#status-aset option[value!='']").each(function() {
                $(this).remove();
            });

            if (status_aset == "Digunakan") {
                let option = `
            <option value="Rusak">Rusak</option>
            <option value="Diperbaiki">Diperbaiki</option>
            <option value="Dibuang">Dibuang</option>`
                $('#status-aset').append(option)
            } else if (status_aset == "Diperbaiki") {
                let option = `
            <option value="Digunakan">Digunakan</option>
            <option value="Rusak">Rusak</option>
            <option value="Dibuang">Dibuang</option>`
                $('#status-aset').append(option)
            } else if (status_aset == "Rusak") {
                let option = `
            <option value="Diperbaiki">Diperbaiki</option>
            <option value="Dibuang">Dibuang</option>`
                $('#status-aset').append(option)
            }

            $('#btn-submit').val(id)

            $('#modal-ubah-status-aset').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        $('#form-ubah-status-aset').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('')
            var formData = $('.req').serializeArray()

            validation(formData)
            var data = new FormData(this)
            data.append('id', $('#btn-submit').val())
            swal({
                title: 'Apakah Anda yakin?',
                text: "Status aset ini akan diubah sesuai dengan pilihan anda.",
                icon: "warning",
                buttons: ["Batal", "Ya"],
            }).then((result) => {
                if (result) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('ubahStatusAsetBergerak') }}",
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: data,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response)
                            if ($.isEmptyObject(response.error)) {
                                swal({
                                    title: "Berhasil!",
                                    text: "Status aset berhasil diubah.",
                                    icon: "success",
                                }).then(function() {
                                    $('#modal-ubah-status-aset').modal('hide');
                                    location.reload();
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
                    swal("Status data batal diubah.", {
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
    </script>
@endpush

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
                                        class="fas fa-circle text-danger ml-2"></i> Rusak, <i
                                        class="fas fa-circle text-info ml-2"></i> Hilang, <i
                                        class="fas fa-circle text-primary ml-2"></i> Pengganti</h5>
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
                                            <td>Kategori Aset:</td>
                                            <td class="text-right td-modal fw-bold" id="td-kategori">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Kode Barang:</td>
                                            <td class="text-right td-modal fw-bold" id="td-kode-barang">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Register:</td>
                                            <td class="text-right td-modal fw-bold" id="td-register">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nama/Jenis Barang:</td>
                                            <td class="text-right td-modal fw-bold" id="td-nama-barang">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Merk/Type:</td>
                                            <td class="text-right td-modal fw-bold" id="td-merek">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>No. Sertifikat/Pabrik/Chasis/Mesin:</td>
                                            <td class="text-right td-modal fw-bold" id="td-no-sertifikat">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bahan:</td>
                                            <td class="text-right td-modal fw-bold" id="td-bahan">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Asal/Cara Perolehan Barang:</td>
                                            <td class="text-right td-modal fw-bold" id="td-asal-barang">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tahun Pembelian:</td>
                                            <td class="text-right td-modal fw-bold" id="td-tahun-pembelian">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ukuran Barang/Kontruksi:</td>
                                            <td class="text-right td-modal fw-bold" id="td-ukuran-barang">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Satuan:</td>
                                            <td class="text-right td-modal fw-bold" id="td-satuan">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Keadaan Barang:</td>
                                            <td class="text-right td-modal fw-bold" id="td-keadaan-barang">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Harga Barang:</td>
                                            <td class="text-right td-modal fw-bold" id="td-harga-barang">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Polisi:</td>
                                            <td class="text-right td-modal fw-bold" id="td-nomor-polisi">
                                                -
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan:</td>
                                            <td class="text-right td-modal fw-bold" id="td-keterangan">
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
                    <div id="foto-aset-bergerak" class="row p-4 d-none">

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
                <div class="modal-body mx-2">
                    <form method="POST" id="form-ubah-status-aset">
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-12 px-2 w-100">
                                <div class="form-group pt-0 w-100">
                                    <label for="exampleFormControlSelect1">Pilih Status</label>
                                    <select class="form-select select2 w-100 req" id="status-aset" name="status"
                                        data-label="Status" style="width:100%">
                                        <option value="">Pilih Salah Satu</option>

                                    </select>
                                    <span class="text-danger error-text status-error"></span>
                                </div>
                            </div>
                            <div class="col-12 px-2 w-100 mt-2 d-none" id="dokumen-pendukung">
                                <div class="form-group pt-0 w-100">
                                    <label for="exampleFormControlSelect1">Dokumen Pendukung</label>
                                    <div class="row" id="dokumen-aset">
                                        <div class="col-12 col-document" id="col-dokumen-1">
                                            <div class="card box-upload mb-3 pegawai" id="box-upload-1"
                                                class="box-upload">
                                                <div class="card-body pb-3">
                                                    <div class="row">
                                                        <div
                                                            class="col-3 d-flex align-items-center justify-content-center">
                                                            <img src="{{ asset('assets/img/pdf.png') }}" alt=""
                                                                width="70px">
                                                        </div>
                                                        <div class="col-9">
                                                            <div class="mb-3 mt-2">
                                                                {{-- start validation --}}
                                                                <input type="hidden" name="nama_dokumen_1"
                                                                    value="" class="nama_dokumen"
                                                                    data-label="Nama Dokumen" data-iter="1"
                                                                    id="nama_dokumen-hidden-1">
                                                                {{-- end validation --}}

                                                                <input type="text" class="form-control nama-dokumen"
                                                                    id="nama-dokumen-1" name="nama_dokumen[]"
                                                                    placeholder="Masukkan Nama Dokumen" value=""
                                                                    data-iter="1" onkeyup="rmValNamaDokumen(1)" readonly>

                                                                {{-- start validation --}}
                                                                <p class="text-danger error-text nama_dokumen_1-error my-0"
                                                                    id="nama_dokumen-error-1"></p>
                                                                {{-- end validation --}}

                                                                <p class="text-danger error-text nama_dokumen-error my-0"
                                                                    id="nama_dokumen-error-1"></p>
                                                            </div>
                                                            <div class="mb-3">
                                                                {{-- start validation --}}
                                                                <input type="hidden" name="file_dokumen_1"
                                                                    value="" class="req file_dokumen"
                                                                    data-label="File Dokumen" data-iter="1"
                                                                    id="file_dokumen-hidden-1">
                                                                {{-- end validation --}}

                                                                <input name="file_dokumen[]"
                                                                    class="form-control file-dokumen" id="file-dokumen-1"
                                                                    type="file" multiple="true" data-iter="1"
                                                                    accept="application/pdf"
                                                                    onchange="rmValFileDokumen(1)">

                                                                {{-- start validation --}}
                                                                <p class="text-danger error-text file_dokumen_1-error my-0"
                                                                    id="file_dokumen-error-1"></p>
                                                                {{-- end validation --}}

                                                                <p class="text-danger error-text file_dokumen-error my-0"
                                                                    id="file_dokumen-error-1"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <p class="text-danger error-text dokumen-error my-0" id="dokumen-error-1"></p>
                                        </div>
                                        <div class="col-12 align-self-center col-add-dokumen">
                                            <div class="text-center text-muted" onclick="addDokumen()"
                                                style="cursor: pointer">
                                                <h1><i class="fas fa-plus-circle"></i></h1>
                                                <h6>Tambah Dokumen</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-12 justify-content-end text-right">
                                <button type="submit" class="btn btn-success" id="btn-submit" value="">
                                    <i class="fas fa-save"></i>
                                    Perbarui Status</button>
                            </div>

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
                    $('#td-kategori').text(data.kategori)
                    $('#td-kode-barang').text(data.kode_barang)
                    $('#td-register').text(data.register)
                    $('#td-nama-barang').text(data.nama_barang)
                    $('#td-merek').text(data.merek_tipe)
                    $('#td-no-sertifikat').text(data.nomor_sertifikat_pabrik_chasis_mesin)
                    $('#td-bahan').text(data.bahan)
                    $('#td-asal-barang').text(data.asal_barang)
                    $('#td-tahun-pembelian').text(data.tahun_pembelian)
                    $('#td-ukuran-barang').text(data.ukuran_barang_kontruksi)
                    $('#td-satuan').text(data.satuan)
                    $('#td-keadaan-barang').text(data.keadaan_barang)
                    $('#td-harga-barang').text(data.harga_barang)
                    $('#td-harga-barang').mask('000.000.000.000.000', {
                        reverse: true
                    })
                    $('#td-nomor-polisi').text(data.nomor_polisi)
                    $('#td-keterangan').text(data.keterangan)
                    $('#td-dibuat-tanggal').text(data.created_at_)
                    $('#td-dibuat-oleh').text(data.created_by_)
                    if (data.created_at_ != data.updated_at_) {
                        $('#td-diperbarui-tanggal').text(data.updated_at_)
                        $('#td-diperbarui-oleh').text(data.updated_by_ ?? '-')
                    }
                    $('#td-jumlah-foto').text(data.jumlah_foto_)

                    if (data.jumlah_foto_ != 0) {
                        $('#foto-aset-bergerak').removeClass('d-none')
                        $('#foto-aset-bergerak').html('')
                        $.each(data.foto_aset_bergerak_, function(index, value) {
                            $('#foto-aset-bergerak').append(`
                            <div class="col-lg-6">
                                <img src="${value}" class="img-fluid card-img-top rounded mb-3" alt="">
                            </div>
                        `)
                        })
                    } else {
                        $('#foto-aset-bergerak').addClass('d-none')
                    }

                    $('#title-modal').text('Lihat Detail')
                    $('#duplikat-form').addClass('d-none')
                    $('#btn-submit').val(id)
                    $('#tr-pegawai').remove()
                    if (data.pegawai_) {
                        $('#dokumen-aset-bergerak').append(`
                            <tr id="tr-pegawai">
                                <td>Pegawai</td>
                                <td class="text-right fw-bold">` + data.pegawai_ + `</td>
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
                                <td>` + value.deskripsi + ` <br> ` + value.pegawai + `</td>
                                <td class="text-right td-modal fw-bold" id="td-jumlah-dokumen">
                                    <a href="` + value.nama_file + `" target="_blank" class="badge badge-primary shadow">Lihat</a>
                                </td>
                            </tr>
                            `)
                    })
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

            if (status_aset == 'Baru' || status_aset == 'Digunakan') {
                let option = `
            <option value="Rusak">Rusak</option>
            <option value="Diperbaiki">Diperbaiki</option>
            <option value="Hilang">Hilang</option>
            <option value="Pengganti">Pengganti</option>
            <option value="Dihibahkan">Dihibahkan</option>
            <option value="Dihapuskan">Dihapuskan</option>
            `
                $('#status-aset').append(option)
            } else if (status_aset == "Diperbaiki") {
                let option = `
            <option value="Digunakan">Digunakan</option>
            <option value="Rusak">Rusak</option>
            <option value="Hilang">Hilang</option>
            <option value="Pengganti">Pengganti</option>
            <option value="Dihibahkan">Dihibahkan</option>
            <option value="Dihapuskan">Dihapuskan</option>
            `
                $('#status-aset').append(option)
            } else if (status_aset == "Rusak") {
                let option = `
            <option value="Digunakan">Digunakan</option>
            <option value="Diperbaiki">Diperbaiki</option>
            <option value="Hilang">Hilang</option>
            <option value="Pengganti">Pengganti</option>
            <option value="Dihibahkan">Dihibahkan</option>
            <option value="Dihapuskan">Dihapuskan</option>
            `
                $('#status-aset').append(option)
            } else if (status_aset == "Hilang") {
                let option = `
            <option value="Digunakan">Digunakan</option>
            <option value="Diperbaiki">Diperbaiki</option>
            <option value="Rusak">Rusak</option>
            <option value="Pengganti">Pengganti</option>
            <option value="Dihibahkan">Dihibahkan</option>
            <option value="Dihapuskan">Dihapuskan</option>
            `
                $('#status-aset').append(option)
            } else if (status_aset == "Pengganti") {
                let option = `
            <option value="Digunakan">Digunakan</option>
            <option value="Diperbaiki">Diperbaiki</option>
            <option value="Rusak">Rusak</option>
            <option value="Hilang">Hilang</option>
            <option value="Dihibahkan">Dihibahkan</option>
            <option value="Dihapuskan">Dihapuskan</option>
            `
                $('#status-aset').append(option)
            }

            $('#btn-submit').val(id)
            $('#dokumen-pendukung').addClass('d-none')
            $('.file_dokumen').removeClass('req')

            $('#modal-ubah-status-aset').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        $('#status-aset').change(function() {
            //         
            $('.file-dokumen').val('')
            if ($(this).val() == 'Hilang' || $(this).val() == 'Pengganti' || $(this).val() == 'Dihibahkan' || $(
                    this).val() == 'Dihapuskan') {
                $('#dokumen-pendukung').removeClass('d-none')
                if ($(this).val() == 'Hilang') {
                    $('#nama-dokumen-1').val('Berita Acara Laporan Kehilangan Aset')
                } else if ($(this).val() == 'Pengganti') {
                    $('#nama-dokumen-1').val('Berita Acara Penggantian Aset')
                } else if ($(this).val() == 'Dihibahkan') {
                    $('#nama-dokumen-1').val('Berita Acara Penghibahkan Aset')
                } else if ($(this).val() == 'Dihapuskan') {
                    $('#nama-dokumen-1').val('Berita Acara Penghapusan Aset')
                }

                $('.file_dokumen').attr('disabled', false)
                $('.nama_dokumen').attr('disabled', false)
                $('.file_dokumen').addClass('req')
            } else {
                $('#dokumen-pendukung').addClass('d-none')
                $('.file_dokumen').attr('disabled', true)
                $('.nama_dokumen').attr('disabled', true)
                $('.file_dokumen').removeClass('req')
            }
            // alert('tets')
        })

        function deleteDokumen(iter) {
            $('#col-dokumen-' + iter).fadeOut(function() {
                $('#col-dokumen-' + iter).remove();
            });
        }

        function rmValNamaDokumen(iter) {
            if ($('#nama-dokumen-' + iter).val() != '') {
                $('#nama_dokumen-hidden-' + iter).removeClass('req');
            } else {
                $('#nama_dokumen-hidden-' + iter).addClass('req');
            }
        }

        function rmValFileDokumen(iter) {
            if ($('#file-dokumen-' + iter).val() != '') {
                $('#file_dokumen-hidden-' + iter).removeClass('req');
            } else {
                $('#file_dokumen-hidden-' + iter).addClass('req');
            }
        }


        let iterDokumen = 2;

        function addDokumen() {
            if (('{{ isset($aset) && $aset->pegawai }}') && (iterDokumen == 2)) {
                let count = {{ $maxDocument ?? '' }} + 1;
                iterDokumen = count + 1;
            }

            $('.col-add-dokumen').remove();
            $('#dokumen-aset').append(`
                <div class="col-12 col-document" id="col-dokumen-` + iterDokumen + `">
                    <div class="card box-upload mb-3" id="box-upload-` +
                iterDokumen + `" class="box-upload">
                        <div class="card-body pb-2">
                            <div class="row">
                                <div class="col-3 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('assets/img/pdf.png') }}" alt="" width="70px">
                                </div>
                                <div class="col-9">
                                    <div class="mb-3 mt-2">
                                        <input type="hidden" name="nama_dokumen_` + iterDokumen +
                `" value=""
                                                            class="req nama_dokumen" data-label="Nama Dokumen" data-iter="` +
                iterDokumen + `"
                                                            id="nama_dokumen-hidden-` + iterDokumen +
                `">
                                                            <input type="text" class="form-control nama-dokumen" id="nama-dokumen-` +
                iterDokumen +
                `"
                                                            name="nama_dokumen[]" placeholder="Masukkan Nama Dokumen" value="" data-iter="` +
                iterDokumen +
                `"  onkeyup="rmValNamaDokumen(` + iterDokumen +
                `)">
                                                            <p class="text-danger error-text nama_dokumen-error my-0" id="nama_dokumen-error-` +
                iterDokumen +
                `"></p>
                                                            <p class="text-danger error-text nama_dokumen_` +
                iterDokumen + `-error my-0"
                                                                                id="nama_dokumen-error-` +
                iterDokumen +
                `"></p>
                                    </div>

                                    <div class="mb-3">
                                        <input type="hidden" name="file_dokumen_` + iterDokumen +
                `" value=""
                                                            class="req file_dokumen" data-label="File Dokumen" data-iter="` +
                iterDokumen + `"
                                                            id="file_dokumen-hidden-` + iterDokumen +
                `">
                                        <input name="file_dokumen[]" class="form-control file-dokumen" type="file" id="file-dokumen-` +
                iterDokumen + `"
                                            multiple="true" data-iter="` + iterDokumen +
                `" accept="application/pdf" onchange="rmValFileDokumen(` + iterDokumen + `)">
                    <p class="text-danger error-text file_dokumen_` + iterDokumen + `-error my-0"
                                                            id="file_dokumen-error-` + iterDokumen +
                `"></p>
                                        <p class="text-danger error-text file_dokumen-error my-0" id="file_dokumen-error-` +
                iterDokumen + `"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button"
                            class="btn btn-danger fw-bold card-footer bg-danger text-center p-0 delete-document"
                            onclick="deleteDokumen(` + iterDokumen + `)"><i class="fas fa-trash-alt"></i>
                            Hapus</button>
                    </div>
                    <p class="text-danger error-text dokumen-error my-0" id="dokumen-error-1"></p>
                </div>
                <div class="col-12 align-self-center col-add-dokumen">
                    <div class="text-center text-muted" onclick="addDokumen()" style="cursor: pointer">
                        <h1><i class="fas fa-plus-circle"></i></h1>
                        <h6>Tambah Dokumen</h6>
                    </div>

                </div>
                    
                `);
            iterDokumen++;
        }

        $('#form-ubah-status-aset').submit(function(e) {
            e.preventDefault();
            $('.error-text').text('')
            var formData = $('#form-ubah-status-aset .req').serializeArray()
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
                                if (response == 'nama_dokumen_kosong') {
                                    swal({
                                        title: "Gagal!",
                                        text: "Terdapat Nama Dokumen yang kosong.",
                                        icon: "error",
                                    })
                                    $.each($('.nama-dokumen'), function(index, value) {
                                        if ($(value).val() == '') {
                                            $(value).addClass('is-invalid');
                                            $('#nama_dokumen-error-' + $(value)
                                                .data(
                                                    'iter')).text(
                                                'Nama Dokumen tidak boleh kosong.'
                                            )
                                        }
                                    });
                                }

                                if (response ==
                                    'nama_dokumen_kosong_dan_file_dokumen_kosong') {
                                    swal({
                                        title: "Gagal!",
                                        text: "Terdapat Nama Dokumen dan File Dokumen yang kosong.",
                                        icon: "error",
                                    })
                                    $.each($('.nama-dokumen'), function(index, value) {
                                        if ($(value).val() == '') {
                                            $(value).addClass('is-invalid');
                                            $('#nama_dokumen-error-' + $(value)
                                                .data(
                                                    'iter')).text(
                                                'Nama Dokumen tidak boleh kosong.'
                                            )
                                        }
                                    });
                                    $.each($('.file-dokumen'), function(index, value) {
                                        if ($(value).val() == '') {
                                            $(value).addClass('is-invalid');
                                            $('#file_dokumen-error-' + $(value)
                                                .data(
                                                    'iter')).text(
                                                'File Dokumen tidak boleh kosong.'
                                            )
                                        }
                                    });
                                }
                                if (response == 'success') {
                                    swal({
                                        title: "Berhasil!",
                                        text: "Status aset berhasil diubah.",
                                        icon: "success",
                                    }).then(function() {
                                        $('#modal-ubah-status-aset').modal('hide');
                                        location.reload();
                                    });
                                }
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
                            overlay.hide();
                            swal({
                                title: "Coba kembali",
                                text: "Maaf, terjadi kesalahan pengiriman data, silahkan coba kembali.",
                                icon: "error",
                                button: "Ok",
                            });
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

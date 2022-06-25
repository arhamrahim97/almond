<table id="table-ekspor" class="table table-bordered">
    <thead class="text-center fw-bold">
        <tr>
            <th>DINAS PERPUSTAKAAN DAN KEARSIPAN</th>
        </tr>
        <tr>
            <th>USULAN MUTASI DAFTAR STATUS PENGGUNA BARANG MILIK DAERAH PADA PEMERINTAH PROVINSI SULAWESI TENGAH TA
                @php
                    echo date('Y');
                @endphp
        </tr>
        <tr>

        </tr>
        <tr style="background-color: #96B3D7;">
            <th colspan="3">NOMOR</th>
            <th colspan="3">SPESIFIKASI BARANG</th>
            <th rowspan="2">Bahan</th>
            <th rowspan="2">Asal/Cara Perolehan Barang</th>
            <th rowspan="2">Tahun Pembelian</th>
            <th rowspan="2">Ukuran Barang/ Konstruksi(P, S, D)</th>
            <th rowspan="2">Satuan</th>
            <th rowspan="2">Keadaan Barang (B/KB/RB)</th>
            <th colspan="2">JUMLAH</th>
            <th rowspan="2">Keterangan</th>
        </tr>

        <tr style="background-color: #96B3D7;">
            <th>Urut</th>
            <th>Kode Barang</th>
            <th>Register</th>
            <th>Nama/Jenis Barang</th>
            <th>Merk/Type</th>
            <th>No. Sertifikat<br>No. Pabrik<br>No. Chasis<br>No. Mesin</th>
            <th>Barang</th>
            <th>Harga</th>
        </tr>
        <tr style="background-color: #96B3D7;">
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>10</th>
            <th>11</th>
            <th>12</th>
            <th>13</th>
            <th>14</th>
            <th>15</th>
        </tr>
    </thead>
    <tbody>
        @if ($asets->where('kategori', 'Tanah (KIB A)')->count() > 0)
            <tr>
                <td colspan="15" class="fw-bold" style="font-style: italic">TANAH (KIB A)
                </td>
            </tr>
            @foreach ($asets->where('kategori', 'Tanah (KIB A)') as $aset)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-right">{{ $aset->kode_barang }}</td>
                    <td class="text-right">{{ $aset->register }}</td>
                    <td>{{ $aset->nama_barang }}</td>
                    <td>{{ $aset->merek_tipe }}</td>
                    <td>{{ $aset->nomor_sertifikat_pabrik_chasis_mesin }}</td>
                    <td class="text-center">{{ $aset->bahan }}</td>
                    <td class="text-center">{{ $aset->asal_barang }}</td>
                    <td class="text-center">{{ $aset->tahun_pembelian }}</td>
                    <td class="text-center">{{ $aset->ukuran_barang_kontruksi }}</td>
                    <td class="text-center">{{ $aset->satuan }}</td>
                    <td class="text-center">{{ $aset->keadaan_barang }}</td>
                    <td class="text-center">{{ $aset->jumlah_barang }}</td>
                    <td class="text-right">{{ $aset->harga_barang }}</td>
                    <td>{{ $aset->keterangan }}</td>
                </tr>
            @endforeach
        @endif
        @if ($asets->where('kategori', 'Peralatan dan Mesin (KIB B)')->count() > 0)
            <tr>
                <td colspan="15" class="fw-bold" style="font-style: italic">PERRALATAN DAN
                    MESIN (KIB B)</td>
            </tr>
            @foreach ($asets->where('kategori', 'Peralatan dan Mesin (KIB B)') as $aset)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-right">{{ $aset->kode_barang }}</td>
                    <td class="text-right">{{ $aset->register }}</td>
                    <td>{{ $aset->nama_barang }}</td>
                    <td>{{ $aset->merek_tipe }}</td>
                    <td>{{ $aset->nomor_sertifikat_pabrik_chasis_mesin }}</td>
                    <td class="text-center">{{ $aset->bahan }}</td>
                    <td class="text-center">{{ $aset->asal_barang }}</td>
                    <td class="text-center">{{ $aset->tahun_pembelian }}</td>
                    <td class="text-center">{{ $aset->ukuran_barang_kontruksi }}</td>
                    <td class="text-center">{{ $aset->satuan }}</td>
                    <td class="text-center">{{ $aset->keadaan_barang }}</td>
                    <td class="text-center">{{ $aset->jumlah_barang }}</td>
                    <td class="text-right">{{ $aset->harga_barang }}</td>
                    <td>{{ $aset->keterangan }}</td>
                </tr>
            @endforeach
        @endif
        @if ($asets->where('kategori', 'Gedung dan Bangunan (KIB C)')->count() > 0)
            <tr>
                <td colspan="15" class="fw-bold" style="font-style: italic">GEDUNG DAN
                    BANGUNAN (KIB C)</td>
            </tr>
            @foreach ($asets->where('kategori', 'Gedung dan Bangunan (KIB C)') as $aset)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-right">{{ $aset->kode_barang }}</td>
                    <td class="text-right">{{ $aset->register }}</td>
                    <td>{{ $aset->nama_barang }}</td>
                    <td>{{ $aset->merek_tipe }}</td>
                    <td>{{ $aset->nomor_sertifikat_pabrik_chasis_mesin }}</td>
                    <td class="text-center">{{ $aset->bahan }}</td>
                    <td class="text-center">{{ $aset->asal_barang }}</td>
                    <td class="text-center">{{ $aset->tahun_pembelian }}</td>
                    <td class="text-center">{{ $aset->ukuran_barang_kontruksi }}</td>
                    <td class="text-center">{{ $aset->satuan }}</td>
                    <td class="text-center">{{ $aset->keadaan_barang }}</td>
                    <td class="text-center">{{ $aset->jumlah_barang }}</td>
                    <td class="text-right">{{ $aset->harga_barang }}</td>
                    <td>{{ $aset->keterangan }}</td>
                </tr>
            @endforeach
        @endif
        @if ($asets->where('kategori', 'Jalan, Indera dan Jaringan (KIB D)')->count() > 0)
            <tr>
                <td colspan="15" class="fw-bold" style="font-style: italic">JALAN, INDERA
                    DAN JARINGAN (KIB D)</td>
            </tr>
            @foreach ($asets->where('kategori', 'Jalan, Indera dan Jaringan (KIB D)') as $aset)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-right">{{ $aset->kode_barang }}</td>
                    <td class="text-right">{{ $aset->register }}</td>
                    <td>{{ $aset->nama_barang }}</td>
                    <td>{{ $aset->merek_tipe }}</td>
                    <td>{{ $aset->nomor_sertifikat_pabrik_chasis_mesin }}</td>
                    <td class="text-center">{{ $aset->bahan }}</td>
                    <td class="text-center">{{ $aset->asal_barang }}</td>
                    <td class="text-center">{{ $aset->tahun_pembelian }}</td>
                    <td class="text-center">{{ $aset->ukuran_barang_kontruksi }}</td>
                    <td class="text-center">{{ $aset->satuan }}</td>
                    <td class="text-center">{{ $aset->keadaan_barang }}</td>
                    <td class="text-center">{{ $aset->jumlah_barang }}</td>
                    <td class="text-right">{{ $aset->harga_barang }}</td>
                    <td>{{ $aset->keterangan }}</td>
                </tr>
            @endforeach
        @endif
        @if ($asets->where('kategori', 'Aset Tetap Lainnya (KIB E)')->count() > 0)
            <tr>
                <td colspan="15" class="fw-bold" style="font-style: italic">ASET TETAP
                    LAINNYA (KIB E)</td>
            </tr>
            @foreach ($asets->where('kategori', 'Aset Tetap Lainnya (KIB E)') as $aset)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-right">{{ $aset->kode_barang }}</td>
                    <td class="text-right">{{ $aset->register }}</td>
                    <td>{{ $aset->nama_barang }}</td>
                    <td>{{ $aset->merek_tipe }}</td>
                    <td>{{ $aset->nomor_sertifikat_pabrik_chasis_mesin }}</td>
                    <td class="text-center">{{ $aset->bahan }}</td>
                    <td class="text-center">{{ $aset->asal_barang }}</td>
                    <td class="text-center">{{ $aset->tahun_pembelian }}</td>
                    <td class="text-center">{{ $aset->ukuran_barang_kontruksi }}</td>
                    <td class="text-center">{{ $aset->satuan }}</td>
                    <td class="text-center">{{ $aset->keadaan_barang }}</td>
                    <td class="text-center">{{ $aset->jumlah_barang }}</td>
                    <td class="text-right">{{ $aset->harga_barang }}</td>
                    <td>{{ $aset->keterangan }}</td>
                </tr>
            @endforeach
        @endif
        @if ($asets->where('kategori', 'Konstruksi Dalam Pengerjaan (KIB F)')->count() > 0)
            <tr>
                <td colspan="15" class="fw-bold" style="font-style: italic">
                    KONSTRUKSI DALAM PENGERJAAN (KIB F)</td>
            </tr>
            @foreach ($asets->where('kategori', 'Konstruksi Dalam Pengerjaan (KIB F)') as $aset)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-right">{{ $aset->kode_barang }}</td>
                    <td class="text-right">{{ $aset->register }}</td>
                    <td>{{ $aset->nama_barang }}</td>
                    <td>{{ $aset->merek_tipe }}</td>
                    <td>{{ $aset->nomor_sertifikat_pabrik_chasis_mesin }}</td>
                    <td class="text-center">{{ $aset->bahan }}</td>
                    <td class="text-center">{{ $aset->asal_barang }}</td>
                    <td class="text-center">{{ $aset->tahun_pembelian }}</td>
                    <td class="text-center">{{ $aset->ukuran_barang_kontruksi }}
                    </td>
                    <td class="text-center">{{ $aset->satuan }}</td>
                    <td class="text-center">{{ $aset->keadaan_barang }}</td>
                    <td class="text-center">{{ $aset->jumlah_barang }}</td>
                    <td class="text-right">{{ $aset->harga_barang }}</td>
                    <td>{{ $aset->keterangan }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

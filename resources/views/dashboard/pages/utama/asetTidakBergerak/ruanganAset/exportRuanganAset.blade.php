<table id="table-ekspor" class="table table-bordered">
    <thead class="text-center fw-bold">
        <tr>
            <th colspan="15">KARTU INVENTARISASI RUANGAN</th>
        </tr>
        <tr>
            <th colspan="2">KABUPATEN/KOTA</th>
            <th colspan="5">: PALU</th>
        </tr>
        <tr>
            <th colspan="2">PROVINSI</th>
            <th colspan="5">: SULAWESI TENGAH</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th colspan="3">NO. KODE LOKASI : </th>
        </tr>
        <tr>
            <th colspan="2">UNIT</th>
            <th colspan="5">: PEMERINTAHAN DAERAH</th>
        </tr>
        <tr>
            <th colspan="2">SATUAN KERJA</th>
            <th colspan="5">: DINAS PERPUSTAKAAN DAN KEARSIPAN PROVINSI SULAWESI TENGAH</th>
        </tr>
        <tr>
            <th colspan="2">RUANGAN</th>
            <th colspan="5">: {{ $namaRuangan }}</th>
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
        @foreach ($asets as $aset)
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
        <tr>
            <td colspan="13">TOTAL</td>
            <td>{{ $totalHarga }}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">Mengetahui</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="3">Palu, {{ $tanggal }}</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">KEPALA DINAS PERPUSTAKAAN DAN KEARSIPAN</td>
            <td></td>
            <td></td>
            <td colspan="4">PENANGGUNG JAWAB RUANGAN</td>
            <td></td>
            <td></td>
            <td colspan="3">PENGURUS BARANG</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">PROVINSI SULAWESI TENGAH</td>
            <td></td>
            <td></td>
            <td colspan="4"></td>
            <td></td>
            <td></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3"></td>
            <td></td>
            <td></td>
            <td colspan="4"></td>
            <td></td>
            <td></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3"></td>
            <td></td>
            <td></td>
            <td colspan="4"></td>
            <td></td>
            <td></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3"></td>
            <td></td>
            <td></td>
            <td colspan="4"></td>
            <td></td>
            <td></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">(Drs. I NYOMAN SRIADIJAYA, MM)</td>
            <td></td>
            <td></td>
            <td colspan="4">(_______________________________)</td>
            <td></td>
            <td></td>
            <td colspan="3">IRSAN TUAMAJI, S.Hi</td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">NIP. 19640919 199003 1 009</td>
            <td></td>
            <td></td>
            <td colspan="4">NIP. _____________________________</td>
            <td></td>
            <td></td>
            <td colspan="3">NIP. 19740715 200701 1 028</td>
        </tr>
        <tr>

        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="4">PENANGGUNG JAWAB KIR</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="4">(_______________________________)</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>

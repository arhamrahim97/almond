<?php

namespace App\Exports;

use App\Models\AsetTidakBergerak;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class ExportRuanganAset implements FromView, WithStyles, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $id;
    protected $count;

    function __construct($data)
    {
        $this->id = $data['id'];
        $this->count = $data['count'];
    }

    public function view(): View
    {
        $id = $this->id;
        $aset = AsetTidakBergerak::with('ruangan')->whereHas('ruangan', function ($query) use ($id) {
            $query->where('id', $id);
        })->orderBy('updated_at', 'desc');
        $totalHarga = $aset->sum('harga_barang');
        $ruangan = Ruangan::find($id);
        $namaRuangan = strtoupper($ruangan->nama_ruangan);
        return view('dashboard.pages.utama.asetTidakBergerak.ruanganAset.exportRuanganAset', [
            'asets' => $aset->get(),
            'ruangan' => $ruangan,
            'namaRuangan' => $namaRuangan,
            'totalHarga' => $totalHarga,
            'tanggal' => Carbon::now()->translatedFormat('j F Y'),
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '96B3D7',
                ],
            ],

        ];

        $styleArraySubHeader = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        $styleArrayBorderAll = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];


        $styleArrayTTD = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];


        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A2:A6')->applyFromArray($styleArraySubHeader);
        $sheet->getStyle('C2:C6')->applyFromArray($styleArraySubHeader);

        $sheet->getStyle('A7:O7')->applyFromArray($styleArray);
        $sheet->getStyle('A8:O8')->applyFromArray($styleArray);
        $sheet->getStyle('A9:O9')->applyFromArray($styleArray);

        $sheet->getStyle('A:O')->getAlignment()->setWrapText(true);

        $countAset = $this->count;
        $sheetHeadStart = 7;
        $sheetHeadEnd = 9;
        $sheetStart = 10;
        $sheetEnd = 9 + $countAset;
        $sheetTotalHarga = $sheetEnd + 1;
        $sheet->getStyle('A' . $sheetTotalHarga)->getFont()->setBold(true);
        $sheet->getStyle('A' . $sheetTotalHarga)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('N' . $sheetTotalHarga)->getFont()->setBold(true);
        $sheet->getStyle('N' . $sheetStart . ':N' . $sheetTotalHarga)->getNumberFormat()
            ->setFormatCode('#,##0');

        // All Border & Alignment Vertical Center
        for ($i = 7; $i < $sheetTotalHarga + 1; $i++) {
            $sheet->getStyle('A' . $i . ':O' . $i)->applyFromArray($styleArrayBorderAll);
        }

        // Alignment Horizontal Isi
        for ($i = 10; $i < $sheetTotalHarga; $i++) {
            $sheet->getStyle('A' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B' . $i . ':C' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->getStyle('G' . $i . ':M' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('N' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        }

        $j = 1;
        for ($i = $sheetTotalHarga + 1; $i < $sheetTotalHarga + 21; $i++) {
            $sheet->getStyle('A' . $i . ':O' . $i)->applyFromArray($styleArrayTTD);
            if ($j == 1) {
                $sheet->getStyle('B' . $i)->getFont()->setBold(true);
            } else if ($j == 7) {
                $sheet->getStyle('B' . $i . ':O' . $i)->getFont()->setBold(true);
            }
            $j++;
        }


        // $sheet->getStyle('A' . $sheetHeadStart . ':A' . $sheetHeadEnd)->applyFromArray($styleArraySubHeader);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 20,
            'C' => 8,
            'D' => 19,
            'E' => 10,
            'F' => 14,
            'G' => 6,
            'H' => 10,
            'I' => 16,
            'J' => 9,
            'K' => 7,
            'L' => 9,
            'M' => 7,
            'N' => 16,
            'O' => 13,
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\AsetBergerak;
use Illuminate\Support\Carbon;
use App\Models\AsetTidakBergerak;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExportSimda implements FromView, WithStyles, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $jumlahKategori;
    protected $jumlahAset;
    protected $totalRow;

    function __construct($data)
    {
        $this->jumlahKategori = $data['jumlahKategori'];
        $this->jumlahAset = $data['jumlahAset'];
        $this->totalRow = $data['totalRow'];
    }

    public function view(): View
    {
        $aset = AsetBergerak::orderBy('kode_barang', 'ASC')->orderBy('register', 'ASC')->get()->merge(AsetTidakBergerak::orderBy('kode_barang', 'ASC')->orderBy('register', 'ASC')->get())->whereNotIn('status', ['Dihibahkan', 'Dihapuskan']);
        $totalHarga = $aset->sum('harga_barang');

        return view('dashboard.pages.utama.exportSimda', [
            'asets' => $aset,
            'totalHarga' => $totalHarga,
            'tanggal' => Carbon::now()->translatedFormat('j F Y'),
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('G:M')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('B:C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('N')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '96B3D7',
                ],
            ],

        ];

        $styleArrayBorderAll = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A1:A2')->getFont()->setBold(true);
        $sheet->getStyle('A4:O4')->applyFromArray($styleArray);
        $sheet->getStyle('A5:O5')->applyFromArray($styleArray);
        $sheet->getStyle('A6:O6')->applyFromArray($styleArray);

        $sheet->getStyle('B:O')->getAlignment()->setWrapText(true);

        $totalRow = $this->totalRow;

        for ($i = 7; $i < $totalRow + 8; $i++) {
            $sheet->getStyle('A' . $i . ':O' . $i)->applyFromArray($styleArrayBorderAll);
            $sheet->getStyle('N' . $i)->getNumberFormat()
                ->setFormatCode('#,##0');
            if ($i == $totalRow + 7) {
                $sheet->getStyle('A' . $i . ':O' . $i)->getFont()->setBold(true);
                $sheet->getStyle('A' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            }
        }

        $sheet->getStyle('K' . $totalRow + 11)->getFont()->setBold(true);
        $sheet->getStyle('K' . $totalRow + 18)->getFont()->setBold(true);
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

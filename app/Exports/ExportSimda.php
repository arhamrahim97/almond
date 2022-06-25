<?php

namespace App\Exports;

use App\Models\AsetBergerak;
use App\Models\AsetTidakBergerak;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class ExportSimda implements FromView, WithStyles, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $aset = AsetBergerak::orderBy('kode_barang', 'ASC')->orderBy('register', 'ASC')->get()->merge(AsetTidakBergerak::orderBy('kode_barang', 'ASC')->orderBy('register', 'ASC')->get())->whereNotIn('status', ['Dihibahkan', 'Dijual', 'Dimusnahkan']);
        return view('dashboard.pages.utama.exportSimda', [
            'asets' => $aset
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
                    'color' => ['argb' => 'D4D4D4'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '96B3D7',
                ],
            ],

        ];

        $sheet->getStyle('A1:A2')->getFont()->setBold(true);
        $sheet->getStyle('A4:O4')->applyFromArray($styleArray);
        $sheet->getStyle('A5:O5')->applyFromArray($styleArray);
        $sheet->getStyle('A6:O6')->applyFromArray($styleArray);

        $sheet->getStyle('B:O')->getAlignment()->setWrapText(true);

        // $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // $sheet->getStyle('B')->getFont()->setSize(17);


        // $sheet->getStyle('A5:O5')->getAlignment()->setHorizontal(true);
        // return [
        //     1    => ['font' => ['bold' => true]], //title
        //     2    => ['font' => ['bold' => true]], //subTitle
        //     3    => ['font' => ['bold' => true]], // space
        //     4    => ['font' => ['bold' => true]], // header 1
        //     5    => ['font' => ['bold' => true]], // header 2
        //     6    => ['font' => ['bold' => true]], // header 3
        // ];
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

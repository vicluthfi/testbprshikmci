<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

$jsonData = file_get_contents('data.json');
$data = json_decode($jsonData, true);

if (isset($_POST['format'])) {
    $format = $_POST['format'];
    if ($format == 'xls') {
        exportToExcel($data);
    } elseif ($format == 'pdf') {
        exportToPDF($data);
    }
}


// Export ke .xslx
function exportToExcel($data) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $header = $data['header'];
    $sheet->setCellValue('A1', 'dibuatOleh');
    $sheet->setCellValue('B1', 'kodeLJKPermintaan');
    $sheet->setCellValue('C1', 'kodeCabangPermintaan');
    $sheet->setCellValue('D1', 'kodeTujuanPermintaan');
    $sheet->setCellValue('E1', 'tanggalPermintaan');
    $sheet->setCellValue('A2', $header['dibuatOleh']);
    $sheet->setCellValue('B2', $header['kodeLJKPermintaan']);
    $sheet->setCellValue('C2', $header['kodeCabangPermintaan']);
    $sheet->setCellValue('D2', $header['kodeTujuanPermintaan']);
    $sheet->setCellValue('E2', $header['tanggalPermintaan']);

    // Menerapkan bold (huruf tebal) dan center (rata tengah) ke header
    $sheet->getStyle('A1:E1')->getFont()->setBold(true);
    $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Menerapkan borders (kotak-kotak) ke header
    $sheet->getStyle('A1:E2')->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);

    // Menerapkan medium border (kotak-kotak dengan ketebalan medium) ke seluruh tabel header
    $sheet->getStyle('A1:A2')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('B1:B2')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('C1:C2')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('D1:D2')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('E1:E2')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);

    // Menerapkan medium border (kotak-kotak dengan ketebalan medium) ke baris pertama dalam tabel header
    $sheet->getStyle('A1')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('B1')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('C1')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('D1')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('E1')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);

    // Data Pokok Debitur
    $sheet->setCellValue('A4', 'namaDebitur');
    $sheet->setCellValue('B4', 'namaLengkap');
    $sheet->setCellValue('C4', 'npwp');
    $sheet->setCellValue('D4', 'bentukBu');
    $sheet->setCellValue('E4', 'goPublic');
    $sheet->setCellValue('F4', 'bentukBuKet');
    $sheet->setCellValue('G4', 'tempatPendirian');

    $row = 5;
    foreach ($data['perusahaan']['dataPokokDebitur'] as $debitur) {
        $sheet->setCellValue('A' . $row, $debitur['namaDebitur']);
        $sheet->setCellValue('B' . $row, $debitur['namaLengkap']);
        $sheet->setCellValue('C' . $row, $debitur['npwp']);
        $sheet->setCellValue('D' . $row, $debitur['bentukBu']);
        $sheet->setCellValue('E' . $row, $debitur['goPublic']);
        $sheet->setCellValue('F' . $row, $debitur['bentukBuKet']);
        $sheet->setCellValue('G' . $row, $debitur['tempatPendirian']);
        $row++;
    }

    // Menerapkan bold (huruf tebal) dan center (rata tengah) ke Data Pokok Debitur
    $sheet->getStyle('A4:G4')->getFont()->setBold(true);
    $sheet->getStyle('A4:G4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Menerapkan borders (kotak-kotak) ke Data Pokok Debitur
    $sheet->getStyle('A4:G' . ($row - 1))->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);

    // Menerapkan medium border (kotak-kotak dengan ketebalan medium) ke seluruh tabel Data Pokok Debitur
    $sheet->getStyle('A4:A6')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('B4:B6')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('C4:C6')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('D4:D6')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('E4:E6')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('F4:F6')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('G4:G6')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);

    // Menerapkan medium border (kotak-kotak dengan ketebalan medium) ke baris pertama dalam tabel Data Pokok Debitur
    $sheet->getStyle('A4')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('B4')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('C4')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('D4')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('E4')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('F4')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('G4')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);

    // Kelompok Pengurus Pemilik
    $row = max($row, 8);
    $sheet->setCellValue('A' . $row, 'namaLJK');
    $sheet->setCellValue('B' . $row, 'namaSesuaiIdentitas');
    $sheet->setCellValue('C' . $row, 'nomorIdentitas');
    $row++;

    $startRow = $row;
    foreach ($data['perusahaan']['kelompokPengurusPemilik'] as $kelompok) {
        foreach ($kelompok['pengurusPemilik'] as $pengurus) {
            $sheet->setCellValue('A' . $row, $kelompok['namaLJK']);
            $sheet->setCellValue('B' . $row, $pengurus['namaSesuaiIdentitas']);
            $sheet->setCellValue('C' . $row, $pengurus['nomorIdentitas']);
            $row++;
        }
    }

    // Menerapkan bold (huruf tebal) dan center (rata tengah) ke Kelompok Pengurus Pemilik
    $sheet->getStyle('A8:C8')->getFont()->setBold(true);
    $sheet->getStyle('A8:C8')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    // Menerapkan borders (kotak-kotak) ke Kelompok Pengurus Pemilik
    $sheet->getStyle('A' . $startRow . ':C' . ($row - 1))->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);

    // Menerapkan medium border (kotak-kotak dengan ketebalan medium) ke seluruh tabel Kelompok Pengurus Pemilik
    $sheet->getStyle('A8:A13')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('B8:B13')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('C8:C13')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);

    // Menerapkan medium border (kotak-kotak dengan ketebalan medium) ke baris pertama dalam tabel Kelompok Pengurus Pemilik
    $sheet->getStyle('A8')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('B8')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);
    $sheet->getStyle('C8')->applyFromArray([
        'borders' => [
            'outline' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '00000000'],
            ],
        ],
    ]);

    // Mengubah ukuran kolom otomatis
    foreach (range('A', 'G') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    $writer = new Xlsx($spreadsheet);
    $fileName = 'data.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    $writer->save('php://output');
}


// Export ke .pdf
function exportToPDF($data) {
    $dompdf = new Dompdf();
    
    // Header
    $header = $data['header'];
    $html = '<style>
                body { font-family: Arial, sans-serif; }
                h1 { color: #333; }
                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                tr:nth-child(even) { background-color: #f9f9f9; }
            </style>';
    $html .= '<h1>Header</h1>';
    $html .= '<table><tr><th>dibuatOleh</th><th>kodeLJKPermintaan</th><th>kodeCabangPermintaan</th><th>kodeTujuanPermintaan</th><th>tanggalPermintaan</th></tr>';
    $html .= '<tr><td>' . $header['dibuatOleh'] . '</td><td>' . $header['kodeLJKPermintaan'] . '</td><td>' . $header['kodeCabangPermintaan'] . '</td><td>' . $header['kodeTujuanPermintaan'] . '</td><td>' . $header['tanggalPermintaan'] . '</td></tr></table>';

    // Data Pokok Debitur
    $html .= '<h1>Data Pokok Debitur</h1>';
    $html .= '<table><tr><th>namaDebitur</th><th>namaLengkap</th><th>npwp</th><th>bentukBu</th><th>goPublic</th><th>bentukBuKet</th><th>tempatPendirian</th></tr>';
    foreach ($data['perusahaan']['dataPokokDebitur'] as $debitur) {
        $html .= '<tr><td>' . $debitur['namaDebitur'] . '</td><td>' . $debitur['namaLengkap'] . '</td><td>' . $debitur['npwp'] . '</td><td>' . $debitur['bentukBu'] . '</td><td>' . $debitur['goPublic'] . '</td><td>' . $debitur['bentukBuKet'] . '</td><td>' . $debitur['tempatPendirian'] . '</td></tr>';
    }
    $html .= '</table>';

    // Kelompok Pengurus Pemilik
    $html .= '<h1>Kelompok Pengurus Pemilik</h1>';
    $html .= '<table><tr><th>namaLJK</th><th>namaSesuaiIdentitas</th><th>nomorIdentitas</th></tr>';
    foreach ($data['perusahaan']['kelompokPengurusPemilik'] as $kelompok) {
        foreach ($kelompok['pengurusPemilik'] as $pengurus) {
            $html .= '<tr><td>' . $kelompok['namaLJK'] . '</td><td>' . $pengurus['namaSesuaiIdentitas'] . '</td><td>' . $pengurus['nomorIdentitas'] . '</td></tr>';
        }
    }
    $html .= '</table>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream('data.pdf', array("Attachment" => 1));
}
?>
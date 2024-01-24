<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$tabel = $_GET['tabel'];

// Membuat objek Spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Menambahkan judul kolom
$sheet->setCellValue('A1', 'No');
$sheet->setCellValue('B1', ($tabel == 'guru') ? 'NIP' : 'NISN');
$sheet->setCellValue('C1', 'Nama');
$sheet->setCellValue('D1', 'Jenis Kelamin');
$sheet->setCellValue('E1', ($tabel == 'guru') ? 'Jabatan' : 'Kelas');
$sheet->setCellValue('F1', 'Alamat');
$sheet->setCellValue('G1', 'Tanggal Lahir');

// Menambahkan satu baris contoh
$sheet->setCellValue('A2', '1');
$sheet->setCellValue('B2', ($tabel == 'guru') ? '(boleh dikosongkan)' : '1234567890');
$sheet->setCellValue('C2', 'Akbar Khalif');
$sheet->setCellValue('D2', 'Laki-laki');
$sheet->setCellValue('E2', ($tabel == 'guru') ? 'Guru Kelas 1' : '1');
$sheet->setCellValue('F2', 'Jl. Merdeka 1');
$sheet->setCellValue('G2', '2006-12-30');

// Mengatur format kolom G sebagai format teks
$lastRow = 100;
$sheet->getStyle('G2:G' . $lastRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

// Mengatur format file XLSX
$writer = new Xlsx($spreadsheet);

// Menentukan header untuk tipe file yang akan diunduh
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Template_Input.xlsx"');

// Menulis data ke output buffer
$writer->save('php://output');

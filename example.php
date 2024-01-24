<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Membuat objek Spreadsheet
$spreadsheet = new Spreadsheet();

// Mengisi data ke dalam Spreadsheet
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello');
$sheet->setCellValue('B1', 'World!');

// Menyimpan Spreadsheet ke file Excel
$writer = new Xlsx($spreadsheet);
$writer->save('example.xlsx');

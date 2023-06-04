<?php
require "../../../config/dbconfig.php";

// Menggunakan namespace PhpOffice\PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Query untuk mengambil data dari tabel
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

// Membuat objek Spreadsheet dengan library PhpSpreadsheet
$spreadsheet = new Spreadsheet();

// Membuat sheet aktif
$sheet = $spreadsheet->getActiveSheet();

// Menambahkan judul kolom
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Nama Lengkap');
$sheet->setCellValue('C1', 'Jenis Kelamin');
$sheet->setCellValue('D1', 'NIM');
$sheet->setCellValue('E1', 'Username');

// Mengatur indeks awal baris
$rowIndex = 2;

// Looping untuk mencetak setiap baris data
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $rowIndex, $row["id"]);
    $sheet->setCellValue('B' . $rowIndex, $row["nama_lengkap"]);
    $sheet->setCellValue('C' . $rowIndex, $row["jenis_kelamin"]);
    $sheet->setCellValue('D' . $rowIndex, $row["nim"]);
    $sheet->setCellValue('E' . $rowIndex, $row["username"]);
    $rowIndex++;
}

// Membuat objek Writer untuk menyimpan file Excel
$writer = new Xlsx($spreadsheet);

// Header untuk mengindikasikan file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="daftar_user.xlsx"');
$writer->save('php://output');

// Menutup koneksi ke database
mysqli_close($conn);

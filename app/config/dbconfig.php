<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'absen';

$conn = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if (mysqli_connect_errno()) {
    echo "Gagal koneksi ke database" . mysqli_connect_errno();
    exit();
}
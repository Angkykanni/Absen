<?php
require "config/dbconfig.php";

session_start();

//cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

//ambil data user dari session
$usernameSession = $_SESSION['username'];
$roleSession = $_SESSION['role'];

//TAMBAH MAHASISWA
if (isset($_POST['btnTambahUser'])) {
    $fotoProfile = $_POST['foto_profile'];
    $namaLengkap = $_POST['nama_lengkap'];
    $jenisKelamin = $_POST['jenis_kelamin'];
    $nim = $_POST['nim'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPasword = md5($password);
    $role = $_POST['role'];

    $tambahUser = mysqli_query($conn, "INSERT INTO users (foto_profile, nama_lengkap, jenis_kelamin, nim, username, password, role) VALUES ('$fotoProfile', '$namaLengkap', '$jenisKelamin', '$nim', '$username', '$hashedPasword', '$role')");

    if ($tambahUser) {
        echo
        "<script>alert('User berhasil ditambah'); window.location='admin/pages/data/maba.php';</script>";
        exit();
    } else {
        echo
        "<script>alert('User gagal ditambah'); window.location='admin/pages/data/maba.php';</script>";
        exit();
    }
}

//UBAH MAHASISWA
if (isset($_POST['btnUbahUser'])) {
    $idUser = $_POST['id'];
    $namaLengkap = $_POST['nama_lengkap'];
    $jenisKelamin = $_POST['jenis_kelamin'];
    $nim = $_POST['nim'];

    $ubahUser = mysqli_query($conn, "UPDATE users SET nama_lengkap='$namaLengkap', jenis_kelamin='$jenisKelamin', nim='$nim' WHERE id='$idUser'");

    if ($ubahUser) {
        echo "<script>alert('User Berhasil diubah');window.location='admin/pages/data/maba.php';</script>";
        exit();
    } else {
        echo "<script>alert('User Gagal diubah');window.location='admin/pages/data/maba.php';</script>";
        exit();
    }
}

//HAPUS MAHASISWA
if (isset($_POST['btnHapusUser'])) {
    $idUser = $_POST['id'];
    $hapusUser = mysqli_query($conn, "DELETE FROM users WHERE id='$idUser'");
    if ($hapusUser) {
        echo "<script>alert('Mahasiswa Berhasil di Hapus');window.location='admin/pages/data/maba.php';</script>";
        exit();
    } else {
        echo "<script>alert('Mahasiswa Gagal di Hapus');window.location='admin/pages/data/maba.php';</script>";
        exit();
    }
}


mysqli_close($conn);
session_unset();
session_destroy();

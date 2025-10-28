<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include '../config/class-mahasiswa.php';
// Membuat objek dari class Mahasiswa
$mahasiswa = new Mahasiswa();
// Mengambil data mahasiswa dari form input menggunakan metode POST dan menyimpannya dalam array
$dataMahasiswa = [
    'nama' => $_POST['nama'],
    'kategori' => $_POST['kategori'],
    'harga' => $_POST['harga'],
    'deskripsi' => $_POST['deskripsi'],
    'status' => $_POST['status'],
];
// Memanggil method inputMahasiswa untuk memasukkan data mahasiswa dengan parameter array $dataMahasiswa
$input = $mahasiswa->inputMahasiswa($dataMahasiswa);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>
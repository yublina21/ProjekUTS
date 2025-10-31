<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include_once '../config/class-menu.php';
// Membuat objek dari class Mahasiswa
$menu = new Menu();
// Mengambil data mahasiswa dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataMenu = [
    'nama' => $_POST['nama'],
    'kategori' => $_POST['kategori'],
    'harga' => $_POST['harga'],
    'deskripsi' => $_POST['deskripsi'],
    'status' => $_POST['status'],
];
// Memanggil method editMahasiswa untuk mengupdate data mahasiswa dengan parameter array $dataMahasiswa
$edit = $menu->editMenu($dataMenu);
// Mengecek apakah proses edit berhasil atau tidak - true/false
if($edit){
    // Jika berhasil, redirect ke halaman data-list.php dengan status editsuccess
    header("Location: ../data-list.php?status=editsuccess");
} else {
    // Jika gagal, redirect ke halaman data-edit.php dengan status failed dan membawa id mahasiswa
    header("Location: ../data-edit.php?id=".$dataMenu['id']."&status=failed");
}

?>
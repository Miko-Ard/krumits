<?php
require 'koneksi.php';

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$password_asli = $_POST['password'];


// (Logika pengecekan NIM bisa ditambahkan di sini untuk mencegah duplikat)


// Enkripsi password asli sebelum disimpan ke database
$hash_password = password_hash($password_asli, PASSWORD_DEFAULT);


$sql = "INSERT INTO mahasiswa (nama, nim, password) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($koneksi, $sql);

// Bind parameter ke query

mysqli_stmt_bind_param($stmt, "sss", $nama, $nim, $hash_password);


if (mysqli_stmt_execute($stmt)) {
    // Jika pendaftaran berhasil, arahkan ke halaman login dengan pesan sukses
    header("Location: login.php?error=Pendaftaran berhasil! Silakan login.");
    exit();
} else {
    // Jika gagal, beri pesan error
    echo "Error: " . mysqli_error($koneksi);
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
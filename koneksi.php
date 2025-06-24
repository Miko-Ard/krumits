<?php
$host       = 'localhost'; // Nama host server database
$user       = 'root';      // Username database (default XAMPP adalah 'root')
$pass       = '';          // Password database (default XAMPP kosong)
$db_name    = 'kampus_konnect'; // Nama database yang sudah kita buat


$koneksi = mysqli_connect($host, $user, $pass, $db_name);


if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
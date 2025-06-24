<?php
// Selalu mulai sesi dan proteksi halaman
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    die("AKSES DITOLAK: Anda tidak memiliki izin.");
}

// Hubungkan ke database
require 'koneksi.php';

// 1. Validasi: Pastikan ada ID yang dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dbadmin3.php?pesan=Error: ID data untuk dihapus tidak ditemukan.");
    exit();
}

$vote_id = $_GET['id'];

// 2. Siapkan query DELETE yang aman menggunakan prepared statements
$sql = "DELETE FROM votes WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);

// Jika statement gagal disiapkan
if ($stmt === false) {
    die("Error preparing statement: " . mysqli_error($koneksi));
}

// Bind parameter ID ke query
mysqli_stmt_bind_param($stmt, "i", $vote_id);

// 3. Eksekusi query
if (mysqli_stmt_execute($stmt)) {
    // Jika berhasil, redirect kembali ke halaman daftar dengan pesan sukses
    header("Location: dbadmin3.php?pesan=Data vote berhasil dihapus.");
} else {
    // Jika gagal, redirect dengan pesan error
    header("Location: dbadmin3.php?pesan=Error: Gagal menghapus data vote.");
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
exit();
?>
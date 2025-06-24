<?php
// Proteksi & Koneksi
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) { die("AKSES DITOLAK"); }
require 'koneksi.php';

// 1. Pastikan metode pengiriman adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: dbadmin3.php");
    exit();
}

// 2. Ambil data dari form yang disubmit
$vote_id = $_POST['vote_id'];
$pilihan_kandidat_baru = $_POST['pilihan_kandidat'];

// Validasi sederhana
if (empty($vote_id) || empty($pilihan_kandidat_baru)) {
    header("Location: dbadmin3.php?pesan=Error: Data tidak lengkap.");
    exit();
}

// 3. Siapkan query UPDATE yang aman
$sql = "UPDATE votes SET pilihan_kandidat = ? WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);

// Bind parameter ke query
// "ii" karena kedua parameter (pilihan_kandidat dan id) adalah integer
mysqli_stmt_bind_param($stmt, "ii", $pilihan_kandidat_baru, $vote_id);

// 4. Eksekusi query
if (mysqli_stmt_execute($stmt)) {
    // Jika berhasil, redirect kembali ke halaman daftar dengan pesan sukses
    header("Location: dbadmin3.php?pesan=Data vote berhasil diupdate.");
} else {
    // Jika gagal
    header("Location: dbadmin3.php?pesan=Error: Gagal mengupdate data.");
}

exit();
?>
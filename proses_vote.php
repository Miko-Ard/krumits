<?php
session_start();
require 'koneksi.php';

// 1. Keamanan ganda: cek lagi apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// 2. Ambil data yang dibutuhkan: ID mahasiswa dari sesi, dan pilihan dari form
$mahasiswa_id = $_SESSION['mahasiswa_id'];
if (!isset($_POST['pilihan_kandidat'])) {
    // Jika pengguna mengakses file ini tanpa menekan tombol vote, kembalikan
    header("Location: voting.php?pesan=Error: Anda harus memilih kandidat.");
    exit();
}
$pilihan = $_POST['pilihan_kandidat'];

// 3. LOGIKA KUNCI: Cek apakah mahasiswa ini sudah pernah memberikan suara sebelumnya
$sql_cek = "SELECT COUNT(*) as jumlah FROM votes WHERE mahasiswa_id = ?";
$stmt_cek = mysqli_prepare($koneksi, $sql_cek);
mysqli_stmt_bind_param($stmt_cek, "i", $mahasiswa_id); // "i" karena mahasiswa_id adalah integer
mysqli_stmt_execute($stmt_cek);
$result_cek = mysqli_stmt_get_result($stmt_cek);
$data_cek = mysqli_fetch_assoc($result_cek);

if ($data_cek['jumlah'] > 0) {
    // Jika jumlah vote dari mahasiswa ini lebih dari 0, berarti sudah pernah vote
    header("Location: voting.php?pesan=Error: Anda sudah pernah memberikan suara!");
    exit();
}

// 4. JIKA BELUM VOTE: Masukkan data suara baru ke dalam tabel 'votes'
$sql_insert = "INSERT INTO votes (mahasiswa_id, pilihan_kandidat) VALUES (?, ?)";
$stmt_insert = mysqli_prepare($koneksi, $sql_insert);
// "ii" karena kedua parameter (mahasiswa_id dan pilihan) adalah integer
mysqli_stmt_bind_param($stmt_insert, "ii", $mahasiswa_id, $pilihan);

if (mysqli_stmt_execute($stmt_insert)) {
    // Jika berhasil menyimpan, beri pesan sukses
    header("Location: voting.php?pesan=Terima kasih, suara Anda telah berhasil direkam!");
    exit();
} else {
    // Jika gagal menyimpan karena alasan lain
    header("Location: voting.php?pesan=Error: Terjadi kesalahan pada sistem.");
    exit();
}

mysqli_stmt_close($stmt_cek);
mysqli_stmt_close($stmt_insert);
mysqli_close($koneksi);
?>
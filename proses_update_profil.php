<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) { die("Akses ditolak."); }
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: halaman_profil.php');
    exit();
}

$mahasiswa_id = $_SESSION['mahasiswa_id'];
$nama_baru = $_POST['nama'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

$nama_file_foto_baru = null;

// PROSES UPLOAD FOTO
if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] === UPLOAD_ERR_OK) {
    $file_info = $_FILES['foto_profil'];
    if ($file_info['size'] > 2000000) { // Maks 2MB
        header("Location: halaman_profil.php?pesan=Error: Ukuran file terlalu besar.");
        exit();
    }
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    $file_extension = strtolower(pathinfo($file_info['name'], PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
        header("Location: halaman_profil.php?pesan=Error: Format file harus JPG, JPEG, atau PNG.");
        exit();
    }
    $nama_file_foto_baru = $mahasiswa_id . '_' . time() . '.' . $file_extension;
    $path_tujuan = __DIR__ . '/uploads/' . $nama_file_foto_baru;
    if (!move_uploaded_file($file_info['tmp_name'], $path_tujuan)) {
        header('Location: halaman_profil.php?pesan=Error: Gagal mengupload foto. Periksa izin folder.');
        exit();
    }
}

// BANGUN QUERY UPDATE DINAMIS
$sql_parts = ["nama = ?"];
$param_types = "s";
$param_values = [$nama_baru];

if (!empty($new_password)) {
    if ($new_password !== $confirm_password) {
        header("Location: halaman_profil.php?pesan=Error: Konfirmasi password tidak cocok.");
        exit();
    }
    $hash_password_baru = password_hash($new_password, PASSWORD_DEFAULT);
    $sql_parts[] = "password = ?";
    $param_types .= "s";
    $param_values[] = $hash_password_baru;
}

if ($nama_file_foto_baru) {
    $sql_parts[] = "foto_profil = ?";
    $param_types .= "s";
    $param_values[] = $nama_file_foto_baru;
}

$sql = "UPDATE mahasiswa SET " . implode(', ', $sql_parts) . " WHERE id = ?";
$param_types .= "i";
$param_values[] = $mahasiswa_id;

$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, $param_types, ...$param_values);

if (mysqli_stmt_execute($stmt)) {
    $_SESSION['mahasiswa_nama'] = $nama_baru;
    if ($nama_file_foto_baru) {
        $_SESSION['user_photo_path'] = 'uploads/' . $nama_file_foto_baru;
    }
    header("Location: halaman_profil.php?pesan=Profil berhasil diperbarui!");
} else {
    header("Location: halaman_profil.php?pesan=Error: Gagal memperbarui data.");
}

exit();
?>
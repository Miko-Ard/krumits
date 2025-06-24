<?php
require 'koneksi.php';

// --- Detail Akun Admin Pertama ---
$username_admin = 'admin123';
$password_admin = 'admin123';

// --- Proses Hashing & Penyimpanan ---

// 1. Hash password
$hash_password = password_hash($password_admin, PASSWORD_DEFAULT);

// 2. Cek dulu apakah username admin sudah ada
$sql_cek = "SELECT id FROM admins WHERE username = ?";
$stmt_cek = mysqli_prepare($koneksi, $sql_cek);
mysqli_stmt_bind_param($stmt_cek, "s", $username_admin);
mysqli_stmt_execute($stmt_cek);
$result_cek = mysqli_stmt_get_result($stmt_cek);

if (mysqli_num_rows($result_cek) > 0) {
    echo "Akun admin dengan username '{$username_admin}' sudah ada.";
} else {
    // 3. Query INSERT disesuaikan, tanpa kolom nama_lengkap
    $sql_insert = "INSERT INTO admins (username, password) VALUES (?, ?)";
    $stmt_insert = mysqli_prepare($koneksi, $sql_insert);
    // bind_param diubah dari "sss" menjadi "ss" (dua string)
    mysqli_stmt_bind_param($stmt_insert, "ss", $username_admin, $hash_password);
    
    if (mysqli_stmt_execute($stmt_insert)) {
        echo "<h2>Instalasi Berhasil!</h2>";
        echo "Akun admin pertama telah berhasil dibuat dengan:<br>";
        echo "<strong>Username:</strong> " . $username_admin;
    } else {
        echo "Error: Gagal membuat akun admin.";
    }
}

mysqli_close($koneksi);
?> 
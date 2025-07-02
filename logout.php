<?php
// Selalu mulai sesi untuk bisa memanipulasinya
session_start();

// Hapus semua variabel yang tersimpan di dalam sesi
session_unset();

// Hancurkan sesi itu sendiri
session_destroy();

// Arahkan pengguna kembali ke halaman login dengan pesan sukses
header("Location: halaman_utama.php?error=Anda telah berhasil logout.");

exit();
?>
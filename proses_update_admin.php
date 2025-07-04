<?php
session_start();
require 'koneksi.php';

// Siapkan array untuk respon JSON
$response = ['status' => 'error', 'message' => 'Terjadi kesalahan.'];

// Proteksi dan validasi dasar
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    $response['message'] = 'AKSES DITOLAK: Sesi tidak valid.';
} else if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Error: Metode pengiriman tidak valid.';
} else {
    // Ambil data
    $admin_id = $_SESSION['admin_id'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Cek hanya jika kolom password baru diisi
    if (!empty($new_password)) {
        if ($new_password !== $confirm_password) {
            $response['message'] = 'Error: Konfirmasi password tidak cocok.';
        } else {
            // Hash password baru
            $hash_password_baru = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Siapkan query untuk update HANYA password
            $sql = "UPDATE admins SET password = ? WHERE id = ?";
            $stmt = mysqli_prepare($koneksi, $sql);
            mysqli_stmt_bind_param($stmt, "si", $hash_password_baru, $admin_id);

            // Eksekusi dan siapkan respon
            if (mysqli_stmt_execute($stmt)) {
                $response['status'] = 'success';
                $response['message'] = 'Password berhasil diperbarui!';
            } else {
                $response['message'] = 'Error: Gagal memperbarui password di database.';
            }
        }
    } else {
        // Jika tidak ada password yang diisi
        $response['status'] = 'info';
        $response['message'] = 'Tidak ada perubahan yang disimpan.';
    }
}

// Kembalikan hasil dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
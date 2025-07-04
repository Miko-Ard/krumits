<?php
// Selalu mulai sesi di baris paling atas
session_start();

// Hubungkan ke database
require 'koneksi.php';

// 1. Siapkan array untuk respon JSON. Defaultnya adalah pesan error.
$response = [
    'status' => 'error',
    'message' => 'Terjadi kesalahan yang tidak diketahui.'
];

// 2. Lakukan pengecekan hanya jika user sudah login dan mengirim data
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_POST['pilihan_kandidat'])) {
    
    $mahasiswa_id = $_SESSION['mahasiswa_id'];
    $pilihan = $_POST['pilihan_kandidat'];

    // 3. LOGIKA KUNCI: Cek apakah mahasiswa ini sudah pernah memberikan suara
    $sql_cek = "SELECT COUNT(*) as jumlah FROM votes WHERE mahasiswa_id = ?";
    $stmt_cek = mysqli_prepare($koneksi, $sql_cek);
    mysqli_stmt_bind_param($stmt_cek, "i", $mahasiswa_id);
    mysqli_stmt_execute($stmt_cek);
    $result_cek = mysqli_stmt_get_result($stmt_cek);
    $data_cek = mysqli_fetch_assoc($result_cek);

    if ($data_cek['jumlah'] > 0) {
        // Jika sudah pernah vote, ubah pesan di dalam respon
        $response['message'] = 'Error: Anda sudah pernah memberikan suara!';
    } else {
        // 4. JIKA BELUM VOTE: Masukkan data suara baru ke dalam tabel 'votes'
        $sql_insert = "INSERT INTO votes (mahasiswa_id, pilihan_kandidat) VALUES (?, ?)";
        $stmt_insert = mysqli_prepare($koneksi, $sql_insert);
        mysqli_stmt_bind_param($stmt_insert, "ii", $mahasiswa_id, $pilihan);

        if (mysqli_stmt_execute($stmt_insert)) {
            // Jika berhasil, ubah status dan pesan di dalam respon
            $response['status'] = 'success';
            $response['message'] = 'Terima kasih, suara Anda telah berhasil direkam!';
        } else {
            // Jika gagal menyimpan karena alasan lain
            $response['message'] = 'Error: Terjadi kesalahan pada sistem saat menyimpan suara.';
        }
        mysqli_stmt_close($stmt_insert);
    }
    mysqli_stmt_close($stmt_cek);

} else {
    // Jika sesi tidak valid atau tidak ada data yang dikirim
    $response['message'] = 'Error: Sesi tidak valid atau tidak ada pilihan kandidat yang dibuat.';
}

mysqli_close($koneksi);

// 5. Kembalikan hasil dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
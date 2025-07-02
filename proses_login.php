<?php

session_start();


require 'koneksi.php';


$identifier = $_POST['identifier'];
$password_input = isset($_POST['password']) ? $_POST['password'] : '';


if (empty($identifier) || empty($password_input)) {
    header("Location: login.php?error=Username/NIM dan Password wajib diisi");
    exit();
}


//  PENGECEKAN UNTUK ADMIN (DENGAN STRUKTUR FINAL)

if ($identifier === 'admin123') {
    
 
    $sql_admin = "SELECT id, username, password FROM admins WHERE username = ?";
    $stmt_admin = mysqli_prepare($koneksi, $sql_admin);
    mysqli_stmt_bind_param($stmt_admin, "s", $identifier);
    mysqli_stmt_execute($stmt_admin);
    $result_admin = mysqli_stmt_get_result($stmt_admin);

    if (mysqli_num_rows($result_admin) === 1) {
        $admin = mysqli_fetch_assoc($result_admin);

        // Verifikasi password admin dengan HASH dari database
        if (password_verify($password_input, $admin['password'])) {
            // JIKA PASSWORD BENAR, buat SESI ADMIN
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            // Simpan USERNAME ke sesi untuk ditampilkan di dashboard
            $_SESSION['admin_username'] = $admin['username']; 

            // Arahkan ke dashboard admin dan hentikan skrip
            header("Location: dbadmin.php");
            exit();
        }
    }
} 

// PENGECEKAN UNTUK MAHASISWA (Tidak ada perubahan di sini)
$sql_mhs = "SELECT id, nama, password FROM mahasiswa WHERE nim = ?";
$stmt_mhs = mysqli_prepare($koneksi, $sql_mhs);
mysqli_stmt_bind_param($stmt_mhs, "s", $identifier);
mysqli_stmt_execute($stmt_mhs);
$result_mhs = mysqli_stmt_get_result($stmt_mhs);

if (mysqli_num_rows($result_mhs) === 1) {
    $mahasiswa = mysqli_fetch_assoc($result_mhs);

    if (password_verify($password_input, $mahasiswa['password'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['mahasiswa_id'] = $mahasiswa['id'];
        $_SESSION['mahasiswa_nama'] = $mahasiswa['nama'];
        $_SESSION['foto_filename'] = $mahasiswa['foto_profil'];
        if (!empty($mahasiswa['foto_profil'])) {
            $_SESSION['user_photo_path'] = 'uploads/' . $mahasiswa['foto_profil'];
        }
        header("Location: halaman_utama.php");
        exit();
    }
}


// JIKA SEMUA LOGIKA GAGAL: Beri pesan error umum

header("Location: login.php?error=Username/NIM atau Password salah");
exit();
?>
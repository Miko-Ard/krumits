<?php
// Selalu mulai sesi dan cek status login mahasiswa
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php?error=Anda harus login untuk mengakses halaman ini.");
    exit();
}

// Hubungkan ke database
require 'koneksi.php';

// Ambil ID mahasiswa dari sesi
$mahasiswa_id = $_SESSION['mahasiswa_id'];

// Ambil data lengkap mahasiswa dari database untuk ditampilkan di form
$sql = "SELECT nim, nama, foto_profil FROM mahasiswa WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $mahasiswa_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user_data = mysqli_fetch_assoc($result);

// Path untuk foto profil
// PERBAIKAN #1: Menggunakan path default yang konsisten
$path_foto = (!empty($user_data['foto_profil']) && file_exists('uploads/' . $user_data['foto_profil'])) ? 'uploads/' . $user_data['foto_profil'] : 'FOTO/default-avatar.png';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/halaman_profil.css"> <title>Profile Setting</title>
</head>
<body>
    <div class="web-display">
        <div class="Setting">
            <div class="Nav-Bar">
                <p style="color: white; font-weight: 700;" id="NavText">Kampus <span>Konnect</span></p>
            </div>
            <div class="container">
                <div class="layout-Setting">
                    <div class="Left-Menu">
                        <div class="user-Menu">
                            <ul>
                                <li id="hover-menu" class="active"><a href="halaman_profil.php"><img src="SourcePic/Profile_White.png" alt="">User</a></li>
                                <li id="hover-menu"><a href="logout.php"><img src="SourcePic/Logout.png" alt="">LogOut</a></li>
                            </ul>
                        </div>
                        <div class="Back">
                            <p id="hover-menu"><a href="halaman_utama.php"><img src="SourcePic/Back.png" alt="">Back</a></p>
                        </div>
                    </div>
                    <div class="Right-Setting">
                        <div class="Setting-Range">
                            <form action="proses_update_profil.php" method="POST" enctype="multipart/form-data">
                                <ul class="list-menu">
                                    <li><h1 style="font-size: 30px;">Your Profile</h1></li>

                                    <li class="Logo-Setting">
                                        <ul class="img-setting">
                                            <div class="img-flex">
                                                <li>
                                                    <img src="<?php echo htmlspecialchars($path_foto); ?>" alt="User-Img" id="user-logo">
                                                    <div style="font-size: 20px;">
                                                        <p class="Nama" style="font-weight: 700;"><?php echo htmlspecialchars($user_data['nama']); ?></p>
                                                        <p class="Nim" style="color: #ffa600;"><?php echo htmlspecialchars($user_data['nim']); ?></p>
                                                    </div>
                                                </li>
                                            </div>
                                            <div class="img-flex">
                                                <label for="foto_profil_input" class="btn-change" style="cursor:pointer;">Change</label>
                                                <input type="file" name="foto_profil" id="foto_profil_input" style="display:none;">
                                            </div>
                                        </ul>
                                    </li>
                                    <li><hr></li>

                                    <li class="SettingMain">
                                        <div class="form-group">
                                            <label for="nama">Nama:</label>
                                            <input type="text" id="nama" name="nama" class="textbox" value="<?php echo htmlspecialchars($user_data['nama']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nim">NIM:</label>
                                            <input type="text" id="nim" class="textbox" value="<?php echo htmlspecialchars($user_data['nim']); ?>" readonly>
                                            <small>NIM tidak dapat diubah.</small>
                                        </div>
                                        
                                        <p style="margin-top:20px; font-size:14px; color:#555;">Kosongkan password jika tidak ingin mengubahnya.</p>
                                        <div class="form-group">
                                            <label for="new_password">Password Baru:</label>
                                            <input type="password" id="new_password" name="new_password" class="textbox" placeholder="Masukkan password baru">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Konfirmasi Password Baru:</label>
                                            <input type="password" id="confirm_password" name="confirm_password" class="textbox" placeholder="Ketik ulang password baru">
                                        </div>
                                    </li>
                                    <li><hr></li>
                                    
                                    <li style="text-align: right;">
                                        <button type="submit" class="btn-save">Simpan Perubahan</button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="hp-display">
        </div>

    <script src="profileScript.js"></script>
</body>
</html>
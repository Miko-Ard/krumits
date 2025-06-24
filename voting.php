<?php
// 1. Memulai sesi dan memeriksa status login
session_start();

// Jika pengguna belum login, tendang ke halaman login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php?error=Anda harus login terlebih dahulu");
    exit();
}

// Ambil nama dari session untuk ditampilkan
$nama_mahasiswa = $_SESSION['mahasiswa_nama'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/voting.css">
    <title>Halaman Voting</title>
    
</head>
<body>
    <div class="voting-container">
        <h2>Halo, <?php echo htmlspecialchars($nama_mahasiswa); ?>!</h2>
        <p>Silakan berikan suara Anda untuk salah satu kandidat di bawah ini.</p>
        
        <?php if(isset($_GET['pesan'])) { 
            // Cek apakah pesan mengandung kata "Error" untuk styling
            $is_error = strpos($_GET['pesan'], 'Error') !== false;
        ?>
            <p class="pesan <?php if($is_error) echo 'error'; ?>">
                <?php echo htmlspecialchars($_GET['pesan']); ?>
            </p>
        <?php } ?>

        <form action="proses_vote.php" method="POST">
            <div class="kandidat-wrapper">
                <div class="kandidat-card">
                    <h3>Kandidat A</h3>
                    <p>Visi & Misi Kandidat A akan ditampilkan di sini.</p>
                    <button type="submit" name="pilihan_kandidat" value="1" class="btn">Vote Kandidat A</button>
                </div>
                <div class="kandidat-card">
                    <h3>Kandidat B</h3>
                    <p>Visi & Misi Kandidat B akan ditampilkan di sini.</p>
                    <button type="submit" name="pilihan_kandidat" value="2" class="btn">Vote Kandidat B</button>
                </div>
            </div>
        </form>
        <a href="logout.php" class="logout-link">Logout</a>
    </div>
</body>
</html>
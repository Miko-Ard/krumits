<?php

session_start();


$_SESSION['username'] = 'Admin';




if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {

    die("AKSES DITOLAK: Anda harus login sebagai admin untuk mengakses halaman ini.");
}


require 'koneksi.php';

// Ambil data 5 respons terakhir dari database
$sql_last_responses = "SELECT m.nim, m.nama, v.pilihan_kandidat, v.waktu_vote 
                       FROM votes v 
                       JOIN mahasiswa m ON v.mahasiswa_id = m.id
                       ORDER BY v.waktu_vote DESC
                       LIMIT 5"; // Kita batasi hanya 5 data terbaru

$result_last_responses = mysqli_query($koneksi, $sql_last_responses);
$bulan = date('m'); // Angka bulan saat ini (misal: 06)
$tahun = date('Y'); // Angka tahun saat ini (misal: 2025)
$jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

// Menentukan hari pertama dalam bulan ini jatuh pada hari ke berapa dalam seminggu
// 0 untuk Minggu, 1 untuk Senin, ..., 6 untuk Sabtu
$timestamp_hari_pertama = mktime(0, 0, 0, $bulan, 1, $tahun);
$hari_pertama_minggu_ke = date('w', $timestamp_hari_pertama);

// Mendapatkan tanggal hari ini (hanya angkanya)
$hari_ini = date('j');

// Mendapatkan nama bulan lengkap (e.g., "June")
$nama_bulan_lengkap = date('F', $timestamp_hari_pertama);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/db.css" /> 
</head>
<body>
    <aside class="sidebar">
      <nav class="sidebar-nav">
        <div class="sidebar-header">
          <span class="logo">VOTE ADMIN</span>
        </div>
        <ul class="sidebar-menu">
          <li class="menu-heading">MENU</li>
          <li class="active">
            <a href="dbadmin.php">
              <svg viewBox="0 0 24 24"><path d="M3,13H11V3H3M3,21H11V15H3M13,21H21V11H13M13,3V9H21V3"></path></svg>
              <span>Dashboard</span>
            </a>
          </li>
          <li>
            <a href="dbadmin2.php">
              <svg viewBox="0 0 24 24"><path d="M16,11V5A1,1 0 0,0 15,4H4A2,2 0 0,0 2,6V18A2,2 0 0,0 4,20H15A1,1 0 0,0 16,19V13L22,16V8L16,11M14,18H4V6H14V18Z"></path></svg>
              <span>Report</span>
            </a>
          </li>
          <li>
            <a href="dbadmin3.php">
              <svg viewBox="0 0 24 24"><path d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.41,8.68 6.34,8.97 6.34,9.28C6.34,11.23 7.94,12.83 9.89,12.83C10.2,12.83 10.49,12.76 10.75,12.64C11,13.09 11.5,13.56 12,14C12.5,13.56 13,13.09 13.25,12.64C13.51,12.76 13.8,12.83 14.11,12.83C16.06,12.83 17.66,11.23 17.66,9.28C17.66,8.97 17.59,8.68 17.47,8.42C17.92,8.15 18.44,8 19,8C19.55,8 20.08,8.15 20.53,8.42C20.41,8.68 20.34,8.97 20.34,9.28C20.34,11.72 18.28,13.78 15.84,13.78C15.54,13.78 15.24,13.73 14.95,13.64C14.2,14.83 13.11,15.75 12,16.17C10.89,15.75 9.8,14.83 9.05,13.64C8.76,13.73 8.46,13.78 8.16,13.78C5.72,13.78 3.66,11.72 3.66,9.28C3.66,8.97 3.59,8.68 3.47,8.42C3.92,8.15 4.45,8 5,8Z"></path></svg>
              <span>Responses</span>
            </a>
          </li>
          <li class="menu-heading">TOOLS</li>
          <li>
            <a href="dbadmin4.php">
              <svg viewBox="0 0 24 24"><path d="M12,8A4,4 0 0,1 16,12A4,4 0 0,1 12,16A4,4 0 0,1 8,12A4,4 0 0,1 12,8M12,10A2,2 0 0,0 10,12A2,2 0 0,0 12,14A2,2 0 0,0 14,12A2,2 0 0,0 12,10M10,22C9.75,22 9.54,21.82 9.5,21.58L9.13,18.93C8.5,18.68 7.96,18.34 7.45,17.9L4.94,18.95C4.73,19.03 4.46,18.95 4.34,18.73L2.34,15.27C2.21,15.05 2.27,14.78 2.46,14.63L4.57,12.97L4.5,12.5C4.5,12.33 4.5,12.17 4.5,12C4.5,11.83 4.5,11.67 4.5,11.5L4.57,11.03L2.46,9.37C2.27,9.22 2.21,8.95 2.34,8.73L4.34,5.27C4.46,5.05 4.73,4.96 4.94,5.05L7.45,6.1C7.96,5.66 8.5,5.32 9.13,5.07L9.5,2.42C9.54,2.18 9.75,2 10,2H14C14.25,2 14.46,2.18 14.5,2.42L14.87,5.07C15.5,5.32 16.04,5.66 16.55,6.1L19.06,5.05C19.27,4.96 19.54,5.05 19.66,5.27L21.66,8.73C21.79,8.95 21.73,9.22 21.54,9.37L19.43,11.03L19.5,11.5C19.5,11.67 19.5,11.83 19.5,12C19.5,12.17 19.5,12.33 19.5,12.5L19.43,12.97L21.54,14.63C21.73,14.78 21.79,15.05 21.66,15.27L19.66,18.73C19.54,18.95 19.27,19.04 19.06,18.95L16.55,17.9C16.04,18.34 15.5,18.68 14.87,18.93L14.5,21.58C14.46,21.82 14.25,22 14,22H10Z"></path></svg>
              <span>Settings</span>
            </a>
          </li>
        </ul>
      </nav>
      <div class="logout-section">
        <ul class="sidebar-menu">
          <li>
            <a href="logout.php">
              <svg viewBox="0 0 24 24"><path d="M16,17V14H9V10H16V7L21,12L16,17M14,2A2,2 0 0,1 16,4V6H14V4H5V20H14V18H16V20A2,2 0 0,1 14,22H5A2,2 0 0,1 3,20V4A2,2 0 0,1 5,2H14Z"></path></svg>
              <span>Log out</span>
            </a>
          </li>
        </ul>
      </div>
      </aside>

    <main class="main-content">
        <header class="header">
            <div class="header-title">
                <h1>Hello Admin</h1>
                <p><?php echo date('l, d F Y'); ?></p>
            </div>
            <div class="admin-profile">
                <img src="FOTO/default.png" alt="Admin Avatar" />
                <div class="admin-info">
                    <div class="name"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
                    <div class="role">Admin</div>
                </div>
            </div>
        </header>

        <div class="dashboard-body">
            <div class="main-column">
              <div class="section-header">
                    <h3>Last response</h3>
                    <a href="dbadmin3.php">View All ></a>
                </div>
                <div class="response-list">
                    <div class="list-header">
                        <div>NIM</div>
                        <div>Name</div>
                        <div>Vote</div>
                        <div>Voting Date</div>
                    </div>
                    <?php
                    if (mysqli_num_rows($result_last_responses) > 0) {
                        while($row = mysqli_fetch_assoc($result_last_responses)) {
                    ?>
                            <div class="list-item">
                                <div><?php echo htmlspecialchars($row['nim']); ?></div>
                                <div><?php echo htmlspecialchars($row['nama']); ?></div>
                                <div><?php echo htmlspecialchars($row['pilihan_kandidat']); ?></div>
                                <div><?php echo date('d-m-Y', strtotime($row['waktu_vote'])); ?></div>
                            </div>
                    <?php
                        } // Akhir loop
                    } else {
                        echo "<p style='text-align:center; padding: 20px;'>Belum ada data vote yang masuk.</p>";
                    }
                    ?>
                </div>
            </div>
            <div class="side-column">
                <div class="calendar-card">
                    <div class="calendar-header">
                        <button class="calendar-nav">‹</button>
                        <h4><?php echo $nama_bulan_lengkap . ' ' . $tahun; ?></h4>
                        <button class="calendar-nav">›</button>
                    </div>
                    <div class="calendar-grid">
                        <div class="calendar-weekdays">
                            <span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span>
                        </div>
                        <div class="calendar-dates">
                            <?php
                            // 1. Cetak sel kosong untuk hari sebelum tanggal 1
                            for ($i = 0; $i < $hari_pertama_minggu_ke; $i++) {
                                echo "<span></span>";
                            }

                            // 2. Cetak semua tanggal di bulan ini
                            for ($tanggal = 1; $tanggal <= $jumlah_hari; $tanggal++) {
                                // Beri class 'today' jika tanggalnya sama dengan hari ini
                                $class_hari_ini = ($tanggal == $hari_ini) ? 'today' : '';
                                echo "<span class='{$class_hari_ini}'>{$tanggal}</span>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
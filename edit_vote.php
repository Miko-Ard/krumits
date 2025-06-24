<?php


session_start();
// Proteksi halaman, pastikan admin sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php?error=Anda harus login sebagai admin.");
    exit();
}
require 'koneksi.php';

// Validasi ID vote dari URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dbadmin3.php?pesan=Error: ID vote tidak ditemukan.");
    exit();
}
$vote_id = $_GET['id'];

// Ambil data vote yang spesifik dari database berdasarkan ID
$sql = "SELECT v.id as vote_id, m.nim, m.nama, v.pilihan_kandidat 
        FROM votes v 
        JOIN mahasiswa m ON v.mahasiswa_id = m.id
        WHERE v.id = ?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $vote_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$vote_data = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan, tendang kembali
if (!$vote_data) {
    header("Location: dbadmin3.php?pesan=Error: Data vote tidak ditemukan.");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - Edit Vote</title>
    <link rel="stylesheet" href="css/db.css" /> <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        /* Tambahan style khusus untuk form jika diperlukan */
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
        }
        .form-group input:disabled {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <aside class="sidebar">
      <nav class="sidebar-nav">
        <div class="sidebar-header">
          <span class="logo">VOTE ADMIN</span>
        </div>
        <ul class="sidebar-menu">
          <li class="menu-heading">MENU</li>
          <li>
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
          <li class="active">
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
      </aside>

    <main class="main-content">
        <header class="header">
            <div class="header-title">
                <h1>Edit Response</h1>
                <p>Mengubah data vote yang sudah masuk</p>
            </div>
            <div class="admin-profile">
                <img src="https://i.pravatar.cc/40?u=admin" alt="Admin Avatar" />
                <div class="admin-info">
                    <div class="name"><?php echo htmlspecialchars($_SESSION['admin_username']); ?></div>
                    <div class="role">Admin</div>
                </div>
            </div>
        </header>

        <div class="card" style="padding: 30px;">
            <form action="proses_update_vote.php" method="POST">
                <input type="hidden" name="vote_id" value="<?php echo $vote_data['vote_id']; ?>">

                <div class="form-group">
                    <label>NIM Mahasiswa</label>
                    <input type="text" value="<?php echo htmlspecialchars($vote_data['nim']); ?>" readonly disabled>
                </div>

                <div class="form-group">
                    <label>Nama Mahasiswa</label>
                    <input type="text" value="<?php echo htmlspecialchars($vote_data['nama']); ?>" readonly disabled>
                </div>
                
                <div class="form-group">
                    <label for="pilihan_kandidat">Ubah Pilihan Kandidat</label>
                    <select id="pilihan_kandidat" name="pilihan_kandidat" required>
                        <option value="1" <?php if($vote_data['pilihan_kandidat'] == 1) echo 'selected'; ?>>
                            Kandidat A
                        </option>
                        <option value="2" <?php if($vote_data['pilihan_kandidat'] == 2) echo 'selected'; ?>>
                            Kandidat B
                        </option>
                        </select>
                </div>
                
                <div class="form-actions" style="margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border:none; border-radius: 5px; cursor:pointer; background-color: var(--primary-color); color: white;">Update Vote</button>
                    <a href="dbadmin3.php" style="margin-left: 10px; text-decoration: none; color: var(--text-color-light);">Batal</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
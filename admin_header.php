<?php
// Selalu mulai sesi di baris paling atas
session_start();

// Proteksi Halaman: Cek apakah admin sudah login
// Jika belum, akan ditendang ke halaman login.
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login_admin.php?error=Akses ditolak, Anda harus login!");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - <?php echo $pageTitle; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* PASTE SEMUA KODE CSS YANG PERNAH KITA BUAT UNTUK DASHBOARD DI SINI */
        :root {
            --primary-color: #6a5af9;
            --background-color: #f4f5f7;
            --white-color: #ffffff;
            --text-color: #333;
            --gray-color: #888;
            /* ...dan seterusnya... */
        }
        body { margin: 0; font-family: 'Poppins', sans-serif; display: flex; /* ... */ }
        /* ... semua gaya lainnya ... */
    </style>
</head>
<body>
    <aside class="sidebar">
        <div>
            <div class="sidebar-header"><span class="logo">ADMIN VOTE</span></div>
            <ul class="sidebar-menu">
                <li class="<?php if ($currentPage == 'dashboard') { echo 'active'; } ?>">
                    <a href="dbadmin.php">Dashboard</a>
                </li>
                <li class="<?php if ($currentPage == 'report') { echo 'active'; } ?>">
                    <a href="dbadmin2.php">Report</a>
                </li>
                <li class="<?php if ($currentPage == 'responses') { echo 'active'; } ?>">
                    <a href="dbadmin3.php">Responses</a>
                </li>
            </ul>
        </div>
        <ul class="sidebar-menu">
            <li class="<?php if ($currentPage == 'settings') { echo 'active'; } ?>">
                <a href="dbadmin4.php">Settings</a>
            </li>
        </ul>
        <div class="logout-section">
            <a href="logout_admin.php">Log out</a>
        </div>
    </aside>
    
    <main class="main-content">
        ```

#### 2. Membuat Footer Admin (`admin_footer.php`)

File ini sangat sederhana, hanya berisi tag-tag penutup.

**Tindakan:** Buat file baru bernama `admin_footer.php`.

```php
        </main>
</body>
</html>
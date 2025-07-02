<?php
// File: navbar.php
// File ini akan di-include, jadi tidak perlu session_start() di sini.
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="stylesheet" href="css/nav-bar-logout.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kampus Konnect</title>
</head>
<body>
<?php
// File: navbar.php
// Versi final yang sudah dibersihkan dari tag <html>, <head>, <body>
// dan disesuaikan dengan ID yang dibutuhkan oleh JavaScript.
?>
<div class="head">
    <div class="SideBar" id="sidebar">
        <ul>
            <li id="backButton"><a href="#"><img src="FOTO/Back-Button Black.png" alt="" id="but-nav">Back</a></li>
            <li><a href="halaman_utama.php#Home"><p>Home</p></a></li>
            <li><a href="about-us.php"><p>About Us</p></a></li>
            <li><a href="#contact"><p>Contact Us</p></a></li>
            
            <?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true): ?>
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
            <?php else: ?>
                <li><a href="logout.php">Log Out</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="navBar">
        <ul class="left">
            <li><a href="halaman_utama.php"><img src="FOTO/Kamp-color-blackblue.png" id="logo" alt="Logo"></a></li>
            <li class="hide-onMobile1"><a href="halaman_utama.php#Home"><p>Home</p></a></li>
            <li class="hide-onMobile1"><a href="about-us.php"><p>About Us</p></a></li>
            <li class="hide-onMobile1"><a href="#contact"><p>Contact Us</p></a></li>
        </ul>
        <ul class="right">

            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) : ?>
                <li class="hide-onMobile">
                    <div class="profile-dropdown-container" id="profileDropdownContainer">
                        <a href="halaman_profil.php" class="profile-link" title="Pengaturan Profil">
                            <?php
                            $path_foto_profil = 'FOTO/default-avatar.png'; 
                            if (isset($_SESSION['user_photo_path']) && !empty($_SESSION['user_photo_path']) && file_exists($_SESSION['user_photo_path'])) {
                                $path_foto_profil = $_SESSION['user_photo_path'];
                            }
                            ?>
                            <img src="<?php echo htmlspecialchars($path_foto_profil); ?>" class="Profile-img" alt="Profil" style="width: 50px; height:50px; border-radius: 50px; object-fit: cover;">
                        </a>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="halaman_profil.php">Profile Settings</a>
                            <a href="logout.php">Log Out</a>
                        </div>
                    </div>
                </li>
                
            <?php else : ?>
                <li class="hide-onMobile"><a href="signup.php" id="sign">Sign Up</a></li>
                <li class="hide-onMobile"><a href="login.php" id="login">Login</a></li>
            <?php endif; ?>
            
            <li class="Menu-List" id="menuButton"><a href="#"><img src="FOTO/menu-sort black.png" alt="Menu" id="but-nav"></a></li>
        </ul>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // Variabel untuk elemen-elemen yang dibutuhkan
  const profileDropdownContainer = document.getElementById('profileDropdownContainer');
  const dropdownMenu = document.getElementById('dropdownMenu');
  const menuButton = document.getElementById('menuButton');
  const sidebar = document.getElementById('sidebar');
  const backButton = document.getElementById('backButton');

  // Logika untuk Dropdown Profil (hanya berjalan jika elemennya ada)
  if (profileDropdownContainer) {
    profileDropdownContainer.addEventListener('click', function (event) {
      event.stopPropagation();
      dropdownMenu.classList.toggle('show');
    });
  }

  // Logika untuk menutup dropdown jika klik di luar
  window.addEventListener('click', function (event) {
    if (dropdownMenu && !profileDropdownContainer.contains(event.target)) {
      dropdownMenu.classList.remove('show');
    }
  });

  // Logika untuk Tombol Menu (hamburger)
  if (menuButton) {
    menuButton.addEventListener('click', function (e) {
      e.preventDefault();
      if(sidebar) sidebar.classList.add('show');
      if(dropdownMenu) dropdownMenu.classList.remove('show'); // Tutup dropdown jika terbuka
    });
  }

  // Logika untuk Tombol Back di dalam sidebar
  if (backButton) {
    backButton.addEventListener('click', function (e) {
      e.preventDefault();
      if(sidebar) sidebar.classList.remove('show');
    });
  }
});
</script>
</body>
</html>
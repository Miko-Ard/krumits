<?php

?><!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kampus Konnect - Sign Up</title>
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <div class="container">
      <!-- Kiri -->
      <div class="left-panel">  
        <div class="logo">
          <img src="FOTO/krumits_putih.png" alt="Logo Kampus Konnect" />
        </div>
        <div class="welcome">
          <h1><span class="wel">WEL</span>COME TO</h1>
          <h1>KAMPUS <span class="konn">KONNECT</span></h1>
          <p>Login atau daftar sekarang, dan jadilah bagian dari perubahan ini!</p>
          <link rel="stylesheet" href="stylesignup.css" />

          <a href="signup.php" class="btn btn-login">SIGN UP</a>
        </div>
      </div>

      <!-- Kanan -->
      <div class="right-panel">
        <!-- FORM CUMA DIBUKA SEKALI -->
        <form class="form-container" action="proses_login.php" method="POST">
        <h2>LOG IN</h2>
        <p>Gabung ke Kampus Konnect</p>
        <?php if(isset($_GET['error'])) { ?>
            <p class="error" ><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php } ?>
            
          <label for="nim">NIM</label>
          <input type="text" id="identifier" name="identifier" required />

          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />

          <div class="terms">
            <input type="checkbox" id="terms" required />
            <label for="terms">Saya menyetujui <a href="#">Syarat</a> & <a href="#">Ketentuan</a></label>
          </div>

          <button type="submit" class="btn btn-signup">LOGIN</button><br>
          <p id="onmobile">Belum punya akun? <a href="signup.php">Klik disini!</a></p>
        </form>
      </div>
    </div>
  </body>
</html>

<?php

?><!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kampus Konnect - Sign Up</title>
    <link rel="stylesheet" href="css/signup.css" />
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

          <a href="login.php" class="btn btn-login">LOG IN</a>
        </div>
      </div>

      <!-- Kanan -->
      <div class="right-panel">
        <!-- FORM CUMA DIBUKA SEKALI -->
        <form class="form-container" action="proses_signup.php" method="POST">
          <h2>SIGN UP</h2>
          <p>Gabung ke Kampus Konnect</p>

          <label for="nama">Nama</label>
          <input type="text" id="nama" name="nama" required />

          <label for="nim">NIM</label>
          <input type="text" id="nim" name="nim" required />

          <label for="password">Password</label>
          <input type="password" id="password" name="password" required />

          <div class="terms">
            <input type="checkbox" id="terms" required />
            <label for="terms">Saya menyetujui <a href="#">Syarat</a> & <a href="#">Ketentuan</a></label>
          </div>

          <button type="submit" class="btn btn-signup">SIGN UP</button><br>
        <p id="onmobile">Sudah punya akun? <a href="login.php">Klik disini!</a></p>  
        </form>
      </div>
    </div>
  </body>
</html>

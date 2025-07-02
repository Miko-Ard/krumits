<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kampus Konnect</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <!-- Header -->
    <header class="header">
        <img src="FOTO/krumits_putih.png" alt="Kampus Konnect Logo" class="logo" />
        <nav class="navbar">
        <a href="#">Home</a>
        <a href="#">About Us</a>
        <a href="#">Our Team</a>
        </nav>
        <div class="auth-buttons">
        <button class="login" ><a href="login.php">LOGIN</a></button>
        <button class="signup"><a href="signup.php">SIGN UP</a></button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
        <div class="hero-text-box">
            <h2>Hollaa There!</h2>
            <p>
            Welcome to our community! Here you'll find exciting events, projects,
            and the chance to voice your opinions on campus matters. Your vote counts,
            and your participation shapes our future. Join us in building a better campus environment.
            </p>
        </div>
        <img src="FOTO/Keqing.png" alt="Mascot" class="hero-character" />
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about">
    <div class="about-container">
        <div class="about-text">
        <h2>About <span style="color: #FF1166;"> Us </span> </h2> 
        <p>
            Selamat datang di Kampus Konnect, platform tepercaya untuk voting pemilihan yang memudahkan partisipasi Anda dalam menentukan hasil penting. Kami menyediakan antarmuka ramah pengguna untuk menjelajahi acara, memberikan suara, dan berinteraksi dengan komunitas. 
            Dengan komitmen pada transparansi dan keadilan, kami memastikan setiap suara bermakna. Bergabunglah bersama kami untuk membentuk masa depan melalui partisipasi aktif—suara Anda penting!
        </p>
        </div>
        <div class="about-logo">
        <img src="FOTO/krumits_putih.png" alt="Kampus Konnect Large Logo" />
        </div>
    </div>
    </section>

    <!-- Our Team Section -->
    <section class="team"><br>
    <h2><center>Our Team</center></h2>
    <div class="container">
        <div class="team-panels">
          <div class="team-card" style="--i:0">
            <div class="blur-bg" style="background-image: url('FOTO/banu.png');"></div>
            <div class="logo1"><img src="FOTO/back-end.png" alt="Back End" style="width:40px; height:auto;margin-left:20px;"/></div>
          </div>
          <div class="team-card" style="--i:1">
            <div class="blur-bg" style="background-image: url('FOTO/bintang.png');"></div>
            <div class="logo1"><img src="FOTO/database.png" alt="Database" style="width:40px; height:auto;margin-left:20px;"/></div>
          </div>
          <div class="team-card" style="--i:2">
            <div class="blur-bg" style="background-image: url('FOTO/miko.png');"></div>
            <div class="logo1"><img src="FOTO/project-manager.png" alt="Project Manager" style="width:40px; height:auto;margin-left:20px;"/></div>
          </div>
          <div class="team-card" style="--i:3">
            <div class="blur-bg" style="background-image: url('FOTO/micdan.png');"></div>
            <div class="logo1"><img src="FOTO/github.png" alt="GitHub Manager" style="width:40px; height:auto;margin-left:20px;"/></div>
          </div>
          <div class="team-card" style="--i:4">
            <div class="blur-bg" style="background-image: url('FOTO/akbar.png');"></div>
            <div class="logo1"><img src="FOTO/ui.png" alt="Front End" style="width:40px; height:auto;margin-left:20px;"/></div>
          </div>
        </div>
    </div>
    </section>

    <!-- Pop-up Info Box -->
    <div id="popup" class="popup hidden">
    <h3 id="popup-name"></h3>
    <p id="popup-role"></p>
    <p><strong>NIM:</strong> <span id="popup-nim"></span></p>
    </div>

    <div class="Footer">

            <div class="logo-footer">
                <div class="img-logo">
                    <img src="FOTO/krumits_putih.png" id="footer-logo">
                </div>
            </div>

            <div class="text-footer">
                <div class="main-text">
                    <ul id="list-footer">
                        <li id="seconnd-footer">
                            <ul style="list-style: none;">
                                <li>
                                    <h2>Help Center</h2><br>
                                    <p>Contact: </p>
                                    <p>Gmail</p>
                                </li>
                                <li>
                                    <h2>Follow Us</h2><br>
                                    <p>Youtube: Kampus Konnect </p>
                                    <p>Instagram: @kampus_konnect</p>
                                    <p>X: kampus_konnect</p>
                                </li>
                                </li>
                            </ul>
                        </li>
                        <li id="first-footer">
                            <p><a href="">Terms and Service</a></p>
                            <p><a href="">Privacy Police</a></p>
                            <p><a href="">Cookies Policy</a></p>
                            <p><a href="">License Policy</a></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    
    <script src="piccel.js"></script>
</body>
<!--<script src="piccel.js"></script>-->
</html>

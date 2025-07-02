<?php
// 1. Selalu mulai sesi di baris paling atas file
// Ini agar PHP bisa membaca apakah ada data sesi yang tersimpan atau tidak.
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/halaman_utama.css" />
  <title>Kampus Konnect</title>
</head>
<body>

    <!-- Header -->
    <header class="header">
        <?php include 'nav-bar-logout.php';?>
    </header>

    <!-- InformationPanel Section -->
    <section class="InformationPanel" id="Home">
        <div class="Innformationn-panel">
            <div class="inf-content">
                <ul id="PanelSwapper">
                    <li class="SwapperContorl"><a href="#" id="prevBtn"><img src="FOTO/Button/Arrow-Left.png" alt="left" class="Button-swap"></a></li>
                    <!--Pannel Satu-->
                    <li class="MainPanel active-panel" style="background-image: url(FOTO/Home-Information.png);">
                        <div class="Main-Content scrollable-box">
                          <h2>HOLLA <span style="color: #5271FF;">THERE !</span></h2>
                          <h4>
                               Welcome to our community! Here, your voice matters—join exciting events and cast your vote to make a real impact. Explore upcoming activities, stay informed, and connect with others who share your passion. Whether you’re voting for your favorites or participating in events, we’re here to support you every step of the way. Get involved, have fun, and let’s make great things happen together!
                          </h4>
                        </div>

                        <div class="Img-Contet">
                            <img src="FOTO/Keqing.png" alt="" class="/img-content-maskot">
                        </div>
                    </li>

                    <!--Pannel Dua-->
                    
                    <li class="MainPanel" style="background-image: url(FOTO/Home-Information-2.png);">
                        <div class="Main-Content scrollable-box">
                            <h2>HOLLA <span style="color: #5271FF;">THERE !</span></h2>
                            <h4>
                                Welcome to our community! Here, your voice matters—join exciting events and cast your vote to make a real impact. Explore upcoming activities, stay informed, and connect with others who share your passion. Whether you’re voting for your favorites or participating in events, we’re here to support you every step of the way. Get involved, have fun, and let’s make great things happen together!
                                
                            </h4>
                            <a href="vote-section.php">Klik disini!</a>
                        </div>
                        
                        <div class="Img-Contet">
                            <img src="FOTO/Miko.png" alt="" class="img-content-maskot">
                        </div>
                    </li>
                
                    
                    <!--Pannel Tiga-->
                    <li class="MainPanel" style="background-image: url(FOTO/Home-Information-3.png);">
                        <div class="Main-Content scrollable-box">
                            <h2>HOLLA <span style="color: #5271FF;">THERE !</span></h2>
                            <h4>
                                Welcome to our community! Here, your voice matters—join exciting events and cast your vote to make a real impact. Explore upcoming activities, stay informed, and connect with others who share your passion. Whether you’re voting for your favorites or participating in events, we’re here to support you every step of the way. Get involved, have fun, and let’s make great things happen together!
                            </h4>
                        </div>
                        
                        <div class="Img-Contet">
                            <img src="FOTO/Donate.png" alt="" class="img-content-maskot">
                        </div>
                    </li>

                    <li class="SwapperContorl"><a href="#" id="nextBtn"><img src="FOTO/Button/Arrow-Right.png" alt="right" class="Button-swap"></a></li>
                </ul>
            </div>
        </div>

    </section>

    <!-- About Us Section -->
    <section class="about" id="about-us">
        <div class="about-container">
            <div class="About-Text scrollable-box-about">
                <div class="Texta">
                    <h2 style="color: black;" id="JudulAbout">About <span style="color: #FF1166;">Us</span></h2><br>
                    <p style="color: #000;" id="TeksAbout">Selamat datang di Kampus Konnect, 
                        platform tepercaya untuk voting pemilihan yang memudahkan partisipasi Anda dalam menentukan hasil penting. 
                        Kami menyediakan antarmuka ramah pengguna untuk menjelajahi acara, memberikan suara, dan berinteraksi dengan komunitas. 
                        Dengan komitmen pada transparansi dan keadilan, kami memastikan setiap suara bermakna. 
                        Bergabunglah bersama kami untuk membentuk masa depan melalui partisipasi aktif—suara Anda penting!</p>
                </div>
            </div>
            <div class="img-about">
                <img src="FOTO/Kamp-color-blackblue.png" alt="logo" id="about-logo">
            </div>
        </div>
    </section>

    <!-- Our Team Section -->
    <section class="team">
        <h2><center style="font-size: 30px;">Our Team</center></h2>
        <div class="container">
            <div class="team-panels">
              <div class="team-card" style="--i:0">
                <div class="blur-bg" style="background-image: url('FOTO/banu.png');"></div>
                <div class="logo1"><img src="FOTO/Back_End.png" alt="Back End" style="width:40px; height:auto;margin-left:20px;"/></div>
              </div>
              <div class="team-card" style="--i:1">
                <div class="blur-bg" style="background-image: url('FOTO/bintang.png');"></div>
                <div class="logo1"><img src="FOTO/Database.png" alt="Database" style="width:40px; height:auto;margin-left:20px;"/></div>
              </div>
              <div class="team-card" style="--i:2">
                <div class="blur-bg" style="background-image: url('FOTO/miko.png');"></div>
                <div class="logo1"><img src="FOTO/Maager.png" alt="Project Manager" style="width:40px; height:auto;margin-left:20px;"/></div>
              </div>
              <div class="team-card" style="--i:3">
                <div class="blur-bg" style="background-image: url('FOTO/bersama.jpeg');"></div>
                <div class="logo1"><img src="FOTO/Group.png" alt="GitHub Manager" style="width:40px; height:auto;margin-left:20px;"/></div>
              </div>
              <div class="team-card" style="--i:4">
                <div class="blur-bg" style="background-image: url('FOTO/micdan.png');"></div>
                <div class="logo1"><img src="FOTO/github-mark.png" alt="Front End" style="width:40px; height:auto;margin-left:20px;"/></div>
              </div>
              <div class="team-card" style="--i:5">
                <div class="blur-bg" style="background-image: url('FOTO/akbar.png"></div>
                <div class="logo1"><img src="FOTO/Front-ed.png" alt="Front End" style="width:40px; height:auto;margin-left:20px;"/></div>
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


    <!-- Footer Section -->
    <div class="Footer" id="contact">
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
    </div>

    
    <script src="halaman.js"></script>
</body>
</html>

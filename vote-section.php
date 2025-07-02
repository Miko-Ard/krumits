<?php
// 1. Memulai sesi dan memeriksa status login
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php?error=Anda harus login terlebih dahulu");
    exit();
}
$nama_mahasiswa = $_SESSION['mahasiswa_nama'];

// Data Kandidat
$kandidat_data = [
    1 => ['nama' => '01<br>M.Miko Ardiansyah', 'gambar' => 'FOTO/kandidat1.png', 'visi' => 'Menjadikan kampus lebih inovatif dan kreatif.', 'misi' => "1. Meningkatkan fasilitas lab.\n2. Mengadakan workshop mingguan.\n3. Memperluas jaringan alumni."],
    2 => ['nama' => '02<br>Bintang Al Fathir', 'gambar' => 'FOTO/kandidat2.png', 'visi' => 'Mewujudkan lingkungan kampus yang suportif dan inklusif.', 'misi' => "1. Membentuk support group mahasiswa.\n2. Program beasiswa internal.\n3. Festival budaya tahunan."]
];
$kandidat_awal_id = 1;
$kandidat_awal_data = $kandidat_data[$kandidat_awal_id];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-vote.css">
    <title>Vote-Section</title>
</head>
<body>
    <div class="head">
        <div class="SideBar">
            <ul>
                <li onclick="HideSiderbar(event)" id="back"><a href="#"><img src="FOTO/Back-Button Black.png" alt="" id="but-nav">Back</a></li>
                <li><a href="#Home"><p>Home</p></a></li>
                <li><a href="#"><p>About Us</p></a></li>
                <li><a href="#"><p>Contact Us</p></a></li>
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
        <div class="navBar">
            <ul class="left">
                <li><a href="halaman_utama.php"><img src="FOTO/Kamp-color-blackblue.png" alt="" id="logo"></a></li>
                <li class="hide-onMobile1"><a href="#"><p>Home</p></a></li>
                <li class="hide-onMobile1"><a href="#"><p>About Us</p></a></li>
                <li class="hide-onMobile1"><a href="#"><p>Contact Us</p></a></li>
            </ul>
            <ul class="right">
                <li class="hide-onMobile"><a href="signup.php" id="sign">Sign Up</a></li>
                <li class="hide-onMobile"><a href="login.php" id="login">Login</a></li>
                <li class="Menu-List" onclick="ShowSideBar(event)" id="but-nav-li"><a href=""><img src="PicRef/menu-sort black.png" alt="" id="but-nav"></a></li>
            </ul>
        </div>
    </div>
    <div class="continer">
        <div class="Home-UI" id="Home">
            <div class="TextHeader">
                <p style="font-size: 20px;">Kampus <span style="color: black;">Konnect</span></p>
                <h2 id="Vote-Main-Text">LEADERSHIP <span id="voteText">VOTING</span></h2>
                <p style="font-size: 20px;">Your Vote, Our Future!</p>
            </div>
        </div>

        <div class="Leader-Candidate">
            <div class="CanditText">
                <h2 id="textMainVote">LEADERSHIP <span id="Candit-Text">CANDIDATE</span></h2>
            </div>

            <div class="showcase" >
              <div class="main-name-bg" id="nama-kandidat-bg"><?php echo $kandidat_awal_data['nama']; ?></div>

              <div class="left-panel">
                <div class="title-info">
                    <button class="visi-btn" id="tombol-lihat-visi-misi">Lihat Visi Misi</button>
                  <h1 id="nama-kandidat-utama"><?php echo $kandidat_awal_data['nama']; ?></h1>
                </div>
              </div>
            
              <div class="character-img">
                <img src="<?php echo $kandidat_awal_data['gambar'] ?>" id="gambar-kandidat" alt="Foto Kandidat">
              </div>
            
              <div class="selector-panel">
                <div class="char-icon active" data-id="1"><img src="FOTO/kandidat1.png" />A</div>
                <div class="char-icon" data-id="2"><img src="FOTO/kandidat2.png" />B</div>
              </div>
            </div>
        </div>

        
        <div class="RTX-Vote">
            <div class="RTX-Main" style="border: 2px solid red;">
                <ul class="RTX-TEXT">
                    <li id="mainC">
                        <img src="PicRef/Kamp-color-blackblue.png" alt="" style="width: 100px;">
                    </li>
                    <li id="TextMain">
                        <h2 style="padding: 0 20px;">LEADERSHIP <span id="TextMainRGB">VOTING</span></h2>
                    </li>
                </ul>
                
                <div class="Button-Vote">
    <form action="proses_vote.php" method="POST">
        <input type="hidden" id="pilihan-vote" name="pilihan_kandidat" value="1">
        <button type="submit" class="Button" id="tombol-vote-utama">VOTE</button>
    </form>
</div>
            </div>
        </div>

        <div class="Footer">

            <div class="logo-footer">
                <div class="img-logo">
                    <img src="PicRef/krumits_putih.png" alt="" id="footer-logo">
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

<div id="visiModal" class="modal">
    <div class="modal-content">
      <span class="close-btn" onclick="toggleModal()">&times;</span>
      <h3 id="modal-nama"></h3>
      <h2>Visi : </h2>
      <p id="modal-visi"></p>
      <h2>Misi : </h2>
      <p id="modal-misi"></p>
    </div>
  </div>
    <script>
      window.kandidatData = <?php echo json_encode($kandidat_data); ?>;
    </script>
    
    <script src="vote.js"></script>
</body>
</html>


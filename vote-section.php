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
    <header class="header">
        <?php include 'nav-bar-logout.php';?>
    </header>
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
            <div class="RTX-Main"">
                <ul class="RTX-TEXT">
                    <li id="mainC">
                        <img src="PicRef/Kamp-color-blackblue.png" alt="" style="width: 100px;">
                    </li>
                    <li id="TextMain">
                        <h2 style="padding: 0 20px;">LEADERSHIP <span id="TextMainRGB">VOTING</span></h2>
                    </li>
                </ul>
                
                <div class="Button-Vote">
    <form action="proses_vote.php" method="POST" id="voteForm">
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

<div id="errorPopup" class="custom-popup">
        <div class="popup-content error">
            <span class="popup-icon"><img src="FOTO/error-icon.png" alt="Error"></span>
            <div>
                <h2 class="popup-title">Error!</h2>
                <p class="popup-message"></p>
            </div>
            <span id="closeErrorPopup" class="popup-close">&times;</span>
        </div>
    </div>

    <div id="successPopup" class="custom-popup">
        <div class="popup-content success">
            <span class="popup-icon"><img src="FOTO/success-icon.png" alt="Success"></span>
            <div>
                <h2 class="popup-title">Berhasil!</h2>
                <p class="popup-message"></p>
            </div>
            <span id="closeSuccessPopup" class="popup-close">&times;</span>
        </div>
    </div>
  
    <script>
      window.kandidatData = <?php echo json_encode($kandidat_data); ?>;
      // Tangkap form voting
const voteForm = document.querySelector('form[action="proses_vote.php"]');

if (voteForm) {
    voteForm.addEventListener('submit', function (event) {
        // 1. Hentikan aksi default form (agar halaman tidak refresh)
        event.preventDefault();

        // 2. Siapkan data untuk dikirim
        const formData = new FormData(this);

        // 3. Kirim data ke proses_vote.php di latar belakang
        fetch('proses_vote.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Ubah respon menjadi JSON
        .then(data => {
            // 4. Tampilkan alert berdasarkan pesan dari PHP
            alert(data.message);

            // 5. Opsional: Jika sukses, nonaktifkan tombol vote
            if (data.status === 'success') {
                const voteButton = this.querySelector('button[type="submit"]');
                if(voteButton) {
                    voteButton.disabled = true;
                    voteButton.textContent = 'Terima Kasih';
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan koneksi saat mengirim suara.');
        });
    });
}
    </script>
    <script src="vote.js"></script>
</body>
</html>


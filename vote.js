function ShowSideBar(event) {
  event.preventDefault();
  document.querySelector(".SideBar").classList.add("show");
}

function HideSiderbar(event) {
  event.preventDefault();
  document.querySelector(".SideBar").classList.remove("show");
}

function NotUp(event) {
  event.preventDefault();
}

function toggleModal() {
  const modal = document.getElementById("visiModal");
  const isOpen = modal.style.display === "flex";

  if (isOpen) {
    modal.style.display = "none";
    document.body.style.overflow = "auto"; // biar scroll normal lagi
  } else {
    modal.style.display = "flex";
    document.body.style.overflow = "hidden"; // lock scroll body!
  }
}

// 1. Ambil data kandidat dari 'jembatan' di window, bukan dari PHP langsung
const dataKandidat = window.kandidatData;

// 2. Pilih semua elemen HTML yang kita butuhkan berdasarkan ID dan Class yang baru
const gambarKandidat = document.getElementById("gambar-kandidat");
const namaKandidatBg = document.getElementById("nama-kandidat-bg");
const namaKandidatUtama = document.getElementById("nama-kandidat-utama");
const pilihanVoteInput = document.getElementById("pilihan-vote");
const tombolVoteUtama = document.getElementById("tombol-vote-utama");
const switcherBoxes = document.querySelectorAll(".char-icon"); // Menargetkan class .char-icon

// Pop-up Elements
const modal = document.getElementById("visiModal");
const tombolLihatVisiMisi = document.getElementById("tombol-lihat-visi-misi");
const closeButton = document.getElementById("close-btn");
const modalNama = document.getElementById("modal-nama");
const modalVisi = document.getElementById("modal-visi");
const modalMisi = document.getElementById("modal-misi");

// 3. Fungsi untuk meng-update tampilan (tidak ada perubahan di sini)
function updateTampilan(id) {
  const kandidat = dataKandidat[id];

  gambarKandidat.src = kandidat.gambar;
  namaKandidatBg.innerHTML = kandidat.nama; // Gunakan innerHTML karena ada <br>
  namaKandidatUtama.innerHTML = kandidat.nama; // Gunakan innerHTML karena ada <br>
  pilihanVoteInput.value = id;
  tombolVoteUtama.textContent = "VOTE";

  switcherBoxes.forEach((box) => {
    box.classList.remove("active");
    if (box.dataset.id == id) {
      box.classList.add("active");
    }
  });
}

// 4. Tambahkan event listener untuk setiap kotak switcher
switcherBoxes.forEach((box) => {
  box.addEventListener("click", function () {
    const idKandidatDipilih = this.dataset.id;
    updateTampilan(idKandidatDipilih);
  });
});

// 5. Tambahkan event listener untuk pop-up visi & misi
tombolLihatVisiMisi.addEventListener("click", function (e) {
  e.preventDefault();
  const kandidatAktifId = pilihanVoteInput.value;
  const data = dataKandidat[kandidatAktifId];

  modalNama.innerHTML = data.nama; // Gunakan innerHTML
  modalVisi.textContent = data.visi;
  modalMisi.innerHTML = data.misi.replace(/\n/g, "<br>");

  modal.style.display = "flex";
});

// Event untuk tombol close modal
closeButton.addEventListener("click", function () {
  modal.style.display = "none";
});

// Event untuk menutup modal jika klik di luar kontennya
window.addEventListener("click", function (e) {
  if (e.target == modal) {
    modal.style.display = "none";
  }
});

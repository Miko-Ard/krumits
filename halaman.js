document.addEventListener("DOMContentLoaded", function () {
  // 1. Ambil semua elemen yang kita butuhkan
  const panels = document.querySelectorAll(".MainPanel");
  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");

  // 2. Tentukan state awal
  let currentIndex = 0;
  const totalPanels = panels.length;

  // 3. Buat fungsi untuk menampilkan panel berdasarkan index
  function showPanel(index) {
    // Pertama, sembunyikan semua panel dengan menghapus class 'active-panel'
    panels.forEach((panel) => {
      panel.classList.remove("active-panel");
    });

    // Kemudian, tampilkan panel yang diinginkan dengan menambahkan class 'active-panel'
    panels[index].classList.add("active-panel");
  }

  // 4. Tambahkan event listener untuk tombol "Next"
  nextBtn.addEventListener("click", function (e) {
    e.preventDefault(); // Mencegah link '#' berpindah halaman

    // Pindah ke index berikutnya
    currentIndex++;

    // Jika sudah di panel terakhir, kembali ke panel pertama
    if (currentIndex >= totalPanels) {
      currentIndex = 0;
    }

    // Tampilkan panel yang baru
    showPanel(currentIndex);
  });

  // 5. Tambahkan event listener untuk tombol "Previous"
  prevBtn.addEventListener("click", function (e) {
    e.preventDefault(); // Mencegah link '#' berpindah halaman

    // Pindah ke index sebelumnya
    currentIndex--;

    // Jika sudah di panel pertama, pindah ke panel terakhir
    if (currentIndex < 0) {
      currentIndex = totalPanels - 1;
    }

    // Tampilkan panel yang baru
    showPanel(currentIndex);
  });

  // 6. Tampilkan panel pertama saat halaman dimuat
  if (totalPanels > 0) {
    showPanel(currentIndex);
  }
});

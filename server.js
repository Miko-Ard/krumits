const express = require('express');
const path = require('path');
const app = express();
const PORT = 4000;


app.use('/css', express.static(path.join(__dirname, 'css')));
app.use('/FOTO', express.static(path.join(__dirname, 'FOTO')));
// Kirim dbadmin.html sebagai halaman utama
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'dbadmin.html'));
});

// Jalankan server
app.listen(PORT, () => {
  console.log(`Server berjalan di http://localhost:${PORT}`);
});

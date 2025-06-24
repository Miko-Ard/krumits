const mysql = require("mysql2");

const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "", // default XAMPP tanpa password
  database: "kampus_konnect", // ganti dengan nama database kamu
});

// Cek koneksi
db.connect((err) => {
  if (err) {
    console.error("Gagal konek ke database:", err);
  } else {
    console.log("Terhubung ke database MySQL (XAMPP)");
  }

  app.listen(PORT, "0.0.0.0", () => {
    console.log(`Server berjalan di http://localhost:${PORT}`);
  });
});

<?php

$password_asli = 'admin123';
$hash_password = password_hash($password_asli, PASSWORD_DEFAULT);

echo "Password Asli: " . $password_asli . "<br>";
echo "Hasil Hash (salin teks di bawah ini):<br>";
echo $hash_password;

?>
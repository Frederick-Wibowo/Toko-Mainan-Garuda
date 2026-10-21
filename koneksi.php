<?php
$host = "localhost";
$user = "root";       // Username bawaan XAMPP
$pass = "";           // Password bawaan XAMPP (biarkan kosong)
$db   = "garuda";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
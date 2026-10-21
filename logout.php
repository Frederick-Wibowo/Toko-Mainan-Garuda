<?php
session_start();
session_destroy(); // Menghapus data login
header("Location: home.php"); // Melempar user kembali ke halaman beranda
exit;
?>
<?php
session_start();

// Hapus semua session
session_unset();
session_destroy();

// Redirect ke halaman index
header('location: index.php');
exit();
?>
<!-- Memulai session.
Menghapus semua data session menggunakan session_unset().
Mengakhiri session dengan session_destroy().
Mengarahkan pengguna kembali ke halaman index menggunakan header(). -->
<?php
session_start();

if (!isset($_SESSION['session_username']) || empty($_SESSION['session_username'])) {
    header('location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
</head>
<body>
    <h1>Selamat Datang, <?php echo $_SESSION['session_username']; ?>!</h1>
    <p>Ini adalah halaman setelah login.</p>
    <a href="logout.php">Logout</a>
</body>
</html>

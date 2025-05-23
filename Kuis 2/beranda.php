<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
</head>
<body>
    <p>Ini beranda</p>
    <p>Selamat datang, <?php echo htmlspecialchars($user); ?>!</p>
    <a href="logout.php">Logout</a>
</body>
</html>
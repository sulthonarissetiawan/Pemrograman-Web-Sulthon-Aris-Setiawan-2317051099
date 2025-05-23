<?php
session_start();
include 'koneksi/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE name='$name'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['name'];
        header("Location: beranda.php");
        exit;
    } else {
        echo 'Login gagal';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
</head>
<body>
<form method="POST" action="">
    <label for="name">Name</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="password">Password</label><br>
    <input type="password" id="password" name="password"><br>
    <input type="submit" value="Login">
</form>
</body>
</html>

<?php
session_start();
include 'koneksi/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $password = $_POST['password'] ?? '';
    $foto = $_FILES['foto'] ?? null;
    if (empty($name) || empty($password) || !$foto) {
        echo "Semua field harus diisi";
    } else {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($foto['type'], $allowed_types)) {
            $upload_dir = 'uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            $file_name = uniqid() . '-' . basename($foto['name']);
            $target_file = $upload_dir . $file_name;
            if (move_uploaded_file($foto['tmp_name'], $target_file)) {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (name, password, foto) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $name, $password_hash, $file_name);
                if ($stmt->execute()) {
                    header("Location: login.php");
                    exit;
                } else {
                    echo "Gagal menyimpan data: " . $conn->error;
                }
                $stmt->close();
            } else {
                echo "Upload foto gagal";
            }
        } else {
            echo "Tipe file tidak diizinkan";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Register</title>
</head>
<body>
<form method="POST" action="" enctype="multipart/form-data">
    <label for="name">Name</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="password">Password</label><br>
    <input type="password" id="password" name="password" required><br>
    <label for="foto">Foto</label><br>
    <input type="file" id="foto" name="foto" accept="image/*" required><br>
    <input type="submit" value="Register">
</form>
</body>
</html>

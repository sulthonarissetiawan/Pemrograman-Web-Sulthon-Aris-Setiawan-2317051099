<?php
include "koneksi/db.php";
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM
mahasiswa WHERE id=$id"));
?>
<!DOCTYPE html>
<html lang="en">
 
<head>
 <title>Edit Mahasiswa</title>
 <link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap
.min.css" rel="stylesheet">
</head>
 
<body class="container mt-5">
 <h2>Edit Data Mahasiswa</h2>
 <form method="POST">
  <div class="mb-3">
   <label>Nama</label>
   <input type="text" name="nama" class="form-control" value="<?=
                                                              $data['nama'] ?>" required>
  </div>
  <div class="mb-3">
   <label>NIM</label>
   <input type="text" name="nim" class="form-control" value="<?=
                                                             $data['nim'] ?>" required>
  </div>
  <div class="mb-3">
   <label>Usia</label>
   <input type="text" name="usia" class="form-control" value="<?=
                                                             $data['usia'] ?>" required>
  </div>
 
  <button type="submit" name="update" class="btn btn-
warning">Update</button>
 
  <a href="index.php" class="btn btn-secondary">Kembali</a>
 </form>
 <?php
 if (isset($_POST['update'])) {
  $nama = $_POST['nama'];
  $nim = $_POST['nim'];
  $usia = $_POST['usia'];
  mysqli_query($conn, "UPDATE mahasiswa SET nama='$nama',
nim='$nim', usia='$usia' WHERE id=$id");
  echo "<div class='alert alert-success mt-3'>Data berhasil
diupdate.</div>";
 }
 ?>
</body>
 
</html>
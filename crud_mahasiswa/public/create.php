<?php
//public /create.php
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Tambah Mahasiswa</title></head>
<body>
  <h1>Tambah Mahasiswa</h1>
  <form action="store.php" method="post" enctype="multipart/form-data">
    <label>Nama:<br><input type="text" name="nama" required></label><br><br>
    <label>NIM:<br><input type="text" name="nim" required></label><br><br>
    <label>Prodi:<br><input type="text" name="prodi" required></label><br><br>
    <label>Angkatan:<br><input type="number" name="angkatan" min="1900" required></label><br><br>
    <label>Foto:<br><input type="file" name="foto" accept="image/jpeg,image/png"></label><br><br>
    <label>Status:<br>
      <select name="status">
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
      </select>
    </label><br><br>
    <button type="submit">Simpan</button>
  </form>
  <p><a href="index.php">Kembali</a></p>
</body>
</html>
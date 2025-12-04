<?php
// public/edit.php
$config = require _DIR_ . '/../config.php';
require_once _DIR_ . '/../src/Database.php';
require_once _DIR_ . '/../src/MahasiswaRepository.php';

$db = Database::getConnection($config['db']);
$repo = new MahasiswaRepository($db);
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$row = $repo->find($id);
if (!$row) {
    echo 'Data tidak ditemukan. <a href="index.php">Kembali</a>';
    exit;
}
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Edit Mahasiswa</title></head>
<body>
  <h1>Edit Mahasiswa</h1>
  <form action="update.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?=htmlspecialchars($row['id'])?>">
    <label>Nama:<br><input type="text" name="nama" value="<?=htmlspecialchars($row['nama'])?>" required></label><br><br>
    <label>NIM:<br><input type="text" name="nim" value="<?=htmlspecialchars($row['nim'])?>" required></label><br><br>
    <label>Prodi:<br><input type="text" name="prodi" value="<?=htmlspecialchars($row['prodi'])?>" required></label><br><br>
    <label>Angkatan:<br><input type="number" name="angkatan" value="<?=htmlspecialchars($row['angkatan'])?>" min="1900" required></label><br><br>
    <p>Foto saat ini:
      <?php if ($row['foto_path']): ?>
        <img src="<?= htmlspecialchars('../' . ltrim($row['foto_path'], '/')) ?>" width="90" alt="foto">
      <?php else: ?>
        Tidak ada
      <?php endif; ?>
    </p>
    <label>Ganti Foto:<br><input type="file" name="foto" accept="image/jpeg,image/png"></label><br><br>
    <label>Status:<br>
      <select name="status">
        <option value="aktif" <?= $row['status'] === 'aktif' ? 'selected' : '' ?>>Aktif</option>
        <option value="nonaktif" <?= $row['status'] === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
      </select>
    </label><br><br>
    <button type="submit">Update</button>
  </form>
  <p><a href="index.php">Kembali</a></p>
</body>
</html>
<?php
//public/index.php
$config = require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/MahasiswaRepository.php';

$db = Database::getConnection($config['db']);
$repo = new MahasiswaRepository($db);
$rows = $repo->all();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Daftar Mahasiswa</title>
</head>
<body>
  <h1>Daftar Mahasiswa</h1>
  <p><a href="create.php">+ Tambah Mahasiswa</a></p>

  <table border="1" cellpadding="6" cellspacing="0">
    <tr>
      <th>ID</th><th>Nama</th><th>NIM</th><th>Prodi</th><th>Angkatan</th><th>Foto</th><th>Status</th><th>Aksi</th>
    </tr>
    <?php if (empty($rows)): ?>
      <tr><td colspan="8">Belum ada data.</td></tr>
    <?php else: ?>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><?=htmlspecialchars($r['id'])?></td>
          <td><?=htmlspecialchars($r['nama'])?></td>
          <td><?=htmlspecialchars($r['nim'])?></td>
          <td><?=htmlspecialchars($r['prodi'])?></td>
          <td><?=htmlspecialchars($r['angkatan'])?></td>
          <td>
            <?php if ($r['foto_path']): ?>
              <img src="<?= htmlspecialchars('../' . ltrim($r['foto_path'], '/')) ?>" width="80" alt="foto">
            <?php else: ?>
              -
            <?php endif; ?>
          </td>
          <td><?=htmlspecialchars($r['status'])?></td>
          <td>
            <a href="edit.php?id=<?= $r['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $r['id'] ?>" onclick="return confirm('Hapus data ini?')">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </table>
</body>
</html>
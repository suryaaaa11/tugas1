<?php
// public/delete.php
$config = require _DIR_ . '/../config.php';
require_once _DIR_ . '/../src/Database.php';
require_once _DIR_ . '/../src/MahasiswaRepository.php';

$db = Database::getConnection($config['db']);
$repo = new MahasiswaRepository($db);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$row = $repo->find($id);
if ($row) {
    // hapus file foto jika ada
    if ($row['foto_path'] && file_exists(_DIR_ . '/../' . ltrim($row['foto_path'], '/'))) {
        @unlink(_DIR_ . '/../' . ltrim($row['foto_path'], '/'));
    }
    $repo->delete($id);
}

header('Location: index.php');
exit;
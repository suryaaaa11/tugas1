<?php
// public/store.php
$config = require __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/MahasiswaRepository.php';

$db = Database::getConnection($config['db']);
$repo = new MahasiswaRepository($db);

// ambil data dan validasi sederhana
$nama = trim((string)($_POST['nama'] ?? ''));
$nim = trim((string)($_POST['nim'] ?? ''));
$prodi = trim((string)($_POST['prodi'] ?? ''));
$angkatan = isset($_POST['angkatan']) ? (int)$_POST['angkatan'] : 0;
$status = $_POST['status'] ?? 'aktif';

$errors = [];
if ($nama === '') $errors[] = 'Nama wajib diisi.';
if ($nim === '') $errors[] = 'NIM wajib diisi.';
if ($prodi === '') $errors[] = 'Prodi wajib diisi.';
if ($angkatan <= 0) $errors[] = 'Angkatan tidak valid.';

$foto_path = null;
if (!empty($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
    $f = $_FILES['foto'];
    if ($f['error'] !== UPLOAD_ERR_OK) $errors[] = 'Gagal upload file.';
    if ($f['size'] > $config['max_file_size']) $errors[] = 'Ukuran file melebihi batas.';
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $f['tmp_name']);
    finfo_close($finfo);
    if (!in_array($mime, $config['allowed_types'])) $errors[] = 'Tipe file tidak diperbolehkan.';
    if (empty($errors)) {
        if (!is_dir($config['upload_dir'])) mkdir($config['upload_dir'], 0755, true);
        $ext = $mime === 'image/png' ? '.png' : '.jpg';
        $filename = 'foto_' . time() . '_' . bin2hex(random_bytes(4)) . $ext;
        $dest = $config['upload_dir'] . '/' . $filename;
        if (!move_uploaded_file($f['tmp_name'], $dest)) $errors[] = 'Gagal menyimpan file di server.';
        else $foto_path = $config['upload_uri'] . '/' . $filename;
    }
}

if ($errors) {
    echo '<h3>Terjadi error:</h3><ul>';
    foreach ($errors as $e) echo '<li>' . htmlspecialchars($e) . '</li>';
    echo '</ul><p><a href="create.php">Kembali</a></p>';
    exit;
}

// simpan ke db
try {
    $repo->create([
        'nama' => $nama,
        'nim' => $nim,
        'prodi' => $prodi,
        'angkatan' => $angkatan,
        'foto_path' => $foto_path,
        'status' => $status
    ]);
} catch (Exception $ex) {
    echo 'Gagal menyimpan data: ' . htmlspecialchars($ex->getMessage());
    exit;
}

header('Location: index.php');
exit;
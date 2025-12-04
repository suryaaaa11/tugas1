<?php
return [
    'db' => [
        'host' => '127.0.0.1',
        'dbname' => 'crud_mahasiswa',
        'user' => 'root',
        'pass' => '',
        'charset' => 'utf8mb4'
    ],
    'upload_dir' => __DIR__ . '/uploads',
    'upload_uri' => 'uploads',
    'max_file_size' => 2 * 1024 * 1024,
    'allowed_types' => ['image/jpeg','image/png']
];
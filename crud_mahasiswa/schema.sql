CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(20) NOT NULL UNIQUE,
    prodi VARCHAR(50) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    angkatan INT NOT NULL,
    foto_path VARCHAR(255),
    status ENUM('aktif', 'nonaktif') NOT NULL DEFAULT 'aktif'
);
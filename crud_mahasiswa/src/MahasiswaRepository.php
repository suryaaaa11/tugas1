<?php
class MahasiswaRepository {
    private PDO $db;

    public function __construct(PDO $pdo) {
        $this->db = $pdo;
    }

    /** @return array<int,array> */
    public function all(): array {
        $stmt = $this->db->query('SELECT * FROM mahasiswa ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array {
        $stmt = $this->db->prepare('SELECT * FROM mahasiswa WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $r = $stmt->fetch();
        return $r ?: null;
    }

    public function create(array $data): int {
        $stmt = $this->db->prepare('INSERT INTO mahasiswa (nama,nim,prodi,angkatan,foto_path,status) VALUES (:nama,:nim,:prodi,:angkatan,:foto_path,:status)');
        $stmt->execute([
            'nama' => $data['nama'],
            'nim' => $data['nim'],
            'prodi' => $data['prodi'],
            'angkatan' => $data['angkatan'],
            'foto_path' => $data['foto_path'],
            'status' => $data['status'],
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare('UPDATE mahasiswa SET nama=:nama, nim=:nim, prodi=:prodi, angkatan=:angkatan, foto_path=:foto_path, status=:status WHERE id=:id');
        $params = [
            'nama' => $data['nama'],
            'nim' => $data['nim'],
            'prodi' => $data['prodi'],
            'angkatan' => $data['angkatan'],
            'foto_path' => $data['foto_path'],
            'status' => $data['status'],
            'id' => $id
        ];
        return $stmt->execute($params);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare('DELETE FROM mahasiswa WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
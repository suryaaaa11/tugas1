<?php
class Mahasiswa {
    public ?int $id;
    public string $nama;
    public string $nim;
    public string $prodi;
    public int $angkatan;
    public ?string $foto_path;
    public string $status;

    public function __construct(array $data = []) {
        $this->id = isset($data['id']) ? (int)$data['id'] : null;
        $this->nama = $data['nama'] ?? '';
        $this->nim = $data['nim'] ?? '';
        $this->prodi = $data['prodi'] ?? '';
        $this->angkatan = isset($data['angkatan']) ? (int)$data['angkatan'] : 0;
        $this->foto_path = $data['foto_path'] ?? null;
        $this->status = $data['status'] ?? 'aktif';
    }
}
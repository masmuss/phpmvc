<?php

class Siswa_model
{
    private $table = 'siswa';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllSiswa()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getSiswaById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataSiswa($data)
    {
        $query = "INSERT INTO siswa
                    VALUES
                    ('', :nama, :tem_lahir, :tan_lahir, :alamat, :jurusan)";

        $this->db->query($query);
        $this->db->bind('nama', htmlspecialchars($data['nama']));
        $this->db->bind('tem_lahir', htmlspecialchars($data['tem_lahir']));
        $this->db->bind('tan_lahir', htmlspecialchars($data['tan_lahir']));
        $this->db->bind('alamat', htmlspecialchars($data['alamat']));
        $this->db->bind('jurusan', htmlspecialchars($data['jurusan']));

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataSiswa($id)
    {
        $query = "DELETE FROM siswa WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataSiswa($data)
    {
        $query = "UPDATE siswa SET
                    nama = :nama,
                    tem_lahir = :tem_lahir,
                    tan_lahir = :tan_lahir,
                    alamat = :alamat,
                    jurusan = :jurusan
                WHERE id =:id";

        $this->db->query($query);
        $this->db->bind('nama', htmlspecialchars($data['nama']));
        $this->db->bind('tem_lahir', htmlspecialchars($data['tem_lahir']));
        $this->db->bind('tan_lahir', htmlspecialchars($data['tan_lahir']));
        $this->db->bind('alamat', htmlspecialchars($data['alamat']));
        $this->db->bind('jurusan', htmlspecialchars($data['jurusan']));
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariSiswa()
    {
        $keyword = $_POST['keyword'];
        $query = "SELECT * FROM siswa WHERE nama LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");

        return $this->db->resultSet();
    }
}

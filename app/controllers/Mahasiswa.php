<?php

class Mahasiswa extends Controller {
    public function index()
    {
        $data["judulHalaman"] = "Halaman Mahasiswa";
        $data["mahasiswa"] = $this->model("Mahasiswa_model")->getAllMahasiswa();

        $this->view("templates/header", $data);
        $this->view("mahasiswa/index", $data);
        $this->view("templates/footer");
    }

    public function detail($id) // ambil parameter id yang dikirim lewat url
    {
        $data["judulHalaman"] = "Halaman Detail Mahasiswa";

        $data["mahasiswa"] = $this->model("Mahasiswa_model")->getMahasiswaById($id);    // kirim $id ke model lewat sini

        $this->view("templates/header", $data);
        $this->view("mahasiswa/detail", $data);
        $this->view("templates/footer");
    }

    public function tambah()
    {
        // var_dump($_POST);   // langsung ambil pakai $_POST, bukan diambil dari parameter function tambah()

        // jika method tambahDataMahasiswa mereturn nilai lebih dari 0 maka data berhasil diinput, lalu redirect ke halaman mahasiswa
        if( $this->model("Mahasiswa_model")->tambahDataMahasiswa($_POST) > 0 ) {
            Flasher::setFlash("Berhasil", "ditambahkan", "success");    // pesan kalau berhasil
            header("Location: " . BASEURL . "/mahasiswa");
            exit;
        } else {
            Flasher::setFlash("Gagal", "ditambahkan", "danger");    // pesan kalau gagal
            header("Location: " . BASEURL . "/mahasiswa");
            exit;
        }

    }

    public function hapus($idMahasiswa)
    {
        if( $this->model("Mahasiswa_model")->hapusDataMahasiswa($idMahasiswa) > 0 ) {
            Flasher::setFlash("Berhasil", "dihapus", "success");
            header("Location: " . BASEURL ."/mahasiswa");
            exit;
        } else {
            Flasher::setFlash("Gagal", "dihapus", "danger");
            header("Location: " . BASEURL ."/mahasiswa");
            exit;
        }
    }

    public function getubah()
    {
        // echo $_POST["id"];
        echo json_encode($this->model("Mahasiswa_model")->getMahasiswaById($_POST["id"]));  // function php merubah array assciative menjadi json
    }

    public function ubah()
    {
        if( $this->model("Mahasiswa_model")->ubahDataMahasiswa($_POST) > 0 ) {
            Flasher::setFlash("Berhasil", "diubah", "success");
            header("Location: " . BASEURL ."/mahasiswa");
            exit;
        } else {
            Flasher::setFlash("Gagal", "diubah", "danger");
            header("Location: " . BASEURL ."/mahasiswa");
            exit;
        }
    }

    public function cari()
    {
        $data["judulHalaman"] = "Halaman Mahasiswa";
        $data["mahasiswa"] = $this->model("Mahasiswa_model")->cariDataMahasiswa($_POST["keyword"]);

        $this->view("templates/header", $data);
        $this->view("mahasiswa/index", $data);
        $this->view("templates/footer");
    }

}

?>
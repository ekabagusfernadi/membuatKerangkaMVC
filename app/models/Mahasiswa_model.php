<?php

class Mahasiswa_model {
    // private $mahasiswa = [
    //     [
    //         "nama" => "Eka Bagus Fernadi",
    //         "nim" => "H76215032",
    //         "email" => "bagusfernadieka@gmail.com",
    //         "jurusan" => "Sistem Informasi"
    //     ],
    //     [
    //         "nama" => "Uzumaki Bayu",
    //         "nim" => "H76215015",
    //         "email" => "bayuuzumai@gmail.com",
    //         "jurusan" => "Ninjutsu"
    //     ],
    //     [
    //         "nama" => "Uzumaki Saburo",
    //         "nim" => "H76215016",
    //         "email" => "saburouzumai@gmail.com",
    //         "jurusan" => "Genjutsu"
    //     ]
    // ];

    
    // koneksi kali ini menggunakan PDO(PHP data objects) bukan mysqli lagi, agar bisa cross platform database
    // private $dbh;    // dbh = database handler
    // private $stmt;  // stmt = statement

    private $table = "mahasiswa";   //nama table yg mau dipakai
    private $db;    // untuk menampung data return dari class Database tadi

    // buat method __construct untuk koneksi kedatabase, agar saat pertama kali method dipanggil lngsung melakukan konesi
    // public function __construct()
    // {
    //     // dsn = data source name
    //     $dsn = "mysql:host=localhost;dbname=phpmvc";  // ini koneksi ke pdo

    //     // koneksikan ke database dan cek koneksi dengan block try catch
    //     try {
    //         $this->dbh = new PDO($dsn, "root", ""); // kemungkinan class PDO ini adalah bawaan dari PHPnya
    //     } catch(PDOException $e) {  // jika ada error tangkap errornya masukkan ke var e
    //         die($e->getMessage());  // hentikan program tampilkan pesan error
    //     }
    // }

    public function __construct()
    {
        $this->db = new Database;   // jadi begitu model Mahasiswa_model dipanggil dari class Mahasiswa di folder controller, otomatis lgsung instansiasi class Database di folder core, jadi bisa pakai semua method didlm nya
    }

    public function getAllMahasiswa()
    {
        // // return $this->mahasiswa;

        // // query
        // $this->stmt = $this->dbh->prepare("SELECT * FROM mahasiswa");    // kurang lebih seperti mysqli_query(konneks($dbh), query(SELECT * FROM mahasiswa));

        // // eksekusi dengan perintah execute (2 kali kalau pdo supaya aman)
        // $this->stmt->execute();
        // return $this->stmt->fetchAll(PDO::FETCH_ASSOC); // sama seperti mysqli_fetch_assoc mengembalikan array associative

        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();

    }

    public function getMahasiswaById($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");   // :id ini untuk menyimpan data yang akan dibinding, jadi tidak lngsung dimasukkan $id untuk menghindari sql injection
        $this->db->bind("id", $id);   // bind id nya disini, parameternya ada 2, $param dan $value
        return $this->db->single(); // isinya cuma satu jadi gunakan method single()
    }

    public function tambahDataMahasiswa($dataMahasiswa) // tangkap argument $_POST dari cotroller jadi parameter
    {
        // var_dump($dataMahasiswa);
        $nama = $dataMahasiswa['nama'];
        $nim = $dataMahasiswa['nim'];
        $email = $dataMahasiswa['email'];
        $jurusan = $dataMahasiswa['jurusan'];

        $query = ("INSERT INTO {$this->table}(nama, nim, email, jurusan)
        VALUES
        (:nama, :nim, :email, :jurusan)");  // jangan lupa dibind agar aman
        
        $this->db->query($query);
        $this->db->bind("nama", $dataMahasiswa["nama"]);    //bind
        $this->db->bind("nim", $dataMahasiswa["nim"]);
        $this->db->bind("email", $dataMahasiswa["email"]);
        $this->db->bind("jurusan", $dataMahasiswa["jurusan"]);

        $this->db->execute();   // wajib dieksekusi, yang select sudah otomatis eksekusi karena di class Database folder core sudah di tambahkan kode eksekusi di method nya
        
        return $this->db->rowCount();
    }

    public function hapusDataMahasiswa($idMahasiswa)
    {
        $query = "DELETE FROM {$this->table} WHERE id = :idMahasiswa";
        $this->db->query($query);
        $this->db->bind("idMahasiswa", $idMahasiswa); // parameter pertama adalah :idMahasiswa
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    // public function getDataUbah($idMahasiswa)
    // {
    //     $query = "SELECT * FROM {$this->table} WHERE id = :id";
    //     $this->db->query($query);
    //     $this->db->bind("id", $idMahasiswa);
    //     return $this->db->single();
    // }

    public function ubahDataMahasiswa() // $_POST bisa ditangkap menggunakan parameter method ubahDataMahasiswa($dataMahasiswa), atau langsung panggil menggunakan $_POST["data"] saja
    {
        $query = "UPDATE {$this->table} SET nama = :nama, nim = :nim, email = :email, jurusan = :jurusan WHERE id = :idMahasiswa";
        $this->db->query($query);
        $this->db->bind("nama", $_POST["nama"]);
        $this->db->bind("nim", $_POST["nim"]);
        $this->db->bind("email", $_POST["email"]);
        $this->db->bind("jurusan", $_POST["jurusan"]);
        $this->db->bind("idMahasiswa", $_POST["idMahasiswa"]);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariDataMahasiswa()
    {
        $keyword = $_POST["keyword"];
        $query = "SELECT * FROM {$this->table} WHERE nama LIKE :keyword";  // %:keyword% tidak mau jalan kalau pakai prepared statement PDO, harus disimpan dibind nya nanti
        $this->db->query($query);
        $this->db->bind("keyword", "%$keyword%");
        return $this->db->resultSet();
    }

}

?>
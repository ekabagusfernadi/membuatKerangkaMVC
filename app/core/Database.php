<?php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh;
    private $stmt;

    public function __construct()
    {
        // dsn = data source name
        $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;  // ini koneksi ke pdo

        $option = [
            // ini adalah parameter dari konfigurasi databasenya
            PDO::ATTR_PERSISTENT => true,   // untuk membuat db kita koneksinya terjaga terus
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION   // untuk mode error tampilkan eception
        ];

        // koneksikan ke database dan cek koneksi dengan block try catch
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option); // kemungkinan class PDO ini adalah bawaan dari PHPnya
            // sebetulnya konesi ke db ini butuh 1 parameter baru untuk optionnya digunakan ketika kita ingin mengoptiamsi koneksi ke database kita
        } catch(PDOException $e) {  // jika ada error tangkap errornya masukkan ke var e
            die($e->getMessage());  // hentikan program tampilkan pesan error
        }
    }

    public function query($query) // dibuat jadi generik jadi query bisa digunakan untuk apapun baik select, update, delete, dll. ini adalah tujuan utama membuat wrapper jadi bisa digunakan secara fleksible
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)  // untuk binding data, siapa tahu diquerynya ada where, values, set, dll
    // parameter $type = null wajib ada, supaya nanti yg menentukan bukan kita tetapi aplikasinya
    {
        if( is_null($type) ) {
            switch( true ) {    // true = supaya switchnya jalan saja
                case is_int($value) :   // jika tipe $value adalah int $type di set jadi int
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);  // gabung query $stmt, misal : where id = 1, 1 akan dicek jika int maka kasih optionnya int, lalu dibind; kenapa harus dibind dulu tidak lgsung dimasukkan kequery agar aman dari sql injection karena query dieksekusi setelah string dibersihkan terlebih dahulu

    }

    public function execute()   // eksekusi database
    {
        $this->stmt->execute();
    }

    public function resultSet() // jika data return banyak
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()    // jika data return satu
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }   // jadi ini wrappernya, bisa digunakan pada table manapun nantinya

    public function rowCount()  // ini rowCount(); buatan kita
    {
        return $this->stmt->rowCount(); // ini rowCount(); milik PDO
    }
}

?>
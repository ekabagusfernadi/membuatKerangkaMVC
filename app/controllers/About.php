<?php

class About extends Controller {
    public function index($nama = "default", $pekerjaan = "default", $umur = 0)    // parameter dari class App atau dari url
    {
        $data["nama"] = $nama;  // array assosiative kawan
        $data["pekerjaan"] = $pekerjaan;
        $data["umur"] = $umur;
        $data["judulHalaman"] = "Halaman About";

        $this->view("templates/header", $data);
        $this->view("about/index", $data);  // jika data banyak kirim sebagai array, kalau bisa array assosiative
        $this->view("templates/footer");
    }

    public function page()
    {
        $data["judulHalaman"] = "Halaman Pages";

        $this->view("templates/header", $data);
        $this->view("about/page");
        $this->view("templates/footer");
    }
}

?>
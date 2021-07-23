<?php

class Home extends Controller {
    public function index()
    {
        $data["judulHalaman"] = "Halaman Home";
        // $data["nama"] = "Eka Bagus Fernadi";
        $data["nama"] = $this->model("User_model")->getUser();   // dari model, "User_model = class" penamaan diberi _model agar tidak bingung/tertukar dengan class User di folder controllers
        // require sekaligus instansiasi karena ini merupakan class

        $this->view("templates/header", $data);
        $this->view("home/index", $data);  // panggil method dari parent(class Controller dari folder core)
        // artinya panggil file yang ada difolder view difolder home dengan nama file index.php
        $this->view("templates/footer");
    }
}

?>
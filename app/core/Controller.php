<?php

class Controller {
    public function view($view, $data = [])   // method view ada dicore/Controller, parameter ada 2 yaitu alamat view dan data yang ingin dikirim ke view
    {
        require_once "../app/views/" . $view . ".php"; // ingat requirenya dari publik/index.php karena instansiasi nya ada di situ
    }

    public function model($model)
    {
        require_once "../app/models/" . $model . ".php";    // sambungkan folder controllers dengan folder models
        return new $model; // instansiasi dulu buat panggil method diclass User_model
    }
}

?>
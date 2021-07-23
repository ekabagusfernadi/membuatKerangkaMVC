<?php

class App {
    protected $controller = "Home";
    protected $method = "index";
    protected $params = [];

    public function __construct()
    {
        // var_dump($_GET);
        $url = $this->parseURL();

        // // // untuk controller
        if( isset($_GET["url"]) ) {
            if( file_exists("../app/controllers/" . $url[0] . ".php") ) { // cek apakah controller yang ditulis diurl ada filenya atau tidak di folder controllers
                $this->controller = $url[0];
                unset($url[0]); // hilangkan controllernya dari elemen array nya, supaya bisa mengambil parameternya (intinya functionnya bisa menghapus array dengan index yang diinginkan nanti array dengan index tersebut akan hilang)
                // var_dump($url);
            }
        }

        require_once "../app/controllers/" . $this->controller . ".php";    // panggil cotroller yang ada diurl
        $this->controller = new $this->controller;  // timpa properti $controller dengan instance dari class difolder controller yang ditulis url(kelasnya diinstransiasi supaya kita bisa memanggil methodnya)
        // instansiasinya mungkin bisa tanpa () misal= $tes = new tes();

        // // // untuk method
        if( isset($url[1]) ) {  // kalau kosong tetap pakai method default
            if( method_exists($this->controller, $url[1]) ) {   // function untuk cek apakah method ada didlm object(parameternya namaObject dan namaMethod)
                $this->method = $url[1];
                unset($url[1]); // jadi nanti sisa arraynya hanya parameternya itupun kalau ada parameternya
            }
        }

        // // // untuk parameter
        if( !empty($url) ) {    // function untuk cek apakah sebuah variable itu kosong atau tidak
            $this->params = array_values($url); // function untuk mengambil nilai/data array

            // kurang lebih function array_values bisa melakukan hal seperti ini
            // foreach( $url as $ur ) {
            //     $this->params[] = $ur;
            // }

            // var_dump($this->params);
        }

        // // // jalankan controller dan method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);  // function untuk menjalankan controller, method, dan mengirim parameter, penulisannya = call_user_func_array([controller, method], params);
        // array akan dikirim jadi parameter functionnya, tinggal tangkap saja pakai variable misal = public function index($nama, $pekerjaan) {}
    }

    public function parseURL() {    // function get key url
        if( isset($_GET["url"]) ) {
            $url = rtrim($_GET["url"], "/"); //rtrim() digunakan untuk dapat menghapus spasi atau karakter standar lainnya dari sisi kanan string.
            $url = filter_var($url, FILTER_SANITIZE_URL);   // membersihkan url dari karakter2 yg memungkinkan url dihack
            $url = explode("/", $url);  // pecah dengan delimiter "/" dan jadi array string
            return $url;    // sekarang url nya sudah rapi tidak ada index.php?url=tes
        }
    }
  
}

?>
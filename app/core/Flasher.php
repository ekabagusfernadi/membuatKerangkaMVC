<?php

class Flasher {
    public static function setFlash($pesan, $aksi, $tipe) {    // $pesan = berhasil/gagal, $aksi = tambah, ubah, hapus (data mahasiswa $pesan(berhasil/gagal) $aksi(dihapus/ditambah/diubah), $tipe = warna bootstrap(success/danger))
        $_SESSION["flash"] = [
            "pesan" => $pesan,
            "aksi" => $aksi,
            "tipe" => $tipe
        ];
    }

    public static function flash()  // pakai static agar mudah dipanggil, tanpa instansiasi
    {
        if( isset($_SESSION["flash"]) ) {
            echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
                    Data Mahasiswa <strong>' . $_SESSION['flash']['pesan'] . ' </strong>' . $_SESSION['flash']['aksi'] . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            
            unset($_SESSION["flash"]);  // langsung diunset agar saat halaman direload flash message hilang
        }
    }

}

?>
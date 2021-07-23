<div class="container">
    <h1 class="mt-4">About Me</h1>
    <img src="<?= BASEURL; ?>/img/saitama.jpg" alt="saitama-nich" class="rounded-circle shadow img-thumbnail ukuran-20">
    <p>Hallo, nama saya <?= $data["nama"]; ?>, umur saya <?= $data["umur"]; ?> tahun, saya adalah seorang <?= $data["pekerjaan"]; ?>.</p>
    <!-- bisa langsung ambil tanpa $_GET mungkin karena sudah direquire_once jadi function halaman controller/about/index sudah jadi satu dengan halamn view/about/index -->
    <!-- mengambilnya seperti ngambil parameter dari function -->
</div>
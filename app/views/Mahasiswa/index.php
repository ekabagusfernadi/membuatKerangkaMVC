<div class="container mt-3 mb-2">

  <!-- flasher messange -->
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <?php Flasher::flash(); ?>
    </div>
  </div>

  <div class="row justify-content-center mb-3">
    <div class="col-lg-6">
      <!-- Button trigger modal -->
      <button id="tombolTambahMahasiswa" type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
        Tambah Data Mahasiswa
      </button>
    </div>
  </div>

  <div class="row justify-content-center mb-3">
    <div class="col-lg-6">
      <form action="<?= BASEURL ?>/mahasiswa/cari" method="post">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Cari mahasiswa..." name="keyword" id="keyword" autocomplete="off">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit" id="tombolCari" name="tombolCari">Cari</button>
        </div>
      </div>
      </form>
    </div>
  </div>

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <h3>Daftar Mahasiswa</h3>
            
            <ul class="list-group">
                <?php foreach( $data["mahasiswa"] as $mhs ) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= $mhs["nama"]; ?>
                        <div>
                          <a href="<?= BASEURL; ?>/mahasiswa/detail/<?= $mhs['id']; ?>" class="badge badge-primary">detail</a>
                          <a href="<?= BASEURL; ?>/mahasiswa/ubah/<?= $mhs['id']; ?>" class="badge badge-success tampilModalUbah" data-toggle="modal" data-target="#formModal" data-id="<?= $mhs['id']; ?>">ubah</a>  <!-- atribut data-(sembaraang)="" ini bisa ditangkap pakai jquery -->
                          <a href="<?= BASEURL; ?>/mahasiswa/hapus/<?= $mhs['id']; ?>" class="badge badge-danger" onclick="return confirm('Yakin Kawan?');">hapus</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulModal">Tambah Data Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- kirim data lewat method post ke controller Mahasiswa, method tambah -->
        <form action="<?= BASEURL; ?>/mahasiswa/tambah" method="post">
        <input type="hidden" name="idMahasiswa" id="idMahasiswa">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="nim">Nim</label>
            <input type="number" class="form-control" id="nim" name="nim" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com" required>
        </div>

        <div class="form-group">
            <label for="jurusan">Jurusan</label>
            <select class="form-control" id="jurusan" name="jurusan">
            <option value="Sistem Informasi">Sistem Informasi</option>
            <option value="Teknik Mesin">Teknik Mesin</option>
            <option value="Teknik Industri">Teknik Industri</option>
            <option value="Teknik Pangan">Teknik Pangan</option>
            <option value="Teknik Planologi">Teknik Planologi</option>
            <option value="Teknik Lingkungan">Teknik Lingkungan</option>
            </select>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
        </form> <!-- simpan tutup form pada akhir button, karena button juga termasuk form -->
      </div>
    </div>
  </div>
</div>
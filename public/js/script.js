$(function () {
  const baseUrl = "http://localhost/oto/9MVC/13Searching/public";

  // ketika dokumen sudah siap jalankan function didlmnya, untuk menggantikan sebuah method bernama ready

  $("#tombolTambahMahasiswa").on("click", function () {
    $("#judulModal").html("Tambah Data Mahasiswa");
    $(".modal-footer button[type=submit]").html("Tambah Data");

    $("#nama").val("");
    $("#nim").val("");
    $("#email").val("");
    $("#jurusan").val("Sistem Informasi");
  });

  $(".tampilModalUbah").on("click", function () {
    // console.log("oke");
    $("#judulModal").html("Ubah Data Mahasiswa");
    $(".modal-footer button[type=submit]").html("Ubah Data");

    // ubah url action pada tag form agar tidak mengirim data ke method tambah data
    $(".modal-body form").attr("action", baseUrl + "/mahasiswa/ubah"); // action pada form tambah tidak perlu diubah keawal lagi karena saat halaman ter refresh akan otomatis kembali ke awal

    const id = $(this).data("id"); // $(this) adalah element yang diklik karena elemennya banyak maka bisa pakai $(this), .data("id"); ambil dari data-id di html
    // console.log(id);

    // jalankan ajax dijquery
    $.ajax({
      // bentuknya object boleh ditambhkan kurung kurawal, bisa ditambahi beberapa parameter
      url: baseUrl + "/mahasiswa/getubah", // jika method controller biasakan tulis kecil semua, method model bolehlah camelcase
      //   kirimkan data keurl diatas id kiri adalah nama data yang akan dikirim id kanan adalah isi data yang diambil dari html
      data: { id: id },
      method: "post", // method bisa get atau post
      dataType: "json", // tipe data bisa text biasa atau json
      success: function (data) {
        // hasil return dari method getUbah akan ditangkap menggunakan parameter data
        // console.log(data); // komentar pada halaman index di public mempengaruhi isinya, terpaksa saya hapus
        $("#nama").val(data.nama); // object dijs = data.nama, kalau di php kan data->nama  // ubah value input dengan id nama dengan data return dari json tadi
        $("#nim").val(data.nim);
        $("#email").val(data.email);
        $("#jurusan").val(data.jurusan);
        $("#idMahasiswa").val(data.id);
        // ngirimnya pakai metode postnya php karena di js ini cuma mengisi input berdasarkan id yang ingin diubah, ngirimnya tetep pakai php
      },
    });
  });
});

<?php
include "koneksi.php";

// Ambil NIP dari parameter URL
if (isset($_GET['id'])) {
    $nip = $_GET['id'];

    // Query untuk mengambil data pegawai berdasarkan NIP
    $query = "SELECT * FROM pegawai WHERE nip = '$nip'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah data pegawai ditemukan
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='index.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('NIP tidak ditentukan!'); window.location.href='index.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    // Mengambil data dari form
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $ruangan = $_POST['ruangan'];

    // Query untuk mengupdate data pegawai
    $query = "UPDATE pegawai SET nama = '$nama', alamat = '$alamat', tgl_lahir = '$tgl_lahir', id_ruangan = '$ruangan' WHERE nip = '$nip'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah query berhasil dieksekusi
    if ($result) {
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Data Gagal diupdate!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Halaman Update Data</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>

  <section class="row">
    <div class="col-md-6 offset-md-3 align-self-center"> 
      <h1 class="text-center mt-4">Form Update Data</h1>
      <form method="POST">
        <input type="hidden" value="<?= $data['nip'] ?>" name="nip">
        <div class="mb-3">
          <label for="inputNama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="inputNama" name="nama" value="<?= $data['nama'] ?>" placeholder="Masukan Nama Pegawai" required>
        </div>
        <div class="mb-3">
          <label for="inputAlamat" class="form-label">Alamat</label>
          <input type="text" class="form-control" id="inputAlamat" name="alamat" value="<?= $data['alamat'] ?>" placeholder="Masukan Alamat" required>
        </div>
        <div class="mb-3">
          <label for="inputTglLahir" class="form-label">Tanggal Lahir</label>
          <input type="date" class="form-control" id="inputTglLahir" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>" required>
        </div>
        <div class="mb-3">
          <label for="inputRuangan" class="form-label">Ruangan</label>
          <select class="form-select" id="inputRuangan" name="ruangan" required>
              <option value="">Pilih Ruangan</option>
              <?php
              // Query untuk mengambil data ruangan
              $query_ruangan = "SELECT * FROM ruangan";
              $result_ruangan = mysqli_query($koneksi, $query_ruangan);

              // Cek apakah query berhasil
              if (!$result_ruangan) {
                  echo "Error: " . mysqli_error($koneksi); // Menampilkan kesalahan jika ada
              } else {
                  // Cek apakah ada data ruangan
                  if (mysqli_num_rows($result_ruangan) > 0) {
                      foreach ($result_ruangan as $ruangan) {
                          // Set opsi terpilih jika id_ruangan pegawai cocok
                          $selected = ($ruangan['id_ruangan'] == $data['id_ruangan']) ? "selected" : "";
                          echo "<option value='". $ruangan['id_ruangan'] ."' $selected>". $ruangan['keterangan'] ."</option>";
                      }
                  } else {
                      echo "<option value=''>Tidak ada ruangan tersedia</option>";
                  }
              }
              ?>
          </select>
        </div>
        <input name="update" type="submit" class="btn btn-primary" value="Update">
        <a href="index.php" type="button" class="btn btn-info text-white">Kembali</a>
      </form>
    </div>
  </section>

</body>
</html>

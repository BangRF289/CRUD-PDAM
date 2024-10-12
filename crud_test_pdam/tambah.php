<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Halaman Tambah Data</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <section class="row">
    <div class="col-md-6 offset-md-3 align-self-center"> 
      <h1 class="text-center mt-4">Form Tambah Data</h1>
      <form method="POST">
        <div class="mb-3">
            <label for="inputNama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="inputNama" name="nama" placeholder="Masukan Nama " required>
        </div>
        <div class="mb-3">
            <label for="inputAlamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="inputAlamat" name="alamat" placeholder="Masukan Alamat" required>
        </div>
        <div class="mb-3">
            <label for="inputTglLahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="inputTglLahir" name="tgl_lahir" required>
        </div>
        <div class="mb-3">
    <label for="inputRuangan" class="form-label">Ruangan</label>
    <select class="form-select" id="inputRuangan" name="ruangan" required>
        <option value="">Pilih Ruangan</option>
        <?php
        
        $query_ruangan = "SELECT * FROM ruangan";
        $result_ruangan = mysqli_query($koneksi, $query_ruangan);
        
       
        if (!$result_ruangan) {
            echo "Error: " . mysqli_error($koneksi);
        } else {
           
            if (mysqli_num_rows($result_ruangan) > 0) {
                foreach ($result_ruangan as $ruangan) {
                    echo "<option value='". $ruangan['id_ruangan'] ."'>". $ruangan['keterangan'] ."</option>";
                }
            } else {
                echo "<option value=''>Tidak ada ruangan tersedia</option>";
            }
        }
        ?>
    </select>
</div>

        <input name="daftar" type="submit" class="btn btn-primary" value="Tambah">
        <a href="index.php" type="button" class="btn btn-info text-white">Kembali</a>
      </form>
    </div>
  </section>

  <?php
    
    
    if (isset($_POST['daftar'])) {
    
      $nama = $_POST['nama'];
      $alamat = $_POST['alamat'];
      $tgl_lahir = $_POST['tgl_lahir'];
      $ruangan = $_POST['ruangan'];

      
      $query = "INSERT INTO pegawai (nama, alamat, tgl_lahir, id_ruangan) VALUES ('$nama', '$alamat', '$tgl_lahir', '$ruangan')";

      $result = mysqli_query($koneksi, $query);

      if ($result) {
        header("location: index.php");
      } else {
        echo "<script>alert('Data Gagal ditambahkan!')</script>";
      }
    }    
  ?>

</body>
</html>

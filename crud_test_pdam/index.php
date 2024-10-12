<!-- Panggil file koneksi, karena kita membutuhkannya -->
<?php
  include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Halaman Utama</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
    }

    h1 {
      color: #333;
      margin-top: 20px;
      font-family: 'Arial', sans-serif;
      font-size: 36px;
      font-weight: 700;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      font-size: 16px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    .table {
      background-color: #ffffff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .table thead {
      background-color: #007bff;
      color: #ffffff;
    }

    .table th, .table td {
      text-align: center;
      vertical-align: middle;
    }

    .btn-success, .btn-danger {
      font-size: 14px;
      font-weight: bold;
      transition: transform 0.2s ease;
    }

    .btn-success:hover, .btn-danger:hover {
      transform: scale(1.05);
    }

    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
    }

    .btn-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .btn-danger:hover {
      background-color: #c82333;
      border-color: #bd2130;
    }
  </style>
</head>
<body>

  <section class="row">
    <div class="col-md-6 offset-md-3 align-self-center"> 
      <h1 class="text-center">Daftar Nama Pegawai</h1>
      
      <!-- Form Pencarian -->
      <form method="GET" class="mb-3">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Cari Nama Pegawai" aria-label="Search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
          <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
      </form>

      <div class="mb-3">
        <a href="tambah.php" class="btn btn-primary">Tambah</a>
        
      </div>

      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nip</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">Tgl Lahir</th>
            <th scope="col">Nama Ruangan</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            
            $no = 1;
            $search = isset($_GET['search']) ? $_GET['search'] : ''; 
            $query = "SELECT pegawai.*, ruangan.keterangan AS nama_ruangan
                      FROM pegawai
                      JOIN ruangan ON pegawai.id_ruangan = ruangan.id_ruangan";

            // Jika ada pencarian
            if (!empty($search)) {
                $query .= " WHERE pegawai.nama LIKE '%" . mysqli_real_escape_string($koneksi, $search) . "%'";
            }

            $result = mysqli_query($koneksi, $query);
      
            if ($result) {
              foreach ($result as $data) {
                echo "
                  <tr>
                    <th scope='row'>". $no++ ."</th>
                    <td>". $data["nip"] ."</td>
                    <td>". $data["nama"] ."</td>
                    <td>". $data["alamat"] ."</td>
                    <td>". $data["tgl_lahir"] ."</td>
                    <td>". $data["nama_ruangan"] ."</td>
                    <td> 
                      <a href='update.php?id=".$data["nip"]."' class='btn btn-success'>Update</a>
                      <a href='delete.php?id=".$data["nip"]."' class='btn btn-danger' onclick=\"return confirm('Yakin ingin menghapus data?')\">Delete</a>
                    </td>
                  </tr>  
                ";
              }
            } else {
              echo "<tr><td colspan='7' class='text-center'>Tidak ada data pegawai ditemukan.</td></tr>";
            }
          ?>
        </tbody>  
      </table>
      <a href="index.php" class="btn btn-secondary">Kembali</a> 
    </div>
  </section>

</body>
</html>

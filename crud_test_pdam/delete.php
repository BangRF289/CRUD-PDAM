<?php
// Panggil file koneksi
include "koneksi.php";

// Cek apakah ada parameter 'id' di URL
if (isset($_GET['id'])) {
    // Ambil NIP dari URL
    $nip = $_GET['id'];

    // Buat query untuk menghapus pegawai berdasarkan NIP
    $query = "DELETE FROM pegawai WHERE nip = '$nip'";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    // Cek apakah query berhasil dieksekusi
    if ($result) {
        // Jika berhasil, redirect ke halaman index
        header("Location: index.php");
        exit; // Pastikan untuk keluar setelah redirect
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<script>alert('Data Gagal dihapus!')</script>";
        echo "<script>window.location.href='index.php'</script>";
    }
} else {
    // Jika tidak ada ID di URL, redirect ke index
    header("Location: index.php");
    exit;
}
?>

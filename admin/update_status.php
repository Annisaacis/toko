<?php 
// BARU - file ini sama fungsinya dengan file selesai.php yaitu untuk mengubah status pesanan agar menjadi dikirim(dikirim oleh admin)
require "../App/db.php";
$conn = connect_DB();

if (isset($_GET['kirim'])) {
    $id = $_GET['kirim'];
    // update status pada table pembelian menjadi dikirim dengan id_pembelian sesuai parameter yg dikirimkan dari data_pembelian saat admin menekan tombol kirim
    $query = "UPDATE `pembelian` SET `status`='Dikirim' WHERE id_pembelian = $id";
    $sql_update = mysqli_query($conn, $query);
    if($sql_update){
        echo "<script>alert('Barang Dikirim.');location.href='index.php?halaman=pembelian';</script>";
    }
  }

?>
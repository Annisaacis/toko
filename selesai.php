<?php 
// BARU - file ini sama fungsinya dengan file update_status.php pada folder admin yaitu untuk mengubah status pesanan pada dashboard user agar menjadi selesai(diterima oleh user)
require "App/db.php";
$conn = connect_DB();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // update status pada table pembelian menjadi selesai dengan id_pembelian sesuai parameter yg dikirimkan dari history saat user menekan tombol selesai
    $query = "UPDATE `pembelian` SET `status`='Selesai' WHERE id_pembelian = $id";
    $sql_update = mysqli_query($conn, $query);
    if($sql_update){
        echo "<script>location.href='history.php';</script>";
    }
  }

?>
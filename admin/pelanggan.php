<?php 
  $alert;

  if( isset($_GET["hapus"]) ) {
    global $conn;

    $id_pelanggan = $_GET["hapus"];

    $sql = "DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'";
    mysqli_query($conn, $sql);

    $res = mysqli_affected_rows($conn);

    if( $res ) {
      $alert["delete"] = true;
    } else {
      $alert["delete"] = false;
    }
  }

?>

<h2>Data Pelanggan</h2>
<div class="card">


  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Username</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>Password</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <?php
          require '../App/query.php';
          $pelanggan = query_select("pelanggan");
        ?>
        <tbody>
          <?php for($i = 0; $i < count($pelanggan); $i++): ?>
            <tr>
              <td><?= 1 + $i?></td>
              <td><?= $pelanggan[$i]["username"] ?></td>
              <td><?= $pelanggan[$i]["nama_pelanggan"] ?></td>
              <td><?= $pelanggan[$i]["alamat_pelanggan"] ?></td>
              <td><?= $pelanggan[$i]["password"] ?></td>
              <td>
                  <a href="index.php?halaman=pelanggan&hapus=<?= $pelanggan[$i]["id_pelanggan"] ?>" class="btn btn-danger btn-sm">hapus</a>
              </td>
            </tr>
          <?php endfor; ?>
        </tbody>
      </table>
    </div>
  </div>
  
</div> 

<?php 

if( isset($alert["delete"]) ) {
  if($alert["delete"]) {
    echo '<script>swal("Berhasil!", "Pelanggan Berhasil Dihapus", "success");</script>';
    echo "<script>setTimeout(() => {
      window.location.href = 'index.php?halaman=pelanggan';
    }, 1500)</script>";
  } else {
    echo '<script>swal("Gagal!", "Pelanggan Gagal Dihapus", "error");</script>';
  }
}

?>
<?php
$error = false;
require '../App/query.php';

if(isset($_POST["tambah_stok"])) {

  if( $_POST["new_stok"] != "" ) {
    $id_produk = htmlspecialchars($_POST["id_produk"]);
    $new_stok = htmlspecialchars($_POST["new_stok"]);
  
    $stok_produk_old = query_select('stok', "id_produk=$id_produk")[0]["stok_produk"];
  
    $new_stok += $stok_produk_old;
  
    $sql = "UPDATE stok SET stok_produk='$new_stok' WHERE id_produk='$id_produk'";
    mysqli_query($conn, $sql);
  
    $result = mysqli_affected_rows($conn);
    if($result != 1) {
      echo "<script>swal('Gagal!', 'Stok Gagal diupdate!', 'error');</script>";
    } else if($result == 1) {
      echo "<script>swal('Sukses!', 'Stok Berhasil diupdate!', 'success');;</script>";
      echo "<script>
        setTimeout(() => {
          window.location.href='index.php?halaman=stok';
        }, 1500)
        </script>";
    }
  
  } else {
    echo "kosong";
  }

}

  if( isset($_GET['id']) ) {

    $produk = query_select('produk', "id_produk='$_GET[id]'")[0];
 
  } else {
    // gagal url kurang
  }
?>

<h2>Tambah Stok Barang</h2>
<form action="" method="post" class="user mt-4" enctype="multipart/form-data">
  <div class="form-group  row">
    <div class="col-md-6">
      <input type="hidden" name="id_produk" id="" value="<?= $produk['id_produk'] ?>">
      <input type="text" class="form-control form-control-user" name="nama_produk" id="nama_produk" value="<?= $produk['nama_produk'] ?>" readonly autocomplete="off">
    </div>
    <div class="col-md-6">
      <input type="text" class="form-control form-control-user" readonly name="unit" id="unit" value="<?= $produk['unit'] ?>">
    </div>
  </div>

  <div class="form-group">
      <input type="number" class="form-control form-control-user" name="new_stok" id="new_stok"
          placeholder="Masukkan Jumlah Stok (<?= $produk['unit']?>)" autocomplete="off">
  </div>
 
  <button type="submit" class="btn btn-primary btn-user btn-block" name="tambah_stok">Tambah Stok</button>
  <hr>
  
</form>
<?php
$error = false;
require '../App/query.php';
if(isset($_POST["ubah"])) {

  $data = [
    "id_produk" => htmlspecialchars($_POST["id_produk"]),
    "nama_produk" => htmlspecialchars($_POST["nama_produk"]),
    "unit" => htmlspecialchars($_POST["unit"]),
    "harga_produk" => htmlspecialchars($_POST["harga"]),
  ];

  $sql = "UPDATE produk SET nama_produk='$data[nama_produk]', unit='$data[unit]', harga_produk='$data[harga_produk]' WHERE id_produk='$data[id_produk]'";
  mysqli_query($conn, $sql);

  $result = mysqli_affected_rows($conn);

  if($result != 1) {
    echo "<script>swal('Gagal!', 'Stok Gagal diupdate!', 'error');</script>";
  } else if($result == 1) {
    echo "<script>swal('Sukses!', 'Data Barang Berhasil ditambah!', 'success');;</script>";
    echo "<script>
      setTimeout(() => {
        window.location.href='index.php?halaman=produk';
      }, 1000)
      </script>";
  }
}

if( isset($_GET['id']) ) {
  $produk = query_select('produk', "id_produk='$_GET[id]'");
  
  if( $produk ) {
    $produk = $produk[0];
    
  } else {
    echo "<script>swal('Gagal!', 'Produk Tidak Ada', 'info');;</script>";
    echo "<script>
    setTimeout(() => {
      window.location.href='index.php?halaman=produk';
    }, 1500)
    </script>";
  }
 
} else {
  echo "<script>swal('Gagal!', '', 'info');;</script>";
  echo "<script>
    setTimeout(() => {
      window.location.href='index.php?halaman=produk';
    }, 1500)
    </script>";
}
?>

<h2>Edit Produk</h2>
<form action="" method="post" class="user mt-4" enctype="multipart/form-data">
  <div class="form-group  row">
    <div class="col-md-6">
      <input type="text" class="form-control form-control-user" name="nama_produk" id="nama_produk" placeholder="Masukkan Nama Produk" value="<?= $produk["nama_produk"] ?>" autocomplete="off">
    </div>
      <input type="hidden" name="id_produk" id="id_produk" placeholder="Masukkan Nama Produk" value="<?= $produk["id_produk"] ?>" autocomplete="off">
    <div class="col-md-6">
      <input type="text" class="form-control form-control-user" value="<?= $produk["unit"] ?>" name="unit" id="unit" placeholder="Masukkan Unit (gram / ml / Pcs)">
    </div>
  </div>

  <div class="form-group">
      <input type="number" class="form-control form-control-user" value="<?= $produk["harga_produk"] ?>" name="harga" id="harga"
          placeholder="Harga (Rp)" autocomplete="off">
  </div>
 
  <button type="submit" class="btn btn-primary btn-user btn-block" name="ubah">Ubah Data</button>
  <hr>
  
</form>
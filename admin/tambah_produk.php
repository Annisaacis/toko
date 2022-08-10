<?php
$error = false;

$conn = connect_DB();
$query = "SELECT * FROM unit";
$sql = mysqli_query($conn, $query);

if (isset($_POST["save"])) {
  require '../App/query.php';

  $data = [
    "id" => "",
    "nama_produk" => htmlspecialchars($_POST["nama_produk"]),
    "unit" => htmlspecialchars($_POST["unit"]),
    "harga_produk" => htmlspecialchars($_POST["harga"]),
    "foto" => $_FILES["foto"]["name"],
  ];


  $result = query_insert('produk', $data);
  if ($result != 1) {
    echo "<script>swal('Gagal!', 'Stok Gagal diupdate!', 'error');</script>";
  } else if ($result == 1) {
    $namaFIle = $_FILES['foto']['name'];
    $path = $_FILES['foto']['tmp_name'];
    move_uploaded_file($path, '../foto_produk/' . $namaFIle);
    echo "<script>swal('Sukses!', 'Data Barang Berhasil ditambah!', 'success');;</script>";
    echo "<script>
    setTimeout(() => {
      window.location.href='index.php?halaman=produk';
    }, 1500)
    </script>";

    $id_produk = mysqli_insert_id($conn);
    $data = [
      "id_stok" => "",
      "id_produk" => $id_produk,
      "stok_produk" => "0",
      "produk_terjual" => "0",
    ];

    query_insert('stok', $data);
  }
}
?>

<h2>Tambah Produk</h2>
<form action="" method="post" class="user mt-4" enctype="multipart/form-data">
  <div class="form-group  row">
    <div class="col-md-6">
      <input type="text" class="form-control form-control-user" name="nama_produk" id="nama_produk" placeholder="Masukkan Nama Produk" autocomplete="off">
    </div>
    <div class="col-md-6">
      <select name="unit" id="unit" class="form-control rounded-pill px-3" style="height: 50px; font-size: 12.5px;" required>
        <option value="" selected disabled>Pilih unit</option>
        <?php while ($unit = mysqli_fetch_object($sql)) : ?>
          <option value="<?= $unit->unit ?>"><?= $unit->unit ?></option>
        <?php endwhile; ?>
      </select>
      <!-- <input type="text" class="form-control form-control-user" name="unit" id="unit" placeholder="Masukkan Unit (gram / ml / Pcs)"> -->
    </div>
  </div>

  <div class="form-group">
    <input type="number" class="form-control form-control-user" name="harga" id="harga" placeholder="Harga (Rp)" autocomplete="off">
  </div>
  <div class="form-group">
    <input type="file" name="foto" class="form-control" id="foto">
  </div>
  <br>
  <button type="submit" class="btn btn-primary btn-user btn-block" name="save">Tambah Data</button>
  <hr>

</form>
<?php
require '../App/query.php';

$hapus = false;

if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];

  $produk = query_select('produk', "id_produk='$id'");
  if ($produk) {
    $namaFile = $produk[0]['foto'];

    if (file_exists("../foto_produk/" . $namaFile)) {
      unlink("../foto_produk/" . $namaFile);
    }

    mysqli_query($conn, "DELETE FROM produk WHERE id_produk='$id'");
    if (mysqli_affected_rows($conn) == 1) {
      echo "<script>alert('Data Berhasil Dihapus!')</script>";
      echo "<script>window.location.href='index.php?halaman=produk';</script>";
    }
  }
}

$produk;
$sql = "SELECT * FROM produk JOIN stok ON produk.id_produk=stok.id_produk";
$result = mysqli_query($conn, $sql);

$produk = [];
while ($row = mysqli_fetch_assoc($result)) {
  $produk[] = $row;
}

?>
<h2>Stok Barang</h2>
<div class="card">

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Terjual</th>
            <th class="text-center">Unit</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php for ($i = 0; $i < count($produk); $i++) : ?>
            <tr>
              <td class="text-center"><?= 1 + $i ?></td>
              <td><?= $produk[$i]["nama_produk"] ?> </td>
              <td>
                <!-- <?php

                      // if (($produk[$i]["stok_produk"] - $produk[$i]["produk_terjual"]) < 0) {
                      //   echo "0";
                      // } else {
                      //   echo $produk[$i]["stok_produk"] - $produk[$i]["produk_terjual"];
                      // }
                      ?> -->
                <?= $produk[$i]["stok_produk"] ?>
              </td>
              <td><?= $produk[$i]["produk_terjual"] ?></td>
              <td class="text-center"><?= $produk[$i]["unit"] ?></td>
              <td class="text-center">
                <!-- <a href="index.php?halaman=produk&hapus=<?= $produk[$i]['id_produk']; ?>" class="btn btn-warning btn-sm" onclick="return confirm('Apakah Yakin Ingin Menghapus?')">Hapus</a> -->
                <a href="index.php?halaman=tambah_stok&id=<?= $produk[$i]['id_produk'] ?>" class="btn btn-info btn-sm">Tambah Stok</a>
              </td>
            </tr>
          <?php endfor; ?>
        </tbody>
      </table>
    </div>


  </div>

</div>
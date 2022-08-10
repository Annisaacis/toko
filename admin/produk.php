<?php
  require '../App/query.php';
  
  $hapus = false;

  if(isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $produk = query_select('produk', "id_produk='$id'");
    if($produk) {
      $namaFile = $produk[0]['foto'];

      if(file_exists("../foto_produk/".$namaFile)) {
        unlink("../foto_produk/".$namaFile);
      }

      mysqli_query($conn, "DELETE FROM produk WHERE id_produk='$id'");
      mysqli_query($conn, "DELETE FROM stok WHERE id_produk='$id'");
      if(mysqli_affected_rows($conn)) {
        echo "<script>alert('Data Berhasil Dihapus!')</script>";
        echo "<script>window.location.href='index.php?halaman=produk';</script>";
      }
    }

  }

  $produk = query_select("produk");
  
?>
<h2>Data Barang</h2>
<div class="card">

  <div class="card-body">
  <a href="index.php?halaman=add" class="btn btn-primary btn-sm mb-3">Tambah Data</a>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th>Nama</th>
            <th class="text-center">Harga</th>
            <th class="text-center">Unit</th>
            <th class="text-center">Foto</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
          
        <tbody>
          <?php for($i = 0; $i < count($produk); $i++): ?>
            <tr>
              <td class="text-center"><?= 1 + $i?></td>
              <td><?= $produk[$i]["nama_produk"] ?></td>
              <td class="text-center">Rp.<?= number_format($produk[$i]["harga_produk"]) ?></td>
              <td class="text-center"><?= $produk[$i]["unit"] ?></td>
              <td class="text-center"><img src="../foto_produk/<?= $produk[$i]["foto"] ?>" style="width: 100px"></td>
              <td class="text-center">
                  <a href="index.php?halaman=produk&hapus=<?= $produk[$i]['id_produk']; ?>" class="btn btn-warning btn-sm" onclick="return confirm('Apakah Yakin Ingin Menghapus?')">Hapus</a>
                  <a href="index.php?halaman=edit_produk&id=<?= $produk[$i]['id_produk']; ?>" class="btn btn-info btn-sm">Edit</a>
                  <!-- <a href="" class="btn btn-primary btn-sm">Ubah</a> -->
              </td>
            </tr>
          <?php endfor; ?>
        </tbody>
      </table>
    </div>

    
  </div>
  
</div> 
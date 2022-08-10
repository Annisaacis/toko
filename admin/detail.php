<?php 

$result = mysqli_query($conn, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
          
$pembelian = [];
while( $row = mysqli_fetch_assoc($result) ) {
  $pembelian[] = $row;
}

?>
<h2>Detail Pembelian</h2>

<div class="card">
  <div class="card-body">
    <?php $total; ?>
    <?php for($i = 0; $i < count($pembelian); $i++): ?>
        <ul>
          <li>Dijual kepada : <?= $pembelian[$i]["nama_pelanggan"] ?></li>
          <li>Alamat : <?= $pembelian[$i]["alamat_pelanggan"] ?></li>
          <li>Tanggal : <?= $pembelian[$i]["tanggal_pembelian"] ?></li>
          <li>Total : <?= number_format($pembelian[$i]["total_pembelian"]) ?></li>
          <!-- OPEN Baru - tambah status untuk ditampilkan -->
          <li>Status : <?= $pembelian[$i]["status"] ?></li>
          <!-- ambil data status -->
          <?php $status = $pembelian[$i]["status"]; ?>
          <!-- CLOSE Baru -->
          <?php $total = $pembelian[$i]["total_pembelian"]; ?>
        </ul>
    <?php endfor; ?>
    

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Kuantitas</th>
            <th>Unit</th>
            <th>Harga Satuan (Rp)</th>
            <th>Jumlah (Rp)</th>
          </tr>
        </thead>
          <?php 
            $result = mysqli_query($conn, "SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'");
          
            $pembelian = [];
            while( $row = mysqli_fetch_assoc($result) ) {
              $pembelian[] = $row;
            }

          ?>
        <tbody>
          <?php for($i = 0; $i < count($pembelian); $i++): ?>
            <tr>
              <td><?= 1 + $i?></td>
              <td><?= $pembelian[$i]["nama_produk"] ?></td>
              <td><?= $pembelian[$i]["jumlah"] ?></td>
              <td><?= $pembelian[$i]["unit"] ?></td>
              <td><?= number_format($pembelian[$i]["harga_produk"]) ?></td>
              <td><?= number_format($pembelian[$i]["jumlah"] * $pembelian[$i]["harga_produk"]) ?></td>
            </tr>
          <?php endfor; ?>
          <tr>
            <td colspan="4"><b>Keterangan<b></td>
            <td>Jumlah Total</td>
            <td><?= number_format($total) ?></td>
          </tr>
        </tbody>
      </table>
      <!-- OPEN Baru - Print faktu hanya jika data status sama dengan selesai -->
      <?php if($status == "Selesai") { ?>
      <a href="print_faktur.php?id=<?= $_GET['id'] ?>" class="btn btn-primary">Print Faktur</a>
      <?php } ?>
      <!-- CLOSE Baru -->
  </div>
</div>

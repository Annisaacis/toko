<?php
require 'App/user_login.php';
// not_login('login', 'login.php');

require "App/db.php";
require 'App/query.php';

$conn = connect_DB();



$halaman = "Keranjang";

?>
<?php require 'Comp/header.php'; ?>

<body>
  <?php require 'Comp/navbar.php'; ?>
  <br><br>
  <section class="main mt-3 pt-5">
    <div class="container">
      <h2 class="mb-4">Riwayat Belanja</h2>
      <form action="" class="d-flex mt-5 mb-2" method="GET">
        <div class="d-flex">
          <input type="month" name="bulan" class="form-control" value="<?= isset($_GET['bulan']) ? $_GET['bulan'] : '' ?>">
          <button type="submit" class="btn btn-primary bg-gradient mx-1">
            <i class="fa fa-filter"></i>
          </button>
          <a href="history.php" class="btn btn-danger bg-gradient">
            Reset
          </a>
        </div>
      </form>
      <table class="table table-bordered table-striped rounded shadow overflow-hidden rounded-3">
        <thead class="table-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Foto</th>
            <!-- OPEN Baru -->
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
            <!-- CLOSE Baru -->
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          $conn = connect_DB();
          if (isset($_GET['bulan'])) {
            $bulan = date("m", strtotime($_GET['bulan']));
            $tahun = date("Y", strtotime($_GET['bulan']));
            $query = "SELECT * FROM `pembelian` LEFT JOIN pembelian_produk USING(id_pembelian) LEFT JOIN produk USING(id_produk) WHERE MONTH(tanggal_pembelian) = '$bulan' AND YEAR(tanggal_pembelian) = '$tahun' AND id_pelanggan = " . $_SESSION['login']['id_pelanggan']." ORDER BY tanggal_pembelian";
          } else {
            $query = "SELECT * FROM `pembelian` LEFT JOIN pembelian_produk USING(id_pembelian) LEFT JOIN produk USING(id_produk) WHERE id_pelanggan = " . $_SESSION['login']['id_pelanggan']." ORDER BY tanggal_pembelian";
          }
          $sql = mysqli_query($conn, $query);
          while ($data = mysqli_fetch_object($sql)) { ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $data->nama_produk ?></td>
              <td>Rp.<?= number_format($data->harga_produk) ?></td>
              <td><?= $data->tanggal_pembelian ?></td>
              <td><?= $data->jumlah ?> / <?= $data->unit ?></td>
              <td><img class="card-img-top p-2" src="foto_produk/<?= $data->foto ?>" alt="Card image cap" style="width: 150px;"></td>
              <!-- OPEN Baru -->
              <!-- Status pesanan -->
              <td><?= $data->status ?></td> 
              <?php if($data->status == 'Menunggu Konfirmasi') { ?>
              <!-- Tampilkan button selesai dengan disabled karena status masih 'Menunggu Konfirmasi' -->
              <td><button type="button" class="btn btn-primary bg-gradient" disabled>Selesai</button></td>
              <?php } else if($data->status == 'Dikirim') { ?>
              <!-- Tampilkan button selesai dengan link ke selesai.php dengan parameter id_pembelian agar nantinya di update status dari pembelian tersebut menjadi selesai -->
              <td><a href="selesai.php?id=<?= $data->id_pembelian ?>" class="btn btn-primary bg-gradient">Selesai</a></td>
              <?php } else if($data->status == 'Selesai') { ?>
                <td>-</td>
              <?php } ?>
              <!-- CLOSE Baru -->
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <a href="/toko/" class="btn btn-info mr-2 mt-4 bg-gradient text-white">Kembali</a>
    </div>
  </section>

  <?php include 'Comp/footer.php'; ?>
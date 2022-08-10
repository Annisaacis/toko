<?php
require 'App/user_login.php';
not_login('login', 'login.php');

require "App/db.php";
require 'App/query.php';

$conn = connect_DB();
$alper = [];
$idper = [];
$stk = [];

// ====================BARU=====================
if(isset($_POST['jumlah'])){
  $jumlah = (int)$_POST['jumlah'];
  $id_produk = (int)$_POST['id_produk'];

  $_SESSION['keranjang'][$id_produk] = $jumlah;
}
// ====================BARU=====================


if (isset($_GET["hapus"])) {
  $idHapus = $_GET["hapus"];

  if (isset($_SESSION["keranjang"][$idHapus])) {
    unset($_SESSION["keranjang"][$idHapus]);
    echo "<script>alert('Produk sudah dihapus dari keranjang belanja')</script>";
  }
}

if (isset($_GET["habis"])) {
  $idhabis = explode("_", $_GET["habis"]);
  $stok = explode("_", $_GET["stok"]);

  for ($k = 0; $k < count($idhabis); $k++) {
    if (isset($_SESSION["keranjang"][$idhabis[$k]])) {
      if ($stok[$k] == 0) {
        unset($_SESSION["keranjang"][$idhabis[$k]]);
      } else if ($_SESSION["keranjang"][$idhabis[$k]] > $stok[$k]) {
        $_SESSION["keranjang"][$idhabis[$k]] = intval($stok[$k]);
      }
    }
  }
}

$halaman = "Keranjang";

?>
<?php require 'Comp/header.php'; ?>

<body>
  <?php require 'Comp/navbar.php'; ?>
  <br><br>
  <section class="main mt-3 pt-5">

    <div class="container">
      <h2 class="mb-4">Keranjang Belanja</h2>
      <table class="table table-bordered table-striped overflow-hidden rounded-3">
        <thead class="table-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subjumlah</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($_SESSION['keranjang'])) : ?>
            <?php $nomor = 1; ?>
            <?php foreach ($_SESSION['keranjang'] as $key => $val) : ?>
              <?php
              $produk = query_select("produk", "id_produk='$key'")[0];
              $cek = query_select("stok", "id_produk='$key'")[0];
              ?>
              <tr class="">
                <th scope="row"><?= $nomor ?></th>
                <td><?= $produk['nama_produk'] ?></td>
                <td>Rp. <?= number_format($produk['harga_produk']) ?></td>

                <!-- BARU Membuat editable jumlah -->
                <td>
                  <form action="" method="POST">
                    <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">
                    <input type="number" name="jumlah" class="form-control" min="1" value="<?= $val ?>" max="<?= $cek['stok_produk'] ?>" onchange="submit()">
                  </form>
                </td>
                <!-- BARU Membuat editable jumlah -->

                <td>Rp. <?= number_format($produk['harga_produk'] * $val) ?></td>
                <td>
                  <?php if ($val > $cek['stok_produk']) { ?>
                    Habis
                    <?php $alert['checkout'] = true;
                    $alper[$nomor - 1] = $produk['nama_produk'];
                    $stk[$nomor - 1] = $cek['stok_produk'];
                    $idper[$nomor - 1] = $produk['id_produk'];
                    ?>
                  <?php } else { ?>
                    <a href="keranjang.php?hapus=<?= $produk["id_produk"] ?>" class="btn btn-danger btn-sm">Hapus</a>
                  <?php } ?>
                </td>
              </tr>
              <?php $nomor++; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
      <a href="/toko/" class="btn btn-info mr-2 bg-gradient text-white">Lanjutkan Belanja</a>
      <?php if (isset($_SESSION['keranjang']) && count($_SESSION['keranjang']) > 0) { ?>
        <a href="checkout.php" class="btn btn-warning bg-gradient text-white">Checkout</a>
      <?php } else { ?>
        <button disabled class="btn btn-warning bg-gradient text-white">Checkout</button>
      <?php } ?>
    </div>
  </section>

  <?php include 'Comp/footer.php'; ?>

  <?php

  if (isset($alert["checkout"])) {
    if ($alert["checkout"]) {

      echo '<script>swal("Maaf Stok dari beberapa produk pada keranjang anda habis/kurang", "Stok dari produk ' . join(", ", $alper) . ' habis", "error");</script>';
      echo "<script>setTimeout(() => {
          location.href='keranjang.php?habis=" . join("_", $idper) . "&stok=" . join("_", $stk) . "'
      }, 2100)</script>";
    }
  }

  ?>
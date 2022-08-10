<?php
require 'App/user_login.php';

if (!isset($_SESSION['login'])) {
  echo "<script>alert('Anda Harus Login Terlabih Dahulu')";
}
not_login('login', 'login.php');

if (empty($_SESSION['keranjang'])) {
  echo "<script>history.back();</script>";
}


require 'App/db.php';
require 'App/query.php';

$conn = connect_DB();

$alert;

$halaman = "Checkout";

if (isset($_POST["checkout"])) {

  $id_pelanggan = $_SESSION['login']['id_pelanggan'];
  $tanggal_pembelian = date("Y-m-d h:i");
  $total_pembelian = $_POST['total'];
  $pembayaran = $_POST['pembayaran'];
  $tahun = date("Y");

  $data = [
    "id_pembelian" => "",
    "id_pelanggan" => $id_pelanggan,
    "tanggal_pembelian" => $tanggal_pembelian,
    "total_pembelian" => $total_pembelian,
    "tahun" => date("Y"),
    "pembayaran" => $pembayaran,
    "perkiraan_sampai" => $tanggal_pembelian,
  ];

  query_insert('pembelian', $data);
  $id_pembelian = $conn->insert_id;

  foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) {
    $data = [
      "id_pembelian_produk" => "",
      "id_pembelian" => $id_pembelian,
      "id_produk" => $id_produk,
      "jumlah" => $jumlah,
    ];
    query_insert('pembelian_produk', $data);

    // Update Stok Produk
    $stok_produk_old = query_select('stok', "id_produk=$id_produk")[0]["stok_produk"];
    $new_stok = $stok_produk_old - $jumlah;

    $sql = "UPDATE stok SET stok_produk='$new_stok' WHERE id_produk='$id_produk'";
    mysqli_query($conn, $sql);

    // Update Produk Terjual
    $produk_terjual_old = query_select('stok', "id_produk=$id_produk")[0]["produk_terjual"];
    $new_produk_terjual = $produk_terjual_old + $jumlah;

    $sql = "UPDATE stok SET produk_terjual='$new_produk_terjual' WHERE id_produk='$id_produk'";
    mysqli_query($conn, $sql);
  }

  unset($_SESSION["keranjang"]);

  $alert["checkout"] = true;
}

$halaman = "Checkout";
?>
<?php require 'Comp/header.php'; ?>

<body>
  <?php require 'Comp/navbar.php'; ?>

  <section class="main mt-3 pt-5">

    <div class="container">
      <h2 class="mb-4">Keranjang Belanja</h2>
      <table class="table table-bordered table-striped table-hover rounded-3 overflow-hidden">
        <thead class="table-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subjumlah</th>
          </tr>
        </thead>
        <tbody>

          <?php if (isset($_SESSION['keranjang'])) : ?>
            <?php $nomor = 1; ?>
            <?php $total = 0; ?>
            <?php foreach ($_SESSION['keranjang'] as $key => $val) : ?>
              <?php $produk = query_select("produk", "id_produk='$key'")[0]; ?>
              <tr>
                <th scope="row"><?= $nomor ?></th>
                <td><?= $produk['nama_produk'] ?></td>
                <td>Rp. <?= number_format($produk['harga_produk']) ?></td>
                <td><?= $val ?></td>
                <td>Rp. <?= number_format($produk['harga_produk'] * $val) ?></td>
              </tr>
              <?php $nomor++; ?>
              <?php $total += ($produk['harga_produk'] * $val) ?>
            <?php endforeach; ?>
          <?php else : ?>
            <tr>
              <td>
                Keranjang Kosong
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
      <form action="" method="post" class="mt-5">
        <div class="d-flex justify-content-end">
          <div class="col-12 col-lg-5">
            <table class="table table-bordered table-striped table-hover rounded-3 overflow-hidden">
              <tr>
                <td>Total Belanja : </td>
                <td>
                  <?php if (isset($total)) : ?>
                    <h6><b>Rp <?= number_format($total) ?>,-</b></h6>
                  <?php endif; ?>
                </td>
              </tr>
              <tr>
                <td>Bayar : </td>
                <td>
                  <?php if (isset($total)) : ?>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" onchange="setPembayaran('Bank Transfer')" required>
                      <label class="form-check-label" for="inlineRadio1">Bank Transfer</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" onchange="setPembayaran('Cash')" required>
                      <label class="form-check-label" for="inlineRadio2">Cash</label>
                    </div>
                  <?php endif; ?>
                </td>
              </tr>
            </table>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-md-4">
              <input type="hidden" class="form-control form-control-user" readonly id="user" name="user" aria-describedby="emailHelp" value="<?= $_SESSION['login']["nama_pelanggan"] ?>" autocomplete="off">
            </div>
            <div class="col-md-4">
              <input type="hidden" class="form-control form-control-user" readonly id="user" name="user" aria-describedby="emailHelp" value="<?= $_SESSION['login']["alamat_pelanggan"] ?>" autocomplete="off">
            </div>
            <input type="hidden" name="total" id="total" value="<?= $total; ?>">
            <input type="hidden" name="pembayaran" id="pembayaran">
          </div>
          <div class="d-flex justify-content-end">
            <?php if (isset($_SESSION['keranjang'])) : ?>
              <button type="submit" name="checkout" id="btn-checkout" class="btn btn-warning btn-sm bg-gradient mt-3 text-white py-2 px-4" disabled>Checkout</button>
            <?php else : ?>
              <a class="btn btn-warning btn-sm mt-3">Checkout</a>
            <?php endif; ?>
          </div>
        </div>
      </form>
    </div>
  </section>
  <script>
    function setPembayaran(p) {
      document.getElementById("pembayaran").value = p;
      document.getElementById("btn-checkout").disabled = false;
    }
  </script>


  <?php include 'Comp/footer.php'; ?>

  <?php

  if (isset($alert["checkout"])) {
    if ($alert["checkout"]) {
      echo '<script>swal("Pembelian Berhasil", "", "success");</script>';
      echo "<script>setTimeout(() => {
        window.location.href = 'pembayaran.php';
      }, 1500)</script>";
    }
  }

  ?>
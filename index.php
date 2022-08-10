<?php
require 'App/user_login.php';
// not_login('login.php', 'login');

require "App/db.php";
require 'App/query.php';

$conn = connect_DB();
$sql = "SELECT * FROM produk JOIN stok WHERE produk.id_produk=stok.id_produk";

$res = mysqli_query($conn, $sql);
$produk = [];
while ($row = mysqli_fetch_assoc($res)) {
  $produk[] = $row;
}

$halaman = "Beranda";
?>

<?php require 'Comp/header.php'; ?>


<style>
  .shadow-sm {
    box-shadow: 0px 3px 5px rgba(0, 0, 0, .15);
  }

  footer {
    text-align: center;
  }

  .zoom,
  .zoom-img {
    transition: all ease-in-out 0.4s;
  }

  .zoom:hover {
    transform: scale(1.05);
  }

  .zoom-img:hover {
    -webkit-filter: brightness(50%);
    -webkit-transition: all 1s ease;
    -moz-transition: all 1s ease;
    -o-transition: all 1s ease;
    -ms-transition: all 1s ease;
    transition: all 1s ease;
  }

  @media (max-width: 576px) {
    .card-title {
      font-size: 14px;
    }

    .card-text {
      font-size: 12px;
    }

    footer p {
      font-size: 10px;
    }
  }
</style>
<!-- Navbar -->
<?php require 'Comp/navbar.php'; ?>
<!-- endnavbar -->

<!-- Jumbotron -->
<?php require 'Comp/jumbotron.php' ?>
<!-- End Jumbotron -->

<!-- content -->
<section class="main mt-4 pt-5" style="min-height: 88vh;">
  <div class="container mt-5">
    <div class="d-flex justify-content-between">
      <div class="container-fluid">
        <hr>
      </div>
      <h3 class="text-center text-break text-nowrap">Tentang Kami</h3>
      <div class="container-fluid">
        <hr>
      </div>
    </div>
    <p class="text-center my-3">
      Dwi Jaya Probolinggo adalah toko bangunan yang menyediakan kebutuhan pembangunan dan renovasi rumah, kantor dan bangunan lainnya. Kami menjual berbagai macam bahan bangunan seperti Genteng, Seng Gajah, Seng Resin, Toto, Galvalum (Hollow, Reng, Canal C, dll), Spandek. Kami juga menjual berbagai Keramik, Lantai Granit/Granit Tile, Sanitary Toto (wastafel, kloset, shower, dll).
      <br><br>
      Dwi Jaya Probolinggo melayani pembelian dan pengiriman ke seluruh Indonesia termasuk ke luar pulau dan luar kota Probolinggo.
    </p>
  </div>
  <br><br><br>
  <div class="container">
    <div class="d-flex justify-content-between">
      <div class="container-fluid">
        <hr>
      </div>
      <h3 class="text-center text-break text-nowrap">Produk Kami</h3>
      <div class="container-fluid">
        <hr>
      </div>
    </div>
    <br><br>
    <div class="row">
      <?php for ($i = 0; $i < 4; $i++) : ?>
        <div class="col-md-3 col-6 mb-4">

          <div class="card shadow rounded-3 border-0">
            <img class="card-img-top p-3 zoom-img" src="foto_produk/<?= $produk[$i]['foto'] ?>" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title"><?= $produk[$i]['nama_produk'] ?></h5>
              <p class="text-secondary"><span class="text-success">Rp.</span><span class="text-success" style="font-size: 25px;"><?= number_format($produk[$i]['harga_produk']) ?> </span>/ <?= $produk[$i]["unit"] ?></p>
              <?php if ($produk[$i]["stok_produk"] == 0 || ($produk[$i]["stok_produk"] - $produk[$i]["produk_terjual"]) == 0) {
              ?>
                <p class="text-secondary">
                  <small>
                    Stok : <span class="text-danger">Kosong</span>
                  </small>
                </p>
                <button type="button" class="btn btn-info btn-sm bg-gradient col-12 text-white py-2" disabled><i class="fa-solid fa-plus"></i> Keranjang</button>
              <?php } else { ?>
                <p class="text-secondary">
                  <small>
                    Stok : <?= $produk[$i]["stok_produk"] . " " . $produk[$i]["unit"]; ?>
                  </small>
                </p>
                <?php if (isset($_SESSION['login'])) { ?>
                  <?php if (!empty($_SESSION['keranjang'][$produk[$i]['id_produk']]) && $_SESSION['keranjang'][$produk[$i]['id_produk']] < $produk[$i]["stok_produk"]) { ?>
                    <!-- OPEN Ubah dari langsung direct ke beli.php dengan a href menjadi buka modal -->
                    <button type="button" data-bs-toggle="modal" data-bs-target="#barang<?= $i ?>" class="btn btn-info btn-sm bg-gradient col-12 text-white py-2 zoom"><i class="fa-solid fa-plus"></i> Keranjang</button>
                    <!-- CLOSE Ubah dari langsung direct ke beli.php dengan a href menjadi buka modal -->
                  <?php } else if (empty($_SESSION['keranjang'][$produk[$i]['id_produk']])) { ?>
                    <!-- OPEN Ubah dari langsung direct ke beli.php dengan a href menjadi buka modal -->
                    <button type="button" data-bs-toggle="modal" data-bs-target="#barang<?= $i ?>" class="btn btn-info btn-sm bg-gradient col-12 text-white py-2 zoom"><i class="fa-solid fa-plus"></i> Keranjang</button>
                    <!-- CLOSE Ubah dari langsung direct ke beli.php dengan a href menjadi buka modal -->
                  <?php } else { ?>
                    <a class="btn btn-info btn-sm bg-gradient col-12 text-white py-2 zoom" onclick="alert('Sudah mencapai limit stok!')"><i class="fa-solid fa-plus"></i> Keranjang</a>
                  <?php } ?>
                <?php } else { ?>
                  <a class="btn btn-info btn-sm bg-gradient col-12 text-white py-2 zoom" onclick="alert('Silahkan login terlebih dahulu!')"><i class="fa-solid fa-plus"></i> Keranjang</a>
                <?php } ?>
              <?php }  ?>
            </div>
          </div>
        </div>
        <!-- OPEN Modal input jumlah barang (BARU) -->
        <div class="modal fade" id="barang<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <!-- Ubah metode dari GET menjadi POST menghindari error oleh user jika menggunakan GET -->
            <form action="beli.php" method="POST" class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Masukkan Jumlah Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Param id untuk identifikasi barang pada proses masuk keranjang -->
                <input type="hidden" name="id" value="<?= $produk[$i]['id_produk'] ?>">
                <!--// Param id untuk identifikasi barang pada proses masuk keranjang -->

                <!-- Menentukan max number/jumlah barang yang bisa dimasukkan bergantung pada isi keranjang
                  Jika produk tidak ada di keranjang maka maksimal produk akan di-set menjadi total stok tersedia
                  Jika produk ada pada keranjang kalkulasi max dengan cara kurangi total stok dari produk dengan stok pada keranjang -->
                <input type="number" name="jumlah" class="form-control" min="1" max="<?= empty($_SESSION['keranjang'][$produk[$i]['id_produk']]) ? $produk[$i]["stok_produk"] : $produk[$i]["stok_produk"] - $_SESSION['keranjang'][$produk[$i]['id_produk']] ?>" required>
                <!-- =========================================================== -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" type="button" class="btn btn-info bg-gradient text-white">Tambah</button>
              </div>
            </form>
          </div>
        </div>
        <!-- CLOSE Modal input jumlah barang (BARU) -->
      <?php endfor; ?>

    </div>
    <br><br><br>
    <div class="d-sm-flex d-none position-relative bg-light p-2" style="border-radius: 10px;">
      <img src="foto_produk/pasir.jpg" class="flex-shrink-0 me-3 zoom zoom-img" alt="..." style="width : 480px; border-radius: 10px;">
      <div class="my-auto mx-5">
        <h3 class="mt-0">Pasir</h3>
        <p>Kami menjual berbagai jenis pasir yang anda butuhkan untuk membangun rumah impian anda. Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, rerum. Hic ad optio provident inventore assumenda laudantium animi non labore cumque molestias, magni autem alias quae, accusantium exercitationem similique distinctio?</p>
        <form action="produk.php" method="POST">
          <input type="hidden" name="search" value="pasir">
          <button type="submit" class="btn btn-primary bg-gradient text-white">Lihat produk</a>
        </form>
      </div>
    </div>
    <br>
    <div class="d-sm-flex d-none position-relative bg-light p-2" style="border-radius: 10px;">
      <div class="my-auto mx-5">
        <h3 class="mt-0">Batu</h3>
        <p>Kami menjual berbagai jenis batu yang anda butuhkan untuk membangun rumah impian anda. Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, rerum. Hic ad optio provident inventore assumenda laudantium animi non labore cumque molestias, magni autem alias quae, accusantium exercitationem similique distinctio?</p>
        <form action="produk.php" method="POST">
          <input type="hidden" name="search" value="Batu">
          <button type="submit" class="btn btn-primary bg-gradient text-white">Lihat produk</a>
        </form>
      </div>
      <img src="foto_produk/2.-BATU-SPLIT.jpg" class="flex-shrink-0 mw-3 zoom zoom-img" alt="..." style="width : 480px; border-radius: 10px;">
    </div>
  </div>
  </div>

</section>
<!-- endContent -->

<footer class="bg-light text-center text-lg-start" style="margin-top: 150px;">
  <div class="container p-4">
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h4 class="text-uppercase">CV. DWI JAYA PROBOLINGGO</h4>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase">Navigasi</h5>

        <ul class="list-unstyled mb-0">
          <li>
            <a href="#" class="text-dark">Produk</a>
          </li>
          <li>
            <a href="#" class="text-dark">Tentang</a>
          </li>
          <li>
            <a href="#" class="text-dark">Blog</a>
          </li>
          <li>
            <a href="#" class="text-dark">Kontak</a>
          </li>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-0">Hubungi Kami</h5>

        <ul class="list-unstyled">
          <li>
            <a href="#" class="text-dark">Pesan Email</a>
          </li>
          <li>
            <a href="#" class="text-dark">Chat Admin Whatsapp</a>
          </li>
          <li>
            <a href="#" class="text-dark">Lokasi Toko</a>
          </li>
        </ul>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase mb-0">Temukan Kami</h5>

        <ul class="list-unstyled">
          <li>
            <a href="#" class="text-primary">
              <h3>
                <i class="fa-brands fa-facebook-square"></i>
              </h3>
            </a>
          </li>
          <li>
            <a href="#" class="text-info">
              <h3>
                <i class="fa-brands fa-twitter-square"></i>
              </h3>
            </a>
          </li>
          <li>
            <a href="#" class="text-secondary">
              <h3>
                <i class="fa-brands fa-instagram-square"></i>
              </h3>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2022 Copyright:
    <a class="text-dark" href="#">build by CV DWI JAYA PROBOLINGGO</a>
  </div>
</footer>

<!-- <footer class="mt-5 pt-3 pb-4 bg-light">
  <p class="mb-0">&copy; copyright 2022 | build by <a href="" class="text-info">CV DWI JAYA PROBOLINGGO</a></p>
</footer> -->

<?php include 'Comp/footer.php'; ?>
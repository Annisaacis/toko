<?php
require 'App/user_login.php';
// not_login('login.php', 'login');

require "App/db.php";
require 'App/query.php';




$conn = connect_DB();

$query = "SELECT * FROM unit";
$sql2 = mysqli_query($conn, $query);


if (isset($_POST['search'])) {
  $key = $_POST['search'];
  $sql = "SELECT * FROM produk JOIN stok WHERE produk.id_produk=stok.id_produk AND nama_produk LIKE '%$key%'";
} else {
  if (isset($_GET['unit']) && $_GET['unit'] != '') {
    $u = $_GET['unit'];
    $sql = "SELECT * FROM produk JOIN stok WHERE produk.id_produk=stok.id_produk AND unit = '$u'";
  } else {
    $sql = "SELECT * FROM produk JOIN stok WHERE produk.id_produk=stok.id_produk";
  }
}
$res = mysqli_query($conn, $sql);

$produk = [];
while ($row = mysqli_fetch_assoc($res)) {
  $produk[] = $row;
}
$row = count($produk);
$halaman = "Produk";
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

<!-- content -->
<section class="main mt-4 pt-5" style="min-height: 88vh; overflow-x: hidden;">
  <div class="container my-5">
    <div class="card shadow-sm" id="filter">
      <div class="d-flex justify-content-between card-body">
        <form action="produk.php" method="POST" class="form-group col-md-5">
          <label for="unit">Cari Produk</label>
          <div class="d-flex">
            <input type="search" name="search" placeholder="Cari Produk..." class="form-control">
            <button type="submit" class="btn btn-info bg-gradient text-white mx-2">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </form>
        <form action="" method="GET" class="form-group col-md-5">
          <label for="unit">Filter berdasarkan unit</label>
          <div class="d-flex">
            <select name="unit" id="unit" class="form-control">
              <option value="">Semua</option>
              <?php while ($unit = mysqli_fetch_object($sql2)) { ?>
                <option value="<?= $unit->unit ?>" <?= isset($_GET['unit']) ? ($_GET['unit'] == $unit->unit ? 'selected' : '') : '' ?>>
                  <?= $unit->unit ?>
                </option>
              <?php } ?>
            </select>
            <button type="submit" class="btn btn-info bg-gradient text-white mx-2">
              <i class="fa fa-filter"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
    <button class="btn btn-secondary mt-4 py-2 px-3" onclick="showFilter()" id="btn-filter">
      <span class="text-center"><i class="fa fa-filter"></i></span>
    </button>
    <br><br>
    <?php if (isset($_POST['search'])) { ?>
      <h5>Hasil search dengan kata kunci "<?= $_POST['search'] ?>"</h5>
    <?php } ?>
    <br>
    <div class="row">
      <?php if ($row > 0) { ?>
        <?php for ($i = 0; $i < count($produk); $i++) : ?>
          <div class="col-md-3 col-6 mb-4">

            <div class="card shadow rounded-3 border-0">
              <img class="card-img-top p-3 zoom-img" src="foto_produk/<?= $produk[$i]['foto'] ?>" alt="Card image cap" style="border-radius: 21px;">
              <div class="card-body">
                <h5 class="card-title"><?= $produk[$i]['nama_produk'] ?></h5>
                <h5 class="text-secondary"><span class="text-success">Rp.</span><span class="text-success" style="font-size: 25px;"><?= number_format($produk[$i]['harga_produk']) ?> </span>/ <?= $produk[$i]["unit"] ?></h5>
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
      <?php } else { ?>
        <?php if (isset($_POST['search'])) { ?>
          <h3 class="text-center mt-5">Produk dengan kata kunci "<?= $_POST['search'] ?>" tidak ditemukan.</h3>
        <?php } else { ?>
          <h3 class="text-center mt-5">Produk tidak ada.</h3>
        <?php } ?>
      <?php } ?>
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
        <h5 class="text-uppercase mb-0">Temukan Kami</h5>

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

<script>
  let showF = 1;

  function showFilter() {
    if (showF == 0) {
      document.getElementById("filter").style.right = "-150%";
      document.getElementById("filter").style.transition = "right 1200ms";
      showF++;
      // setTimeout(() => {
      //   document.getElementById("filter").style.display = "none";
      // }, 1250)
    } else if (showF == 1) {
      // document.getElementById("filter").style.display = "block";
      document.getElementById("filter").style.right = "0";
      document.getElementById("filter").style.transition = "right 1200ms";
      showF--;
    }
  }
</script>

<?php include 'Comp/footer.php'; ?>
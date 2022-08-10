<?php
require 'App/user_login.php';
not_login('login.php', 'login');

require "App/db.php";
require 'App/query.php';

$conn = connect_DB();
$sql = "SELECT * FROM produk JOIN stok WHERE produk.id_produk=stok.id_produk";

$res = mysqli_query($conn, $sql);
$produk = [];
while ($row = mysqli_fetch_assoc($res)) {
  $produk[] = $row;
}

$halaman = "Profile";
?>

<?php require 'Comp/header.php'; ?>
<?php
require 'Comp/navbar.php'; ?>

<main class="mt-5 pt-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header d-flex">

            <h6 class="py-1"><i class="fa fa-user"></i> Profile</h6>
          </div>
          <div class="card-body">
            <h3 class="text-center mb-5">Profile Anda</h3>
            <!-- <h5 class="card-title"><?= $_SESSION["login"]["nama_pelanggan"] ?></h5>
            <p class="card-text"><?= $_SESSION["login"]["alamat_pelanggan"] ?></p> -->

            <div class="row mb-3">
              <div class="col-sm-6">
                <label for="username">Username : </label>
                <input type="text" name="username" readonly value="<?= $_SESSION["login"]["username"] ?>" class="form-control">
              </div>
              <div class="col-sm-6">
                <label for="password">Password : </label>
                <input type="password" name="password" readonly value="<?= $_SESSION["login"]["password"] ?>" class="form-control">
              </div>
            </div>
            <a href="ubah_profile.php" class="btn btn-primary bg-gradient px-4">Ubah</a>
            <a href="index.php" class="btn btn-secondary bg-gradient">Kembali</a>
          </div>

        </div>
      </div>
    </div>

  </div>
</main>

<?php require 'Comp/footer.php'; ?>
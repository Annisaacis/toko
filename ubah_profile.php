<?php
require 'App/user_login.php';
not_login('login.php', 'login');

require "App/db.php";
require 'App/query.php';

$conn = connect_DB();
$query = "SELECT * FROM pelanggan WHERE id_pelanggan = ".$_SESSION['login']['id_pelanggan']." LIMIT 1";
$sql = mysqli_query($conn, $query);
$user = mysqli_fetch_object($sql);


$halaman = "Profile";
$alert;

if (isset($_POST["simpan"])) {

  $data = [
    "id_pelanggan" => htmlspecialchars($_POST["id_pelanggan"]),
    "username" => htmlspecialchars($_POST["username"]),
    "nama_pelanggan" => htmlspecialchars($_POST["nama_pelanggan"]),
    "alamat_pelanggan" => htmlspecialchars($_POST["alamat_pelanggan"]),
    "password" => mysqli_real_escape_string($conn, $_POST["password"]),
  ];

  $sql = "UPDATE pelanggan SET username='$data[username]', nama_pelanggan='$data[nama_pelanggan]', alamat_pelanggan='$data[alamat_pelanggan]', password='$data[password]' WHERE id_pelanggan='$data[id_pelanggan]'";

  mysqli_query($conn, $sql);
  $res = mysqli_affected_rows($conn);

  if ($res) {
    $alert["ubah"] = true;
    $_SESSION["login"] = $data;
  } else {
    $alert["ubah"] = false;
  }
}
?>

<?php require 'Comp/header.php'; ?>
<?php
require 'Comp/navbar.php'; ?>

<main class="mt-5 pt-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <div class="d-flex py-2">
              <h5>
                <i class="fa fa-user"></i> Edit Profile
              </h5>
            </div>
          </div>
          <div class="card-body">

            <form action="" method="post">
              <h3 class="text-center mb-5">Profile Anda</h3>
              <label for="nama_pelanggan">Nama Lengkap : </label>
              <input type="text" name="nama_pelanggan" value="<?= $user->nama_pelanggan ?>" class="form-control mb-3">

              <input type="hidden" name="id_pelanggan" value="<?= $user->id_pelanggan ?>">

              <label for="alamat_pelanggan">Alamat : </label>
              <textarea class="form-control mb-3" name="alamat_pelanggan" id="alamat_pelanggan" cols="30" rows="4"><?= $user->alamat_pelanggan ?></textarea>
              <!-- <input type="text" name="alamat_pelanggan" value="<?= $user->alamat_pelanggan ?>" class="form-control mb-3"> -->

              <div class="row mb-3">
                <div class="col-sm-6">
                  <label for="username">Username : </label>
                  <input type="text" name="username" value="<?= $user->username ?>" class="form-control">
                </div>
                <div class="col-sm-6">
                  <label for="password">Password : </label>
                  <div class="input-group">
                    <input type="password" name="password" class="form-control" value="<?= $user->password ?>" id="pass">
                    <span class="input-group-text" style="cursor: pointer;" onclick="showPassword()"><i class="fa fa-eye-slash" id="showpass"></i></span>
                  </div>
                </div>
              </div>
              <button type="submit" name="simpan" class="btn btn-primary bg-gradient">Simpan</button>
              <a href="profile.php" name="simpan" class="btn btn-secondary bg-gradient">Kembali</a>
            </form>

          </div>
        </div>
      </div>
    </div>

  </div>
</main>

<script>
  let show = 0;

  function showPassword() {
    if (show == 0) {
      document.getElementById("pass").setAttribute("type", "text");

      document.getElementById("showpass").classList.remove("fa-eye-slash");
      document.getElementById("showpass").classList.add("fa-eye");
      show++;
    } else if (show == 1) {
      document.getElementById("pass").setAttribute("type", "password");

      document.getElementById("showpass").classList.remove("fa-eye");
      document.getElementById("showpass").classList.add("fa-eye-slash");

      show--;
    }

  }
</script>

<?php require 'Comp/footer.php'; ?>


<?php

if (isset($alert["ubah"])) {
  if ($alert["ubah"]) {
    echo '<script>swal("Berhasil", "Profil Berhasil Diubah", "success");</script>';
    echo "<script>setTimeout(() => {
      window.location.href = 'profile.php';
    }, 1500)</script>";
  } else {
    echo '<script>swal("Gagal", "Profil Gagal Diubah", "error");</script>';
  }
}

?>
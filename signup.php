<?php

$halaman = "Daftar";
$alert;

if (isset($_POST["daftar"])) {
  require 'App/db.php';
  $conn = connect_DB();

  if ($_POST["nama"] != "" && $_POST["alamat"] != "" && $_POST["password"] != "" && $_POST["username"] != "") {

    require 'App/query.php';

    $data = [
      "id" => "",
      "username" => htmlspecialchars($_POST["username"]),
      "nama" => htmlspecialchars($_POST["nama"]),
      "alamat" => htmlspecialchars($_POST["alamat"]),
      "password" => mysqli_real_escape_string($conn, $_POST["password"]),
    ];

    $res = query_insert("pelanggan", $data);

    if ($res) {
      $alert["registrasi"] = true;
    } else {
      $alert["registrasi"] = false;
    }
  } else {
    $alert["error"] = true;
  }
}


?>

<?php require 'Comp/header.php' ?>

<style>
  body {
    background-color: #eee;
    padding-bottom: 16px;
  }

  .card {
    box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.1);
  }
</style>

<section class="vh-100 mt-3" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Mendaftar di Toko Kami</p>

                <form class="mx-1 mx-md-4" action="" method="post">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw mr-3"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw mr-3"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama" autocomplete="off" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-home fa-lg me-3 fa-fw mr-3"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" autocomplete="off" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw mr-3"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" name="daftar" class="btn btn-info bg-gradient text-white">Daftar</button>
                  </div>
                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <p>Sudah Punya Akun? <a href="login.php" class="text-info">Login</a></p>
                  </div>


                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="foto_produk/warehouse-building-materials-industiral-store_102375-446.jpg" class="img-fluid" alt="Sample image" style="-webkit-filter: brightness(70%);">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require 'Comp/footer.php' ?>

<?php

if (isset($alert["error"])) {
  if ($alert["error"]) {
    echo '<script>swal("Error!", "Isi Semua Kolom Dengan Benar!", "error");</script>';
  }
}

if (isset($alert["registrasi"])) {
  if ($alert["registrasi"]) {
    echo '<script>swal("Berhasil Registrasi!", "", "success");</script>';
    echo "<script>setTimeout(() => {
      window.location.href = 'login.php';
    }, 1500)</script>";
  } else {
    echo '<script>swal("Gagal Registrasi!", "", "error");</script>';
  }
}

?>
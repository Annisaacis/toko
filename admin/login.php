<?php
session_start();
require "../App/db.php";
$conn = connect_DB();
$alert;

if (isset($_POST["login"])) {

  if ($_POST["username"] != "" && $_POST["password"] != "") {

    require '../App/query.php';

    $data = [
      "username" => htmlspecialchars($_POST["username"]),
      "password" => mysqli_real_escape_string($conn, $_POST["password"]),
    ];

    $res = query_select("admin", "username='$data[username]' && password='$data[password]'");

    if ($res) {
      $res = $res[0];
    }


    if ($res) {
      $_SESSION["admin"] = $res;
      $alert["login"] = true;
    } else {
      $alert["login"] = false;
    }
  } else {
    $alert["error"] = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <style>
    .glass {
      /* From https://css.glass */
      background: rgba(255, 255, 255, 0.36);
      border-radius: 16px;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(5px);
      -webkit-backdrop-filter: blur(5px);
      border: 1px solid rgba(255, 255, 255, 0.3);
    }
  </style>
</head>

<body class="bg-gradient-primary" style="background-image: url('img/photo-1599707254554-027aeb4deacd.avif');">

  <div class="container mt-5">

    <!-- Outer Row -->
    <div class="row justify-content-center px-5">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5 glass">
          <div class="card-body p-0">
            <div class="row px-2">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login Admin</h1>
                  </div>
                  <form method="post" class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                    </div>

                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    <hr>
                  </form>
                  <hr>
                  <div class="text-center ">
                    <a class="small text-white" href="../index.php">Go To User Page</a>
                  </div>
                  <div class="text-center">
                    <a class="small text-white" href="#">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</body>

</html>

<?php

if (isset($alert["error"])) {
  if ($alert["error"]) {
    echo '<script>swal("Error!", "Isi Semua Kolom Dengan Benar!", "error");</script>';
  }
}

if (isset($alert["login"])) {
  if ($alert["login"]) {
    echo '<script>swal("Berhasil Login!", "", "success");</script>';
    echo "<script>setTimeout(() => {
      window.location.href = 'index.php';
    }, 1500)</script>";
  } else {
    echo '<script>swal("Gagal Login!", "Username atau Password Salah", "error");</script>';
  }
}

?>
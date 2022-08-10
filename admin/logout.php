<?php

require 'login.php';
echo '<script>swal("Berhasil Logout!", "", "success");</script>';
session_start();
session_unset();
session_destroy();
echo "<script>setTimeout(() => {
  window.location.href = 'login.php';
}, 1500)</script>";

<?php

require 'Comp/footer.php';
echo '<script>swal("Berhasil Logout!", "", "success");</script>';
session_start();
session_unset();
session_destroy();
echo "<script>setTimeout(() => {
  window.location.href = 'index.php';
}, 1500)</script>";

<?php
require 'App/user_login.php';
not_login('login.php', 'login');


// BARU ganti dari get ke post
$id_produk = $_POST['id'];
// Menambahakan jumlah
$jumlah = $_POST['jumlah'];
// BARU

require 'App/db.php';
require 'App/query.php';
require 'Comp/footer.php';

$conn = connect_DB();

$res = query_select('stok', "id_produk='$id_produk'")[0];

if ($res["stok_produk"] == 0 || ($res["stok_produk"] - $res["produk_terjual"]) == 0) {
  echo "<script>swal('Gagal', 'Stok Barang Kosong', 'error')</script>";
  echo "<script>setTimeout(() => {
    window.location.href = 'index.php';
  }, 1500)</script>";
} else {
  //jika produk sudah ada;
  if (isset($_SESSION['keranjang'][$id_produk])) {
    // Tidak lagi increment 1 tetapi menggunakan jumlah yang diinput user
    $_SESSION['keranjang'][$id_produk] += $jumlah;
  } else {
    // jika produk belom ada
    // Tidak lagi increment 1 tetapi menggunakan jumlah yang diinput user
    $_SESSION['keranjang'][$id_produk] = $jumlah;
  }

  echo "<script>swal('Sukses', 'Produk sudah ditambah ke keranjang', 'success')</script>";
  echo "<script>setTimeout(() => {
    window.location.href = 'produk.php';
  }, 1500)</script>";
}

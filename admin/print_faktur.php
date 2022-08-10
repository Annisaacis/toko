<?php 
require '../App/db.php';
$conn = connect_DB();
$result = mysqli_query($conn, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
          
$pembelian = [];
while( $row = mysqli_fetch_assoc($result) ) {
  $pembelian[] = $row;
}

$html = '<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Data Faktur</title>
</head>
<body>
<div class="container">
<h2>Detail Pembelian</h2>


<div class="card border-0">
  <div class="card-body">';

  $total;
  for($i = 0; $i < count($pembelian); $i++) {
    $html .= '<ul>';
    $html .= "<li>Dijual kepada : " . $pembelian[$i]["nama_pelanggan"] . "</li>";
    $html .= "<li>Alamat : " . $pembelian[$i]["alamat_pelanggan"] . "</li>";
    $html .= "<li>Tanggal : " . $pembelian[$i]["tanggal_pembelian"] . "</li>";
    $html .= "<li>Total : " . number_format($pembelian[$i]["total_pembelian"]) . "</li>";
    $html .= '</ul>';
    $total = $pembelian[$i]["total_pembelian"];
  }

  $html .= '<table class="table table-bordered mt-4" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Barang</th>
      <th>Kuantitas</th>
      <th>Unit</th>
      <th>Harga Satuan (Rp)</th>
      <th>Jumlah (Rp)</th>
    </tr>
  </thead><tbody>';
  $result = mysqli_query($conn, "SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$_GET[id]'");
          
  $pembelian = [];
  while( $row = mysqli_fetch_assoc($result) ) {
    $pembelian[] = $row;
  }

  for($i = 0; $i < count($pembelian); $i++) {
    $html .= '<tr>';
    $html .= '<td>' . 1 + $i . '</td>';
    $html .= '<td>' . $pembelian[$i]["nama_produk"] . '</td>';
    $html .= '<td>' . $pembelian[$i]["jumlah"] . '</td>';
    $html .= '<td>' . $pembelian[$i]["unit"] . '</td>';
    $html .= '<td>' . number_format($pembelian[$i]["harga_produk"]) . '</td>';
    $html .= '<td>' . number_format($pembelian[$i]["jumlah"] * $pembelian[$i]["harga_produk"]) . '</td>';
    $html .= '</tr>';
  }

  $html .= '<tr>
  <td colspan="4"><b>Keterangan<b></td>
  <td>Jumlah Total</td>';

  $html .= '<td>' . number_format($total) . '</td>';
  $html .= '</tr></tbody></table></div></div></div></body></html>';
  $html .= '';
  echo $html;

  echo "<script>window.print();</script>";
  // echo "<script>window.location.href='index.php?halaman=pembelian';</script>";

// require_once 'dompdf/autoload.inc.php';
// // reference the Dompdf namespace
// use Dompdf\Dompdf;
// $dompdf = new Dompdf();

// $dompdf->loadHtml($html);
// // // Setting ukuran dan orientasi kertas
// $dompdf->setPaper('A4', 'potrait');
// // // Rendering dari HTML Ke PDF
// $dompdf->render();
// // // Melakukan output file Pdf
// $dompdf->stream();
?>

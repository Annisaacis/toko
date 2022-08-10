<?php

$result;

require '../App/query.php';
function getData($tahun)
{
  global $conn;

  $sql = "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE tahun='$tahun'";
  $result = mysqli_query($conn, $sql);

  $pembelian = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $pembelian[] = $row;
  }

  echo "<br>";

  echo "<h4>Data Pembelian Tahun $tahun</h4>";

  echo "<div class='table-responsive'>";
  echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
  echo '<thead> <tr>
            <th>No</th>
            <th>Nama Pembeli</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Perkiraan Sampai</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>';

  echo '<tbody>';
  for ($i = 0; $i < count($pembelian); $i++) {
    echo "<tr>";
    echo "<td>" . (1 + $i) . "</td>";
    echo "<td>" . $pembelian[$i]['nama_pelanggan'] . "</td>";
    echo "<td>" . $pembelian[$i]['tanggal_pembelian'] . "</td>";
    echo "<td>Rp. " . number_format($pembelian[$i]['total_pembelian']) . ",-</td>";
    echo "<td>" . $pembelian[$i]['perkiraan_sampai'] . "</td>";

    // OPEN Baru - Menambahkan button kirim untuk mengubah status pesanan menjadi dikirim
    echo "<td>" . $pembelian[$i]['status'] . "</td>";
    if ($pembelian[$i]['status'] == 'Menunggu Konfirmasi') {
      echo "<td>
            <a href='update_status.php?kirim=" . $pembelian[$i]['id_pembelian'] . "' class='btn btn-warning btn-sm'>Kirim</a>
            <a href='index.php?halaman=detail&id=" . $pembelian[$i]['id_pembelian'] . "' class='btn btn-info btn-sm'>Detail Pembelian</a>
            <a href='index.php?halaman=edit_pembelian&id=" . $pembelian[$i]['id_pembelian'] . "' class='btn btn-info btn-sm'>Edit</a>
          </td>";
    } else {
      echo "<td>
            <a href='index.php?halaman=detail&id=" . $pembelian[$i]['id_pembelian'] . "' class='btn btn-info btn-sm'>Detail Pembelian</a>
            <a href='index.php?halaman=edit_pembelian&id=" . $pembelian[$i]['id_pembelian'] . "' class='btn btn-info btn-sm'>Edit</a>
          </td>";
    }
    // CLOSE Baru

    echo "</tr>";
  }
  echo '</tbody>';
  echo '</table></div>';
}

<?php
// file ini merupakan copy dari data_pembelian akan tetapi saya ubah beberapa agar relate menjadi sebuah laporan
$result;

require '../App/query.php';
// func getData ini untuk mengambil data dengan tahun dan bulan
function getData($tahun, $bulan)
{
    global $conn;
    // gunakan MONTH(column type DATE) sama dengan $value untuk mencari data berdasarkan bulan 
    $sql = "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE tahun = '$tahun' AND MONTH(tanggal_pembelian) = '$bulan' AND status = 'Selesai' ORDER BY tanggal_pembelian";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    $pembelian = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $pembelian[] = $row;
    }

    echo "<br>";

    echo "<div class='d-flex justify-content-between mb-4'>
            <h4>Data Pembelian Tahun $tahun</h4>";
    if ($count > 0) {
        echo "  <a href='cetak_laporan.php?tahun=$tahun&bulan=$bulan' class='btn btn-danger bg-gradient'>Cetak Laporan</a>";
    }
    echo "</div>";

    echo "<div class='table-responsive'>";
    echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
    echo '<thead> <tr>
            <th>No</th>
            <th>Nama Pembeli</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>';

    echo '<tbody>';
    for ($i = 0; $i < count($pembelian); $i++) {
        echo "<tr>";
        echo "<td>" . 1 + $i . "</td>";
        echo "<td>" . $pembelian[$i]['nama_pelanggan'] . "</td>";
        echo "<td>" . $pembelian[$i]['tanggal_pembelian'] . "</td>";
        echo "<td>Rp. " . number_format($pembelian[$i]['total_pembelian']) . ",-</td>";

        // OPEN Baru - Menambahkan button kirim untuk mengubah status pesanan menjadi dikirim
        echo "<td>" . $pembelian[$i]['status'] . "</td>";

        echo "<td>
            <a href='index.php?halaman=detail&id=" . $pembelian[$i]['id_pembelian'] . "' class='btn btn-info btn-sm'>Detail Pembelian</a>
          </td>";

        // CLOSE Baru

        echo "</tr>";
    }
    echo '</tbody>';
    echo '</table></div>';
}

// func getDataTahun ini untuk mendapatkan data berdasarkan tahun saja
function getDataTahun($tahun)
{
    global $conn;

    $sql = "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE tahun = '$tahun' AND status = 'Selesai' ORDER BY tanggal_pembelian";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    $pembelian = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $pembelian[] = $row;
    }

    echo "<br>";

    echo "<div class='d-flex justify-content-between mb-4'>
            <h4>Data Pembelian Tahun $tahun</h4>";
    if ($count > 0) {
        echo "  <a href='cetak_laporan.php?tahun=$tahun' class='btn btn-danger bg-gradient'>Cetak Laporan</a>";
    }
    echo "</div>";

    echo "<div class='table-responsive'>";
    echo '<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">';
    echo '<thead> <tr>
            <th>No</th>
            <th>Nama Pembeli</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>';

    echo '<tbody>';
    for ($i = 0; $i < count($pembelian); $i++) {
        echo "<tr>";
        echo "<td>" . 1 + $i . "</td>";
        echo "<td>" . $pembelian[$i]['nama_pelanggan'] . "</td>";
        echo "<td>" . $pembelian[$i]['tanggal_pembelian'] . "</td>";
        echo "<td>Rp. " . number_format($pembelian[$i]['total_pembelian']) . ",-</td>";

        // OPEN Baru - Menambahkan button kirim untuk mengubah status pesanan menjadi dikirim
        echo "<td>" . $pembelian[$i]['status'] . "</td>";
        echo "<td>
            <a href='index.php?halaman=detail&id=" . $pembelian[$i]['id_pembelian'] . "' class='btn btn-info btn-sm'>Detail Pembelian</a>
          </td>";

        // CLOSE Baru

        echo "</tr>";
    }
    echo '</tbody>';
    echo '</table></div>';
}

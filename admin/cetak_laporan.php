<?php

require '../App/db.php';

$conn = connect_DB();

// Cek jika parameter nya membawa bulan maka lakukan cetak laporan perbulan
if (isset($_GET['bulan'])) {
    $tahun = $_GET['tahun'];
    $bulan = $_GET['bulan'] < 10 ? "0" . $_GET['bulan'] : $_GET['bulan'];

    $sql = "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE tahun = '$tahun' AND MONTH(tanggal_pembelian) = '$bulan' AND status = 'Selesai' ORDER BY tanggal_pembelian";
    $result = mysqli_query($conn, $sql);
}
// Cek jika parameter nya TIDAK membawa bulan maka lakukan cetak laporan pertahun
else {
    $tahun = $_GET['tahun'];

    $sql = "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE tahun = '$tahun' AND status = 'Selesai' ORDER BY tanggal_pembelian";
    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/bbd5e16b21.js" crossorigin="anonymous"></script>
    <title>Cetak Laporan</title>
    <style>
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt;
        }

        .page {
            width: 21cm;
            min-height: 29.7cm;
            padding: 2cm;
            margin: 1cm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="col-lg-12 page">
        <center>
            <h3>Laporan Penjualan</h3>
            <h5>Periode <?= isset($_GET["bulan"]) ? date("F", strtotime($tahun . "-" . $bulan)) : '' ?> Tahun <?= $tahun ?></h5>
        </center>
        <br>
        <div class="d-flex justify-content-between">
            <table class="col-lg-6 mt-1 table table-bordered table-responsive rounded overflow-hidden" cellspacing="0">
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Nama Pembeli</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $total = 0;
                    while ($data = mysqli_fetch_object($result)) {
                        $total += $data->total_pembelian;
                    ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data->nama_pelanggan ?></td>
                            <td><?= $data->tanggal_pembelian ?></td>
                            <td>Rp. <?= number_format($data->total_pembelian) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Total Pemasukan</th>
                        <th colspan="4" class="text-end">Rp. <?= number_format($total) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</body>

</html>
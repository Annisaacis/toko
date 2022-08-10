<?php

require 'App/user_login.php';
require "App/db.php";
require 'App/query.php';
$conn = connect_DB();

if (!isset($_SESSION['login'])) {
    echo "<script>alert('Anda Harus Login Terlabih Dahulu')";
}
not_login('login', 'login.php');

$id_pelanggan = $_SESSION['login']['id_pelanggan'];
$sql = $sql = "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pelanggan='$id_pelanggan'";
$result = mysqli_query($conn, $sql);

$pembelian = [];
while ($row = mysqli_fetch_assoc($result)) {
    $pembelian[] = $row;
}
?>
<?php require 'Comp/header.php'; ?>

<?php require 'Comp/navbar.php'; ?>
<section class="main mt-4 pt-5" style="min-height: 88vh; overflow-x: hidden;">
    <div class="container">
        <h4 class="mb-4">Data Pembelian</h4>
        <div class='table-responsive'>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pembeli</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Perkiraan Sampai</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php for ($i = 0; $i < count($pembelian); $i++) : ?>
                        <tr>
                            <td><?= (1 + $i) ?></td>
                            <td><?= $pembelian[$i]['nama_pelanggan'] ?></td>
                            <td><?= $pembelian[$i]['tanggal_pembelian'] ?></td>
                            <td>Rp. <?= number_format($pembelian[$i]['total_pembelian']) ?>,-</td>
                            <td><?= $pembelian[$i]['perkiraan_sampai'] ?></td>
                            <td><?= $pembelian[$i]['status'] ?></td>

                            <!-- OPEN Baru - Menambahkan button kirim untuk mengubah status pesanan menjadi dikirim -->

                            <!-- CLOSE Baru -->

                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
        <!-- table-responsive -->
    </div>
</section>

<?php include 'Comp/footer.php'; ?>
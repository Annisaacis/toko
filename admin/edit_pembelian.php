<?php
$error = false;
require '../App/query.php';
if (isset($_POST["ubah"])) {

    $data = [
        "id_pembelian" => htmlspecialchars($_POST["id_pembelian"]),
        "perkiraan_sampai" => htmlspecialchars($_POST["perkiraan_sampai"]),
        "status" => htmlspecialchars($_POST["status"]),
    ];

    $sql = "UPDATE pembelian SET perkiraan_sampai='$data[perkiraan_sampai]', status='$data[status]' WHERE id_pembelian='$data[id_pembelian]'";
    mysqli_query($conn, $sql);

    $result = mysqli_affected_rows($conn);

    if ($result != 1) {
        echo "<script>swal('Gagal!', 'Pembelian Gagal diupdate!', 'error');</script>";
    } else if ($result == 1) {
        echo "<script>swal('Sukses!', 'Data Pembelian Berhasil ditambah!', 'success');;</script>";
        echo "<script>
      setTimeout(() => {
        window.location.href='index.php?halaman=pembelian';
      }, 1000)
      </script>";
    }
}

if (isset($_GET['id'])) {
    $pembelian = query_select('pembelian', "id_pembelian='$_GET[id]'");

    if ($pembelian) {
        $pembelian = $pembelian[0];
    } else {
        echo "<script>swal('Gagal!', 'Pembelian Tidak Ada', 'info');;</script>";
        echo "<script>
    setTimeout(() => {
      window.location.href='index.php?halaman=pembelian';
    }, 1500)
    </script>";
    }
} else {
    echo "<script>swal('Gagal!', '', 'info');;</script>";
    echo "<script>
    setTimeout(() => {
      window.location.href='index.php?halaman=pembelian';
    }, 1500)
    </script>";
}
?>

<h2>Edit Pembelian</h2>
<form action="" method="post" class="user mt-4" enctype="multipart/form-data">
    <div class="form-group  row">
        <div class="col-md-6">
            <input type="text" class="form-control form-control-user" name="perkiraan_sampai" id="perkiraan_sampai" placeholder="Masukkan tanggal perkiraan sampai" value="<?= $pembelian["perkiraan_sampai"] ?>" autocomplete="off">
        </div>
        <!-- <input type="hidden" name="id_pembelian" id="id_pembelian" placeholder="Masukkan Nama Produk" value="<?= $pembelian["id_pembelian"] ?>" autocomplete="off"> -->
        <div class="col-md-6">
            <input type="text" class="form-control form-control-user" value="<?= $pembelian["status"] ?>" name="status" id="status" placeholder="Masukkan Status">
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-user btn-block" name="ubah">Ubah Data</button>
    <hr>

</form>
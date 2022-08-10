<div class="container-fluid mt-5 mb-5">
    <h2 class="text-center font-weight-bold p-5">Form Pembayaran</h2>

    <div class="row ml-5 mr-5">
        <div class="col-md-2">

        </div>

        <div class="col-md-8">
            <!-- <p></p>
            <p><br><br></p> -->
            <div class="btn btn-sm btn-secondary">
                <!-- </div><br><br> -->
                <h5>Input Alamat Penigiriman dan Pembayaran</h5>
                <form method="POST" action="">
                    <div class="fom-group">
                        <label for="nama">Nama Lengkap</label>
                        <input class="form-control" type="text" name="nama" id="nama">

                    </div>

                    <div class="fom-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <input class="form-control" type="text" name="alamat" id="alamat">

                    </div>

                    <div class="fom-group">
                        <label for="notelp">No. Telepon</label>
                        <input class="form-control" type="text" name="notelp" id="notelp">

                    </div>



                    <div class="fom-group">
                        <label for="bank">Pembayaran</label>
                        <select class="form-control" id="bank" name="bank">
                            <option>BRI - xxxxxxxxxx</option>
                            <option>BNI - xxxxxxxxxx</option>
                            <option>BCA - xxxxxxxxxx</option>
                            <option>MANDIRI - xxxxxxxxxx</option>
                            <option>CASH</option>
                        </select>

                    </div>

                    <?php
                    echo "<button type='submit' class='btn btn-sm btn-success mb-3 mt-3'>Pesan Sekarang</button>";
                    ?>
                    <?php
                    if (isset($alert["pembayaran"])) {
                        if ($alert["pembayaran"]) {
                            echo '<script>swal("Pembayaran Berhasil", "", "success");</script>';
                            echo "<script>setTimeout(() => {
                            window.location.href = 'pembayaran.php';
                          }, 1500)</script>";
                        }
                    }
                    ?>
                </form>
            </div>

            <div class="col-md-2">

            </div>
        </div>
    </div>
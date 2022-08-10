<h2>Halaman Home</h2>
<!-- Content Row -->
<div class="row">

<?php 

  $sql_1 = "SELECT COUNT(nama_produk)
  FROM produk";

  $res_1 = mysqli_query($conn, $sql_1);
  $res_1 = mysqli_fetch_assoc($res_1);

  $sql_2 = "SELECT COUNT(nama_pelanggan)
  FROM pelanggan";

  $res_2 = mysqli_query($conn, $sql_2);
  $res_2 = mysqli_fetch_assoc($res_2);
  
  $sql_3 = "SELECT * FROM stok";
  $res_3 = mysqli_query($conn, $sql_3);

  $stok = [];
	while( $row = mysqli_fetch_assoc($res_3) ) {
		// menjadikan variabel $stok[] array assosiatif
		$stok[] = $row;
	}

  $total_terjual = 0;
  $total_stok = 0;

  for($i = 0; $i < count($stok); $i++) {
    if( ($stok[$i]["stok_produk"] - $stok[$i]["produk_terjual"]) <= 0 ) {
      $total_stok += 0;
    } else {
      $total_stok += ($stok[$i]["stok_produk"] - $stok[$i]["produk_terjual"]);
    }
    
    $total_terjual += ($stok[$i]["produk_terjual"]);
  }

?>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Total Stok Barang</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?= $total_stok ?> Ton 
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Total Penjualan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_terjual ?> Ton</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Barang
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $res_1['COUNT(nama_produk)'] ?> Unit</div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Total Pelanggan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $res_2["COUNT(nama_pelanggan)"] ?></div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
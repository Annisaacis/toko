<h2>Data Laporan</h2>
<div class="card">
    <form method="POST" action="" class="p-4">
        <select name="tahun" id="tahun" class="form-control" onchange="submit()">
            <?php for ($i = 0; $i <= 5; $i++) { ?>
                <option value="202<?= $i ?>" <?= isset($_POST['tahun']) ? ('202' . $i == $_POST['tahun'] ? 'selected' : '') : '' ?>>202<?= $i ?></option>
            <?php } ?>
        </select>
    </form>
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#data-1" role="tab" aria-selected="true">Januari</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-2" role="tab" aria-selected="false">Februari</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#data-3" role="tab" aria-selected="false">Maret</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#data-4" role="tab" aria-selected="false">April</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#data-5" role="tab" aria-selected="false">Mei</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#data-6" role="tab" aria-selected="false">Juni</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#data-7" role="tab" aria-selected="false">Juli</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#data-8" role="tab" aria-selected="false">Agustus</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#data-9" role="tab" aria-selected="false">September</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#data-10" role="tab" aria-selected="false">Oktober</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#data-11" role="tab" aria-selected="false">November</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#data-12" role="tab" aria-selected="false">Desember</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#data-all" role="tab" aria-selected="false">Semua</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <?php require 'data_laporan.php';
            $tahun = $_POST['tahun']; ?>
            <?php for ($i = 1; $i <= 12; $i++) { ?>
                <div class="tab-pane fade" id="data-<?= $i ?>" role="tabpanel" aria-labelledby="home-tab">
                    <?php getData($tahun, $i); ?>
                </div>
            <?php } ?>
                 <div class="tab-pane fade" id="data-all" role="tabpanel" aria-labelledby="home-tab">
                    <?php getDataTahun($tahun); ?>
                 </div>
            </div>



        </div>

    </div>
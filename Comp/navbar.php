<nav class="navbar navbar-expand-lg navbar-dark bg-info shadow fixed-top" id="navi">
  <div class="container py-1">
    <a class="navbar-brand" href="#">CV DWI JAYA PROBOLINGGO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav" style="margin-left: auto;">
        <a class="nav-item nav-link" href="/toko/">Beranda</a>
        <?php if (isset($_SESSION['login'])) : ?>
          <a class="nav-item nav-link" href="produk.php">Produk</a>
          <!-- <a class="nav-item nav-link" href="checkout.php">Checkout</a> -->
          <a class="nav-item nav-link" href="cek_status.php">Cek Status</a>
          <a class="nav-item nav-link" href="keranjang.php"><i class="fa fa-shopping-cart"></i></a>
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle text-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-user"></i>
            </button>
            <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item rounded" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item rounded" href="history.php">History</a></li>
              <li><a class="dropdown-item rounded" href="logout.php">Log Out</a></li>
            </ul>
          </div>
        <?php else : ?>
          <a class="nav-item nav-link mx-1" href="produk.php">Produk</a>
          <a class="nav-item nav-link mx-1 btn btn-info text-white" href="login.php">
            <i class="fa fa-sign-in"></i>
            Login
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<script>
  let navLink = document.querySelectorAll('.nav-link');
  navLink.forEach(e => {
    if (e.innerHTML == '<?= $halaman ?>') {
      e.classList.add('active');
    }
  });
</script>
<style>
  .jumbotron {
    height: 500px;
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('foto_produk/bg.jpg');
    background-size: cover;
  }

  .jumbotron h2,
  .jumbotron h5 {
    text-shadow: 0px 3px 5px rgba(0, 0, 0, 0.35);
  }

  .max-slider-size {
    max-height: 500px;
    /* min-height: 500px; */
  }

  .darken {
    filter: brightness(30%);
  }
</style>

<div id="carouselExampleInterval" class="carousel slide mt-5" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner max-slider-size rounded mt-5">
    <div class="w-100 pt-5 position-absolute mt-5 text-center" style="z-index: 20;" id="title-text">
      <h1 class="text-white mb-3 mt-5">CV DWI JAYA PROBOLINGGO</h1>
      <h5 class="text-white mb-4">Penyedia Bahan Bangunan Berkualitas</h5>
      <a href="produk.php" class="btn text-white btn-success bg-gradient py-2 px-4">Pesan Sekarang</a>
    </div>
    <div class="carousel-item active " data-bs-interval="4500">
      <img src="foto_produk/bg.jpg" class="d-block w-100 darken" alt="...">
    </div>
    <div class="carousel-item " data-bs-interval="4500">
      <img src="foto_produk/warehouse-building-materials-industiral-store_102375-446.jpg" class="d-block w-100 darken" alt="...">
    </div>
    <div class="carousel-item " data-bs-interval="4500">
      <img src="admin/img/billy-freeman-nkxB5Ab-ONY-unsplash.jpg" class="d-block w-100 darken" alt="...">
    </div>
  </div>
</div>

<script>
 window.onscroll = function() {scrollFunction()};
var timer;

function scrollFunction() {
  
  clearTimeout(timer);
  timer = setTimeout( refresh , 300 );
  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
    if (document.body.scrollTop > 180 || document.documentElement.scrollTop > 180) {
      document.getElementById("title-text").style.left="-100%";
      document.getElementById("title-text").style.transition="left 1200ms";
    }
  } else {
    document.getElementById("title-text").style.left="0";
    document.getElementById("title-text").style.transition="left 1200ms";
  }
}
var refresh = function () { 

    };
</script>
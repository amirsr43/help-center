<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}user{$ds}core{$ds}header.php");

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>About</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">About</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <!--  about -->
  <div class="about">
    <img src="../../../assets/img/logo-recovery.png">
    <h1>RECOVERY.U COMPUTER</h1>
    <p>
      Recovery.U Computer merupakan bisnis start-up dibidang teknologi komputer. Recovery.U Computer ini adalah usaha yang diciptakan sejak tahun 2020. Kegiatan usaha Recovery.U Computer yaitu menjual jasa perbaikan, penjualan laptop, PC, dan aksesoris komputer. Manfaat yang dapat dirasakan dari produk Recovery.U Computer ini yaitu produk yang update dan kekinian namun tidak mengurangi fungsinya membuat para konsumen sangat tertarik dan bisa merasakan produk yang relevan untuk digunakan di masa kini.
    </p>
    <p>
      Sebagai bisnis yang bergerak di sektor jasa perbaikan dan penjualan computer, maka untuk mendapatkan hasil perbaikan laptop yang berkualitas Recovery.U Computer memilih sparepart dari supplier yang memiliki kualitas sangat baik dan terpercaya agar hasil yang diperoleh bisa sesuai dengan harapan konsumen. Karena seperti yang sudah kita ketahui bahwa sparepart laptop yang bagus akan menghasilkan performa laptop yang pastinya lebih baik dari sebelumnya.Selain pemilihan supplier, kualitas SDM juga sangat menentukan hasil dari layanan jasa yang dibutuhkan. Maka dari itu, di pilihlah orang-orang yang berpengalaman di bidangnya untuk menghidari loss quality control atau kurangnya kepuasan konsumen. Adapun target wilayah pasar produk Recovery.U Computer yaitu yang utama adalah daerah Karawang dan sekitarnya. Sistem penjualan Recovery.U Computer yaitu melalui 2 media,Online dan Offline. Untuk online, Recovery.U Computer menggunakkan berbagai media sosial seperti WhatsApp Bussines, Instagram dan ecommerce Tokopedia. Konsumen yang berasal dari luar kota akan dikirimkan barangnya melalui ekspedisi Tiki, sedangkan untuk konsumen lokal Karawang biasanya menggunakkan Go-send. Untuk offline, konsumen Recovery.U Computer bisa datang langsung ke store Recovery.U Computer yang beralamat di Jalan HS. Ronggowaluyo tepatnya 5di seberang indomart kampus UBP Karawang. Harapan kami, Recovery.U Computer dapat menjadi brand servis komputer nomor 1 di Indonesia.
    </p>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.5448180798603!2d107.29930787374175!3d-6.323357261872849!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e697785f56d81b9%3A0x2dbeb569177e93bf!2sRECOVERY.U%20COMPUTER!5e0!3m2!1sid!2sid!4v1700229451701!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <h1>CONTACT ME</h1>

    <a class="nav-link collapsed" href="https://wa.me/085899335508">
      <i class="bi bi-whatsapp"></i>
      <span>085899335508</span>
    </a>
    <a class="nav-link collapsed" href="https://instagram.com/recoveryu.co?igshid=Yjc0OGI0MDc4OA==">
      <i class="bi bi-instagram"></i>
      <span>Recoveryu.co</span>
    </a>
    <a class="nav-link collapsed" href="https://m.facebook.com/recoveryu.id">
      <i class="bi bi-facebook"></i>
      <span>Recoveryu.id</span>
    </a>
  </div>
  <!-- End about -->

</main><!-- End #main -->
<style>
  @media (max-width: 767px) {
    .about {
      padding: 20px;
      max-width: 800px;
      margin: 0 auto;
    }

    .about img {
      width: 100%;
      height: auto;
      max-width: 300px;
      display: block;
      margin: 0 auto 20px;
    }

    .about p {
      margin-bottom: 20px;
      text-align: justify;
    }

    .about iframe {
      max-width: 100%;
      width: 300px;
      height: 200px;
      border: 0;
      margin: 0 auto;
      display: block;
    }
  }
</style>

<?php
require_once("{$base_dir}user{$ds}core{$ds}footer.php");
?>
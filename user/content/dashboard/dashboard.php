<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}user{$ds}core{$ds}header.php");

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="db">
    <h1>Recovery.U Computer</h1>
    <h2>Jl.HS.Ronggo Waluyo, Puseurjaya, Telukjambe Timur, Karawang,Jawa Barat.</h2>

  </div><br>

  <section>
    <div class="feature-box">
      <a href="../store/store.php">
        <img src="https://www.wmfs.net/wp-content/uploads/2022/03/Shopping-Cart.png" alt="gambar1">
        <p>Store</p>
      </a>
    </div>

    <div class="feature-box">
      <a href="../service/service.php">
        <img src="https://logodix.com/logo/757786.png" alt="gambar1">
        <p>Service</p>
      </a>
    </div>

    <div class="feature-box">
      <a href="../status/status.php">
        <img src="https://cdn.pixabay.com/photo/2016/08/19/20/37/time-1606153_1280.png" alt="gambar1">
        <p>Status</p>
      </a>
    </div>

    <div class="feature-box">
      <a href="../about/About.php ">
        <img src="https://cdn1.iconfinder.com/data/icons/creative-round-ui/223/8-1024.png" alt="gambar1">
        <p>About</p>
      </a>
    </div>
    <style>
      .db h1 {
        font-size: 25px;
        font-weight: bold;
        text-align: center;
        color: orange;
        margin-bottom: 10px;
      }

      .db h2 {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
      }

      section {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        margin: 20px;
      }

      .feature-box {
        flex: 1;
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        margin: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      .feature-box img {
        width: 70px;
        height: 70px;
        display: block;
        margin-left: auto;
        margin-right: auto;
      }

      .feature-box p {
        font-size: 20px;
        text-align: center;
      }
    </style>
  </section>


  <section class="section dashboard">
    <div class="row">
      <div class="dasboard">
        <h1>Rekomendasi Produk</h1>
      </div>
      <style>
        .dashboard h1 {
          color: black;
          font-size: 20px;
          font-weight: bold;
          margin-bottom: 10px;
        }
      </style>
      <div class="product-list">
        <?php
        require_once("../../core/connection.php");

        // Ensure successful database connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch products from the database
        $products = mysqli_query($conn, "SELECT * FROM products");

        // Display products
        if (mysqli_num_rows($products) > 0) {
          $counter = 0; // Initialize counter for every two products
          while ($row = mysqli_fetch_assoc($products)) {
            if ($counter % 3 == 0) {
              echo '<div class="row">';
            }
        ?>
            <div class="col-12 col-md-4 mb-4">
              <div class="card h-100">
                <a href="https://wa.me/085899335508">
                  <img src="<?= $row['image']; ?>" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                  <a href="https://wa.me/085899335508" class="h5 text-decoration-none text-dark"><?= $row['name']; ?></a>
                  <ul class="list-unstyled d-flex justify-content-between">
                    <li class="text-muted text-right">Rp.<?= $row['price']; ?></li>
                  </ul>
                  <p class="card-text">

                  </p>
                </div>
              </div>
            </div>
        <?php
            $counter++;
            if ($counter % 3 == 0) {
              echo '</div>'; // Close div tag after two products are displayed
            }
          }
          if ($counter % 3 != 0) {
            echo '</div>'; // Close div tag if the number of products is odd
          }
        } else {
          echo "No products found";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
      </div>
    </div>
  </section>

</main><!-- End #main -->


<?php
require_once("{$base_dir}user{$ds}core{$ds}footer.php");
?>
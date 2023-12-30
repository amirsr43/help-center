<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}user{$ds}core{$ds}header.php");

?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Store</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Store</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section dashboard">
    <div class="row">
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
              echo '</div>'; 
            }
          }
          if ($counter % 3 != 0) {
            echo '</div>'; 
          }
        } else {
          echo "No products found";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
      </div>
    </div>
    <div class="store"  >
        <a href="https://wa.me/085899335508"><i  class="bi bi-whatsapp"> Pesan disini</i></a>
    </div>
    <style>
      .store{
        background-color: #00FF00;
        width: 150px;
        border-radius: 10px;
      }
      .store a{
        margin-left: 10px;
        color: black;
        font-weight: bold;
      }
      
    </style>
  </section>
</main>
<?php
require_once("{$base_dir}user{$ds}core{$ds}footer.php");
?>
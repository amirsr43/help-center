<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");

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
        if (isset($_GET['delete_id'])) {
          $deleteId = $_GET['delete_id'];
          $deleteQuery = "DELETE FROM products WHERE id = $deleteId";
          mysqli_query($conn, $deleteQuery);
        }
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
                <a href="#">
                  <img src="<?= $base_dir . 'https://recoveryucomputer.com/pages/core/path/to/upload/directory/' . $row['image']; ?>" class="card-img-top" alt="<?= $row['name']; ?>">
                </a>
                <div class="card-body">
                  <a href="#" class="h5 text-decoration-none text-dark"><?= $row['name']; ?></a>
                  <ul class="list-unstyled d-flex justify-content-between">
                    <li class="text-muted text-right">Rp.<?= $row['price']; ?></li>
                  </ul>
                  <p class="card-text">
                    <a class="delete-link" href="?delete_id=<?= $row['id']; ?>" onclick="return confirm('apakah anda ingin menolak orderan ini?')">Hapus</a>
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
</main>
<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>
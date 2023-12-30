<?php
class DatabaseManager
{
  protected $conn;

  public function __construct($connection)
  {
    $this->conn = $connection;
  }

  public function executeQuery($query)
  {
    return mysqli_query($this->conn, $query);
  }

  public function getProducts()
  {
    return $this->executeQuery("SELECT id_pesan, merk, detail, token, price, status FROM service_requests ORDER BY id_pesan ASC");
  }
}

class ProductService extends DatabaseManager
{
  public function displayProducts()
  {
    $products = $this->getProducts();
    $index = 1;
    if (mysqli_num_rows($products) > 0) {
      while ($row = mysqli_fetch_assoc($products)) {
        echo '<tr>
                <td>' . $index . '</td>
                <td>' . $row['merk'] . '</td>
                <td>' . $row['detail'] . '</td>
                <td>' . $row['token'] . '</td>
                <td>' . $row['price'] . '</td>
                <td>';
        $index++;
        if ($row['status'] == 'pending') {
          echo '<span class="pending-label">Pending</span>';
        } else {
          echo $row['status'];
        }
        // Di dalam loop while pada metode displayProducts(), tambahkan tautan download
        echo '<td><a href="struk.php?id=' . $row['id_pesan'] . '">Download</a></td>';
      }
    } else {
      echo "No data found";
    }
  }
}

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '../../../') . $ds;
require_once("{$base_dir}user{$ds}core{$ds}header.php");
require_once("../../core/connection.php");

$productService = new ProductService($conn);
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Status Service</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Status Service</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section dashboard">
    <div class="row">
      <h3>Service Receipt</h3>
      <div class="table-container">
        <table class="receipt-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Merk</th>
              <th>Keluhan kerusakan</th>
              <th>Kode Pesanan</th>
              <th>Harga</th>
              <th>Status Service</th>
              <th>Bukti Pesanan</th>
            </tr>
          </thead>
          <tbody>
            <?php $productService->displayProducts(); ?>
          </tbody>
          <?php $index = 1; ?>
        </table>
      </div>
    </div>
  </section>
</main><!-- End #main -->

<?php require_once("{$base_dir}user{$ds}core{$ds}footer.php"); ?>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f7f7f7;
    color: #333;
  }

  .section {
    margin-bottom: 30px;
  }

  .row {
    margin: 0 auto;
    max-width: 1200px;
  }

  h1,
  h3 {
    margin-top: 0;
  }

  .table-container {
    overflow-x: auto;
  }

  .receipt-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  .receipt-table th,
  .receipt-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  .receipt-table th {
    background-color: #FFCB19;
    font-weight: bold;
  }

  .receipt-table tbody tr:hover {
    background-color: #f9f9f9;
  }

  .receipt-table td a {
    display: inline-block;
    padding: 5px 10px;
    background-color: #3498db;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
  }

  .accept-link {
    background-color: #5cb85c;
  }

  /* Media query for responsiveness */
  @media (max-width: 767px) {
    .receipt-table {
      display: block;
      overflow-x: auto;
      white-space: nowrap;
    }

    .receipt-table th,
    .receipt-table td {
      min-width: 120px;
    }

    .receipt-table td a {
      display: block;
      width: 100%;
      text-align: center;
      margin-top: 5px;
    }
  }
</style>

<script>
  // JavaScript untuk menangani klik pada tautan "Download"
  document.addEventListener('DOMContentLoaded', function() {
    const downloadLinks = document.querySelectorAll('.download-link');
    downloadLinks.forEach(function(link) {
      link.addEventListener('click', function(event) {
        event.preventDefault();
        const id = this.getAttribute('data-id');
        // Jika Anda ingin membuka jendela cetak saat tautan "Download" diklik
        window.open('cetak_struk.php?id=' + id, '_blank');
      });
    });
  });
</script>
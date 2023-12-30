<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");
require '../../core/connection.php';

require_once 'OrderManager.php';

$orderManager = new OrderManager($conn);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_status"])) {
  $orderId = $_POST["order_id"];
  $newStatus = $_POST["new_status"];

  $orderManager->updateOrderStatus($orderId, $newStatus);
}

if (isset($_GET['delete_id'])) {
  $deleteId = $_GET['delete_id'];
  $orderManager->deleteOrder($deleteId);
}

if (isset($_GET['accept_id'])) {
  $acceptId = $_GET['accept_id'];
  $orderManager->acceptOrder($acceptId);
}

$products = $orderManager->getAllOrders();

// Tambahkan ini untuk menangani jika $products kosong
if (empty($products) || mysqli_num_rows($products) === 0) {
  $products = []; // Set $products sebagai array kosong
}
?>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f7f7f7;
    color: #333;
  }

  .main {
    padding: 20px;
  }

  .pagetitle {
    margin-bottom: 20px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  th,
  td {
    padding: 10px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #FFCB19;
    font-weight: bold;
    color: #333;
  }

  tr:hover {
    background-color: #f9f9f9;
  }

  form {
    margin-bottom: 20px;
  }

  label {
    font-weight: bold;
    display: block;
    margin-bottom: 6px;
  }

  .delete-link {
    color: #BF3131;
    text-decoration: none;
    margin-right: 10px;
  }

  .update-link {
    color: #007bff;
    text-decoration: none;
    margin-right: 10px;
  }

  .delete-link:hover,
  .update-link:hover {
    text-decoration: underline;
  }

  .section.dashboard {
    margin: 20px;
    overflow-x: auto;
  }

  @media (max-width: 767px) {
    .section.dashboard {
      margin: 20px;
      overflow-x: auto;
    }

    th,
    td {
      min-width: 100px;
      font-size: 14px;
    }
  }
</style>

<!-- ... Bagian lain dari halaman ... -->
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Proses Service</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Proses Service</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section dashboard">
    <div class="row">
      <h1>Pesanan Sedang Diproses</h1>
      <?php if (!empty($products) && mysqli_num_rows($products) > 0) : ?>
        <table>
          <thead>
            <tr>
              <th>no</th>
              <th>nama</th>
              <th>telepon</th>
              <th>merk</th>
              <th>kode pesanan</th>
              <th>kerusakan</th>
              <th>status</th>
              <th>harga</th>
              <th>options</th>
            </tr>
          </thead>
          <tbody>
            <?php $index = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($products)) : ?>
              <tr>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                  <td><?= $index; ?></td>
                  <td><?= $row['nama_lengkap']; ?></td>
                  <td><?= $row['telepon']; ?></td>
                  <td><?= $row['merk']; ?></td>
                  <td><?= $row['token']; ?></td>
                  <td><?= $row['detail']; ?></td>
                  <td>
                    <input type="hidden" name="order_id" value="<?= $row['id_pesan']; ?>">
                    <?= $row['status']; ?>
                  </td>
                  <td>Rp.<?= $row['price']; ?></td>
                  <td>
                    <a class="update-link" href="edit_service.php?id=<?= $row['id_pesan']; ?>">Edit</a>
                    <a class="delete-link" href="?delete_id=<?= $row['id_pesan']; ?>" onclick="return confirm('Apakah Anda ingin menghapus orderan ini?')">Hapus</a>
                    <input type="hidden" name="order_id" value="<?= $row['id_pesan']; ?>">
                  </td>
                </form>
              </tr>
              <?php $index++; ?>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else : ?>
        <p>Tidak ada pesanan yang sedang diproses.</p>
      <?php endif; ?>
    </div>
  </section>
</main>



<?php require_once("{$base_dir}pages{$ds}core{$ds}footer.php"); ?>
<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");
require '../../core/connection.php';

require_once 'OrderManager.php';

$orderManager = new OrderManager($conn);

$search = isset($_GET['search']) ? $_GET['search'] : '';
$products = $orderManager->searchOrders($search);

if (isset($_GET['delete_id'])) {
  $deleteId = $_GET['delete_id'];
  $orderManager->deleteOrder($deleteId);
}

if (isset($_GET['accept_id'])) {
  $acceptId = $_GET['accept_id'];
  $orderManager->acceptOrder($acceptId);
}
?>

<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f7f7f7;
  }

  /* Main container */
  main {
    padding: 20px;
  }

  /* Table styles */
  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  th,
  td {
    padding: 10px 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  /* Table header */
  th {
    background-color: #FFCB19;
    font-weight: bold;
    color: #333;
  }

  /* Hover effect on table rows */
  tr:hover {
    background-color: #f9f9f9;
  }

  /* Form styles */
  form {
    margin-bottom: 20px;
  }

  label {
    font-weight: bold;
    display: block;
    margin-bottom: 6px;
  }

  input[type="text"] {
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    width: 200px;
    margin-bottom: 10px;
  }

  button {
    padding: 8px 12px;
    border: none;
    background-color: #007bff;
    color: #fff;
    border-radius: 4px;
    cursor: pointer;
  }

  /* Custom status label */
  .pending-label {
    background-color: #f39c12;
    color: #fff;
    padding: 10px 8px;
    border-radius: 3px;
    margin-right: 5px;
  }

  /* Hover effect on buttons */
  button:hover {
    background-color: #0056b3;
  }

  /* Option links in table */
  .accept-link {
    color: #007bff;
  }

  .delete-link {
    color: #BF3131;
    background-color: white;
  }

  /* Media query for smaller screens */
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


<main id="main" class="main">
  <div class="pagetitle">
    <h1>Pesanan Masuk</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Pesanan Masuk</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <h1>Pesanan Masuk</h1>

      <!-- Formulir Pencarian -->
      <form method="GET" action="">
        <label for="search">Cari Kode Pesanan:</label>
        <input type="text" id="search" name="search" value="<?= $search ?>">
        <button type="submit">Cari</button>
      </form>

      <table>
        <thead>
          <tr>
            <th>no</th>
            <th>nama</th>
            <th>telepon</th>
            <th>merk</th>
            <th>kerusakan</th>
            <th>kode pesanan</th>
            <th>tanggal dan waktu</th>
            <th>unduh</th>
            <th>status</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody>
          <?php $index = 1; ?>
          <?php
          while ($row = mysqli_fetch_assoc($products)) {
          ?>
            <tr>
              <td><?= $index; ?></td>
              <td><?= $row['nama_lengkap']; ?></td>
              <td><?= $row['telepon']; ?></td>
              <td><?= $row['merk']; ?></td>
              <td><?= $row['detail']; ?></td>
              <td><?= $row['token']; ?></td>
              <td><?= $row['tanggal']; ?> / <?= $row['jam']; ?></td>
              <td>
  <?php if (!empty($row['foto']) && file_exists($row['foto'])) : ?>
    <a href="<?= $row['foto']; ?>" download="<?= basename($row['foto']); ?>">download</a>
  <?php else : ?>
    Foto tidak tersedia
  <?php endif; ?>
</td>
              <td><?= $row['status']; ?></td>
              <td>
                <?php if ($row['status'] == 'pending') : ?>
                  <a class="accept-link" href="?accept_id=<?= $row['id_pesan']; ?>">Terima</a>
                <?php endif; ?>
                <a class="delete-link" href="?delete_id=<?= $row['id_pesan']; ?>" onclick="return confirm('apakah anda ingin menolak orderan ini?')">Tolak</a>
              </td>
            </tr>
            <?php $index++; ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </section>
</main><!-- End #main -->

<?php require_once("{$base_dir}pages{$ds}core{$ds}footer.php"); ?>
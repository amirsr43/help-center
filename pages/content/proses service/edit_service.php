<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");
require '../../core/connection.php';

require_once 'OrderManager.php';

$orderManager = new OrderManager($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_order"])) {
    $orderId = $_POST["order_id"];
    $newDetail = $_POST["new_detail"];
    $newPrice = $_POST["new_price"];
    if (isset($_POST["new_status"]) && isset($_POST["order_id"])) {
        $orderId = $_POST["order_id"];
        $newStatus = $_POST["new_status"];

        $result = $orderManager->updateOrderStatus($orderId, $newStatus);

        if ($result) {
            echo "Status updated successfully.";
        } else {
            echo "Failed to update the status.";
        }
    }


    $result = $orderManager->editOrder($orderId, $newDetail, $newPrice);

    if ($result) {
        echo "berhasil diubah";
    } else {
        echo "Failed to update the order.";
    }
}

if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    $order = $orderManager->getOrderById($orderId); // Implement this method to fetch order details by ID
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Order</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Edit Order</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="row">
            <?php if (!empty($order)) : ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <input type="hidden" name="order_id" value="<?= $order['id_pesan']; ?>">
                    <label for="new_detail">New Detail:</label>
                    <input type="text" name="new_detail" value="<?= $order['detail']; ?>"><br><br>
                    <label for="new_price">New Price:</label>
                    <input type="number" name="new_price" value="<?= $order['price']; ?>"><br><br>
                    <label for="new_status">Update Status:</label>
                    <select name="new_status">
                        <option value="sedang_proses">sedang_proses</option>
                        <option value="pesanan_selesai">pesanan_selesai</option>
                    </select><br><br>
                    <button type="submit" name="edit_order">Update Order</button>
                </form>
            <?php else : ?>
                <p>No order found for editing.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php require_once("{$base_dir}pages{$ds}core{$ds}footer.php"); ?>

<style>
    /* Global Styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
    }

    .main {
        padding: 20px;
    }

    .pagetitle {
        margin-bottom: 20px;
    }

    /* Section Styles */
    .section.dashboard {
        margin: 20px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

    /* Form Input and Button Styles */
    input[type="text"],
    input[type="number"],
    input[type="file"],
    button[type="submit"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        box-sizing: border-box;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Center the Form Elements */
    form {
        max-width: 400px;
        margin: 0 auto;
    }

    .judul {
        text-align: center;
        margin-bottom: 20px;
    }

    select[name="new_status"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        box-sizing: border-box;
        appearance: none;
        background-image: linear-gradient(45deg, transparent 50%, #ccc 50%), linear-gradient(135deg, #ccc 50%, transparent 50%);
        background-position: calc(100% - 20px) calc(1em + 2px), calc(100% - 15px) calc(1em + 2px);
        background-size: 5px 5px, 5px 5px;
        background-repeat: no-repeat;
    }

    select[name="new_status"]:hover {
        border-color: #007bff;
    }

    select[name="new_status"]::-ms-expand {
        display: none;
    }

    select[name="new_status"]:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }
</style>
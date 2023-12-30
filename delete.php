<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Data</title>
</head>

<body>
    <h1>Product Data</h1>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Product Image</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require './../config/db.php';

            if (isset($_GET['delete_id'])) {
                $deleteId = $_GET['delete_id'];
                $deleteQuery = "DELETE FROM products WHERE id = $deleteId";
                mysqli_query($db_connect, $deleteQuery);
            }

            $products = mysqli_query($db_connect, "SELECT * FROM products");
            $no = 1;

            while ($row = mysqli_fetch_assoc($products)) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['price']; ?></td>
                    <!-- <td><img src="<?= $row['image']; ?>" width="100"></td> -->
                    <td><a href="<?= $row['image']; ?>" target="_blank">Download</a></td>
                    <td>
                        <a href="edit_product.php?id=<?= $row['id']; ?>">Edit</a>
                        <a href="?delete_id=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>

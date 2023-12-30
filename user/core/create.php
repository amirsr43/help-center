<?php
require_once("connection.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $deskripsi = $_POST['deskripsi'];
    $tempImage = $_FILES['image']['tmp_name'];

    $randomFilename = time() . '-' . md5(rand()) . '-' . $image;

    $uploadDirectory = 'C:/xampp/htdocs/store/'; // Customize to match your server configuration
    $uploadPath = $uploadDirectory . $randomFilename;

    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif'); // Allowed extensions

    $fileExtension = strtolower(pathinfo($uploadPath, PATHINFO_EXTENSION)); // Get file extension

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Hanya file gambar yang diizinkan: JPG, JPEG, PNG, GIF";
        exit();
    }

    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); // Create directory if not exists
    }

    if (move_uploaded_file($tempImage, $uploadPath)) {
        $imagePath = '/store/' . $randomFilename;
        mysqli_query($conn, "INSERT INTO products (name, price, image, deskripsi) VALUES ('$name', '$price', '$imagePath','$deskripsi')");
        header("Location: ./user/content/store/store.php?success=1");
        exit();
    } else {
        echo "Gagal mengunggah file";
    }
}

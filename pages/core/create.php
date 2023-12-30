<?php
require_once("connection.php");

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];
    $fileExtension = strtolower(pathinfo($image, PATHINFO_EXTENSION));

    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

    // Validasi tipe file dengan getimagesize
    $image_info = getimagesize($tempImage);
    if (!$image_info || !in_array($fileExtension, $allowedExtensions)) {
        echo "Hanya file gambar yang diizinkan: JPG, JPEG, PNG, GIF";
        exit();
    }

    $randomFilename = time() . '-' . md5(rand()) . '-' . $image;
    $uploadDirectory = 'path/to/upload/directory/';
    $uploadPath = $uploadDirectory . $randomFilename;

    // Pastikan direktori penyimpanan ada dan memiliki izin yang benar
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    if (move_uploaded_file($tempImage, $uploadPath)) {
        $imagePath = 'path/to/upload/directory/' . $randomFilename;

        $stmt = mysqli_prepare($conn, "INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $name, $price, $imagePath);
        mysqli_stmt_execute($stmt);


        header("Location: https://recoveryucomputer.com/pages/content/store/store.php?success=1");
        exit();
    } else {
        echo "Gagal mengunggah file";
    }
}

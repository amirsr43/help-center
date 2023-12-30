<?php
require_once("connection.php");
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $merk = $_POST['merk'];
    $detail = $_POST['detail'];
    $token = $_POST['token'];
    $idPesan = $_POST['id_pesan'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $telepon = $_POST['telepon'];

    // Pastikan 'price' ada dalam form HTML
    if (isset($_POST['price'])) {
        $price = $_POST['price'];
    } else {
        $price = 0; // Atau berikan nilai default jika tidak ada
    }

    $tempFoto = $_FILES['foto']['tmp_name'];
    $foto = $_FILES['foto']['name'];

    $randomFilename = time() . '-' . md5(rand()) . '-' . $foto;

    $uploadDirectory = 'path/to/upload/directory/'; // Sesuaikan dengan direktori yang sesuai

    $uploadPath = $uploadDirectory . $randomFilename;

    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif'); // Ekstensi file yang diizinkan

    $fileExtension = strtolower(pathinfo($foto, PATHINFO_EXTENSION)); // Dapatkan ekstensi file

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "Hanya file gambar yang diizinkan: JPG, JPEG, PNG, GIF";
        exit();
    }

    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true); // Buat direktori jika tidak ada
    }

    if (move_uploaded_file($tempFoto, $uploadPath)) {
        $fotoPath = 'path/to/uploaded/files/' . $randomFilename; // Sesuaikan dengan path penyimpanan file

        // Gunakan parameterized query untuk INSERT dan bind_param untuk mencegah SQL injection
        $sql = "INSERT INTO service_requests (merk, detail, foto, token, id_pesan, tanggal, jam, nama_lengkap, telepon, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssi", $merk, $detail, $fotoPath, $token, $idPesan, $tanggal, $jam, $nama_lengkap, $telepon, $price);

        if ($stmt->execute()) {
            echo "Data berhasil disimpan ke database";
            header("Location: /final/user/content/service/service.php?success=1");
            exit();
        } else {
            echo "Error: " . $stmt->error; // Pesan error jika terjadi masalah pada query
        }
    } else {
        echo "Gagal mengunggah file";
    }
}

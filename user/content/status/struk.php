<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}user{$ds}core{$ds}header.php");
require_once("../../core/connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 75vh;
            background-color: #f5f5f5;
        }

        .struk-content {
            width: 100%;
            max-width: 800px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        h3 {
            font-size: 25px;
            margin-bottom: 10px;
        }

        p {
            margin: 5px 0;
            line-height: 1.4;
        }

        .pagetitle {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="struk-content">
                <?php
                // Pastikan untuk menghubungkan ke database atau mengambil data yang diperlukan untuk cetak struk
                // Sertakan file koneksi database atau lakukan inisialisasi koneksi di sini
                $databaseHost = 'localhost';
                $databaseName = 'user_db';
                $databaseUsername = 'root';
                $databasePassword = '';

                $conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

                // Ambil ID pesan dari parameter GET
                if (isset($_GET['id'])) {
                    // Sanitasi parameter ID yang diterima dari URL
                    $id_pesan = mysqli_real_escape_string($conn, $_GET['id']);

                    // Lakukan query untuk mengambil informasi pesanan berdasarkan ID
                    $query = "SELECT merk, detail, token, jam, tanggal, telepon, nama_lengkap FROM service_requests WHERE id_pesan = '$id_pesan'";

                    // Lakukan eksekusi query ke database
                    $result = mysqli_query($conn, $query);

                    // Periksa apakah query berhasil dieksekusi dan hasilnya ditemukan
                    if ($result) {
                        // Periksa apakah ada hasil dari query
                        if (mysqli_num_rows($result) > 0) {
                            // Ambil baris data dari hasil query
                            $row = mysqli_fetch_assoc($result);

                            // Ambil informasi yang diperlukan dari baris data
                            $merk = $row['merk'];
                            $detail = $row['detail'];
                            $nama_lengkap = $row['nama_lengkap'];
                            $jam = $row['jam'];
                            $tanggal = $row['tanggal'];
                            $telepon = $row['telepon'];
                            $token = $row['token'];


                            // Cetak struk
                            echo '<div class="pagetitle">
                    <h1 class="judul">Service Receipt</h1>
                        </div>';
                            echo '<h3>Request Anda Diterima</h3>';
                            echo '<p>Anda telah mengisi form Request/Permintaan dan Memilih Layanan Jasa Service Kami. Anda akan
                    langsung dihubungi oleh penyedia jasa kami. Mohon menunggu beberapa jam.
                </p> <br>';
                            echo '<p>Nomor Pesanan <br>' . $token . '</p>';
                            echo '<h1>Data Lengkap</h1>';
                            echo '<b>NAMA LENGKAP</b>';
                            echo '<p>' . $nama_lengkap . '</p>';
                            echo '<b>NO TELEPON</b>';
                            echo '<p>' . $telepon . '</p>';
                            echo '<h1>Ringkasan Menu</h1>';
                            echo '<b>TANGGAL DAN WAKTU PENJEMPUTAN</b>';
                            echo '<p>' . $tanggal . ', ' . $jam . '</p>';
                            echo '<b>TIPE PERANGKAT DAN MERK</b>';
                            echo '<p>Laptop '  . $merk . '</p>';
                            echo '<b>KELUHAN KERUSAKAN</b>';
                            echo '<p>' . $detail . '</p>';
                            echo '<br>
                    <b>Jika dalam waktu 1x24 jam tidak ada telepon dari kami, harap melakukan konfirmasi ulang pada
                        Customer Care recovery u computer di nomor 085899335508 </b>';
                            // Tampilkan informasi pesanan lainnya sesuai kebutuhan

                            // Setelah menampilkan informasi, lakukan pemanggilan fungsi untuk mencetak secara otomatis
                            echo '<script>window.print();</script>'; // Script JavaScript untuk memanggil fungsi print secara otomatis saat halaman terbuka
                        } else {
                            echo 'Informasi pesanan tidak ditemukan';
                        }
                    } else {
                        // Tampilkan pesan kesalahan jika query gagal dieksekusi
                        echo 'Terjadi kesalahan dalam mengambil data pesanan';
                    }
                } else {
                    echo 'ID Pesanan tidak valid';
                }
                ?>
            </div>
        </section>
    </main><!-- End #main -->
</body>

</html>
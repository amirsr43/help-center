<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - Recovery</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="./assets/img/icon.png" rel="icon">
    <link href="./assets/img/icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href=".assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="./assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="./assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="./assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="./assets/css/style.css" rel="stylesheet">

    <!-- Script font awesome -->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="./assets/img/icon.png" alt="">
                <span style="color: orange; font-size:20px;" class="d-none d-lg-block">Recovery U Computer</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a href="login.php" class="login-link">
                        <button type="button" class="login-button">Login</button>
                    </a>
                </li><!-- End Profile Nav -->
            </ul>
        </nav><!-- End Icons Navigation -->
    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link " href="index.php">
                    <i class="bi bi-house"></i>
                    <span>HOME</span>
                </a>
            </li><!-- End Dashboard Nav -->
        </ul>
    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <section class="section dashboard">
            <div class="about">
                <img src="./assets/img/logo-recovery.png">
                <h1>RECOVERY.U COMPUTER</h1>
                <p>
                    Recovery.U Computer merupakan bisnis start-up dibidang teknologi komputer. Recovery.U Computer ini adalah usaha yang diciptakan sejak tahun 2020. Kegiatan usaha Recovery.U Computer yaitu menjual jasa perbaikan, penjualan laptop, PC, dan aksesoris komputer. Manfaat yang dapat dirasakan dari produk Recovery.U Computer ini yaitu produk yang update dan kekinian namun tidak mengurangi fungsinya membuat para konsumen sangat tertarik dan bisa merasakan produk yang relevan untuk digunakan di masa kini.
                </p>
            </div>
            <div class="row">
                <div class="product-list">
                    <?php
                    require_once("./pages/core/connection.php");

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
                                    <a href="login.php">
                                        <img src="<?= $row['image']; ?>" class="card-img-top" alt="...">
                                    </a>
                                    <div class="card-body">
                                        <a href="login.php" class="h5 text-decoration-none text-dark"><?= $row['name']; ?></a>
                                        <ul class="list-unstyled d-flex justify-content-between">
                                            <li class="text-muted text-right">Rp.<?= $row['price']; ?></li>
                                        </ul>
                                        <p class="card-text"></p>
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

            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.5448180798603!2d107.29930787374175!3d-6.323357261872849!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e697785f56d81b9%3A0x2dbeb569177e93bf!2sRECOVERY.U%20COMPUTER!5e0!3m2!1sid!2sid!4v1700229451701!5m2!1sid!2sid" width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            <h3>CONTACT ME</h3>

            <a class="nav-link collapsed" href="https://wa.me/085899335508">
                <i class="bi bi-whatsapp"></i>
                <span>085899335508</span>
            </a>
            <a class="nav-link collapsed" href="https://instagram.com/recoveryu.co?igshid=Yjc0OGI0MDc4OA==">
                <i class="bi bi-instagram"></i>
                <span>Recoveryu.co</span>
            </a>
            <a class="nav-link collapsed" href="https://m.facebook.com/recoveryu.id">
                <i class="bi bi-facebook"></i>
                <span>Recoveryu.id</span>
            </a>
        </section>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Recovery U computer</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://ubpkarawang.ac.id/">Amir,Reffi Dan Nizar</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../../../assets/js/main.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleSidebarBtn = document.querySelector('.toggle-sidebar-btn');

        toggleSidebarBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    </script>

</body>

</html>
<style>
    .login-link {
        text-decoration: none;
    }

    .login-button {
        display: inline-block;
        padding: 8px 16px;
        background-color: orange;
        color: white;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .login-button:hover {
        background-color: #ff8c00;
    }

    @media (max-width: 767px) {
        .about {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .about img {
            width: 100%;
            height: auto;
            max-width: 300px;
            display: block;
            margin: 0 auto 20px;
        }

        iframe {
            max-width: 100%;
            width: 300px;
            height: 200px;
            border: 0;
            margin: 0 auto;
            display: block;
        }

        .copyright {
            font-size: 12px;
        }
    }
</style>
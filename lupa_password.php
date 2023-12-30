<?php
include('./pages/core/connection.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Pastikan email yang dimasukkan valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format. Please enter a valid email address.";
    } else {
        $select = "SELECT * FROM user_form WHERE email = ?";
        $stmt = mysqli_prepare($conn, $select);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Generate token dengan fungsi hash yang lebih aman
            $token = bin2hex(random_bytes(32)); // Ubah menjadi panjang yang sesuai

            $update = "UPDATE user_form SET reset_token = ? WHERE email = ?";
            $stmt = mysqli_prepare($conn, $update);
            mysqli_stmt_bind_param($stmt, 'ss', $token, $email);
            mysqli_stmt_execute($stmt);

            $reset_link = "https://recoveryucomputer.com/reset_password.php?token=$token";
            $to = $email;
            $subject = "Password Reset";
            $message = "Click the following link to reset your password: $reset_link";
            $headers = "From: amirramadhan768@gmail.com"; // Ganti dengan email Anda

            if (mail($to, $subject, $message, $headers)) {
                $message = "Password reset link has been sent to your email. Please check your inbox.";
            } else {
                $message = "Failed to send the password reset link. Please try again later.";
            }
        } else {
            $message = "Email not found. Please enter a valid email address.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pages / Login - Recovery Computer</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/icon.png" rel="icon">
    <link href="assets/img/icon.png" rel="apple-touch-icon">


    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="./assets/css/login.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <head>
        <!-- Add your head content here -->
    </head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Forgot Password</h3>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="submit" name="submit" value="Submit" class="form-btn">
            <p><a href="login.php">Back to Login</a></p>
        </form>
    </div>
</body>

</html>
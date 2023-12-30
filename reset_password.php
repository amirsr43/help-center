<?php
@include './pages/core/connection.php';

if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    // Check if the token is valid and not expired
    $select = "SELECT * FROM user_form WHERE reset_token = '$token' AND reset_expiration > NOW()";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        // Token is valid, allow the user to reset the password
        if (isset($_POST['submit'])) {
            $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
            $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the password and reset_token in the database
                $update = "UPDATE user_form SET password = '$hashed_password', reset_token = NULL, reset_expiration = NULL WHERE reset_token = '$token'";
                if (mysqli_query($conn, $update)) {
                    echo "Password reset successfully. You can now <a href='login.php'>login</a> with your new password.";
                } else {
                    echo "Failed to reset the password. Please try again later.";
                }
            } else {
                $error_msg = 'Passwords do not match.';
            }
        }
    } else {
        // Invalid or expired token
        echo "Invalid or expired token. Please make sure you have the correct link or request a new password reset.";
    }
} else {
    // Token not provided
    echo "Token not provided. Please make sure you have the correct link or request a new password reset.";
}
?>

<!-- ... (existing HTML content) ... -->


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
        <!-- ... (existing head content) ... -->
    </head>

<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Reset Password</h3>
            <?php
            if (isset($error_msg)) {
                echo '<div class="error-msg">' . $error_msg . '</div>';
            }
            ?>
            <input type="password" name="new_password" required placeholder="New Password">
            <input type="password" name="confirm_password" required placeholder="Confirm Password">
            <input type="submit" name="submit" value="Reset Password" class="form-btn">
        </form>
    </div>

    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script> <!-- ... (existing body content) ... -->
</body>


</html>
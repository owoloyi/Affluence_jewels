<?php
require_once('../includes/db.php');
require_once(__DIR__ . '/../functions/common_functions.php');

// Only start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in (assuming you set $_SESSION['username'] on login)
if (isset($_SESSION['username'])) {
    // User is logged in, get their info
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM `user_table` WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $get_user);
    if ($result && mysqli_num_rows($result) > 0) {
        $run_query = mysqli_fetch_assoc($result);
        $user_id = $run_query['user_id'];
    } else {
        // Session exists but user not found in DB, force logout and redirect to login
        session_destroy();
        header("Location: login.php");
        exit();
    }
} else {
    // Not logged in, check if user exists by IP
    $user_ip = getIPAddress();
    $get_user = "SELECT * FROM `user_table` WHERE user_ip='$user_ip' LIMIT 1";
    $result = mysqli_query($conn, $get_user);
    if ($result && mysqli_num_rows($result) > 0) {
        // User exists but not logged in, redirect to login
        header("Location: login.php");
        exit();
    } else {
        // New user, redirect to register
        header("Location: register.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .payment_img {
            width: 50%;
            margin: auto;
            display: block;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center text-info">Payment Options</h2>
    <div class="row d-flex justify-content-center align-items-center mt-5">
        <div class="col-md-6">
            <a href="https://www.paypal.com" target="_blank">
                <img src="../images/pay.png" alt="PayPal Payment" class="payment_img">
            </a>
        </div>
        <div class="col-md-6 text-center">
            <a href="order.php?user_id=<?php echo $user_id; ?>">
                <h2 class="text-primary">Pay Offline</h2>
            </a>
        </div>
    </div>
</div>

</body>
</html>
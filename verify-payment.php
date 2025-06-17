<?php
ob_start();
session_start();
include('includes/db.php');
include('functions/common_functions.php');

// If the user is not authenticated, send back to login
if (!isset($_SESSION['username'])) {
    header("Location: user_login.php");
    exit();
}

// Get user IP address
$ip_address = getIPAddress();

// Clear the cart for this IP address
$delete_cart = "DELETE FROM `cart_details` WHERE ip_address='$ip_address'";
if ($conn && mysqli_query($conn, $delete_cart)) {
    // Cart cleared successfully, redirect to homepage with success message
    header("Location: index.php?payment=success");
    exit();
} else {
    // If unable to clear cart, show error
    ?>
    <h3 class='text-danger text-center'>Unable to clear your cart</h3>
    <p class='text-center'>Please contact support if this problem persists.</p>
    <?php
}

ob_end_flush();
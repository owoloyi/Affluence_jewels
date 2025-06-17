<?php
include('includes/db.php');
include('functions/common_functions.php');
cart();

$get_ip_address = getIPAddress();

// Update quantities
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $product_id => $qty) {
        $update_cart = "UPDATE `cart_details` SET quantity='$qty' WHERE product_id='$product_id' AND ip_address='$get_ip_address'";
        mysqli_query($conn, $update_cart);
    }
    echo "<script>alert('Cart updated successfully!'); window.location.href='cart.php';</script>";
}

// Remove selected items
if (isset($_POST['remove_cart'])) {
    if (!empty($_POST['remove'])) {
        foreach ($_POST['remove'] as $remove_id) {
            $delete_query = "DELETE FROM `cart_details` WHERE product_id='$remove_id' AND ip_address='$get_ip_address'";
            mysqli_query($conn, $delete_query);
        }
        echo "<script>alert('Selected item(s) removed!'); window.location.href='cart.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affluence Jewels</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .cart_image {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }
    </style>
</head>
<body>

<!-- Hero -->
<div class="bg-light">
    <h3 class="text-center">Affluence Jewels</h3>
    <p class="text-center">A touch of Elegance, style and class</p>
</div>

<!-- Cart -->
<div class="container">
    <div class="row">
        <form action="" method="post">
            <?php
            $total_price = 0;
            $cart_query = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
            $result_query = mysqli_query($conn, $cart_query);
            $result_count = mysqli_num_rows($result_query);

            if ($result_count > 0) {
                echo "<table class='table table-bordered'>
                        <thead class='thead-light'>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                                <th colspan='2'>Operations</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = mysqli_fetch_array($result_query)) {
                    $product_id = $row['product_id'];
                    $cart_quantity = $row['quantity'];

                    $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
                    $result_products = mysqli_query($conn, $select_products);
                    $row_product = mysqli_fetch_array($result_products);

                    $product_title = $row_product['product_title'];
                    $product_image1 = $row_product['product_image1'];
                    $product_price = $row_product['product_price'];

                    $product_total = $product_price * $cart_quantity;
                    $total_price += $product_total;

                    echo "
                        <tr>
                            <td>$product_title</td>
                            <td><img src='./admin/product_images/$product_image1' alt='$product_title' class='cart_image'></td>
                            <td><input type='number' name='quantity[$product_id]' class='form-control w-50' value='$cart_quantity' min='1'></td>
                            <td>₦" . number_format($product_total) . "</td>
                            <td><input type='checkbox' name='remove[]' value='$product_id'></td>
                            <td>
                                <input type='submit' name='update_cart' value='Update' class='btn btn-info btn-sm me-2'>
                                <input type='submit' name='remove_cart' value='Remove' class='btn btn-danger btn-sm'>
                            </td>
                        </tr>
                    ";
                }
                echo "</tbody></table>";
            } else {
                echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
            }
            ?>
        </form>

        <!-- Subtotal & Actions -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <?php if ($result_count > 0): ?>
                <h4 class="mb-0">Subtotal: <strong class="text-info">₦<?= number_format($total_price) ?></strong></h4>
                <div>
                    <a href="index.php" class="btn btn-info text-light me-2">Continue Shopping</a>
                    <a href="users_area/checkout.php" class="btn btn-secondary text-light me-2">Checkout</a>

                    <!-- Paystack Payment Form -->
                    <form id="paystackForm" class="d-inline">
                        <input type="hidden" id="email" value="<?php echo $_SESSION['email'] ?? 'test@example.com'; ?>">
                        <input type="hidden" id="amount" value="<?= $total_price * 100 ?>"> <!-- Convert to kobo -->
                        <input type="hidden" id="reference" value="PSK_<?php echo time(); ?>">
                        <button type="button" onclick="payWithPaystack()" class="btn btn-success">Pay with Card</button>
                    </form>
                </div>
            <?php else: ?>
                <h4 class="mb-0">Subtotal: <strong class="text-info">₦0</strong></h4>
                <div>
                    <a href="index.php" class="btn btn-info text-light">Continue Shopping</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include('includes/footer.php'); ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Paystack Inline Script -->
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
function payWithPaystack() {
    var email = document.getElementById("email").value;
    var amount = document.getElementById("amount").value;
    var reference = document.getElementById("reference").value;

    var handler = PaystackPop.setup({
        key: 'pk_test_0b275c0a9e227e2ae47f2a8878f08625a2a62047', // ✅ Replace with your Paystack public key
        email: email,
        amount: amount,
        currency: 'NGN',
        ref: reference,
        callback: function(response) {
            window.location.href = "verify-payment.php?reference=" + response.reference;
        },
        onClose: function() {
            alert('Payment window closed.');
        }
    });
    handler.openIframe();
}
</script>

</body>
</html>

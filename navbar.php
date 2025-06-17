<?php
$loggedIn = isset($_SESSION['username']);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Affluence Jewels</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? ' active' : '' ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'shop.php' ? ' active' : '' ?>" href="shop.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'cart.php' ? ' active' : '' ?>" href="cart.php">Cart</a>
                </li>
                <?php if ($loggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">Orders</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
                <?php if ($loggedIn): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'login.php' ? ' active' : '' ?>" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= basename($_SERVER['PHP_SELF']) == 'register.php' ? ' active' : '' ?>" href="register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<?php
// Connect to database and include common functions
include('includes/db.php');
include('functions/common_functions.php');
session_start();
cart();
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
.hero video {
    object-fit: cover;
    height: 100vh;
    width: 100%;
}
.hero .carousel-caption {
    bottom: 30%;
    background:rgba(0,0,0,0.5);
    padding: 20px;
    border-radius: 10px;
    animation: fadeInDown 1.5s ease;
}
@keyframes fadeInDown {
    0% { transform: translateY(-50px);opacity: 0 }
    100% { transform: translateY(0);opacity: 1 }
}
</style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-info fixed">
    <div class="container-fluid p-0">
        <a class="navbar-brand" href="index.php">
            <img src="./images/logo.png" alt="Logo" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="display_all.php">Products</a></li>
                <?php
                if(isset($_SESSION['username'])){
                  echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_registration.php'>My Account</a></li>";
                    
                }else{
                     echo "<li class='nav-item'><a class='nav-link' href='./users_area/profile.php'>Register</a></li>";
                }
                ?>
                
                
                <li class="nav-item"><a class="nav-link" href="https://wa.me/2347018391251?text=Hi%20Jewelry%20Shop%2C%20I'm%20interested%20in%20your%20products">Contact</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <sup><span class="badge bg-danger"><?php cart_item(); ?></span></sup>
                    </a>
                </li>
                <li class="nav-item">
                    <span class="nav-link">Total: ₦<?php total_cart_price(); ?></span>
                </li>
            </ul>

            <form class="d-flex" action="index.php" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" name="search_data" required>
                <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
            </form>
        </div>
    </div>
</nav>

<!-- Secondary Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-auto">
        <?php
        if (isset($_SESSION['username'])) {
            echo "<li class='nav-item'><a href='#' class='nav-link'>Welcome " . htmlspecialchars($_SESSION['username']) . "</a></li>";
        } else {
            echo "<li class='nav-item'><a href='#' class='nav-link'>Welcome Guest</a></li>";
        }

        if (isset($_SESSION['username'])) {
            echo "<li class='nav-item'><a href='./users_area/user_profile.php' class='nav-link'>My Profile</a></li>";
            echo "<li class='nav-item'><a href='./users_area/logout.php' class='nav-link'>Logout</a></li>";
        } else {
            echo "<li class='nav-item'><a href='./users_area/user_login.php' class='nav-link'>Login</a></li>";
        }
        ?>
    </ul>
</nav>
<?php if (isset($_GET['payment']) && $_GET['payment'] === 'success'): ?>
  <div class="alert alert-success text-center my-3" role="alert">
    ✅ Payment successful! Thank you for your order.
  </div>
<?php endif; ?>



<!-- hero section -->

<section class="hero">
  <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <video src="images/vid.mp4" autoplay muted loop playsinline class="w-100" style="height: 500px; object-fit: cover;"></video>
        <div class="carousel-caption">
          <h1>Welcome to Our Jewelry Store</h1>
          <p>Discover timeless designs made just for you</p>
        </div>
      </div>

      <div class="carousel-item">
        <video src="images/vid1.mp4" autoplay muted loop playsinline class="w-100" style="height: 500px; object-fit: cover;"></video>
        <div class="carousel-caption">
          <h1>Handcrafted Jewelry</h1>
          <p>Every piece tells a unique story</p>
        </div>
      </div>

      <div class="carousel-item">
        <video src="images/vid3.webm" autoplay muted loop playsinline class="w-100" style="height: 500px; object-fit: cover;"></video>
        <div class="carousel-caption">
          <h1>Gems That Last Forever</h1>
          <p>Quality, Beauty, and Durability</p>
        </div>
      </div>

      <div class="carousel-item">
        <video src="images/vid5.webm" autoplay muted loop playsinline class="w-100" style="height: 500px; object-fit: cover;"></video>
        <div class="carousel-caption">
          <h1>Your Jewelry, Your Story</h1>
          <p>Designs crafted just for you</p>
        </div>
      </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>

    <div class="carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
  </div>
</section>





<!-- Hero Section -->
<div class="bg-light py-3">
    <h3 class="text-center">Affluence Jewels</h3>
    <p class="text-center">A touch of Elegance, Style, and Class</p>
</div>

<!-- Main Content -->
<div class="row px-1">
    <!-- Product Column -->
    <div class="col-md-10">
        <div class="row">
            <?php
            if (isset($_GET['search_data_product'])) {
                search_product();
            } elseif (isset($_GET['category'])) {
                get_unique_categories();
            } elseif (isset($_GET['brand'])) {
                get_unique_brands();
            } elseif (isset($_GET['gender'])) {
                get_unique_gender();
            } else {
                getproducts();
            }
            ?>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-2 bg-secondary p-0">
        <!-- Categories -->
        <ul class="navbar-nav text-center">
            <li class="nav-item bg-info">
                <a href="#" class="nav-link text-light"><h4>Category</h4></a>
            </li>
            <?php getcategories(); ?>
        </ul>

        <!-- Brands -->
        <ul class="navbar-nav text-center">
            <li class="nav-item bg-info">
                <a href="#" class="nav-link text-light"><h4>Jewelry Brands</h4></a>
            </li>
            <?php getbrands(); ?>
        </ul>

        <!-- Gender -->
        <ul class="navbar-nav text-center">
            <li class="nav-item bg-info">
                <a href="#" class="nav-link text-light"><h4>Gender</h4></a>
            </li>
            <?php getgender(); ?>
        </ul>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center p-4 mt-5">
    <div class="container">
        <h5 class="mb-3">Subscribe to Our Newsletter</h5>
        <form class="d-flex flex-column flex-sm-row gap-2 justify-content-center mb-4" method="post" action="subscribe.php">
            <input type="email" name="email" class="form-control w-auto" placeholder="Enter your email" required>
            <button type="submit" class="btn btn-primary">Subscribe</button>
        </form>

        <div class="social-icons mb-3">
            <a href="https://wa.me/2347018391251?text=Hi%20Jewelry%20Shop%2C%20I'm%20interested%20in%20your%20products." class="text-white me-3" target="_blank" rel="noopener">
                <i class="fab fa-whatsapp fa-lg"></i>
            </a>
            <a href="https://instagram.com/grandsabor_restaurantabuja" class="text-white me-3" target="_blank" rel="noopener">
                <i class="fab fa-instagram fa-lg"></i>
            </a>
            <a href="https://www.facebook.com/yourjewelrystore" class="text-white me-3" target="_blank" rel="noopener">
                <i class="fab fa-facebook fa-lg"></i>
            </a>
        </div>

        <p class="mb-0">&copy; 2025 Affluencity Jewelry Shop. All rights reserved.</p>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button id="scrollTopBtn" class="btn btn-secondary rounded-circle shadow d-flex align-items-center justify-content-center"
        style="width: 50px; height: 50px; position: fixed; bottom: 20px; right: 20px; z-index: 1050; display: none;"
        aria-label="Scroll to top" title="Scroll to top">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Scroll Script -->
<script>
    const scrollBtn = document.getElementById('scrollTopBtn');
    window.onscroll = () => {
        scrollBtn.style.display = window.scrollY > 200 ? 'block' : 'none';
    };
    scrollBtn.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

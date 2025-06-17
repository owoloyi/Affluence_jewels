<!-- connect to db -->

<?php
include('includes/db.php');
include('functions/common_functions.php');
cart();
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>affleunce_jewels</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- fontawsom link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- css link -->
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid p-0">
            <img src="./images/logo.png" class="logo_img" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="display_all.php">products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Acoount</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup></<?php cart_item();?>sup></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Total Price   <?php total_cart_price(); ?></a>
                    </li>

                </ul>
                <form class="d-flex" action="search_product.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" name="search_data"
                        aria-label="Search">

                    <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                </form>
            </div>
        </div>
    </nav>

    <!-- second nav -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a href="#" class="nav-link">Welcome Guest</a>
            </li>
            <li class="nav-item">
                <a href="./users/user_login.php" class="nav-link">Login</a>
        </ul>
    </nav>

    <!-- welcome hero -->
    <div class="bg-light">
        <h3 class="text-center">Affleunce Jewels</h3>
        <p class="text-center">A touch of Elegance, style and class </p>
    </div>

    <!-- product section-->
    <div class="row px-1">
        <div class="col-md-10">
            <!-- all products -->
            <div class="row">
  
               
                <?php
                //calling the function to get products
                view_details();
                get_unique_categories();
                get_unique_brands();
                get_unique_gender();
                ?>

                <!-- row end -->
            </div>
            <!-- column end -->
        </div>


        <div class="col md-2 bg-secondary p-0">
            <!-- side nav brands to be displayed-->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-info">
                    <a href="#" class="nav-link text-light text-center">
                        <h4>Category</h4>
                    </a>
                </li>
                <?php
                getcategories();

                ?>

            </ul>
            <!-- brand to be displayed -->
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-info">
                    <a href="#" class="nav-link text-light text-center">
                        <h4 class="w-100 text-center m-0">Jewelry Brands</h4>
                    </a>
                </li>
                <?php getbrands(); ?>



                <!-- Gender -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light text-center">
                            <h4>Gender</h4>
                        </a>
                    </li>
                    <?php
                    getgender();
                    ?>
                </ul>
            </ul>
</div>







            <!-- footer link -->
            <?php
            include("./includes/footer.php");
            ?>

       
        <!-- Scroll to Top Button -->
        <button id="scrollTopBtn"
            class="btn btn-secondary rounded-circle shadow d-flex align-items-center justify-content-center"
            style="width: 50px; height: 50px; position: fixed; bottom: 20px; right: 20px; z-index: 1050; display: none;"
            aria-label="Scroll to top" title="Scroll to top">
            <i class="fas fa-arrow-up"></i>
        </button>

        <!-- Scroll to Top Script -->
        <script>
            const scrollBtn = document.getElementById('scrollTopBtn');
            window.onscroll = () => {
                scrollBtn.style.display = window.scrollY > 200 ? 'block' : 'none';
            };
            scrollBtn.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
        </script>




        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</body>

</html>
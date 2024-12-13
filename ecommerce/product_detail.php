<?php
include('includes/connect.php');
include('functions/common_functions.php');

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
} else {
    echo "Product ID not provided.";
}

$id_query = "SELECT * FROM products WHERE product_id=$product_id";
$id_result = mysqli_query($con,$id_query);
$product = mysqli_fetch_assoc($id_result);
$product_title = $product['product_title'];
$product_description = $product['product_description'];
$product_image1 = $product['product_image1'];
$product_image2 = $product['product_image2'];
$product_image3 = $product['product_image3'];
$product_price = $product['product_price'];
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhucMart</title>

    <link rel="stylesheet" href="style.css">
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- style css -->
</head>
<body>

<div class="container-fluid">

    <!-- header start -->
    <header>
    <nav class="navbar navbar-expand-lg d-flex mb-3 top-bar row">
        <!-- logo -->
        <a href="#" class="col-3"><img class="logo" src="imgs/Logo.png" alt="LOGO"></a>
        <!-- search -->
        <form class="d-flex align-items-center col-6">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
        <!-- icons -->
        <div class="col-3 d-flex justify-content-center icons">
          <a class="me-1" href="user/user_login.php"><i class="fa-solid fa-right-to-bracket" style="color: #ffffff"></i></a>
          <a class="me-1" href="#"><i class="fa-solid fa-user" style="color: #ffffff"></i></a>
          <a class="me-1" href="cart.php"><i class="fa-solid fa-cart-shopping" style="color: #ffffff"></i></a>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav d-flex justify-content-between" style="width: 100%">
                <li class="nav-item text-center">
                <a class="nav-link fs-5" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item text-center">
                <a class="nav-link fs-5" href="products.php">Products</a>
                </li>
                <li class="nav-item dropdown text-center">
                    <a class="nav-link dropdown-toggle fs-5" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Category
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                      $select_categories="SELECT * FROM categories";
                      $result_categories=mysqli_query($con, $select_categories);
                      //echo row_data
                      while($row_data=mysqli_fetch_assoc($result_categories)){
                      $category_title=$row_data['category_title'];
                      $category_id=$row_data['category_id'];
                      echo "<li>
                                <a href='$category_id' class='dropdown-item text-capitalize text-center fs-5'>$category_title</a>
                            </li>";
                      }
                    ?>
                    </ul>
                </li>
                <li class="nav-item dropdown text-center">
                    <a class="nav-link dropdown-toggle fs-5" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Brand
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                      $select_brands="SELECT * FROM brands";
                      $result_brands=mysqli_query($con, $select_brands);
                      //echo row_data
                      while($row_data=mysqli_fetch_assoc($result_brands)){
                      $brand_title=$row_data['brand_title'];
                      $brand_id=$row_data['brand_id'];
                      echo "<li>
                                <a href='$brand_id' class='dropdown-item text-capitalize text-center fs-5'>$brand_title</a>
                            </li>";
                      }
                    ?>
                    </ul>
                </li>
                <li class="nav-item text-center">
                <a class="nav-link fs-5" href="#">Register</a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    </header>
    <!-- header end -->


    <div class="row m-3">
        <!-- side-navigation-bar -->
        <div class="col-md-2 side-nav p-0 d-md-block d-none">
        <!-- brands displayed -->
        <ul class="navbar-nav me-auto text-center">
            <li class="nav-item bg-dark widget-title">
                <a href="#" class="nav-link text-light"><h5>Brands</h5></a>
            </li>
            <?php
                $select_brands="SELECT * FROM brands";
                $result_brands=mysqli_query($con, $select_brands);
                //echo row_data
                while($row_data=mysqli_fetch_assoc($result_brands)){
                  $brand_title=$row_data['brand_title'];
                  $brand_id=$row_data['brand_id'];
                  echo "<li class='nav-item side-item'>
                            <a href='$brand_id' class='nav-link text-dark text-capitalize'>$brand_title</a>
                        </li>";
                }
            ?>
        </ul>

        <!-- category displayed -->
        <ul class="navbar-nav me-auto text-center">
            <li class="nav-item bg-dark">
                <a href="#" class="nav-link text-light"><h5>Categories</h5></a>
            </li>
            <?php
                $select_categories="SELECT * FROM categories";
                $result_categories=mysqli_query($con, $select_categories);
                //echo row_data
                while($row_data=mysqli_fetch_assoc($result_categories)){
                  $category_title=$row_data['category_title'];
                  $category_id=$row_data['category_id'];
                  echo "<li class='nav-item side-item'>
                            <a href='$category_id' class='nav-link text-dark text-capitalize'>$category_title</a>
                        </li>";
                }
            ?>
        </ul>
        </div>
        <!-- product-detail -->
        <div class="product-content product-wrap clearfix product-detail col-md-10">
            <div class="row">
                <!-- image -->
                <div class="col-md-6">
                <div class="product-image">
                    <div id="myCarousel-2" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#myCarousel-2" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#myCarousel-2" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#myCarousel-2" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <!-- Slide 1 -->
                            <div class="carousel-item active">
                                <img src="admin/product_images/<?php echo $product_image1 ?>" class="d-block w-100 prod-img-top" alt="" />
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <img src="admin/product_images/<?php echo $product_image2 ?>" class="d-block w-100 prod-img-top" alt="" />
                            </div>
                            <!-- Slide 3 -->
                            <div class="carousel-item">
                                <img src="admin/product_images/<?php echo $product_image3 ?>" class="d-block w-100 prod-img-top" alt="" />
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel-2" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel-2" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                </div>
                <!-- end_image -->
                <div class="col-md-6">
                    <h2><?php echo $product_title ?></h2>
                    <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                    <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                    <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                    <i class="fa-solid fa-star fa-lg" style="color: #FFD43B;"></i>
                    <i class="fa-solid fa-star fa-lg text-muted" style="color: #FFD43B;"></i>
                    <h4>(109) Votes</h4>
                <hr>
                    <blockquote>
                        <?php echo $product_description ?>
                    </blockquote>
                <hr>
                <h1 style="font-size: 2rem; font-weight: bold; color: #28a745; margin: 0;">
                    $<?php echo $product_price ?> 
                </h1>
                <a href='index.php?add-to-cart=<?php echo $product_id ?>' class="btn btn-dark my-4 px-5 py-2">Add to cart</a>
                </div>
            </div>
        </div>
    </div>


    <footer class="bg-dark p-3 text-center text-light row">
        <p>All right reserved - Designed by Phuc 2024 -</p>
    </footer>
</div>
<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
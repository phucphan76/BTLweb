<?php
include('includes/connect.php');
include('functions/common_functions.php');
if(isset($_GET['add-to-cart'])){
    $product_id=$_GET['add-to-cart'];
    addToCart($product_id);
} 
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
  
<!-- nav-bar -->
  <div class="container-fluid">
    
    <!-- first child -->
    <header>
    <nav class="navbar navbar-expand-lg d-flex mb-3 top-bar row">
        <!-- logo -->
        <a href="#" class="col-3"><img class="logo" src="imgs/Logo.png" alt="LOGO"></a>
        <!-- search -->
        <form class="d-flex align-items-center col-6" action="search.php" method="get">
            <input class="form-control me-2" type="search" name="search_data" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit" name="search_data_product" value="Search">Search</button>
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
                <a class="nav-link fs-5 active" aria-current="page" href="index.php">Home</a>
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
                <a class="nav-link fs-5" href="user/user_registration.php">Register</a>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    </header>

    <!-- third child -->
    <!-- <div class="bg-light row">
        <h3 class="text-center">Hidden Store</h3>
        <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, sunt.</p>
    </div> -->

    <!-- fourth child -->
    <div class="my-3 shadow"> 
<div id="carouselExampleIndicators" class="carousel slide custom-carousel" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="imgs/slide1.png" class="d-block w-100" alt="SLIDE1">
    </div>
    <div class="carousel-item">
      <img src="imgs/slide2.png" class="d-block w-100" alt="SLIDE2">
    </div>
    <div class="carousel-item">
      <img src="imgs/slide3.gif" class="d-block w-100" alt="SLIDE3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    </div>
    
    <!-- fifth child -->
    <div class="container-fluid">
      <div class="mt-5 mb-4 text-center">
        <h2 class="m-0">New products</h2>
      </div>
      <!-- products slider-->
      <div id="productCarousel" class="carousel slide product-carousel" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php
            $select_products = "SELECT * FROM products ORDER BY product_id DESC LIMIT 8;";
            getSlideCard($select_products);
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
          <i class="fa-solid fa-circle-arrow-left fa-2xl me-auto" style="color: #000000"></i>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
          <i class="fa-solid fa-circle-arrow-right fa-2xl ms-auto" style="color: #000000"></i>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <!-- sixth child -->
    <div class="container my-2 py-5 shadow">
    <h1 class="text-center mb-3 brand-headlines">Our Popular Brands</h1>
    <p class="text-center mx-5 mb-2 brand-description">Voluptas itaque nisi possimus, eveniet vel officiis. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem, consectetur.</p>
    <div class="row text-center brand-wrapper">
      <!-- Image 1 -->
      <div class="col-md-4 my-3 brand-card">
        <img src="imgs/brand1.png" alt="Image 1" class="circle-image">
        <button class="btn btn-dark d-block mx-auto mt-3">Shop Now</button>
      </div>
      <!-- Image 2 -->
      <div class="col-md-4 my-3 brand-card">
        <img src="imgs/brand2.png" alt="Image 2" class="circle-image">
        <button class="btn btn-dark d-block mx-auto mt-3">Shop Now</button>
      </div>
      <!-- Image 3 -->
      <div class="col-md-4 my-3 brand-card">
        <img src="imgs/brand3.png" alt="Image 3" class="circle-image">
        <button class="btn btn-dark d-block mx-auto mt-3">Shop Now</button>
      </div>
    </div>
    </div>

    <!-- seventh child -->
    <div class="container-fluid">
      <div class="mt-5 mb-4 text-center">
        <h2 class="m-0">Modern Cooktop</h2>
      </div>
      <!-- products slider-->
      <div id="productCarousel1" class="carousel slide product-carousel" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php
            $select_products = "SELECT * FROM products WHERE category_id = 1 LIMIT 8;";
            getSlideCard($select_products);
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel1" data-bs-slide="prev">
          <i class="fa-solid fa-circle-arrow-left fa-2xl me-auto" style="color: #000000"></i>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel1" data-bs-slide="next">
          <i class="fa-solid fa-circle-arrow-right fa-2xl ms-auto" style="color: #000000"></i>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <!-- eigth child -->
    <div class="container my-4 px-5 shadow banner">
      <img src="imgs/banner1.jpg" alt="" class="banner-img d-block">
    </div>
    <!-- seventh child -->
    <div class="container-fluid">
      <div class="mt-5 mb-4 text-center">
        <h2 class="m-0">High Quality Air Purifier</h2>
      </div>
      <!-- products slider-->
      <div id="productCarousel3" class="carousel slide product-carousel" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php
            $select_products = "SELECT * FROM products WHERE category_id = 1 LIMIT 8;";
            getSlideCard($select_products);
          ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel3" data-bs-slide="prev">
          <i class="fa-solid fa-circle-arrow-left fa-2xl me-auto" style="color: #000000"></i>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel3" data-bs-slide="next">
          <i class="fa-solid fa-circle-arrow-right fa-2xl ms-auto" style="color: #000000"></i>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>

  
  <!-- last child -->
  <footer class="bg-dark p-3 text-center text-light row">
      <p>All right reserved - Designed by Phuc 2024 -</p>
  </footer>
  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
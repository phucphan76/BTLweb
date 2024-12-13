<?php
include('includes/connect.php');
include('functions/common_functions.php');

if(isset($_GET['search_data_product'])){
    $search_data = $_GET['search_data'];
}

// Set the number of products per page
$products_per_page = 9;

// Get the current page from the URL, default to 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($page - 1) * $products_per_page;
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
        <form class="d-flex align-items-center col-6" action="search.php" method="get">
        <input class="form-control me-2" type="search" name="search_data" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light" type="submit" name="search_data_product" value="Search">Search</button>
        </form>
        <!-- icons -->
        <div class="col-3 d-flex justify-content-center icons">
          <a class="me-1" href="#"><i class="fa-solid fa-right-to-bracket" style="color: #ffffff"></i></a>
          <a class="me-1" href="#"><i class="fa-solid fa-user" style="color: #ffffff"></i></a>
          <a class="me-1" href="#"><i class="fa-solid fa-cart-shopping" style="color: #ffffff"></i></a>
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
        <div class="col-md-2 side-nav p-0 d-none d-md-block">
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
        <!-- display products -->
        <div class="col-md-10">
            <div class="bg-dark text-light text-center rounded fs-2">
                Result for: "<?php echo $search_data?>"
            </div>
            <div class="row my-2">
                <?php
                    $select_products="SELECT * FROM products where product_keywords LIKE '%$search_data%' LIMIT $products_per_page OFFSET $offset";
                    getCard($select_products);
                ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center p-3">
                        <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                        </li>
                        <?php 
                        $total_products_query = "SELECT COUNT(*) AS total FROM products where product_keywords LIKE '%$search_data%'";
                        $result = mysqli_query($con, $total_products_query);
                        $total_products = $result->fetch_assoc()['total'];
                        // Calculate the total number of pages
                        $total_pages = ceil($total_products / $products_per_page);
                        for ($i=1; $i <= $total_pages; $i++) { 
                            echo "<li class='page-item'><a class='page-link' href='?search_data=$search_data&search_data_product=Search&page=$i'>$i</a></li>";
                        }
                        ?>
                        <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>  
            </div>
        </div>
        
    </div>


    <!-- <footer class="bg-dark p-3 text-center text-light row">
        <p>All right reserved - Designed by Phuc 2024 -</p>
    </footer> -->
</div>

</body>
</html>
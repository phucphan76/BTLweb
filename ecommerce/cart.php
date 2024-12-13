<?php
include('includes/connect.php');
include('functions/common_functions.php');

if(isset($_POST['update_quantity'])){
    $product_id=$_POST['product_id'];
    $quantity=$_POST['quantity'];
    updateQuantity($quantity, $product_id);
}
if(isset($_POST['remove_item'])){
    $product_id=$_POST['product_id'];
    removeCartItem($product_id);
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
                <a class="nav-link fs-5 active" href="#">Products</a>
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

    <div class="container-fluid">                  
    <div class="row m-3">
        <!-- Cart items -->
        <div class="col-lg-9 col-12">
            <!-- Title -->
            <div class="bg-dark text-light text-center rounded fs-3 py-2">
                Shopping Cart
            </div>
            <?php
                $get_ip_add = getIPAddress();
                $total_price = 0;
                $button_id = 0;
                $query = "SELECT p.*, cd.quantity 
                          FROM cart_details cd
                          INNER JOIN products p ON cd.product_id = p.product_id
                          WHERE cd.ip_address = '$get_ip_add';";
                $result_product_id = mysqli_query($con, $query);
                if(mysqli_num_rows($result_product_id)==0){
                    echo "<h3 class='text-center p-4 my-3 text-danger'>There aren't any items in the cart</h3>";
                }
                // Store products in an array
                $products = [];
                while ($row_data = mysqli_fetch_assoc($result_product_id)) {
                    $products[] = $row_data;
                }
                foreach ($products as $product) {
                    $button_id+=1;
                    $product_id = $product['product_id'];
                    $product_title = $product['product_title'];
                    $product_image1 = $product['product_image1'];
                    $product_price = $product['product_price'];
                    $quantity = $product['quantity'];
                    $total_price+=$product_price*$quantity;
                    echo "<div class='d-block d-md-flex justify-content-between align-items-center my-4 pb-4 border-bottom'>
                        <div class='d-flex align-items-start'>
                            <div class='me-md-3 mb-3 mb-md-0 me-2 w-50 text-center text-md-start'>
                                <img src='admin/product_images/$product_image1' alt='$product_title' class='rounded img-fluid'>
                            </div>
                            <div class='media-body w-100'>
                                <p class='product-card-title fw-bold mb-2'><a href='#' class='text-decoration-none text-dark'>$product_title</a></p>
                                <div class='fs-5 text-primary'>$$product_price</div>
                            </div>
                        </div>
                        <div class='mt-3 mt-md-0 text-center' style=''>
                            <form action='cart.php' method='POST'>
                            <div class='d-grid gap-2 form-group mb-3'>
                                <label for='quantity$button_id' class='form-label small'>Quantity</label>
                                <input class='form-control form-control-sm text-center' type='number' name='quantity' id='quantity$button_id' value='$quantity' min='1' data-initial-quantity='$quantity' oninput='updateButtonState$button_id()'>
                                <input class='d-none' type='text' name='product_id' value='$product_id'>
                                <input class='btn btn-sm btn-outline-primary' type='submit' name='update_quantity' value='Update' id='updateButton$button_id' disabled>
                                <input class='btn btn-sm btn-outline-danger' type='submit' name='remove_item' value='Remove'>
                            </div>
                            </form>
                        </div>
                    </div>";
                    echo '<script>
        function updateButtonState' . $button_id . '() {
            const currentQuantity = document.getElementById("quantity' . $button_id . '").value;
            const initialQuantity = document.getElementById("quantity' . $button_id . '").getAttribute("data-initial-quantity");

            if (currentQuantity !== initialQuantity) {
                document.getElementById("updateButton' . $button_id . '").disabled = false;
            } else {
                document.getElementById("updateButton' . $button_id . '").disabled = true;
            }
        }
    </script>';
                }?>
        </div>
        <!-- Side elements -->
        <div class="col-lg-3 col-12">
            <div class="bg-dark text-light text-center rounded fs-3 py-2">
                Subtotal
            </div>
            <form action="payment.php">
            <div class="h3 font-weight-semibold text-center pt-3 pb-1">$<?php echo $total_price ?></div>
            <input class="d-none" type="text" name="total_price" value="<?php echo $total_price ?>">
            <hr>
            <button class="btn btn-primary w-100" type="submit" name="check_out" <?php if(mysqli_num_rows($result_product_id)==0){echo"disabled";} ?>>Proceed To Checkout</button>
            </form>
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
<?php
include('includes/connect.php');
include('functions/common_functions.php');

// if(!isset($_SESSION['username'])){
//     echo "<script>window.open('http://localhost/ecommerce/user/user_login.php','_self')</script>";
// }else{
//     echo "<script>window.open('http://localhost/ecommerce/payment.php','_self')</script>";
// }


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
                
    <div class="container mt-3">
        <!-- Title -->
        <div class="bg-dark text-light text-center rounded fs-3 py-2">
            Payment
        </div>
        <form action="" method="POST">
    <div class="row py-3 my-3 shadow">
        
        <div class="col-lg-4">
            <h5 class="text-uppercase text-primary fw-bold border-bottom mb-2">Ordering Information</h5>

                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="fullName" id="fullName" placeholder="Enter your full name" required>
                </div>
                <div class="mb-3">
                    <label for="homeAddress" class="form-label">Home Address</label>
                    <input type="text" class="form-control" name="homeAddress" id="homeAddress" placeholder="Enter your address" required>
                </div>
                <div class="mb-3">
                    <label for="phoneNumber" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Enter your phone number" required>
                </div>
                <div class="mb-3">
                    <label for="emailAddress" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="emailAddress" id="emailAddress" placeholder="Enter your email" required>
                </div>

        </div>

        <!-- Payment Methods and Order Note -->
        <div class="col-lg-4">
            <h5 class="text-uppercase text-primary fw-bold border-bottom mb-2">Payment Methods</h5>
            <div class="form-check mb-2">
                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
                <label class="form-check-label" for="creditCard">Credit and Debit Cards</label>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="paymentMethod" id="payLater">
                <label class="form-check-label" for="payLater">Buy Now, Pay Later</label>
            </div>
            <h5 class="text-uppercase text-primary fw-bold border-bottom mb-2">Order Note</h5>
            <textarea class="form-control" id="orderNote" rows="4" placeholder="Add a note for your order..."></textarea>
        </div>

        <!-- Cart Information -->
        <div class="col-lg-4">
            <h5 class="text-uppercase text-primary fw-bold border-bottom mb-2">Your Order</h5>
            <?php
                $get_ip_add = getIPAddress();
                $total_price = 0;
                $query = "SELECT p.*, cd.quantity 
                          FROM cart_details cd
                          INNER JOIN products p ON cd.product_id = p.product_id
                          WHERE cd.ip_address = '$get_ip_add';";
                $result_product_id = mysqli_query($con, $query);
                // Store products in an array
                $products = [];
                while ($row_data = mysqli_fetch_assoc($result_product_id)) {
                    $products[] = $row_data;
                }
                foreach ($products as $product) {
                    $product_id = $product['product_id'];
                    $product_title = $product['product_title'];
                    $product_image1 = $product['product_image1'];
                    $product_price = $product['product_price'];
                    $quantity = $product['quantity'];
                    $total_price+=$product_price*$quantity;
                    echo "<div class='d-flex align-items-center border-bottom pb-3 mb-3'>
                            <img src='admin/product_images/$product_image1' alt='Product' class='rounded img-fluid me-3' style='width: 120px; height: 80px;'>
                            <div>
                                <h6 class='mb-1'><a href='#' class='text-decoration-none text-dark'>$product_title</a></h6>
                                <p class='mb-0 text-primary fw-bold'>$$product_price</p>
                                <span class='text-muted'>Quantity: $quantity</span> 
                            </div>
                        </div>";
                }
            ?>
            <!-- Total -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h6 class="mb-0">Subtotal</h6>
                <p class="mb-0 fs-5 text-danger">$<?php echo $total_price ?></p>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-4" name="order">Place Order</button>
        </div>
        
    </div>
    </form>
    </div>           
</div>

    <footer class="bg-dark p-3 text-center text-light row">
        <p>All right reserved - Designed by Phuc 2024 -</p>
    </footer>
<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</div>

</body>
</html>

<?php

if(isset($_POST['order'])){
    $fullname=$_POST['fullName'];
    $address=$_POST['homeAddress'];
    $contact=$_POST['phoneNumber'];
    $email=$_POST['emailAddress'];
    
    $insert_query="INSERT INTO orders (fullname, address, email, contact)
                    VALUES ('$fullname', '$address', '$email', '$contact')";
    $result=mysqli_query($con, $insert_query);
    if($result){
        echo "<script>alert('Ordering successfully!')</script>";
        echo "<script>window.open('http://localhost/ecommerce','_self')</script>";
    }else{
        echo "<script>alert('FAILED!')</script>";
    }
}

?>
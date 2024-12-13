<?php
include('../includes/connect.php');
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhucMart</title>

    <link rel="stylesheet" href="../style.css">
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
        <a href="#" class="col-3"><img class="logo" src="../imgs/Logo.png" alt="LOGO"></a>
        <!-- search -->
        <form class="d-flex align-items-center col-6">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
        <!-- icons -->
        <div class="col-3 d-flex justify-content-center icons">
          <a class="me-1" href="user_login.php"><i class="fa-solid fa-right-to-bracket" style="color: #ffffff"></i></a>
          <a class="me-1" href="#"><i class="fa-solid fa-user" style="color: #ffffff"></i></a>
          <a class="me-1" href="../cart.php"><i class="fa-solid fa-cart-shopping" style="color: #ffffff"></i></a>
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
                <a class="nav-link fs-5" aria-current="page" href="../index.php">Home</a>
                </li>
                <li class="nav-item text-center">
                <a class="nav-link fs-5" href="#">Products</a>
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
        <div class="row justify-content-center pt-3">
        <div class="col-md-6">
                <h2 class="text-center mb-4">Login Form</h2>
                <div class="form-container py-3 px-5">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                        </div>
                        <a href="">Forgot password</a>
                        <button type="submit" name="login" class="btn btn-primary w-100 mt-3">Login</button>
                        <p class="small fw-bold mt-3">Don't have an account?<a class="text-danger" href="user_registration.php"> Register</a></p>
                    </form>
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

<?php

if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $select_query = "SELECT * FROM user_table WHERE username = '$username';";
    $result_query = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result_query);
    $row_data = mysqli_fetch_assoc($result_query);
    if($row_count>0){
        if(password_verify($password,$row_data['user_password'])){
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('http://localhost/ecommerce','_self')</script>";
        }else{
            echo "<script>alert('Invalid Credentials')</script>";
        }
    }else{
        echo "<script>alert('Invalid Credentials')</script>";
    }
}

?>
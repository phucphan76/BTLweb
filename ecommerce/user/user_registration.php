<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
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
    <style>
        .form-container {
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container m-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Registration Form</h2>
                <div class="form-container py-3 px-5">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter your username" required="required" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email" required="required" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="userImage" class="form-label">User Image</label>
                            <input type="file" class="form-control" id="userImage" required="required" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your password" required="required" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" required="required" name="conf_password">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" rows="3" placeholder="Enter your address" required="required" name="address"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact" placeholder="Enter your phone number" required="required" name="contact">
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="register">Register</button>
                        <p class="small fw-bold mt-3">Already have an account?<a class="text-danger" href="user_login.php"> Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

<?php

if(isset($_POST['register'])){
    $username=$_POST['username'];
    $user_email=$_POST['email'];
    $user_password=$_POST['password'];
    $hash_password=password_hash($user_password, PASSWORD_DEFAULT);   
    $conf_user_password=$_POST['conf_password'];
    $user_image=$_FILES['image']['name'];
    $user_image_tmp=$_FILES['image']['tmp_name'];
    $user_address=$_POST['address'];
    $contact=$_POST['contact'];
    $user_ip=getIPAddress();

    $select_query = "SELECT * FROM user_table WHERE username = '$username' OR user_email = '$user_email' OR contact = '$contact';";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if($num_of_rows>0){
        echo "<script>alert('Username or email or contact already exist!')</script>";
    }else if($user_password!=$conf_user_password){
        echo "<script>alert('Password does not match!')</script>";
    }else{
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");
        $insert_query="INSERT INTO user_table (username, user_email, user_password, user_image, user_ip, user_address, contact)
                       VALUES ('$username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$contact')";
        $result=mysqli_query($con, $insert_query);
        if($result){
            echo "<script>alert('Data inserted successfully!')</script>";
            echo "<script>window.open('http://localhost/ecommerce/user/user_login.php','_self')</script>";
        }else{
            echo "<script>alert('FAILED!')</script>";
        }
    }
}

?>
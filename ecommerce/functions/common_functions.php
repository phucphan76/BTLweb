<?php
function executeQuery($query) {
    global $con;
    $result = $con->query($query);

    // Handle the result based on the query type
    if ($result) {
        if (strtoupper(substr($query, 0, 6)) === "SELECT") {
            // For SELECT queries, return an array of rows
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            // For INSERT, UPDATE, DELETE, etc., return the number of affected rows
            return $con->affected_rows;
        }
    } else {
        // Handle query execution errors
        return false;
    }
}

function getCard($query){
    global $con;
    $result_products = mysqli_query($con, $query);
    // Store products in an array
    $products = [];
    while ($row_data = mysqli_fetch_assoc($result_products)) {
        $products[] = $row_data;
    }

    foreach ($products as $product) {
        $product_id = $product['product_id'];
        $product_title = $product['product_title'];
        $product_image1 = $product['product_image1'];
        $product_price = $product['product_price'];
        echo "<div class='col-6 col-md-4 mb-2'>
                <a href='product_detail.php?product_id=$product_id' class='product-link'>
                <div class='product-card'>
                    <img src='admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                    <div class='card-body'>
                    <h5 class='card_title'>$product_title</h5>
                    <div class='d-flex justify-content-between align-items-center'>
                        <p class='text-center price'>$product_price<span>$</span></p>
                        <a href='index.php?add-to-cart=$product_id' class='btn btn-dark'>Add to cart</a>
                    </div>
                    </div>
                </div>
                </a>
                </div>";
    }
}

function getSlideCard($query){
    global $con;
    $result_products = mysqli_query($con, $query);
    // Store products in an array
    $products = [];
    while ($row_data = mysqli_fetch_assoc($result_products)) {
        $products[] = $row_data;
    }
    // Split products into chunks: 4 for large screens, 2 for small screens
    $chunks = array_chunk($products, 2);

    foreach ($chunks as $index => $chunk) {
        // Add `active` class to the first carousel-item
        $active_class = $index === 0 ? 'active' : '';
        echo "<div class='carousel-item $active_class'>
                <div class='row'>";
        foreach ($chunk as $product) {
        $product_id = $product['product_id'];
        $product_title = $product['product_title'];
        $product_image1 = $product['product_image1'];
        $product_price = $product['product_price'];
        echo "<div class='col-6 mb-2'>
                <a href='product_detail.php?product_id=$product_id' class='product-link' value='$product_id'>
                <div class='product-card'>
                    <img src='admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                    <div class='card-body'>
                    <h5 class='card_title'>$product_title</h5>
                    <div class='d-flex justify-content-between align-items-center'>
                        <p class='text-center price'>$product_price<span>$</span></p>
                        <a href='index.php?add-to-cart=$product_id' class='btn btn-dark'>Add to cart</a>
                    </div>
                    </div>
                </div>
                </a>
                </div>";
        }
        echo " </div>
            </div>";
    }
}

function addToCart($product_id){
    global $con;
    $get_ip_add = getIPAddress();
    $select_query = "SELECT * FROM cart_details WHERE ip_address = '$get_ip_add' AND product_id = $product_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if($num_of_rows>0){
        echo "<script>alert('This item is already present inside cart')</script>";
        echo "<script>window.open('http://localhost/ecommerce/index.php','_self')</script>";
    }else{
        $insert_query="INSERT INTO cart_details (product_id,ip_address,quantity) values 
        ($product_id,'$get_ip_add',1)";
        $result_query=mysqli_query($con,$insert_query);
        echo "<script>alert('Item is added to cart')</script>";
        echo "<script>window.open('http://localhost/ecommerce/index.php','_self')</script>";
    }
}

// total price function 
function total_cart_price(){ 
    global $con; 
    $get_ip_add = getIPAddress(); 
    $total_price=0; 
    $cart_query="SELECT * FROM cart_details where ip_address='$get_ip_add'"; 
    $result=mysqli_query($con, $cart_query); 
    while($row = mysqli_fetch_array($result)) { 
        $product_id=$row['product_id']; 
        $select_products="SELECT * FROM products where product_id=$product_id"; 
        $result_products=mysqli_query($con, $select_products); 
        while($row_product_price=mysqli_fetch_array($result_products)){ 
            $product_price=array($row_product_price['product_price']); 
            $product_values=array_sum($product_price);
            $total_price+=$product_values;
        }
    }
    echo $total_price;
}

function updateQuantity($quantity,$product_id){
    global $con; 
    $get_ip_add = getIPAddress(); 
    $update_query="UPDATE cart_details
                 SET quantity = $quantity
                 WHERE ip_address='$get_ip_add' AND product_id=$product_id"; 
    mysqli_query($con, $update_query); 
}

function removeCartItem($product_id){
    global $con; 
    $get_ip_add = getIPAddress(); 
    $delete_query="DELETE FROM cart_details WHERE ip_address='$get_ip_add' AND product_id=$product_id"; 
    mysqli_query($con, $delete_query); 
}
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  

?>
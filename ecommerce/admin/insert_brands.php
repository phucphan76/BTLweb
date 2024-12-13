<?php
include('../includes/connect.php');
if(isset($_POST['insert_brand'])){
    $brand_title=$_POST['brand_title'];

    //validate brand
    $select_query="SELECT * FROM brands WHERE brand_title='$brand_title'";
    $result_select=mysqli_query($con, $select_query);
    $number=mysqli_num_rows($result_select);
    if($number>0){
        echo "<script>alert('This brand has already existed in the database')</script>";
    }else{
        //insert brand
        $insert_query="insert into brands (brand_title) values ('$brand_title')";
        $result=mysqli_query($con,$insert_query);
        if($result){
            echo "<script>alert('Brand has been inserted successfully')</script>";
        }
    }   
}
?>

<form action="" method="post" class="mb-2">
    <h4 class="text-center">Insert Brands</h4>
    <div class="input-group w-90 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="btn btn-info p-2 my-1" name="insert_brand" value="Insert Brands">
    </div>
</form>
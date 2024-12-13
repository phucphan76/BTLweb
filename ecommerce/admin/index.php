<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
   
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- css file -->
    <link rel="stylesheet" href="../style.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <!-- nav-bar -->
    <div class="container-fluid">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info row">
            <a href="#" class="col-3"><img class="logo" src="../imgs/Logo.png" alt=""></a>
            <div class="container-fluid col-9">
                <nav class="navbar navbar-expand-lg ms-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link">Welcome Guest</a>   
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- second child -->
        <div class="bg-light row">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>

        <!-- third child -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center justify-content-between">
            <!-- Admin Profile Section -->
                <div class="admin-profile text-center">
                    <img src="../imgs/avatar.jpg" alt="Admin Avatar" class="admin-image">
                    <p class="text-light mt-2">Admin Name</p>
                </div>

            <!-- Navigation Buttons -->
                <div class="button text-center">
            <button class="btn btn-info my-1">
                <a href="insert_product.php" class="nav-link text-light">Insert Products</a>
            </button>
            <button class="btn btn-info my-1">
                <a href="#" class="nav-link text-light">View Products</a>
            </button>
            <button class="btn btn-info my-1">
                <a href="index.php?insert_category" class="nav-link text-light">Insert Categories</a>
            </button>
            <button class="btn btn-info my-1">
                <a href="#" class="nav-link text-light">View Categories</a>
            </button>
            <button class="btn btn-info my-1">
                <a href="index.php?insert_brand" class="nav-link text-light">Insert Brands</a>
            </button>
            <button class="btn btn-info my-1">
                <a href="#" class="nav-link text-light">View Brands</a>
            </button>
            <button class="btn btn-info my-1">
                <a href="#" class="nav-link text-light">All Orders</a>
            </button>
            <button class="btn btn-info my-1">
                <a href="#" class="nav-link text-light">All Payments</a>
            </button>
            <button class="btn btn-info my-1">
                <a href="#" class="nav-link text-light">List Users</a>
            </button>
            <button class="btn btn-danger my-1">
                <a href="#" class="nav-link text-light">Log Out</a>
            </button>
                </div>
        </div>
    </div>
        <!-- fourth child -->
         <div class="container my-3">
            <?php 
            if(isset($_GET['insert_category'])){
                include('insert_categories.php');
            }
            if(isset($_GET['insert_brand'])){
                include('insert_brands.php');
            }
            ?>
         </div>

        

    </div>

    <!-- last child -->
    <div class="bg-info p-3 text-center row footer w-100">
        <p>All right reserved - Designed by Phuc 2024 -</p>
    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>